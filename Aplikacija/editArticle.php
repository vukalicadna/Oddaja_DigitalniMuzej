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
    $heading = $instrument['title'];
    $imeslike = $instrument['cover_photo'];
    $naslov = "Urejanje"; 
    $heading = "Urejanje";
    include './includes/header.php';
    include './includes/jumbotron.php';

    $vsiinstrumenti = $dbo->prepare("
        SELECT *
        FROM muzej
        WHERE id = :id
    ");

    $vsiinstrumenti->execute([ 
        'id' => $_GET['id'],
    ]);
    $vsiinstrumenti = $vsiinstrumenti->fetch(PDO::FETCH_ASSOC);

    ?>

    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="./styles/newArticle.css" rel="stylesheet">

    <div class="newArticle__container">
        <h2>UREJAJ</h2>
        <div class="html-editor-bubble" id="quillEditorBubble"><?php echo $vsiinstrumenti['content'] ?></div>
        <form action="./db/updateArticle.php" id="newArticleForm" method="post" enctype="multipart/form-data">
            <div>
                <label>NASLOV</label>
                <input type="text" name="title" value="<?php echo $vsiinstrumenti['title'] ?>" required />
            </div>
            <div>
                <label>KRATEK OPIS</label>
                <input type="text" name="short_description" value="<?php echo $vsiinstrumenti['short_description'] ?>" required />
            </div>
            <div>
                <label>KATEGORIJA</label>
                <input type="text" name="category"  value=" <?php echo $vsiinstrumenti['category'] ?>" required />
            </div>
            <div>
                <label>SLIKA</label>
                <input type="file" name="cover_photo" accept="image/png, image/jpeg" required />
            </div>
            <input type="hidden" name="content" id="content" />
            <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>" />
            <button class="submit_button" onClick="window.open('./article.php?id=<?php echo $_GET['id']; ?>', '_self')">SHRANI SPREMEMBE</button>
        </form>
    </div>

<script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
<script>
    var quill = new Quill('#quillEditorBubble', {
        modules: {
            toolbar: [
            [{ header: [1, 2, false] }],
            ['bold', 'italic', 'underline'],
            ['image', 'code-block']
            ]
        },
        placeholder: 'Compose an epic...',
        theme: 'snow'
    });
    $('.submit_button').click((e) => {
        e.preventDefault();
        $('#content').val($(".ql-editor").html());
        $('#newArticleForm').submit();
    });
</script>