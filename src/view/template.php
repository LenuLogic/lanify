<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <title>Lanify - <?=$this->e($title)?></title>
    <link href="styles/styles.css" rel="stylesheet">
</head>
<body>
    <header>
        <h1><a href="<?=BASEURL?>">Lanify</a></h1>
        <div class="profile">
            <?php
                if (isset($_SESSION['user'])) {
                    echo "<div>$_SESSION[user]</div>";
                    echo "<div><a href='logout'>Kirjaudu ulos</a></div>";
                } else {
                    echo "<div><a href='kirjaudu'>Kirjaudu</a></div>";
                }
            ?>
        </div>
    </header>
    <section>
        <?=$this->section('content')?>
    </section>
<footer>
    <hr>
    <div>Lanify by Lenu Logic</div>
</footer>
</body>
</html>