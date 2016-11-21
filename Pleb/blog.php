<head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="styles/style.css" type="text/css" rel=stylesheet>
    <script src="scripts/blogScript.js"></script>
</head>

<body>
<?php include_once("includes/nav.html"); ?>
<main class="blog">
        <button name="new" onclick="newPost()">Uusi</button>
        <section class="postList">
            <article id="newPost">
                <textarea name="postText" rows="5" cols="50" placeholder="Teksti tähän..."></textarea><br>
                <button name="add">Add</button>
            </article>
        </section>
        <section class="postList">
            <article class="post">
                <p class="date">6.11.2016</p>
                <h1 class="blogHeader">POst 1</h1>
                <p>asdasdasdadasdasda</p>
                <hr>
                <p class="footer">aamo</p>
            </article>
        </section>
    </main>
<?php include_once("includes/footer.php"); ?>
</body>

<?php
function printTable(){
	//tietokannasta tiedot
}
?>