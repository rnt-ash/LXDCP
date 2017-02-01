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

use Phalcon\Paginator\Adapter\Model as Paginator;
use Phalcon\Filter;

class JobsController extends ControllerBase
{
    public function indexAction(){

        $numberPage = 1;
        $numberPage = $this->request->getQuery("page", "int");

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "id DESC";

        $jobs = Jobs::find($parameters);
        if (count($jobs) == 0) {
            $this->flash->notice("The search did not find any dcoipobjects");
            // go not return and work with empty resultset..
        }

        $limit = 10;
        $paginator = new Paginator([
            'data' => $jobs,
            'limit'=> $limit,
            'page' => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();

        // From-To Anzeige berechnen
        $this->view->page->from_items = $this->view->page->current*$limit-$limit+1;
        $this->view->page->to_items = $this->view->page->current*$limit;
        if($this->view->page->to_items > $this->view->page->total_items)
            $this->view->page->to_items = $this->view->page->total_items;
        
    }
    
    public function updateJobsAction(){
        $push = $this->getPushService();
        $push->pushJobs();
        $this->response->redirect("jobs/index");
        $this->view->disable(); 
    }
    
    /**
    * dummy method only for auto completion purpose
    * 
    * @return Push
    */
    protected function getPushService(){
        return $this->di['push'];
    }
    
    protected function forwardToIndexAction(){
        return $this->dispatcher->forward([
            'action' => 'index',
        ]);
    }
    
    public function deleteAction($id){
        // find item
        $item = Jobs::findFirst($this->filter->sanitize($id, "int"));
        if (!$item) {
            $this->flashSession->error("item was not found");
            return $this->dispatcher->forward([
                'action' => 'index',
            ]);
        }
        
        if($item->getDone() < 1){
            $this->flashSession->error("you can't delete runnig jobs Dude!");
            return $this->dispatcher->forward([
                'action' => 'index',
            ]);
        }

        // try to delete
        if (!$item->delete()) {
            foreach ($item->getMessages() as $message) {
                $this->flashSession->error($message);
            }
            return $this->dispatcher->forward([
                'action' => 'index',
            ]);
        }

        // sucess
        $this->flashSession->success("item was deleted successfully");
        return $this->dispatcher->forward([
            'action' => 'index',
        ]);

    }
}
