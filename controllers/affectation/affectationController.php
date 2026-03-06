<?php

include '../../routes/MainRoutes.php';
include '../../models/dataBase/iespConnection.php';
include '../../models/affectation/affectation.php';
include '../../models/supervisor/supervisor.php';
include '../../models/proxyMonitor/proxyMonitor.php';
include '../../models/PHPMailer-src/Config.php';
include '../../models/PHPMailer-src/Settings.php';

if (isset($_POST['add_affectation'])) {
    $start = securise($_POST['start']); 
    $end = securise($_POST['end']); 
    $instruction = securise($_POST['instruction']); 
    $axeId = securise($_POST['axeId']);
    $village = securise($_POST['village']); 
    $supervisorId = securise($_POST['supervisorId']); 
    // $proxyId = securise($_POST['proxyId']);
    $activityId = securise($_POST['activityId']);
    $phaseId = securise($_POST['phaseId']);
    $ipId = securise($_POST['ipId']);

    // die;

    if ($axeId!=0 && $supervisorId!=0 && $ipId!=0 && $start!="" && $end!="" && $phaseId!=0 && $activityId!=0) {
        $bdAffectation = new Affectation();
        if (1) {
            if ($bdAffectation->addAffectation4($start, $end, $instruction, $axeId, $village,  $ipId, $supervisorId, $activityId, $phaseId)) {
                $bdSupervisor = new Supervisor();
                $supervisors = $bdSupervisor->getSupervisorById($supervisorId);
                foreach ($supervisors as $supervisor) {
                    $mail->addAddress($supervisor['email']);     //Add a recipient
                }

                $mail->isHTML(true);

                $mail->Subject = "IES-TPM Services Notification";

                $mail->Body = '
                            <h4><strong>'. 'New Assignement to perform</strong></h4><hr>
                            <p>Dear IES Supervisor, You have just been affected to perform IES TPM Services at '.$village.'</p>
                            <p>Start Date: '.$start.' </p>
                            <p>End Date: '.$end.' </p>
                            <hr>
                            <p>To get more details, please visit <a href="https://rtmeal.iescongo.com/"> rtmeal.iescongo.com/</a></p>
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

    MainRoutes::myWay('affectation', 'start', 'affectation', $reponse, false, false, true, false);
    die;
}

if (isset($_POST['assign_proxy'])) {
    $affectationId = securise($_POST['affectationId']);
    $start = securise($_POST['start']); 
    $end = securise($_POST['end']); 
    $instruction = securise($_POST['instruction']); 
    $village = securise($_POST['village']); 
    $proxyId = securise($_POST['proxyId']);

    // die;

    if ($proxyId!="0" && $start!="" && $end!="" && $instruction!="" && $village!="") {
        $bdAffectation = new Affectation();
        if (1) {
            if ($bdAffectation->assignProxy($proxyId, $village, $start, $end, $instruction, $affectationId)) {
                $bdProxy = new ProxyMonitor();
                $proxies = $bdProxy->getProxyById($proxyId);
                foreach ($proxies as $proxy) {
                    $mail->addAddress($proxy['email']);     //Add a recipient
                }

                $mail->isHTML(true);

                $mail->Subject = "IES-TPM Services Notification";

                $mail->Body = '
                            <h4><strong>'. 'New Assignement to perform</strong></h4><hr>
                            <p>Dear IES Proxy Monitor, You have just been affected to perform IES TPM Services at '.$village.'</p>
                            <p>Start Date: '.$start.' </p>
                            <p>End Date: '.$end.' </p>
                            <hr>
                            <p>To get more details, please visit <a href="https://rtmeal.iescongo.com/"> rtmeal.iescongo.com/</a></p>
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

    MainRoutes::myWay('affectation', 'start', 'affectation', $reponse, false, false, true, false);
    die;
}

if (isset($_POST['bt_delete'])) {
    $affectationId = securise($_POST['affectationId']);

    // die;

    if ($affectationId!="") {
        $bdAffectation = new Affectation();
        if (1) {
            if ($bdAffectation->deleteAffectation($affectationId)) {

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

    MainRoutes::myWay('affectation', 'start', 'affectation', $reponse, false, false, true, false);
    die;
}
