<?php
// Suoritetaan projektin alustusskripti:
require_once '../src/init.php';

/*Tämä siistii urlin lyhemmäksi, ettei tuu järkkypitkää.*/ 
$request=str_replace($config['urls']['baseUrl'],'',$SERVER['REQUEST_URI']);
$request=strtok($request,'?');

//Luodaan uusi Plates-olio ja kytketään se sivupohjaan:
$templates = new League\Plates\Engine('../src/view');

//Selvitetään kutsuttu sivu ja suoritetaan sitä vastaava käsittelijä:
if ($request === '/' || $request === '/tapahtumat') {
    echo $templates->render('/tapahtumat'); 
} else if ($request === '/tapahtuma') {
    echo $templates->render('tapahtuma');
} else {
    echo $templates->render('notfound');
}

?>

<!-- Selvitetään, mitä sivua on kutsuttu, ja suoritetaan 
sivua vastaava käsittelijä (eli PHP-koodi). 
if ($request==="/" || $request === "/tapahtumat") {
    echo "<h1>Kaikki tapahtumat</h1>";
} else if ($request === "/tapahtuma") {
    echo "<h1>Yksittäisen tapahtuman tiedot</h1>";
} else {
    echo "<h1>Pyydettyä sivua ei löytynyt :}</h1>";
}
Tämä olikin apupyöräskripti.
-->