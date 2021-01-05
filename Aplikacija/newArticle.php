<nav>
    <h1><a href="./index.php">Nazaj na začetno stran</a></h1>
    <button onClick="window.open('./newArticle.php', '_self')">Dodaj novi instrument</button>
</nav>

<?php 

    $naslov = "Novi instrument"; 
    $heading = "NOVI INSTRUMENT";
    $imeslike = 'KK.jpg';

    include './includes/header.php';
    include './includes/jumbotron.php';
    
    $dbo = new PDO('mysql:host=localhost;dbname=konacno;charset=utf8', 'root', '');
    $vsiinstrumenti = $dbo->query("
        SELECT *
        FROM muzej
    ");
    $vsiinstrumenti = $vsiinstrumenti->fetchAll(PDO::FETCH_ASSOC);

?>

    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="./styles/newArticle.css" rel="stylesheet">

    <div class="newArticle__container">
        <h2>USTVARI NOVI INSTRUMENT</h2>
        <div class="html-editor-bubble" id="quillEditorBubble"></div>
        <form action="./db/saveArticle.php" id="newArticleForm" method="post" enctype="multipart/form-data">
            <div>
                <label>NASLOV</label>
                <input type="text" name="title" required />
            </div>
            <div>
                <label>KRATEK OPIS</label>
                <input type="text" name="short_description" required />
            </div>
            <div>
                <label>KATEGORIJA</label>
                <input type="text" name="category" required />
            </div>
            <div>
                <label>SLIKA</label>
                <input type="file" name="cover_photo" accept="image/png, image/jpeg" required />
            </div>
            <input type="hidden" name="content" id="content" />
            <button class="submit_button">USTVARI</button>
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
        placeholder: 'Tekst',
        theme: 'snow'
    });
    $('.submit_button').click((e) => {
        e.preventDefault();
        $('#content').val($(".ql-editor").html());
        $('#newArticleForm').submit();
    });
</script>
