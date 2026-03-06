<?php

session_start();

include '../../routes/MainRoutes.php';
include '../../models/dataBase/iespConnection.php';
include '../../models/rapportage/Rapportage.php';
include '../../models/information/Information.php';
include '../../models/source/Source.php';
include '../../models/donnee/Donnee.php';
include '../../models/agent/Agent.php';
include '../../models/triangulation/Triangulation.php';
include '../../models/territoire/Territoire.php';
include '../../models/groupement/Groupement.php';

if (isset($_POST['bt_add'])) {

    $keyinformantId = securise($_POST['cb_keyinformant']);
    
    $dateInformation = securise($_POST['tb_date']);
    $heureInformation = securise($_POST['tb_heure']);
    $lieuInformation = securise($_POST['cb_groupement']);
    $donnee = securise($_POST['tb_donnee']);
    $projectId = securise($_POST['tb_projectId']);
    $rapportageId = securise($_POST['tb_rapportageId']);

    // die;

    if ($keyinformantId != 0 && $dateInformation!="" && $heureInformation!="" && $lieuInformation!="none" && $donnee!="" && $projectId!="" && $rapportageId!="") {
        $bdDonnee = new Donnee();
        $bdSource = new Source();
        $bdInformation = new Information();
        $bdRapportage = new Rapportage();
        $bdTriangulation = new Triangulation();

        $bdTerritoire = new Territoire();
        $bdGroupement = new Groupement();

        // echo $groupm;

        $groupements=$bdGroupement->getGroupementByName($lieuInformation);
        $territoires=$bdTerritoire->getTerritoireByName($groupements[0]['territoire']);


        if (1) {
            if ($bdDonnee->addDonnee($donnee)) {
                $donneeRecentId=0;
                $donnees=$bdDonnee->getDonneeRecent();
                foreach ($donnees as $donnee) {
                    $donneeRecentId=$donnee['recentId'];
                }

                $sourceSelected=0;
                $forInformationId=0;
                $rapportages=$bdRapportage->getRapportageByProjectIdById($projectId,$rapportageId);
                foreach ($rapportages as $rapportage) {
                    $sourceSelected=$rapportage['scId'];
                    $forInformationId=$rapportage['infId'];
                }

                if (1) {
                   
                    if ($bdInformation->addInformation($dateInformation,$heureInformation,$lieuInformation,$sourceSelected,$donneeRecentId,$territoires[0]['id'])) {
                        $informationRecentId=0;
                        $informations=$bdInformation->getInformationRecent();
                        foreach ($informations as $information) {
                            $informationRecentId=$information['recentId'];
                        }

                        $agentId=0;
                        $niveauId=0;
                        $bdAgent=new Agent();
                        $agents=$bdAgent->getAgentActiveByCompteId($_SESSION['compteId']);
                        foreach ($agents as $agent) {
                            $agentId=$agent['agId'];
                            $niveauId=$agent['nvId'];
                        }

                        // echo $keyinformantId; die;

                        if ($bdTriangulation->addTriangulation($agentId,$niveauId,$keyinformantId,$forInformationId,$informationRecentId)) {
                            $reponse = "success";
                        }
                    }
                }
                
            } else {
                $reponse = "traitement_error";
            }
        } else {
            $reponse = "doublons_error";
        }
    } else {
        $reponse = "remplissage_error";
    }

    $render = "triangulation";
    $sub = "start";
    $op = "";

    header('Location:../../views/home.php?render=' . sha1($render) . '&sub=' . sha1($sub) . '&op=' . sha1($op) . '&use_project=' . sha1($projectId) . '&use_rapportage=' . ($rapportageId) . '&reponse=' . sha1($reponse));
    die;
}



if (isset($_POST['bt_for_triangulation']))
{
    $rapportageId = securise($_POST['tb_rapportageId']);
    $projectId = securise($_POST['tb_projectId']);

    $render = "triangulation";
    $sub = "start";
    $op = "";
    $reponse="";

    header('Location:../../views/home.php?render=' . sha1($render) . '&sub=' . sha1($sub) . '&op=' . sha1($op) . '&use_rapportage=' . ($rapportageId) . '&use_project=' . sha1($projectId) . '&reponse=' . sha1($reponse));
    die;
}

if (isset($_POST['bt_for_view']))
{
    
    $projectId = securise($_POST['tb_projectId']);
    $triangulationId = securise($_POST['tb_triangulationId']);
    $rapportageId = securise($_POST['tb_rapportageId']);


    $render = "triangulation";
    $sub = "view";
    $op = "";
    $reponse="";

    header('Location:../../views/home.php?render=' . sha1($render) . '&sub=' . sha1($sub) . '&op=' . sha1($op) . '&use_project=' . sha1($projectId) . '&use_triangulation=' . ($triangulationId) . '&use_rapportage=' . ($rapportageId) . '&reponse=' . sha1($reponse));
    die;
}

if (isset($_POST['bt_edit_donnee_triangulation']))
{
    
    $donneeId = securise($_POST['tb_donneeId']);
    $donnee = securise($_POST['tb_donnee']);
    $projectId = securise($_POST['tb_projectId']);
    $triangulationId = securise($_POST['tb_triangulationId']);
    $rapportageId = securise($_POST['tb_rapportageId']);

    if ($donnee!="") {
        $bdDonnee=new Donnee();
        if ($bdDonnee->updateDonnee($donneeId,$donnee)) {
            $reponse="success";
        } else {
            $reponse="traitement_error";
        }
    } else {
        $reponse="remplissage_error";
    }


    $render = "triangulation";
    $sub = "view";
    $op = "";

    header('Location:../../views/home.php?render=' . sha1($render) . '&sub=' . sha1($sub) . '&op=' . sha1($op) . '&use_project=' . sha1($projectId) . '&use_triangulation=' . ($triangulationId) . '&use_rapportage=' . ($rapportageId) . '&reponse=' . sha1($reponse));
    die;
}

if (isset($_POST['bt_search_triangulation']))
{
    
    $projectId = securise($_POST['tb_projectId']);
    $rapportageId = securise($_POST['tb_rapportageId']);
    $triangulationId = securise($_POST['cb_triangulation']);


    $render = "triangulation";
    $sub = "start";
    $op = "";
    $reponse="";

    header('Location:../../views/home.php?render=' . sha1($render) . '&sub=' . sha1($sub) . '&op=' . sha1($op) . '&use_project=' . sha1($projectId) . '&use_triangulation=' . ($triangulationId) . '&use_rapportage=' . ($rapportageId) . '&reponse=' . sha1($reponse));
    die;
}

