<?php

include '../../routes/MainRoutes.php';
include '../../models/dataBase/iespConnection.php';
include '../../models/tpmphase/tpmphase.php';


if (isset($_POST['add_phase'])) {

    $projectId = securise($_POST['projectId']);;
    $name = securise($_POST['name']);
    $type = securise($_POST['type']);
    $start = securise($_POST['start']);
    $end = securise($_POST['end']);

    if ($name != "" && $type != "0" && $projectId != "0" && $start <= $end) {

        $bdPhase = new Phase();

        if (1) {
            if ($bdPhase->addPhase($projectId, $name, $type, $start, $end)) {
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

    MainRoutes::myWay('tpmphase', 'start', 'tpmphase', $reponse, false, false, true, false);
    die;
}

if (isset($_POST['bt_disable'])) {

    $phaseId = securise($_POST['phaseId']);

    if ($phaseId != "") {

        $bdPhase = new Phase();

        if (1) {
            if ($bdPhase->disablePhase($phaseId)) {
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

    MainRoutes::myWay('tpmphase', 'start', 'tpmphase', $reponse, false, false, true, false);
    die;
}

if (isset($_POST['bt_activate'])) {

    $phaseId = securise($_POST['phaseId']);

    if ($phaseId != "") {

        $bdPhase = new Phase();

        if (1) {
            if ($bdPhase->activatePhase($phaseId)) {
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

    MainRoutes::myWay('tpmphase', 'start', 'tpmphase', $reponse, false, false, true, false);
    die;
}
