<?php
// Suoritetaan projektin alustusskripti:
require_once '../src/init.php';

/*Tämä siistii urlin lyhemmäksi, ettei tuu järkkypitkää.*/ 
$request=str_replace($config['urls']['baseUrl'],'',$_SERVER['REQUEST_URI']);
$request=strtok($request,'?');

//Luodaan uusi Plates-olio ja kytketään se sivupohjaan:
$templates = new League\Plates\Engine(TEMPLATE_DIR); 

//Selvitetään kutsuttu sivu ja suoritetaan sitä vastaava käsittelijä:
if ($request === '/' || $request === '/tapahtumat') {
    require_once MODEL_DIR . 'tapahtuma.php';
    $tapahtumat = haeTapahtumat();
    echo $templates->render('tapahtumat', ['tapahtumat' => $tapahtumat]); 
} else if ($request === '/tapahtuma') {
    require_once MODEL_DIR . 'tapahtuma.php';
    $tapahtuma = haeTapahtuma($_GET['id']);
    if ($tapahtuma) {
        echo $templates->render('tapahtuma',['tapahtuma' => $tapahtuma]);
    } else {
        echo $templates->render('tapahtumanotfound');
        }
} else {
    echo $templates->render('notfound');
}

?>
