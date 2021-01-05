<?php

$dbo = new PDO('mysql:host=localhost;dbname=konacno;charset=utf8', 'root', '');

$shrani = $dbo->prepare("
    UPDATE muzej
    SET deleted = 1
    WHERE id = :id
");

$shrani->execute(['id' => $_GET['id']]);

echo "\nPDOStatement::errorInfo():\n";
$arr = $shrani->errorInfo();
print_r($arr);

header("Location: " . '../index.php');