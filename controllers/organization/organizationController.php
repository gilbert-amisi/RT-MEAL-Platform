<?php

include '../../routes/MainRoutes.php';
include '../../models/dataBase/iespConnection.php';
include '../../models/organization/Organization.php';

if (isset($_POST['bt_add'])) {

    $designation = securise($_POST['tb_designation']);
    $color = securise($_POST['tb_color']);

    if ($designation != "" && $color != "") {
        $bdOrganization = new Organization();

        if (1) {
            if ($bdOrganization->addOrganization($designation, $color)) {
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

    MainRoutes::myWay('organization', 'start', 'menuProjet', $reponse, false, false, true, false);
    die;
}

