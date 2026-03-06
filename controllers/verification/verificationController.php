<?php

include '../../routes/MainRoutes.php';
include '../../models/dataBase/iespConnection.php';
include '../../models/verification/verification.php';
include '../../models/pointfocal/Pointfocal.php';
include '../../models/compte/Compte.php';
include '../../models/PHPMailer-src/Config.php';
include '../../models/PHPMailer-src/Settings.php';


if (isset($_POST['add_verification2'])) {
    $previousId= $_POST['verificationId'];
    $tpmId = $_POST['tpmId'];
    // $keyinformantId = $_POST['keyinformantId'];
    $comment = $_POST['comment'];
    $mention = $_POST['mention'];
    $compteId = $_POST['compteId'];
    // $rating = $_POST['rating'];
    // $issue = $_POST['issue'];
    $issueAnalysis = $_POST['issueAnalysis'];
    $action = $_POST['action'];
    $status = $_POST['status'];

    foreach ($_POST['issue'] as $is) {
        $issue.= $is.", ";
    }
    if (strpos($issue, 'Identification of a case of fraud') != false || strpos($issue, 'Activity reported but not carried out') != false || strpos($issue, 'Non-acceptance of staff or implementing organization in the community') != false) {
        $rating="red";
    } elseif (strpos($issue, 'Delay in the implementation of activities') != false || strpos($issue, 'Carrying out part of the planned activities') != false || strpos($issue, 'Some other concerns identified in the implementation of the activity') != false) {
        $rating="orange";
    } else {
        $rating="green";
    }

    if ($mention != "") {
        $bdVerification = new Verification();
        if (1) {
            if ($bdVerification->addVerification1($tpmId,$comment,$mention,$status,$compteId,$rating,$issue,$issueAnalysis,$action)) {
                $bdVerification->updateVerification($previousId);

                $bdFocal = new Pointfocal();
                $focals = $bdFocal->getFocalPointByTpm($tpmId);
                foreach ($focals as $focal) {
                    $mail->addAddress($focal['email']);     //Add a recipient
                }

                $mail->isHTML(true);

                $mail->Subject = "IES-TPM Services Notification";

                $mail->Body = '
                            <h4><strong>'. 'New IES TPM Repport</strong></h4><hr>
                            <p>Dear IES Partner, You have just received a TPM Report from IES Coordination</p>
                            <p>To get more details, please visit <a href="https://rtmeal.iescongo.com/"> rtmeal.iescongo.com</a></p>
                            <p><strong>Use your credentials to login</strong></p>
                        ';
                $mail->AltBody = 'IES-TPM Services Notification';

                if (!$mail->send()) {
                    $reponse = 'Message could not be sent.';
                    $reponse = 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
                    $reponse = 'Message has been sent';
                    $reponse='success';
                }

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

    MainRoutes::myWay('tpmreport', 'start', 'tpmreport', $reponse, false, false, true, false);
    die;
}

if (isset($_POST['add_verification1'])) {

    $tpmId = $_POST['tpmId'];
    // $keyinformantId = $_POST['keyinformantId'];
    $comment = $_POST['comment'];
    $mention = $_POST['mention'];
    $compteId = $_POST['compteId'];
    $note = $_POST['note'];

    if ($mention != "") {
        $bdVerification = new Verification();
        if (1) {
            if ($bdVerification->addVerification($tpmId,$comment,$mention,$compteId)) {
                $bdVerification->updateTpm($tpmId, $note);

                $bdCoordinator = new Compte();
                $coordinators = $bdCoordinator->getCompteCoordinator();
                foreach ($coordinators as $coordinator) {
                    $mail->addAddress($coordinator['email']);     //Add a recipient
                }

                $mail->isHTML(true);

                $mail->Subject = "IES-TPM Services Notification";

                $mail->Body = '
                            <h4><strong>'. 'New IES TPM Repport</strong></h4><hr>
                            <p>Dear IES Coordinator, You have just received a TPM Report from a Supervisor</p>
                            <p>To get more details, please visit <a href="https://rtmeal.iescongo.com/"> rtmeal.iescongo.com</a></p>
                            <p><strong>Use your credentials to login</strong></p>
                        ';
                $mail->AltBody = 'IES-TPM Services Notification';

                if (!$mail->send()) {
                    $reponse = 'Message could not be sent.';
                    $reponse = 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
                    $reponse = 'Message has been sent';
                    $reponse='success';
                }
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

    MainRoutes::myWay('tpmreport', 'start', 'tpmreport', $reponse, false, false, true, false);
    die;
}

if (isset($_POST['edit_verification'])) {

    $verificationId = $_POST['verificationId'];
    $comment = $_POST['comment'];

    if ($comment != "") {
        $bdVerification = new Verification();
        if (1) {
            if ($bdVerification->editVerification($verificationId,$comment)) {
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

    MainRoutes::myWay('tpmreport', 'start', 'tpmreport', $reponse, false, false, true, false);
    die;
}

if (isset($_POST['send_feedback'])) {

    $tpmId = $_POST['tpmId'];
    $instruction = $_POST['instruction'];
    $note = $_POST['note'];

    if ($note != "0" && $tpmId !=0) {
        $bdVerification = new Verification();
        if (1) {
            if ($bdVerification->addTpmFeedback($tpmId,$instruction)) {
                $bdVerification->updateTpm($tpmId, $note);
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

    MainRoutes::myWay('tpmreport', 'start', 'tpmreport', $reponse, false, false, true, false);
    die;
}
