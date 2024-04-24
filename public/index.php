<?php
/*Tämä siistii urlin lyhemmäksi, ettei tuu järkkypitkää.*/ 
$request=str_replace('/~lkevatky/lanify', '',$SERVER['REQUEST_URI']);
$request=strtok($request,'?');


/* Selvitetään, mitä sivua on kutsuttu, ja suoritetaan 
sivua vastaava käsittelijä (eli PHP-koodi). */
if ($request==="/" || $request === "/tapahtumat") {
    echo "<h1>Kaikki tapahtumat</h1>";
} else if ($request === "/tapahtuma") {
    echo "<h1>Yksittäisen tapahtuman tiedot</h1>";
} else {
    echo "<h1>Pyydettyä sivua ei löytynyt :}</h1>";
}
?>