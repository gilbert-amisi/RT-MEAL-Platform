<?php

session_start();

include '../../routes/MainRoutes.php';
include '../../models/dataBase/iespConnection.php';
include '../../models/rapportage/Rapportage.php';
include '../../models/information/Information.php';
include '../../models/source/Source.php';
include '../../models/donnee/Donnee.php';
include '../../models/agent/Agent.php';
include '../../models/soumission/Soumission.php';
include '../../models/niveau/Niveau.php';
include '../../models/remonte/Remonte.php';
include '../../models/pointfocal/Pointfocal.php';
include '../../models/sensibilite/Sensibilite.php';
include '../../models/territoire/Territoire.php';

if (isset($_POST['bt_add'])) {


    $donnee = securise($_POST['tb_donnee']);
    $sensibiliteId = securise($_POST['cb_sensibilite']);
    $projectId = securise($_POST['tb_projectId']);
    $rapportageId = securise($_POST['tb_rapportageId']);
    $remonteId = securise($_POST['tb_remonteId']);
    $needFeedback = securise($_POST['rb_needFeedback']);
    $trust = securise($_POST['rb_trust']);

    // die;

    if ($donnee != "" && $sensibiliteId != 0 && $projectId != "" && $rapportageId != "" && $remonteId != "") {
        $bdDonnee = new Donnee();
        $bdSource = new Source();
        $bdInformation = new Information();
        $bdRapportage = new Rapportage();
        $bdSoumission = new Soumission();
        $bdSensibilite = new Sensibilite();

        if (1) {
            if ($bdDonnee->addDonnee($donnee)) {
                $donneeRecentId = 0;
                $donnees = $bdDonnee->getDonneeRecent();
                foreach ($donnees as $donnee) {
                    $donneeRecentId = $donnee['recentId'];
                }
                if (1) {

                    if (1) {

                        $emergencySensibilite = "";
                        $sensibilites = $bdSensibilite->getSensibiliteById($sensibiliteId);
                        foreach ($sensibilites as $sensibilite) {
                            $emergencySensibilite = $sensibilite['emergency'];
                        }

                        $emergency = $emergencySensibilite;


                        if ($bdSoumission->addSoumission($emergency, $trust, $needFeedback, $sensibiliteId, $donneeRecentId, $remonteId)) {


                            include '../../models/PHPMailer-src/Config.php';
                            include '../../models/PHPMailer-src/Settings.php';

                            $bdSensibilite = new Sensibilite();
                            $sensibilites = $bdSensibilite->getSensibiliteById($sensibiliteId);
                            $levelSensibilite = 0;
                            foreach ($sensibilites as $sensibilite) {
                                $levelSensibilite = $sensibilite['levelSensibilite'];
                            }


                            $bdPointfocal = new Pointfocal();
                            $pointfocals = $bdPointfocal->getPointFocalActiveByProjectId($projectId);
                            foreach ($pointfocals as $pointfocal) {
                                if ($pointfocal['levelSensibilite'] >= $levelSensibilite) {

                                    $mail->addAddress($pointfocal['email']);     //Add a recipient
                                }
                            }





                            $mail->isHTML(true);

                            $mail->Subject = "IES-RTME Platform Notification";
                            // $mail->addEmbeddedImage('path/to/image_file.jpg', 'image_cid');

                            $bdRemonte = new Remonte();
                            $remontes = $bdRemonte->getRemonteById($remonteId);

                            $dateRemonte = "";
                            $dateRapport = "";
                            $subjectRapport = "";
                            $dateEvent = "";
                            $heureEvent = "";
                            $locationEvent = "";
                            $data = "";
                            $projectDesignation = "";
                            $organisationDesignation = "";

                            foreach ($remontes as $remonte) {
                                $dateRemonte = $remonte['reDateHeure'];
                                $dateRapport = $remonte['raDateHeure'];
                                $subjectRapport = $remonte['subject'];
                                $dateEvent = $remonte['dateEvent'];
                                $heureEvent = $remonte['infHeure'];
                                $locationEvent = $remonte['infLieu'];
                                $data = $remonte['dorValeur'];
                                $projectDesignation = $remonte['prDesignation'];
                                $organisationDesignation = $remonte['ogDesignation'];
                            }

                            $em = "";
                            if ($emergency == 'yes') {
                                $em = "Emergency! ";
                            }

                            $mail->Body = '
                                <h4><strong>' . $em . 'IES-RTME Notification from IES Call-Center</strong></h4>
                                <p>Submission from IES Call-Center</p>
                                
                                    <p>Reporting at: ' .
                                $dateRapport .
                                ' </p>
                                <p>Project: ' .
                                $projectDesignation
                                . '
                                </p>
                                <p>Organization: ' .
                                $organisationDesignation
                                . '
                                </p>
                                <hr>
                                
                                <p><strong>Subject: ' .
                                $subjectRapport
                                . '
                                    </strong></p>
                                    <p>Event Date: ' .
                                $dateEvent
                                . '
                                    </p>
                                    <p>Event Time: ' .
                                $heureEvent
                                . '
                                    </p>
                                    <p>Event location: ' .
                                $locationEvent
                                . '
                                    </p>
                                    <hr>
                                    <p><strong>Information: 
                                    </strong></p>
                                    <p>' .
                                $data
                                . '
                                    </p>
                                    <hr>
                                    <p>Please, follow this link to access IES-RTME platform <a href="www.iescongo.com"> www.iescongo.com</a></p>
                                    <p><strong>Use your credentials to login</strong></p>
                                ';
                            $mail->AltBody = 'New IES-RTME Notification';

                            if (!$mail->send()) {
                                $reponse = 'Message could not be sent.';
                                $reponse = 'Mailer Error: ' . $mail->ErrorInfo;
                            } else {
                                $reponse = 'Message has been sent';
                                $reponse = 'success';
                            }
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

    $render = "information";
    $sub = "start";
    $op = "";

    header('Location:../../views/home.php?render=' . sha1($render) . '&sub=' . sha1($sub) . '&op=' . sha1($op) . '&use_project=' . sha1($projectId) . '&use_rapportage=' . ($rapportageId) . '&use_remonte=' . ($remonteId) . '&reponse=' . sha1($reponse));
    die;
}

if (isset($_POST['bt_for_selectCategory'])) {
    $category = securise($_POST['cb_sensibilite']);

    $render = "visualization";
    $sub = "start";
    $op = "";
    $reponse = "";

    header('Location:../../views/home.php?render=' . sha1($render) . '&sub=' . sha1($sub) . '&op=' . sha1($op) . '&use_category=' . ($category) . '&reponse=' . sha1($reponse));
    die;
}

if (isset($_POST['bt_for_view'])) {

    $rapportageId = securise($_POST['tb_rapportageId']);
    $remonteId = securise($_POST['tb_remonteId']);
    $projectId = securise($_POST['tb_projectId']);

    $render = "information";
    $sub = "start";
    $op = "";
    $reponse = "";

    header('Location:../../views/home.php?render=' . sha1($render) . '&sub=' . sha1($sub) . '&op=' . sha1($op) . '&use_rapportage=' . ($rapportageId) . '&use_project=' . sha1($projectId) . '&use_remonte=' . ($remonteId) . '&reponse=' . sha1($reponse));
    die;
}

if (isset($_POST['bt_for_filter'])) {

    $filter = $_POST['tb_filter'];

    if ($filter == "") {
        $filter = "$$$";
    }

    $itemsF = explode('$', $filter);
    $partTerritoire = $itemsF[0];
    $partGroupement = $itemsF[1];
    $partSen = $itemsF[2];
    $partDates = $itemsF[3];

    if (isset($_POST['tb_nTerr'])) {
        $nTerr = $_POST['tb_nTerr'];

        // echo $nTerr;

        $partTerr = '';

        for ($i = 1; $i <= $nTerr; $i++) {
            if (isset(($_POST['chk_territoire_' . $i]))) {
                $partTerr = $partTerr . '-' . $_POST['chk_territoire_' . $i];
            }
        }

        $filter = $partTerr . '$' . $partGroupement . '$' . $partSen . '$' . $partDates;
    } else if (isset($_POST['tb_nGrp'])) {
        $nGrp = $_POST['tb_nGrp'];

        // echo $nTerr;

        $partGrp = '';

        for ($i = 1; $i <= $nGrp; $i++) {
            if (isset(($_POST['chk_groupement_' . $i]))) {
                $partGrp = $partGrp . '-' . $_POST['chk_groupement_' . $i];
            }
        }

        $filter = $partTerritoire . '$' . $partGrp . '$' . $partSen . '$' . $partDates;

    } else if (isset($_POST['tb_nSen'])) {
        $nSen = $_POST['tb_nSen'];

        // echo $nTerr;

        $partSen = '';

        for ($i = 1; $i <= $nSen; $i++) {
            if (isset(($_POST['chk_sen_' . $i]))) {
                $partSen = $partSen . '-' . $_POST['chk_sen_' . $i];
            }
        }

        $filter = $partTerritoire . '$' . $partGrp . '$' . $partSen . '$' . $partDates;
    }

    // echo 'Dedans';

    // die; 


    $render = "visualization";
    $sub = "start";
    $op = "";
    $reponse = "";

    header('Location:../../views/home.php?render=' . sha1($render) . '&sub=' . sha1($sub) . '&op=' . sha1($op) . '&filter=' . ($filter) . '&reponse=' . sha1($reponse) . '#sFilter');
    die;
}
