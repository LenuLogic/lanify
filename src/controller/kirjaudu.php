<?php
function tarkistaKirjautuminen($email="", $salasana="") {
    require_once(MODEL_DIR . 'henkilo.php');
    $tiedot = haeHenkiloSahkopostilla($email); // Hakee henkilön tiedot kannasta syötetyn sähköpostiosoitteen avulla.
    $tiedot = array_shift($tiedot); 
    // Poistaa taulukon ensimmäisen arvon ja tulostaa sen.
    // array_shiftiä käytetään siksi, että kannassa voi periaatteessa
    // olla useampi samanlainen sähköpostiosoite. Koska kannassa
    // ei kuitenkaan pitäisi olla tuplia, funktio palauttaa vain ekan.

    if ($tiedot && password_verify($salasana, $tiedot['salasana'])) {
        return true;
    }
    return false;
}

function logout() {
    $_SESSION = array(); // Tyhjentää istuntomuuttujat.

    if (ini_get("session.use_cookies")) { // Poistaa istunnon evästeen.
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
    );
    }
    session_destroy(); // Tuhoaa istunnon.
}
?>