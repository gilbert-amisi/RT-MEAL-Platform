<?php

include '../../routes/MainRoutes.php';
include '../../models/dataBase/iespConnection.php';
include '../../models/supervisor/supervisor.php';

if (isset($_POST['bt_add'])) {

    $compte = securise($_POST['tb_compte']);
    $name = securise($_POST['tb_name']);
    $phone = securise($_POST['tb_phone']);
    $email = securise($_POST['tb_email']);

    // die;

    if ($name != "" && $phone!="" && $compte!=0) {
        $bdSupervisor = new Supervisor();

        if (1) {
            if ($bdSupervisor->addSupervisor($name, $phone, $email, $compte)) {
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

    MainRoutes::myWay('supervisor', 'start', 'menuProjet', $reponse, false, false, true, false);
    die;
}

