<?php

$dbo = new PDO('mysql:host=localhost;dbname=konacno;charset=utf8', 'root', '');

$target_dir = getcwd().DIRECTORY_SEPARATOR;


if($_FILES["cover_photo"]["tmp_name"] !== "") {
	move_uploaded_file($_FILES["cover_photo"]["tmp_name"], $target_dir. '../images/' . $_FILES['cover_photo']['name']);  
	$shrani = $dbo->prepare("
        UPDATE muzej
        SET title = :title, short_description = :short_description, content = :content, cover_photo = :cover_photo
        WHERE id = :id
    ");

    $shrani->execute([ 
        'title' => $_POST['title'],
        'short_description' => $_POST['short_description'],
        'content' => $_POST['content'],
        'cover_photo' => $_FILES['cover_photo']['name'],
        'id' => $_POST['id']
    ]);
} else {
    $shrani = $dbo->prepare("
        UPDATE muzej
        SET title = :title, short_description = :short_description, content = :content
        WHERE id = :id
    ");

    $shrani->execute([ 
        'title' => $_POST['title'],
        'short_description' => $_POST['short_description'],
        'content' => $_POST['content'],
        'id' => $_POST['id']
    ]);
}

echo "\nPDOStatement::errorInfo():\n";
$arr = $shrani->errorInfo();
print_r($arr);

header("Location: " . '../article.php?id=' . $_POST['id']);