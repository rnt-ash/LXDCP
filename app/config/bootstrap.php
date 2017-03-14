<?php
/**
* @copyright Copyright (c) ARONET GmbH (https://aronet.swiss)
* @license AGPL-3.0
*
* This code is free software: you can redistribute it and/or modify
* it under the terms of the GNU Affero General Public License, version 3,
* as published by the Free Software Foundation.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU Affero General Public License for more details.
*
* You should have received a copy of the GNU Affero General Public License, version 3,
* along with this program.  If not, see <http://www.gnu.org/licenses/>
*
*/

use Phalcon\Di\FactoryDefault;
use Phalcon\Config\Adapter\Ini as ConfigIni;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Simple as SimpleView;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Dispatcher\Exception as DispatchException;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Direct as FlashDirect;
use Phalcon\Flash\Session as FlashSession;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Mvc\Router;
use Phalcon\Logger as Logger;
use Phalcon\Logger\Adapter\File as LoggerFileAdapter;

use RNTForest\core\plugins\Security;

// FactoryDefault Dependency Injector
$di = new FactoryDefault();

// Dispatcher
$di->set('dispatcher', function () {

    // Create an EventsManager
    $eventsManager = new EventsManager();

    // Attach a listener
    $eventsManager->attach("dispatch:beforeException", function($event, $dispatcher, $exception) {
        // Handle 404 exceptions
        if ($exception instanceof DispatchException) {
            $dispatcher->forward(array(
                "namespace"  => "RNTForest\\OVZCP\\controllers",
                "controller" => "errors",
                "action" => "show404"
            ));
            return false;
        }
        
        // Alternative way, controller or action doesn't exist
        if ($event->getType() == 'beforeException') {
            switch ($exception->getCode()) {
                case \Phalcon\Dispatcher::EXCEPTION_HANDLER_NOT_FOUND:
                case \Phalcon\Dispatcher::EXCEPTION_ACTION_NOT_FOUND:
                    $dispatcher->forward(array(
                        "namespace"  => "RNTForest\\OVZCP\\controllers",
                        "controller" => "errors",
                        "action" => "show404"
                    ));
                    return false;
            }
        }
    });

    // Instantiate the Security plugin
    $security = new Security();

    // Listen for events produced in the dispatcher using the Security plugin
    $eventsManager->attach('dispatch', $security);

    // Bind the EventsManager to the dispatcher
    $dispatcher = new \Phalcon\Mvc\Dispatcher();
    $dispatcher->setEventsManager($eventsManager);

    return $dispatcher;
});

// Shared configuration service
$di->setShared('config', function () {
    $config = include APP_PATH . "/config/config.php";
    $permissionbase = include APP_PATH . "/config/permissionbase.php";
    $config->merge($permissionbase);
    
    if (is_readable(APP_PATH . '/config/config.ini')) {
        $override = new ConfigIni(APP_PATH . '/config/config.ini');
        $config->merge($override);
    }

    if(substr($config->application->baseUrl,-1,1)!='/'){
        $config->application->baseUrl = $config->application->baseUrl.'/';
    }
    
    return $config;
});

// The URL component is used to generate all kind of urls in the application
$di->setShared('url', function () {
    $config = $this->getConfig();

    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);

    return $url;
});

// set up router
$di->setShared('router',function (){
    
    $router = new Router();
    $router->setDefaultNamespace("RNTForest\\OVZCP\\controllers");
    
    // default
    $router->add(
        '/',
        array(
            "controller" => "index",
            "action" => "index",
        )
    );
    
    // not found
    $router->notFound([
        "controller" => "errors",
        "action"     => "route404",
    ]);
    
    // access
    $router->add(
        '/login',
        array(
            "controller" => "access",
            "action" => "login",
        )
    );
    $router->add(
        '/logout',
        array(
            "controller" => "access",
            "action" => "logout",
        )
    );
    $router->add(
        '/forgot-password',
        array(
            "controller" => "access",
            "action" => "forgotPassword",
        )
    );
    $router->add(
        '/reset-password/(.*)',
        array(
            "controller" => "access",
            "action" => "resetPassword",
            "token" => 1,
        )
    );
    
    // pusher
    $router->add(
        '/push',
        array(
            "controller" => "periodic",
            "action" => "push"
        )    
    ); 
    
    return $router;
});

