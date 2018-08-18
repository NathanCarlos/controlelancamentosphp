<?php
include_once('config.php');

$conexao = new PDO(DB_DRIVE .':host='. DB_HOSTNAME .';dbname='. DB_DATABASE,DB_USERNAME,DB_PASSWORD);

?>