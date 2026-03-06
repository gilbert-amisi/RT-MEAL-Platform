<?php

session_start();

include '../../routes/MainRoutes.php';
include '../../models/dataBase/iespConnection.php';
include '../../models/rapportage/Rapportage.php';
include '../../models/information/Information.php';
include '../../models/source/Source.php';
include '../../models/donnee/Donnee.php';
include '../../models/agent/Agent.php';
include '../../models/remonte/Remonte.php';
include '../../models/niveau/Niveau.php';
include '../../models/sensibilite/Sensibilite.php';

// include '../../models/PHPMailer-master/src/PHPMailer.php';
// include '../../models/PHPMailer-master/src/SMTP.php';




if (isset($_POST['bt_add'])) {

    $contact = securise($_POST['tb_contact']);
    $adresse = securise($_POST['tb_adresse']);
    $identite = securise($_POST['tb_identite']);
    $genre = securise($_POST['cb_genre']);
    $profession = securise($_POST['tb_profession']);
    $etatcivil = securise($_POST['tb_etatcivil']);
    $dateInformation = securise($_POST['tb_date']);
    $heureInformation = securise($_POST['tb_heure']);
    $lieuInformation = securise($_POST['tb_lieu']);
    $donnee = securise($_POST['tb_donnee']);
    $projectId = securise($_POST['tb_projectId']);

    // die;

    if ($contact != "" && $adresse != "" && $genre != "" && $dateInformation != "" && $heureInformation != "" && $lieuInformation != "" && $donnee != "" && $projectId != "") {
        $bdDonnee = new Donnee();
        $bdSource = new Source();
        $bdInformation = new Information();
        $bdRapportage = new Rapportage();

        if (1) {
            if ($bdDonnee->addDonnee($donnee)) {
                $donneeRecentId = 0;
                $donnees = $bdDonnee->getDonneeRecent();
                foreach ($donnees as $donnee) {
                    $donneeRecentId = $donnee['recentId'];
                }
                if ($bdSource->addSource($identite, $contact, $profession, $etatcivil, $genre, $adresse)) {
                    $sourceRecentId = 0;
                    $sources = $bdSource->getSourceRecent();
                    foreach ($sources as $source) {
                        $sourceRecentId = $source['recentId'];
                    }
                    if ($bdInformation->addInformation($dateInformation, $heureInformation, $lieuInformation, $sourceRecentId, $donneeRecentId)) {
                        $informationRecentId = 0;
                        $informations = $bdInformation->getInformationRecent();
                        foreach ($informations as $information) {
                            $informationRecentId = $information['recentId'];
                        }

                        $agentId = 0;
                        $bdAgent = new Agent();
                        $agents = $bdAgent->getAgentActiveByCompteId($_SESSION['compteId']);
                        foreach ($agents as $agent) {
                            $agentId = $agent['agId'];
                        }

                        // echo $agentId; die;

                        if ($bdRapportage->addRapportage(date('Y-m-d H:i:s'), $informationRecentId, $agentId, $projectId)) {
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

if (isset($_POST['bt_remonte'])) {


    $donnee = securise($_POST['tb_donnee']);
    $projectId = securise($_POST['tb_projectId']);
    $rapportageId = securise($_POST['tb_rapportageId']);
    $trust = securise($_POST['rb_trust']);
    $sensibiliteId = securise($_POST['cb_sensibilite']);


    // die;

    if ($donnee != "" && $projectId != "" && $rapportageId != "" && $sensibiliteId != 0) {
        $bdDonnee = new Donnee();
        $bdSource = new Source();
        $bdInformation = new Information();
        $bdRapportage = new Rapportage();
        $bdRemonte = new Remonte();
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

                        $agentId = 0;
                        $bdAgent = new Agent();
                        $levelNiveau = 0;
                        $agents = $bdAgent->getAgentActiveByCompteId($_SESSION['compteId']);
                        foreach ($agents as $agent) {
                            $agentId = $agent['agId'];
                            $niveauId = $agent['nvId'];
                            $levelNiveau = $agent['levelNiveau'];
                        }

                        $newLevelNiveau = ($levelNiveau + 1);

                        $bdNiveau = new Niveau();
                        $niveaus = $bdNiveau->getNiveauByLevelNiveau($newLevelNiveau);
                        foreach ($niveaus as $niveau) {
                            $newNiveauId = $niveau['id'];
                        }

                        // echo $newNiveauId; die;

                        // echo $agentId; die;

                        $bdNiveau = new Niveau();
                        $niveauIdForValidation = 0;
                        $niveaus = $bdNiveau->getNiveauForValidation();
                        foreach ($niveaus as $niveau) {
                            $niveauIdForValidation = $niveau['id'];
                        }

                        $emergencySensibilite = "";
                        $sensibilites = $bdSensibilite->getSensibiliteById($sensibiliteId);
                        foreach ($sensibilites as $sensibilite) {
                            $emergencySensibilite = $sensibilite['emergency'];
                        }

                        $emergency = $emergencySensibilite;

                        include '../../models/PHPMailer-src/Config.php';
                        include '../../models/PHPMailer-src/Settings.php';


                        if ($emergency == "yes") {
                            if ($bdRemonte->addRemonte($niveauId, $emergency, $trust, $niveauIdForValidation, $rapportageId, $donneeRecentId, $agentId, $sensibiliteId)) {


                                $agents = $bdAgent->getAgentActiveByNiveauId($niveauIdForValidation);
                                foreach ($agents as $agent) {
                                    $mail->addAddress($agent['email']);     //Add a recipient
                                }


                                $mail->isHTML(true);

                                $mail->Subject = "IES-RTME Platform Notification";
                                // $mail->addEmbeddedImage('path/to/image_file.jpg', 'image_cid');

                                $bdRemontes = new Remonte();
                                $remontes = $bdRemonte->getRemonteByRapportageId($rapportageId);

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
                                <p>Submission to your Level</p>
                                <p>From Level ' .
                                    $levelNiveau .
                                    ' </p>
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

                        if ($bdRemonte->addRemonte($niveauId, $emergency, $trust, $newNiveauId, $rapportageId, $donneeRecentId, $agentId, $sensibiliteId)) {




                            $agents = $bdAgent->getAgentActiveByNiveauId($newNiveauId);
                            foreach ($agents as $agent) {
                                $mail->addAddress($agent['email']);     //Add a recipient
                            }


                            $mail->isHTML(true);

                            $mail->Subject = "IES-RTME Platform Notification";
                            // $mail->addEmbeddedImage('path/to/image_file.jpg', 'image_cid');

                            $bdRemontes = new Remonte();
                            $remontes = $bdRemonte->getRemonteByRapportageId($rapportageId);

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
                                <p>Submission to your Level</p>
                                <p>From Level ' .
                                $levelNiveau .
                                ' </p>
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

    $render = "rapportage";
    $sub = "start";
    $op = "";

    header('Location:../../views/home.php?render=' . sha1($render) . '&sub=' . sha1($sub) . '&op=' . sha1($op) . '&use_project=' . sha1($projectId) . '&use_rapportage=' . ($rapportageId) . '&reponse=' . sha1($reponse));
    die;
}

if (isset($_POST['bt_for_view'])) {

    $rapportageId = securise($_POST['tb_rapportageId']);
    $projectId = securise($_POST['tb_projectId']);

    $render = "information";
    $sub = "start";
    $op = "";
    $reponse = "";

    header('Location:../../views/home.php?render=' . sha1($render) . '&sub=' . sha1($sub) . '&op=' . sha1($op) . '&use_rapportage=' . ($rapportageId) . '&use_project=' . sha1($projectId) . '&reponse=' . sha1($reponse));
    die;
}

if (isset($_POST['bt_search_soumission_byProjectIdByEtat'])) {

    $projectId = securise($_POST['cb_project']);
    $etat = securise($_POST['cb_etat']);

    $render = "soumission";
    $sub = "start";
    $op = "";
    $reponse = "";

    header('Location:../../views/home.php?render=' . sha1($render) . '&sub=' . sha1($sub) . '&op=' . sha1($op) . '&use_project=' . ($projectId) . '&use_etat=' . ($etat) . '&reponse=' . sha1($reponse));
    die;
}

if (isset($_POST['bt_search_soumission_byEmergencyByTrustLevel'])) {

    $emergency = securise($_POST['cb_emergency']);
    $trustLevel = securise($_POST['cb_trustLevel']);

    $render = "soumission";
    $sub = "start";
    $op = "";
    $reponse = "";

    header('Location:../../views/home.php?render=' . sha1($render) . '&sub=' . sha1($sub) . '&op=' . sha1($op) . '&use_emergency=' . ($emergency) . '&use_trustLevel=' . ($trustLevel) . '&reponse=' . sha1($reponse));
    die;
}

if (isset($_POST['bt_search_soumission_byDates'])) {

    $date1 = securise($_POST['tb_date1']);
    $date2 = securise($_POST['tb_date2']);

    $render = "soumission";
    $sub = "start";
    $op = "";
    $reponse = "";

    header('Location:../../views/home.php?render=' . sha1($render) . '&sub=' . sha1($sub) . '&op=' . sha1($op) . '&use_date1=' . ($date1) . '&use_date2=' . ($date2) . '&reponse=' . sha1($reponse));
    die;
}
