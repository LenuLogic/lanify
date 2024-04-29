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