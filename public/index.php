<?php
// Suoritetaan projektin alustusskripti:
require_once '../src/init.php';

/*Tämä siistii urlin lyhemmäksi, ettei tuu järkkypitkää.*/ 
$request=str_replace($config['urls']['baseUrl'],'',$_SERVER['REQUEST_URI']);
$request=strtok($request,'?');

//Luodaan uusi Plates-olio ja kytketään se sivupohjaan:
$templates = new League\Plates\Engine(TEMPLATE_DIR); 

//Selvitetään kutsuttu sivu ja suoritetaan sitä vastaava käsittelijä:
switch ($request) {
    case '/':
    case '/tapahtumat':
        require_once MODEL_DIR . 'tapahtuma.php';
        $tapahtumat = haeTapahtumat();
        echo $templates->render('tapahtumat',['tapahtumat' => $tapahtumat]);
        break;
    case '/tapahtuma':
        require_once MODEL_DIR . 'tapahtuma.php';
        $tapahtuma = haeTapahtuma($_GET['id']);
        if ($tapahtuma) {
            echo $templates->render('tapahtuma', ['tapahtuma' => $tapahtuma]);
        } else {
            echo $templates->render('tapahtumanotfound');
        }
        break;
    case '/lisaa_tili':
        if (isset($_POST['laheta'])) {
            $formdata = cleanArrayData($_POST);
            require_once CONTROLLER_DIR . 'tili.php';
            $tulos = lisaaTili($formdata);
            if ($tulos['status'] == "200") {
            echo $templates->render('tili_luotu', ['formdata' => $formdata]);
            break;
            }
            echo $templates->render('lisaa_tili', ['formdata' => $formdata, 'error' => $tulos['error']]);
            break;
        } else {
        echo $templates->render('lisaa_tili', ['formdata' => [], 'error' => []]);
        break;
        }
    default:
        echo $templates->render('notfound');
}

?>



<!--
    VANHA IF... ELSE IF -RAKENNE
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
} else if ($request === '/lisaa_tili') {
    echo $templates->render('lisaa_tili');
} else {
    echo $templates->render('notfound');
} -->