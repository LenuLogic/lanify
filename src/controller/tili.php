<?php

function lisaaTili($formdata) {
    require_once(MODEL_DIR . 'henkilo.php');

    $error = [];

    //En ymmärrä, mihin tuo $formdata['nimi'] viittaa.
    // Index.php:ssä on rivi: $formdata = cleanArrayData($_POST);
    if (!isset($formdata['nimi']) || !$formdata['nimi']) {
        $error['nimi'] = "Anna nimesi.";
    } else {
        if (!preg_match("/^[- '\p{L}]+$/u", $formdata["nimi"])) { //Selvitä preg_match!
            $error['nimi'] = "Syötä nimesi ilman erikoismerkkejä.";
        }
    }

    if (!isset($formdata['discord']) || !$formdata['discord']) {
        $error['discord'] = "Anna Discord-tunnuksesi muodossa tunnus#0000.";
    } else {
        if (!preg_match("/^.+#\d{4}$/", $formdata['discord'])) {
            $error['discord'] = "Discord-tunnuksesi on virheellinen.";
        }
    }
    
    if (!isset($formdata['email']) || !$formdata['email']) {
        $error['email'] = "Anna sähköpostiosoitteesi.";
    } else {
        if (!filter_var($formdata['email'], FILTER_VALIDATE_EMAIL)) {
            $error['email'] = "Sähköpostiosoite on virheellisessä muodossa.";
        } else {
            if (haeHenkiloSahkopostilla($formdata['email'])) {
                $error['email'] = "Sähköpostiosoite on jo käytössä.";
            }
        }
    }

    if (isset($formdata['salasana1']) && $formdata['salasana1'] && isset($formdata['salasana2']) && $formdata['salasana2']) {
        if ($formdata['salasana1'] != $formdata['salasana2']) {
            $error['salasana'] = "Salasanasi eivät täsmää.";
        }
    } else {
        $error['salasana'] = "Syötä salasanasi kahteen kertaan.";
    }

    if (!$error) {
        $nimi = $formdata['nimi'];
        $email = $formdata['email'];
        $discord = $formdata['discord'];
        $salasana = password_hash($formdata['salasana1'], PASSWORD_DEFAULT);

        $idhenkilo = lisaaHenkilo($nimi,$email,$discord,$salasana);

        if ($idhenkilo) {
            return [
                "status" => 200,
                "id" => $idhenkilo,
                "data" => $formdata
            ];
        } else {
            return [
                "status" => 500,
                "data" => $formdata
            ];
        }
    } else {
        return [
            "status" => 400,
            "data" => $formdata,
            "error" => $error
        ];
    }
}

?>