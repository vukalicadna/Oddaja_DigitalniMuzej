    <nav>
        <h6>Vir:<br>Geodetski instrumenti in oprema na Slovenskem</h6>
        <h1><a href="./index.php">ZAČETNA STRAN</a></h1>
        <h1><a href="./about.php">O MUZEJU</a></h1>
    </nav>

    <?php 
    $naslov = "MUZEJ"; 
    $heading = "MUZEJ GEODETSKIH INSTRUMENTOV IZ 20. STOLETJA";
    $imeslike = 'kk.jpg';
    include './includes/header.php';
    include './includes/jumbotron.php';

    $dbo = new PDO('mysql:host=localhost;dbname=konacno;charset=utf8', 'root', '');
    $vsiinstrumenti = $dbo->query("
        SELECT *
        FROM muzej
        WHERE category = 2
    ");
    $vsiinstrumenti = $vsiinstrumenti->fetchAll(PDO::FETCH_ASSOC);

    ?>

    <main>
        <?php foreach($vsiinstrumenti as $eninstrument): ?>
            <article>
                <div class="article__background">
                    <img src="./images/<?php echo $eninstrument['cover_photo']; ?>" alt="cover">
                </div>
                <div class="article__info">
                    <h3><?php echo $eninstrument['title']; ?></h3>
                    <p><?php echo $eninstrument['short_description']; ?></p>
                    <a href="./category.php?id=<?php echo $eninstrument['id']; ?>&categoryId=<?php echo $eninstrument['main_category'] ?>">PREBERI VEČ</a>
                </div>
            </article>
        <?php endforeach; ?>
    </main>

   