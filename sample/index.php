<?php
include_once('../autoload.php'); 
use Foobar\Reader\Stream as Stream;


$StreamReader = new Stream();
$query = '((foo)*bar*(bar*foo) + (bar*foo)) + (foo*bar)';
$StreamReader->read($query);


?>