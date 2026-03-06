<?php

include '../../routes/MainRoutes.php';
include '../../models/dataBase/iespConnection.php';
include '../../models/sensibilite/Sensibilite.php';

if (isset($_POST['bt_add'])) {

    $levelSensibilite = securise($_POST['tb_level']);
    $designation = securise($_POST['tb_designation']);
    $emergency = securise($_POST['tb_emergency']);
    $projectId = securise($_POST['cb_project']);

    // die;

    if ($levelSensibilite != "" && $designation!="" && $projectId!=0) {
        $bdSensibilite = new Sensibilite();

        if (1) {
            if ($bdSensibilite->addSensibilite($levelSensibilite, $designation, $emergency, $projectId)) {
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

    MainRoutes::myWay('sensibilite', 'start', 'menuProjet', $reponse, false, false, true, false);
    die;
}

