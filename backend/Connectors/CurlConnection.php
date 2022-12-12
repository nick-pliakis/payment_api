<?php

namespace Connectors;

use Interfaces\HttpConnection;

class CurlConnection implements HttpConnection
{

    private static $instance = null;
    private $curl_conn;

    private function __construct() {
        $this->curl_conn = curl_init();
        
        curl_setopt($this->curl_conn, CURLOPT_POST, 1);
        curl_setopt($this->curl_conn, CURLOPT_RETURNTRANSFER, 1);
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function setUrl($url) {
        curl_setopt($this->curl_conn, CURLOPT_URL, $url);
        return $this;
    }

    public function setHeaders(array $headers) {
        curl_setopt($this->curl_conn, CURLOPT_HTTPHEADER, $headers);
        return $this;
    }

    public function setData(array $data) {
        curl_setopt($this->curl_conn, CURLOPT_POSTFIELDS, http_build_query($data));
        return $this;
    }

    public function setOption($name, $value) {
        curl_setopt($this->curl_conn, $name, $value);
        return $this;
    }

    public function setOptions(array $options) {
        foreach ($options as $key => $value) {
            $this->setOption($key, $value);
        }
        return $this;
    }

    public function execute() {
        return curl_exec($this->curl_conn);
    }

    public function getConnection() {
        return $this->curl_conn;
    }

    public function closeConnection() {
        curl_close($this->curl_conn);
    }

}