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

class HttpClient
{
    private $_host = null;
    private $_port = null;
    private $_protocol = null;

    const HTTP  = 'http';
    const HTTPS = 'https';

    const HTTP_OK = 200;
    const HTTP_CREATED = 201;
    const HTTP_ACEPTED = 202;

    const POST   = 'POST';
    const GET    = 'GET';
    const DELETE = 'DELETE';

    protected function __construct($host, $port, $protocol)
    {
        $this->_host     = $host;
        $this->_port     = $port;
        $this->_protocol = $protocol;
    }

    /**
    *
    * @param string $host
    * @param integer $port
    * @param string $protocol
    * @return HttpClient
    */
    static public function connect($host, $port = 80, $protocol = self::HTTP)
    {
        return new self($host, $port, $protocol);
    }


    /**
    *
    * @param string $type
    * @param string $url
    * @param array $params
    * @return string
    */
    public function doPost($url, $params = array())
    {
        // Build absolute url
        $url = "{$this->_protocol}://{$this->_host}:{$this->_port}/{$url}";

        $s = curl_init();
        curl_setopt($s, CURLOPT_URL, $url);
        curl_setopt($s, CURLOPT_POST, true);
        curl_setopt($s, CURLOPT_POSTFIELDS, $params);
        curl_setopt($s, CURLOPT_RETURNTRANSFER, true);

        $_out = curl_exec($s);
        $status = curl_getinfo($s, CURLINFO_HTTP_CODE);
        curl_close($s);
        switch ($status) {
            case self::HTTP_OK:
            case self::HTTP_CREATED:
            case self::HTTP_ACEPTED:
                $out = $_out;
                break;
            default:
                throw new Exception("http error: {$status}");
        }
        return $out;
    }

}