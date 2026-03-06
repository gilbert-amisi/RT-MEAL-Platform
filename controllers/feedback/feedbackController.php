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
include '../../models/feedback/Feedback.php';
include '../../models/ajuste/Ajuste.php';
include '../../models/traite/Traite.php';
include '../../models/niveau/Niveau.php';

if (isset($_POST['bt_add'])) {


    $donnee = securise($_POST['tb_donnee']);
    $projectId = securise($_POST['tb_projectId']);
    $rapportageId = securise($_POST['tb_rapportageId']);
    $remonteId = securise($_POST['tb_remonteId']);
    $soumissionId = securise($_POST['tb_soumissionId']);
    $pointfocalId = securise($_POST['tb_pointfocalId']);

    // die;

    if ($donnee != "" && $projectId != "" && $rapportageId != "" && $remonteId != "" && $soumissionId != "") {
        $bdDonnee = new Donnee();
        $bdFeedback = new Feedback();

        if (1) {
            if ($bdDonnee->addDonnee($donnee)) {
                $donneeRecentId = 0;
                $donnees = $bdDonnee->getDonneeRecent();
                foreach ($donnees as $donnee) {
                    $donneeRecentId = $donnee['recentId'];
                }
                if (1) {

                    if (1) {

                        if ($bdFeedback->addFeedback($soumissionId, $donneeRecentId, $pointfocalId)) {


                            include '../../models/PHPMailer-src/Config.php';
                            include '../../models/PHPMailer-src/Settings.php';

                            $bdNiveau = new Niveau();
                            $bdAgent = new Agent();
                            $niveaus = $bdNiveau->getNiveauForValidation();
                            foreach ($niveaus as $niveau) {
                                $agents = $bdAgent->getAgentActiveByNiveauId($niveau['id']);
                                foreach ($agents as $agent) {
                                    $mail->addAddress($agent['email']);     //Add a recipient
                                }
                            }


                            $bdFeedback = new Feedback();

                            $recentFeedback = "";
                            $feedbacks = $bdFeedback->getFeedbackRecent();
                            foreach ($feedbacks as $feedback) {
                                $recentFeedback = $feedback['recentId'];
                            }


                            $dateRemonte = "";
                            $dateFeedback = "";
                            $dateRapport = "";
                            $subjectRapport = "";
                            $dateEvent = "";
                            $heureEvent = "";
                            $locationEvent = "";
                            $data = "";
                            $projectDesignation = "";
                            $organisationDesignation = "";

                            $feedbacks = $bdFeedback->getFeedbackById($recentFeedback);
                            foreach ($feedbacks as $feedback) {

                                $dateFeedback = $feedback['feDateHeure'];
                                $dateRemonte = $feedback['feDateHeure'];
                                $dateRapport = $feedback['raDateHeure'];
                                $subjectRapport = $feedback['subject'];
                                $dateEvent = $feedback['dateEvent'];
                                $heureEvent = $feedback['infHeure'];
                                $locationEvent = $feedback['infLieu'];
                                $dataReport = $feedback['dorValeur'];
                                $dataFeedback = $feedback['dofeValeur'];
                                $projectDesignation = $feedback['prDesignation'];
                                $organisationDesignation = $feedback['ogDesignation'];
                            }

                            $mail->isHTML(true);

                            $mail->Subject = "IES-RTME Platform Notification from " . $organisationDesignation;
                            // $mail->addEmbeddedImage('path/to/image_file.jpg', 'image_cid');


                            $mail->Body = '
                                <h4><strong>IES-RTME Notification from Partner</strong></h4>
                                
                                <p>Feedback date : ' .
                                $dateFeedback .
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
                                    <table>
                                        <tr>
                                            <td>
                                                <p><strong>Information: 
                                                    </strong></p>
                                                    <p>' .
                                $dataReport
                                . '
                                                    </p>
                                            </td>
                                            <td>
                                                <p><strong>Feedback: 
                                                    </strong></p>
                                                    <p>' .
                                $dataFeedback
                                . '
                                                    </p>
                                            </td>
                                        </tr>
                                    </table>
                                    
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

    $render = "feedback";
    $sub = "viewFeedback";
    $op = "";

    header('Location:../../views/home.php?render=' . sha1($render) . '&sub=' . sha1($sub) . '&op=' . sha1($op) . '&use_project=' . sha1($projectId) . '&use_rapportage=' . ($rapportageId) . '&use_remonte=' . ($remonteId) . '&reponse=' . sha1($reponse));
    die;
}

if (isset($_POST['bt_validate'])) {


    $donnee = securise($_POST['tb_donnee']);
    $projectId = securise($_POST['tb_projectId']);
    $rapportageId = securise($_POST['tb_rapportageId']);
    $remonteId = securise($_POST['tb_remonteId']);
    $soumissionId = securise($_POST['tb_soumissionId']);
    $feedbackId = securise($_POST['tb_feedbackId']);
    $niveauIdOriginal = securise($_POST['cb_niveau']);

    // die;

    if ($donnee != "" && $projectId != "" && $rapportageId != "" && $remonteId != "" && $soumissionId != "" && $feedbackId != "" && $niveauIdOriginal != 0) {
        $bdDonnee = new Donnee();
        $bdFeedback = new Feedback();
        $bdAjuste = new Ajuste();

        if (1) {
            if ($bdDonnee->addDonnee($donnee)) {
                $donneeRecentId = 0;
                $donnees = $bdDonnee->getDonneeRecent();
                foreach ($donnees as $donnee) {
                    $donneeRecentId = $donnee['recentId'];
                }
                if (1) {
                    $agentId = 0;
                    $niveauId = 0;
                    $bdAgent = new Agent();
                    $agents = $bdAgent->getAgentActiveByCompteId($_SESSION['compteId']);
                    foreach ($agents as $agent) {
                        $agentId = $agent['agId'];
                        $niveauId = $agent['nvId'];
                    }


                    if (1) {

                        if ($bdAjuste->addAjuste($agentId, $feedbackId, $donneeRecentId, $niveauIdOriginal)) {

                            include '../../models/PHPMailer-src/Config.php';
                            include '../../models/PHPMailer-src/Settings.php';

                            $bdNiveau = new Niveau();
                            $bdAgent = new Agent();
                            $agents = $bdAgent->getAgentActiveByNiveauId($niveauIdOriginal);
                            foreach ($agents as $agent) {
                                $mail->addAddress($agent['email']);     //Add a recipient
                            }

                            $dateRemonte = "";
                            $dateFeedback = "";
                            $dateRapport = "";
                            $subjectRapport = "";
                            $dateEvent = "";
                            $heureEvent = "";
                            $locationEvent = "";
                            $dataValidation = "";
                            $projectDesignation = "";
                            $organisationDesignation = "";

                            $ajustes = $bdAjuste->getAjusteByFeedbackId($feedbackId);
                            foreach ($ajustes as $ajuste) {

                                $dateAjuste = $ajuste['afDateHeure'];
                                $dateFeedback = $ajuste['feDateHeure'];
                                $dateRemonte = $ajuste['feDateHeure'];
                                $dateRapport = $ajuste['raDateHeure'];
                                $subjectRapport = $ajuste['subject'];
                                $dateEvent = $ajuste['dateEvent'];
                                $heureEvent = $ajuste['infHeure'];
                                $locationEvent = $ajuste['infLieu'];
                                $dataValidation = $ajuste['doafValeur'];
                                $projectDesignation = $ajuste['prDesignation'];
                                $organisationDesignation = $ajuste['ogDesignation'];
                            }

                            $mail->isHTML(true);

                            $mail->Subject = "IES-RTME Platform Notification";
                            // $mail->addEmbeddedImage('path/to/image_file.jpg', 'image_cid');


                            $mail->Body = '
                                <h4><strong>Feedback validation</strong></h4>
                                
                                <p>Validation date : ' .
                                $dateAjuste .
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
                                    <table >
                                        <tr>
                                            
                                            <td>
                                                <p><strong>Feedback validated: 
                                                    </strong></p>
                                                    <p>' .
                                $dataValidation
                                . '
                                                    </p>
                                            </td>
                                        </tr>
                                    </table>
                                    
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


    $render = "feedback";
    $sub = "validateFeedback";
    $op = "";

    header('Location:../../views/home.php?render=' . sha1($render) . '&sub=' . sha1($sub) . '&op=' . sha1($op) . '&use_project=' . sha1($projectId) . '&use_rapportage=' . ($rapportageId) . '&use_remonte=' . ($remonteId) . '&use_soumission=' . ($soumissionId) . '&use_feedback=' . ($feedbackId) . '&reponse=' . sha1($reponse));
    die;
}

if (isset($_POST['bt_traite'])) {

    $commentaire = securise($_POST['tb_commentaire']);
    $projectId = securise($_POST['tb_projectId']);
    $rapportageId = securise($_POST['tb_rapportageId']);
    $remonteId = securise($_POST['tb_remonteId']);
    $soumissionId = securise($_POST['tb_soumissionId']);
    $feedbackId = securise($_POST['tb_feedbackId']);
    $ajusteId = securise($_POST['tb_ajusteId']);
    $etat = securise($_POST['cb_etat']);

    // die;

    if ($commentaire != "" && $projectId != "" && $rapportageId != "" && $remonteId != "" && $soumissionId != "" && $feedbackId != "" && $ajusteId != "" && $etat != "none") {
        $bdDonnee = new Donnee();
        $bdFeedback = new Feedback();
        $bdAjuste = new Ajuste();
        $bdTraite = new Traite();

        if (1) {
            if (1) {

                if (1) {
                    $agentId = 0;
                    $niveauId = 0;
                    $bdAgent = new Agent();
                    $agents = $bdAgent->getAgentActiveByCompteId($_SESSION['compteId']);
                    foreach ($agents as $agent) {
                        $agentId = $agent['agId'];
                        $niveauId = $agent['nvId'];
                    }


                    if (1) {

                        if ($bdTraite->addTraite($etat, $commentaire, $agentId, $ajusteId)) {


                            include '../../models/PHPMailer-src/Config.php';
                            include '../../models/PHPMailer-src/Settings.php';

                            $bdNiveau = new Niveau();
                            $bdAgent = new Agent();
                            $agents = $bdAgent->getAgentActiveAll();
                            foreach ($agents as $agent) {
                                $mail->addAddress($agent['email']);     //Add a recipient
                            }

                            $dateTraite = "";
                            $dateRemonte = "";
                            $dateFeedback = "";
                            $dateRapport = "";
                            $subjectRapport = "";
                            $dateEvent = "";
                            $heureEvent = "";
                            $locationEvent = "";
                            $dataValidation = "";
                            $projectDesignation = "";
                            $organisationDesignation = "";
                            $tfCommentaire = "";
                            $tfEtat = "";

                            $traites = $bdTraite->getTraiteByAjusteId($ajusteId);
                            foreach ($traites as $traite) {

                                $dateTraite = $traite['tfDateHeure'];
                                $dateAjuste = $traite['afDateHeure'];
                                $dateFeedback = $traite['feDateHeure'];
                                $dateRemonte = $traite['feDateHeure'];
                                $dateRapport = $traite['raDateHeure'];
                                $subjectRapport = $traite['subject'];
                                $dateEvent = $traite['dateEvent'];
                                $heureEvent = $traite['infHeure'];
                                $locationEvent = $traite['infLieu'];
                                $dataValidation = $traite['doafValeur'];
                                $projectDesignation = $traite['prDesignation'];
                                $organisationDesignation = $traite['ogDesignation'];
                                $tfCommentaire = $traite['tfCommentaire'];
                                $tfEtat = $traite['tfEtat'];

                            }

                            $mail->isHTML(true);

                            $mail->Subject = "IES-RTME Platform Notification";
                            // $mail->addEmbeddedImage('path/to/image_file.jpg', 'image_cid');


                            $mail->Body = '
                                <h4><strong>Feedback posted</strong></h4>
                                
                                <p>Post date : ' .
                                $dateTraite .
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
                                    <table>
                                        <tr>
                                            
                                            <td>
                                                <p><strong>Feedback validated: 
                                                    </strong></p>
                                                    <p>' .
                                $dataValidation
                                . '
                                                    </p>
                                            </td>
                                            <td>
                                                 | 
                                            </td>
                                            <td>
                                                <p><strong>Comment from source: 
                                                    </strong></p>
                                                    <p>' .
                                $tfCommentaire
                                . '
                                                    </p>
                                            </td>
                                            <td>
                                                 | 
                                            </td>
                                            <td>
                                                <p><strong>Situation: 
                                                    </strong></p>
                                                    <p>' .
                                $tfEtat
                                . '
                                                    </p>
                                            </td>
                                            <td>
                                                 | 
                                            </td>
                                        </tr>
                                    </table>
                                    
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


    $render = "feedback";
    $sub = "traite";
    $op = "";

    header('Location:../../views/home.php?render=' . sha1($render) . '&sub=' . sha1($sub) . '&op=' . sha1($op) . '&use_project=' . sha1($projectId) . '&use_rapportage=' . ($rapportageId) . '&use_remonte=' . ($remonteId) . '&use_soumission=' . ($soumissionId) . '&use_feedback=' . ($feedbackId) . '&use_ajuste=' . ($ajusteId) . '&reponse=' . sha1($reponse));
    die;
}

if (isset($_POST['bt_for_triangulation'])) {
    $rapportageId = securise($_POST['tb_rapportageId']);
    $projectId = securise($_POST['tb_projectId']);

    $render = "triangulation";
    $sub = "start";
    $op = "";
    $reponse = "";

    header('Location:../../views/home.php?render=' . sha1($render) . '&sub=' . sha1($sub) . '&op=' . sha1($op) . '&use_rapportage=' . ($rapportageId) . '&use_project=' . sha1($projectId) . '&reponse=' . sha1($reponse));
    die;
}

if (isset($_POST['bt_for_view_information'])) {

    $rapportageId = securise($_POST['tb_rapportageId']);
    $remonteId = securise($_POST['tb_remonteId']);
    $projectId = securise($_POST['tb_projectId']);
    $soumissionId = securise($_POST['tb_soumissionId']);

    $render = "feedback";
    $sub = "viewInformation";
    $op = "";
    $reponse = "";

    header('Location:../../views/home.php?render=' . sha1($render) . '&sub=' . sha1($sub) . '&op=' . sha1($op) . '&use_rapportage=' . ($rapportageId) . '&use_project=' . sha1($projectId) . '&use_remonte=' . ($remonteId) . '&use_soumission=' . ($soumissionId) . '&reponse=' . sha1($reponse));
    die;
}

if (isset($_POST['bt_for_view_triangulation'])) {

    $rapportageId = securise($_POST['tb_rapportageId']);
    $remonteId = securise($_POST['tb_remonteId']);
    $projectId = securise($_POST['tb_projectId']);
    $soumissionId = securise($_POST['tb_soumissionId']);

    $render = "feedback";
    $sub = "viewTriangulation";
    $op = "";
    $reponse = "";

    header('Location:../../views/home.php?render=' . sha1($render) . '&sub=' . sha1($sub) . '&op=' . sha1($op) . '&use_rapportage=' . ($rapportageId) . '&use_project=' . sha1($projectId) . '&use_remonte=' . ($remonteId) . '&use_soumission=' . ($soumissionId) . '&reponse=' . sha1($reponse));
    die;
}

if (isset($_POST['bt_for_view_triangulation_details'])) {

    $rapportageId = securise($_POST['tb_rapportageId']);
    $remonteId = securise($_POST['tb_remonteId']);
    $projectId = securise($_POST['tb_projectId']);
    $soumissionId = securise($_POST['tb_soumissionId']);
    $triangulationId = securise($_POST['tb_triangulationId']);

    $render = "feedback";
    $sub = "viewTriangulationDetails";
    $op = "";
    $reponse = "";

    header('Location:../../views/home.php?render=' . sha1($render) . '&sub=' . sha1($sub) . '&op=' . sha1($op) . '&use_rapportage=' . ($rapportageId) . '&use_project=' . sha1($projectId) . '&use_remonte=' . ($remonteId) . '&use_soumission=' . ($soumissionId) . '&use_triangulation=' . ($triangulationId) . '&reponse=' . sha1($reponse));
    die;
}

if (isset($_POST['bt_for_add'])) {

    $rapportageId = securise($_POST['tb_rapportageId']);
    $remonteId = securise($_POST['tb_remonteId']);
    $projectId = securise($_POST['tb_projectId']);
    $soumissionId = securise($_POST['tb_soumissionId']);

    $render = "feedback";
    $sub = "add";
    $op = "";
    $reponse = "";

    header('Location:../../views/home.php?render=' . sha1($render) . '&sub=' . sha1($sub) . '&op=' . sha1($op) . '&use_rapportage=' . ($rapportageId) . '&use_project=' . sha1($projectId) . '&use_remonte=' . ($remonteId) . '&use_soumission=' . ($soumissionId) . '&reponse=' . sha1($reponse));
    die;
}

if (isset($_POST['bt_for_view_information_feedback'])) {

    $rapportageId = securise($_POST['tb_rapportageId']);
    $remonteId = securise($_POST['tb_remonteId']);
    $projectId = securise($_POST['tb_projectId']);
    $soumissionId = securise($_POST['tb_soumissionId']);
    $feedbackId = securise($_POST['tb_feedbackId']);

    $render = "feedback";
    $sub = "viewFeedbackDetails";
    $op = "";
    $reponse = "";

    header('Location:../../views/home.php?render=' . sha1($render) . '&sub=' . sha1($sub) . '&op=' . sha1($op) . '&use_rapportage=' . ($rapportageId) . '&use_project=' . sha1($projectId) . '&use_remonte=' . ($remonteId) . '&use_soumission=' . ($soumissionId) . '&use_feedback=' . ($feedbackId) . '&reponse=' . sha1($reponse));
    die;
}

if (isset($_POST['bt_for_validate'])) {

    $rapportageId = securise($_POST['tb_rapportageId']);
    $remonteId = securise($_POST['tb_remonteId']);
    $projectId = securise($_POST['tb_projectId']);
    $soumissionId = securise($_POST['tb_soumissionId']);
    $feedbackId = securise($_POST['tb_feedbackId']);

    $render = "feedback";
    $sub = "validateFeedback";
    $op = "";
    $reponse = "";

    header('Location:../../views/home.php?render=' . sha1($render) . '&sub=' . sha1($sub) . '&op=' . sha1($op) . '&use_rapportage=' . ($rapportageId) . '&use_project=' . sha1($projectId) . '&use_remonte=' . ($remonteId) . '&use_soumission=' . ($soumissionId) . '&use_feedback=' . ($feedbackId) . '&reponse=' . sha1($reponse));
    die;
}

if (isset($_POST['bt_for_view_information_validation'])) {

    $rapportageId = securise($_POST['tb_rapportageId']);
    $remonteId = securise($_POST['tb_remonteId']);
    $projectId = securise($_POST['tb_projectId']);
    $soumissionId = securise($_POST['tb_soumissionId']);
    $feedbackId = securise($_POST['tb_feedbackId']);
    $ajusteId = securise($_POST['tb_ajusteId']);

    $render = "feedback";
    $sub = "validationDetails";
    $op = "";
    $reponse = "";

    header('Location:../../views/home.php?render=' . sha1($render) . '&sub=' . sha1($sub) . '&op=' . sha1($op) . '&use_rapportage=' . ($rapportageId) . '&use_project=' . sha1($projectId) . '&use_remonte=' . ($remonteId) . '&use_soumission=' . ($soumissionId) . '&use_feedback=' . ($feedbackId) . '&use_ajuste=' . ($ajusteId) . '&reponse=' . sha1($reponse));
    die;
}

if (isset($_POST['bt_for_traite'])) {

    $rapportageId = securise($_POST['tb_rapportageId']);
    $remonteId = securise($_POST['tb_remonteId']);
    $projectId = securise($_POST['tb_projectId']);
    $soumissionId = securise($_POST['tb_soumissionId']);
    $feedbackId = securise($_POST['tb_feedbackId']);
    $ajusteId = securise($_POST['tb_ajusteId']);

    $render = "feedback";
    $sub = "traite";
    $op = "";
    $reponse = "";

    header('Location:../../views/home.php?render=' . sha1($render) . '&sub=' . sha1($sub) . '&op=' . sha1($op) . '&use_rapportage=' . ($rapportageId) . '&use_project=' . sha1($projectId) . '&use_remonte=' . ($remonteId) . '&use_soumission=' . ($soumissionId) . '&use_feedback=' . ($feedbackId) . '&use_ajuste=' . ($ajusteId) . '&reponse=' . sha1($reponse));
    die;
}

if (isset($_POST['bt_search_validation'])) {

    $ajusteId = securise($_POST['cb_ajuste']);

    $render = "feedback";
    $sub = "validation";
    $op = "";
    $reponse = "";

    header('Location:../../views/home.php?render=' . sha1($render) . '&sub=' . sha1($sub) . '&op=' . sha1($op) . '&use_ajuste=' . ($ajusteId) . '&reponse=' . sha1($reponse));
    die;
}

if (isset($_POST['bt_search_validation_byProjectId'])) {

    $projectId = securise($_POST['cb_project']);

    $render = "feedback";
    $sub = "validation";
    $op = "";
    $reponse = "";

    header('Location:../../views/home.php?render=' . sha1($render) . '&sub=' . sha1($sub) . '&op=' . sha1($op) . '&use_project=' . ($projectId) . '&reponse=' . sha1($reponse));
    die;
}

if (isset($_POST['bt_search_post_byProjectByEtat'])) {

    $projectId = securise($_POST['cb_project']);
    $etat = securise($_POST['cb_etat']);

    $render = "feedback";
    $sub = "viewPost";
    $op = "";
    $reponse = "";

    header('Location:../../views/home.php?render=' . sha1($render) . '&sub=' . sha1($sub) . '&op=' . sha1($op) . '&use_project=' . ($projectId) . '&use_etat=' . ($etat) . '&reponse=' . sha1($reponse));
    die;
}

if (isset($_POST['bt_search_post_byAgentId'])) {

    $agentId = securise($_POST['cb_agent']);

    $render = "feedback";
    $sub = "viewPost";
    $op = "";
    $reponse = "";

    header('Location:../../views/home.php?render=' . sha1($render) . '&sub=' . sha1($sub) . '&op=' . sha1($op) . '&use_agent=' . ($agentId) . '&reponse=' . sha1($reponse));
    die;
}

if (isset($_POST['bt_search_post_byDates'])) {

    $date1 = securise($_POST['tb_date1']);
    $date2 = securise($_POST['tb_date2']);

    $render = "feedback";
    $sub = "viewPost";
    $op = "";
    $reponse = "";

    header('Location:../../views/home.php?render=' . sha1($render) . '&sub=' . sha1($sub) . '&op=' . sha1($op) . '&use_date1=' . ($date1) . '&use_date2=' . ($date2) . '&reponse=' . sha1($reponse));
    die;
}

if (isset($_POST['bt_search_soumission_bySensibiliteId'])) {

    $sensibiliteId = securise($_POST['cb_sensibilite']);

    $render = "feedback";
    $sub = "start";
    $op = "";
    $reponse = "";

    header('Location:../../views/home.php?render=' . sha1($render) . '&sub=' . sha1($sub) . '&op=' . sha1($op) . '&use_sensibilite=' . ($sensibiliteId) . '&reponse=' . sha1($reponse));
    die;
}

if (isset($_POST['bt_search_soumission_byEmergencyByTrustLevel'])) {

    $emergency = securise($_POST['cb_emergency']);
    $trustLevel = securise($_POST['cb_trustLevel']);

    $render = "feedback";
    $sub = "start";
    $op = "";
    $reponse = "";

    header('Location:../../views/home.php?render=' . sha1($render) . '&sub=' . sha1($sub) . '&op=' . sha1($op) . '&use_emergency=' . ($emergency) . '&use_trustLevel=' . ($trustLevel) . '&reponse=' . sha1($reponse));
    die;
}

if (isset($_POST['bt_search_soumission_byDates'])) {

    $date1 = securise($_POST['tb_date1']);
    $date2 = securise($_POST['tb_date2']);

    $render = "feedback";
    $sub = "start";
    $op = "";
    $reponse = "";

    header('Location:../../views/home.php?render=' . sha1($render) . '&sub=' . sha1($sub) . '&op=' . sha1($op) . '&use_date1=' . ($date1) . '&use_date2=' . ($date2) . '&reponse=' . sha1($reponse));
    die;
}
