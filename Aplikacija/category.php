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
    $heading = $instrument['title'];
    $imeslike = 'kk.jpg';

    include './includes/header.php';
    include './includes/navigation.php';
    include './includes/jumbotron.php';

    if(isset($_GET['phrase'])) {
        $vsiinstrumenti = $dbo->prepare("
            SELECT *
            FROM muzej
            WHERE deleted IS NOT TRUE AND category = :main_category AND title LIKE CONCAT('%', :phrase, '%')
        ");
        $vsiinstrumenti->execute([ 'main_category' => $_GET['categoryId'], 'phrase' => $_GET['phrase'] ]);
        $vsiinstrumenti = $vsiinstrumenti->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $vsiinstrumenti = $dbo->prepare("
            SELECT *
            FROM muzej
            WHERE deleted IS NOT TRUE AND category = :main_category
        ");
        $vsiinstrumenti->execute([ 'main_category' => $_GET['categoryId'] ]);
        $vsiinstrumenti = $vsiinstrumenti->fetchAll(PDO::FETCH_ASSOC);
    }

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
                    <a href="./article.php?id=<?php echo $eninstrument['id']; ?>">PREBERI VEČ</a>
                </div>
            </article>
        <?php endforeach; ?> 
    </main>

    <script
    src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"></script>
    <script>
        $('.pretragaSubmit').click((e) => {
            e.preventDefault();
            let phrase = $('#search').val();
            window.open(`./category.php?id=` + <?php echo $_GET['id'] ?> + `&categoryId=` + <?php echo $_GET['categoryId'] ?> + `&phrase=${phrase}`, '_self');
        });
    </script>
    