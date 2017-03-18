<?php

require_once ('app/Database.php');

$conn = new Database();
$conn->connect_db();
$conn->createTable();
//$conn->insertData('Ed', 'skjdfhkjsdhfk.jsdbf');
//$conn->updateData('Den', 'sdfsdfsdf',1);
//$conn->deleteData(4);
print_r($conn->selectData());
