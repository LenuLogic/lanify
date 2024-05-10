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
?>