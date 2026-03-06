<?php

include '../../routes/MainRoutes.php';
include '../../models/dataBase/iespConnection.php';
include '../../models/ip/ip.php';

if (isset($_POST['bt_add'])) {

    $name = securise($_POST['name']);

    // die;

    if ($name != "") {
        $bdIp = new Ip();

        if (1) {
            if ($bdIp->addIp($name)) {
                $reponse = "success";
            } else {
                $reponse = "traitement_error";
            }
        } else {
            $reponse = "doublons_error";
        }
    } else {
        $reponse = "remplissage_error";
    }

    MainRoutes::myWay('ip', 'start', 'ip', $reponse, false, false, true, false);
    die;
}

