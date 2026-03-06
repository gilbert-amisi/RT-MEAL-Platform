<?php

include '../../routes/MainRoutes.php';
include '../../models/dataBase/iespConnection.php';
include '../../models/agent/Agent.php';

if (isset($_POST['bt_add'])) {

    $identite = securise($_POST['tb_identite']);
    $compteId = securise($_POST['cb_compte']);
    $niveauId = securise($_POST['cb_niveau']);

    // die;

    if ($identite != "" && $compteId!=0 && $niveauId!=0) {
        $bdAgent = new Agent();

        if ($bdAgent->desactiveAgentByCompteId($compteId)) {
            if ($bdAgent->addAgent($identite, $compteId, $niveauId)) {
                $reponse = "success";
            } else {
                $reponse = "traitement_error";
            }
        } else {
            $reponse = "traitement_error";
        }
    } else {
        $reponse = "remplissage_error";
    }

    MainRoutes::myWay('agent', 'start', 'menuProjet', $reponse, false, false, true, false);
    die;
}

