<?php

session_start();

include '../../routes/MainRoutes.php';
include '../../models/dataBase/iespConnection.php';
include '../../models/rapportage/Rapportage.php';
include '../../models/information/Information.php';
include '../../models/source/Source.php';
include '../../models/donnee/Donnee.php';
include '../../models/agent/Agent.php';
include '../../models/territoire/Territoire.php';
include '../../models/groupement/Groupement.php';

if (isset($_POST['bt_add'])) {

    $contact = securise($_POST['tb_contact']);
    $adresse = securise($_POST['tb_adresse']);
    $identite = securise($_POST['tb_identite']);
    $genre = securise($_POST['cb_genre']);
    $profession = securise($_POST['tb_profession']);
    $etatcivil = securise($_POST['tb_etatcivil']);
    $dateInformation = securise($_POST['tb_date']);
    $heureInformation = securise($_POST['tb_heure']);
    
    $subject = securise($_POST['tb_subject']);
    $donnee = securise($_POST['tb_donnee']);
    $projectId = securise($_POST['tb_projectId']);
    $groupm = securise($_POST['cb_groupement']);

    // die;

    if ($contact != "" && $adresse!="" && $genre!="" && $dateInformation!="" && $heureInformation!="" && $subject!="" && $donnee!="" && $projectId!="" && $groupm!="none") {
        $bdDonnee = new Donnee();
        $bdSource = new Source();
        $bdInformation = new Information();
        $bdRapportage = new Rapportage();
        $bdTerritoire = new Territoire();
        $bdGroupement = new Groupement();

        // echo $groupm;

        $groupements=$bdGroupement->getGroupementByName($groupm);
        $territoires=$bdTerritoire->getTerritoireByName($groupements[0]['territoire']);

        

        if (1) {
            if ($bdDonnee->addDonnee($donnee)) {
                $donneeRecentId=0;
                $donnees=$bdDonnee->getDonneeRecent();
                foreach ($donnees as $donnee) {
                    $donneeRecentId=$donnee['recentId'];
                }
                if ($bdSource->addSource($identite,$contact,$profession,$etatcivil,$genre,$adresse)) {
                    $sourceRecentId=0;
                    $sources=$bdSource->getSourceRecent();
                    foreach ($sources as $source) {
                        $sourceRecentId=$source['recentId'];
                    }

                    if ($bdInformation->addInformation($dateInformation,$heureInformation,$groupm,$sourceRecentId,$donneeRecentId,$territoires[0]['id'])) {
                        $informationRecentId=0;
                        $informations=$bdInformation->getInformationRecent();
                        foreach ($informations as $information) {
                            $informationRecentId=$information['recentId'];
                        }

                        $agentId=0;
                        $bdAgent=new Agent();
                        $agents=$bdAgent->getAgentActiveByCompteId($_SESSION['compteId']);
                        foreach ($agents as $agent) {
                            $agentId=$agent['agId'];
                        }

                        // echo $agentId; die;

                        if ($bdRapportage->addRapportage(date('Y-m-d H:i:s'),$subject,$informationRecentId,$agentId,$projectId)) {
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

    $render = "rapportage";
    $sub = "start";
    $op = "";

    header('Location:../../views/home.php?render=' . sha1($render) . '&sub=' . sha1($sub) . '&op=' . sha1($op) . '&use_project=' . sha1($projectId) . '&reponse=' . sha1($reponse));
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

if (isset($_POST['bt_search_rapportage']))
{
    
    $projectId = securise($_POST['tb_projectId']);
    $rapportageId = securise($_POST['cb_rapportage']);

    $render = "rapportage";
    $sub = "start";
    $op = "";
    $reponse="";

    header('Location:../../views/home.php?render=' . sha1($render) . '&sub=' . sha1($sub) . '&op=' . sha1($op) . '&use_rapportage=' . ($rapportageId) . '&use_project=' . sha1($projectId) . '&reponse=' . sha1($reponse));
    die;
}

if (isset($_POST['bt_for_view']))
{

    $rapportageId = securise($_POST['tb_rapportageId']);
    $projectId = securise($_POST['tb_projectId']);

    $render = "information";
    $sub = "start";
    $op = "";
    $reponse="";

    header('Location:../../views/home.php?render=' . sha1($render) . '&sub=' . sha1($sub) . '&op=' . sha1($op) . '&use_rapportage=' . ($rapportageId) . '&use_project=' . sha1($projectId) . '&reponse=' . sha1($reponse));
    die;
}

