<?php

include '../../routes/MainRoutes.php';
include '../../models/dataBase/iespConnection.php';
include '../../models/axe/axe.php';

if (isset($_POST['bt_add'])) {

    $name = securise($_POST['tb_name']);
    $province = securise($_POST['tb_province']);
    $vaix = securise($_POST['vaix']);
    $vaiy = securise($_POST['vaiy']);

    // die;

    if ($name != "") {
        $bdAxe = new Axe();

        if (1) {
            if ($bdAxe->addAxe($name, $province, $vaix,$vaiy)) {
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

    MainRoutes::myWay('axe', 'start', 'menuProjet', $reponse, false, false, true, false);
    die;
}

