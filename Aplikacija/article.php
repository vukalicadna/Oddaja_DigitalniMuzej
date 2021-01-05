<nav>
    <h1><a href="./index.php">Nazaj na začetno stran</a></h1>
    <button onClick="window.open('./newArticle.php', '_self')">Dodaj novi instrument</button>
</nav>

<?php 
    $dbo = new PDO('mysql:host=localhost;dbname=konacno;charset=utf8', 'root', '');
    $instrument = $dbo->prepare("
        SELECT *
        FROM muzej
        WHERE id = :article_id
    ");

    $instrument->execute([ 'article_id' => $_GET['id'] ]);
    $instrument = $instrument->fetch(PDO::FETCH_ASSOC);

    $naslov = $instrument['title']; 
    $heading1 = $instrument['title'];
    $imeslike = $instrument['cover_photo'];
	
    include './includes/header.php';
    include './includes/jumbotron1.php'; 
    
    ?>

    <div class="content1">
        <?php echo $instrument['content'] ?>
        <div class="buttonHolder">
            <button class="submit_button" onClick="window.open('./db/deleteArticle.php?id=<?php echo $_GET['id']; ?>', '_self')">IZBRIŠI POST</button>
            <button class="submit_button" onClick="window.open('./editArticle.php?id=<?php echo $_GET['id']; ?>', '_self')">UREJAJ POST</button>
        </div>
    </div>