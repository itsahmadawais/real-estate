<?php

// Using Medoo namespace
require 'vendor/Medoo.php';
use Medoo\Medoo;
 
$database = new Medoo([
	// required
	'database_type' => 'mysql',
	'database_name' => 'realestate',
	'server' => 'localhost',
	'username' => 'root',
	'password' => ''
]);

define ('ROOT_PATH', realpath(dirname(__FILE__)));
define('BASE_URL', 'http://localhost/realestate/');
?>