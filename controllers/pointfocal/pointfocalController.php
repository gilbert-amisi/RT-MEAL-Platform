<?php

include '../../routes/MainRoutes.php';
include '../../models/dataBase/iespConnection.php';
include '../../models/pointfocal/Pointfocal.php';

if (isset($_POST['bt_add'])) {

    $identite = securise($_POST['tb_identite']);
    $compteId = securise($_POST['cb_compte']);
    $sensibiliteId = securise($_POST['cb_sensibilite']);
    $organisationId = securise($_POST['organisationId']);
    if ($sensibiliteId !="All") {
        if ($identite != "" && $compteId!=0) {
            $bdPointfocal = new Pointfocal();
    
            if ($bdPointfocal->addPointfocal($identite, $compteId, $sensibiliteId, $organisationId)) {
                $reponse = "success";
            } else {
                $reponse = "traitement_error";
            }
        } else {
            $reponse = "remplissage_error";
        }
    } else {
        if ($identite != "" && $compteId!=0) {
            $bdPointfocal = new Pointfocal();
    
            if ($bdPointfocal->addPointfocalTpm($identite,$compteId,$organisationId)) {
                $reponse = "success";
            } else {
                $reponse = "traitement_error";
            }
        } else {
            $reponse = "remplissage_error";
        }
    }

    

    MainRoutes::myWay('pointfocal', 'start', 'menuProjet', $reponse, false, false, true, false);
    die;
}

