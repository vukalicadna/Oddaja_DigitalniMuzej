<?php

$dbo = new PDO('mysql:host=localhost;dbname=konacno;charset=utf8', 'root', '');

$target_dir = getcwd().DIRECTORY_SEPARATOR;;
move_uploaded_file($_FILES["cover_photo"]["tmp_name"], $target_dir. '../images/' . $_FILES['cover_photo']['name']);

$vsiinstrumenti = $dbo->prepare("
    INSERT INTO muzej (title, short_description, category, cover_photo, content)
    VALUES (:title, :short_description, :category, :cover_photo, :content)
");

$vsiinstrumenti->execute([ 
    'title' => $_POST['title'],
    'short_description' => $_POST['short_description'],
    'cover_photo' => $_FILES['cover_photo']['name'],
    'content' => $_POST['content'],
    'category' => $_POST['category']
]);

	echo "\nPDOStatement::errorInfo():\n";
	$arr = $vsiinstrumenti->errorInfo();
	print_r($arr);

header("Location: " . '../article.php?id=' . $dbo->lastInsertId());