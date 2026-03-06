<?php

include '../../routes/MainRoutes.php';
include '../../models/dataBase/iespConnection.php';
include '../../models/project/Project.php';

if (isset($_POST['bt_add'])) {

    $designation = securise($_POST['tb_designation']);
    $comment = securise($_POST['tb_comment']);
    $projectDuration = securise($_POST['tb_projectDuration']);
    $yearDebut = securise($_POST['tb_yearDebut']);
    $monthDebut = securise($_POST['tb_monthDebut']);
    $frequency = securise($_POST['cb_frequency']);
    $organisationId = securise($_POST['cb_organization']);
    $pointfocalId = securise($_POST['cb_focalpoint']);

    // die;

    if ($designation != "" && $organisationId!=0 && $projectDuration!="" && $yearDebut!="" && $monthDebut!="") {
        $bdProject = new Project();

        if (1) {
            if ($bdProject->addProject($designation, $comment, $organisationId, $pointfocalId, $projectDuration,$yearDebut,$monthDebut,$frequency)) {
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

    MainRoutes::myWay('project', 'start', 'menuProjet', $reponse, false, false, true, false);
    die;
}

