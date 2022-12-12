<?php

namespace Interfaces;

interface HttpConnection 
{

    public static function getInstance();

    public function setUrl($url);

    public function setHeaders(array $headers);

    public function setData(array $data);

    public function setOption($name, $value);

    public function setOptions(array $options);

    public function getConnection();

    public function closeConnection();

}