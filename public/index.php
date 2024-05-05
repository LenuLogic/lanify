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
            require_once MODEL_DIR . 'henkilo.php';
            $salasana = password_hash($_POST['salasana1'], PASSWORD_DEFAULT);
            $id = lisaaHenkilo($_POST['nimi'],$_POST['email'],$_POST['discord'],$salasana);
            echo "Tili on luotu tunnisteella $id";
            break;
        } else {
        echo $templates->render('lisaa_tili');
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