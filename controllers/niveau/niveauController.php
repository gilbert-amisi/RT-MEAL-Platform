<?php

include '../../routes/MainRoutes.php';
include '../../models/dataBase/iespConnection.php';
include '../../models/niveau/Niveau.php';

if (isset($_POST['bt_add'])) {

    $levelNiveau = securise($_POST['tb_level']);
    $designation = securise($_POST['tb_designation']);
    $forValidation = securise($_POST['rb_forValidation']);

    if ($levelNiveau != "" && $designation != "") {
        $bdNiveau = new Niveau();

        if (1) {
            if ($bdNiveau->addNiveau($levelNiveau, $designation,$forValidation)) {
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

    MainRoutes::myWay('niveau', 'start', 'menuProjet', $reponse, false, false, true, false);
    die;
}