// Setting up the view component
$di->setShared('view', function () {
    $config = $this->getConfig();

    $view = new View();
    $view->setDI($this);
    $view->setViewsDir($config->application->viewsDir);

    $view->registerEngines([
        '.volt' => function ($view) {
            $config = $this->getConfig();
            $volt = new VoltEngine($view, $this);
            $volt->setOptions([
                'compiledPath' => $config->application->cacheDir,
                'compiledSeparator' => '_',
                'compileAlways' => ($config->application->mode=='debug'?true:false),
            ]);
            
            // modify compiler
            compiler($volt->getCompiler());

            return $volt;
        },
        '.phtml' => PhpEngine::class
    ]);

    return $view;
});

// Setting up the view component
$di->setShared('simpleview', function () {
    $config = $this->getConfig();

    $view = new SimpleView();
    $view->setDI($this);
    $view->setViewsDir($config->application->viewsDir);

    $view->registerEngines([
        '.volt' => function ($view) {
            $config = $this->getConfig();
            $volt = new VoltEngine($view, $this);
            $volt->setOptions([
                'compiledPath' => $config->application->cacheDir,
                'compiledSeparator' => '_',
                'compileAlways' => ($config->application->mode=='debug'?true:false),
            ]);

            // modify compiler
            compiler($volt->getCompiler());

            return $volt;
        },
        '.phtml' => PhpEngine::class
    ]);

    return $view;
});

function compiler($compiler){
    $compiler->addFunction('is_a', 'is_a');
    $compiler->addFunction('get_class', 'get_class');
    $compiler->addFunction('_', function ($resolvedArgs, $exprArgs) {
        return sprintf('$this->translate->query(\'%s\')', $exprArgs[0]['expr']['value']);
    });    
    
    
    $compiler->addFilter('formatBytesHelper', function($resolvedArgs, $exprArgs) 
    {
            return  '\RNTForest\core\libraries\Helpers::formatBytesHelper(' . $resolvedArgs . ');';
    });

    
}

// Database connection is created based in the parameters defined in the configuration file
$di->setShared('db', function () {
    $config = $this->getConfig();

    $class = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
    $params = [
        'host'     => $config->database->host,
        'username' => $config->database->username,
        'password' => $config->database->password,
        'dbname'   => $config->database->dbname,
        'charset'  => $config->database->charset
    ];

    if ($config->database->adapter == 'Postgresql') {
        unset($params['charset']);
    }

    $connection = new $class($params);
    
    // DB logs
    $eventsManager = new Phalcon\Events\Manager();
    $logger = new \Phalcon\Logger\Adapter\File($config->application->logsDir."db.log");
    
    //Listen all the database events
    $eventsManager->attach('db', function($event, $connection) use ($logger) {
        /*
       if ($event->getType() == 'beforeQuery') {
            $sqlVariables = $connection->getSQLVariables();
            if (count($sqlVariables)) {
                $logger->log($connection->getSQLStatement() . ' ' . join(', ', $sqlVariables), Logger::INFO);
            } else {
                $logger->log($connection->getSQLStatement(), Logger::INFO);
            }
        }
        */
    });

    //Assign the eventsManager to the db adapter instance
    $connection->setEventsManager($eventsManager);    
    
    return $connection;
});

// If the configuration specify the use of metadata adapter use it or use memory otherwise
$di->setShared('modelsMetadata', function () {
    return new MetaDataAdapter();
});

// Register the flash service with the Twitter Bootstrap classes
$di->set('flash', function () {
    return new FlashDirect([
        'error'   => 'alert alert-danger',
        'success' => 'alert alert-success',
        'notice'  => 'alert alert-info',
        'warning' => 'alert alert-warning'
    ]);
});
$di->set('flashSession', function () {
    return new FlashSession([
        'error'   => 'alert alert-danger',
        'success' => 'alert alert-success',
        'notice'  => 'alert alert-info',
        'warning' => 'alert alert-warning'
    ]);
});

