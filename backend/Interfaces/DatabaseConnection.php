<?php

namespace Interfaces;

interface DatabaseConnection 
{

    public static function getInstance();

    public function getConnection();

    public function closeConnection();

}