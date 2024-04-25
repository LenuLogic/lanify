<?php
// Suoritetaan projektin alustusskripti:
require_once '../src/init.php';

/*Tämä siistii urlin lyhemmäksi, ettei tuu järkkypitkää.*/ 
$request=str_replace($config['urls']['baseUrl'],'',$_SERVER['REQUEST_URI']);
$request=strtok($request,'?');

//Luodaan uusi Plates-olio ja kytketään se sivupohjaan:
$templates = new League\Plates\Engine('../src/view'); // Kokeilen vaihtaa kenoviivat - ei

//Selvitetään kutsuttu sivu ja suoritetaan sitä vastaava käsittelijä:
if ($request === '/' || $request === '/tapahtumat') {
    echo $templates->render('tapahtumat'); 
} else if ($request === '/tapahtuma') {
    echo $templates->render('tapahtuma');
} else {
    echo $templates->render('notfound');
}

?>