// Session
$di->setShared('session', function () {
    $session = new SessionAdapter();
    $session->start();

    return $session;
});

// Translation
$di->setShared('translate', function() use($di) {
    $config = $this->getConfig();
    $session = $this->getSession();
    if ($session->has("auth")){
        $locale = $session->auth['locale'];
    } else {
        $locale = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
    }
    $lang = substr($locale,0,2);
    
    if (file_exists($config->application['messagesDir'].$lang.".php")) {
        require $config->application['messagesDir'].$lang.".php";
    } else {
        require $config->application['messagesDir']."en.php";
    }

    return new \Phalcon\Translate\Adapter\NativeArray(array(
        "content" => $messages
    ));
});

// Logger
$di->setShared('logger', function() {
    $config = $this->getConfig();
    return new LoggerFileAdapter($config->application->logsDir."app.log");
});

// Push
$di->setShared('push', function() use ($di) {
    $push = new \RNTForest\core\services\Push($di);
    return $push;
});

// Permissions
$di->setShared('permissions', function() {
    $permissions = new \RNTForest\core\libraries\Permissions();
    return $permissions;
});

// Autoloader
$config = $di->getConfig();
$loader = new \Phalcon\Loader();

$loader->registerNamespaces(array(
    // OVZCP
    "RNTForest\\OVZCP\\controllers" => APP_PATH . "/controllers/",
    "RNTForest\\OVZCP\\models" => APP_PATH . "/models/",
    "RNTForest\\OVZCP\\forms" => APP_PATH . "/forms/",
    "RNTForest\\OVZCP\\libraries" => APP_PATH . "/libraries/",

    // core
    "RNTForest\\core\\controllers" => BASE_PATH . "/vendor/rnt-forest/core/controllers/",
    "RNTForest\\core\\models" => BASE_PATH . "/vendor/rnt-forest/core/models/",
    "RNTForest\\core\\forms" => BASE_PATH . "/vendor/rnt-forest/core/forms/",
    "RNTForest\\core\\services" => BASE_PATH . "/vendor/rnt-forest/core/services/",
    "RNTForest\\core\\libraries" => BASE_PATH . "/vendor/rnt-forest/core/libraries/",
    "RNTForest\\core\\interfaces" => BASE_PATH . "/vendor/rnt-forest/core/interfaces/",
    "RNTForest\\core\\plugins" => BASE_PATH . "/vendor/rnt-forest/core/plugins/",

    // ovz
    "RNTForest\\ovz\\controllers" => BASE_PATH . "/vendor/rnt-forest/ovz/controllers/",
    "RNTForest\\ovz\\models" => BASE_PATH . "/vendor/rnt-forest/ovz/models/",
    "RNTForest\\ovz\\forms" => BASE_PATH . "/vendor/rnt-forest/ovz/forms/",
    "RNTForest\\ovz\\services" => BASE_PATH . "/vendor/rnt-forest/ovz/services/",
    "RNTForest\\ovz\\libraries" => BASE_PATH . "/vendor/rnt-forest/ovz/libraries/",
    "RNTForest\\ovz\\interfaces" => BASE_PATH . "/vendor/rnt-forest/ovz/interfaces/",
    "RNTForest\\ovz\\utilities" => BASE_PATH . "/vendor/rnt-forest/ovz/utilities/",
    
    // ovzhost
    "RNTFOREST\\OVZJOB\\ovz\\jobs" => BASE_PATH . "/vendor/rnt-forest/ovz/ovzhost/ovzjob/ovz/jobs/",
    "RNTFOREST\\OVZJOB\\general\\jobs" => BASE_PATH . "/vendor/rnt-forest/ovz/ovzhost/ovzjob/general/jobs/",
));

$loader->register();

// Composer Autoloading
require_once $config->application->vendorDir.'/autoload.php';
