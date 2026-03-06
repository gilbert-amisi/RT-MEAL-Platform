<?php

include '../../routes/MainRoutes.php';
include '../../models/dataBase/iespConnection.php';
include '../../models/tpmreport/tpmreport.php';
include '../../models/supervisor/supervisor.php';
include '../../models/PHPMailer-src/Config.php';
include '../../models/PHPMailer-src/Settings.php';


if (isset($_POST['add_tpm'])) {

    $affectationId = securise($_POST['affectationId']);;
    $comment = securise($_POST['comment']);

    if ( (isset($_FILES['image1']['tmp_name']))) {
        $urlImage1=$_FILES['image1']['tmp_name'];
        $image1=basename($_FILES['image1']['name']);
        $urlImage2=$_FILES['image2']['tmp_name'];
        $image2=basename($_FILES['image2']['name']);
        $urlImage3=$_FILES['image3']['tmp_name'];
        $image3=basename($_FILES['image3']['name']);
        $urlFg=$_FILES['fgFile']['tmp_name'];
        $fgFile=basename($_FILES['fgFile']['name']);
        $urlKi=$_FILES['kiFile']['tmp_name'];
        $kiFile=basename($_FILES['kiFile']['name']);
        $filedest1='pieces/'.$image1;
        $filedest2='pieces/'.$image2;
        $filedest3='pieces/'.$image3;
        $filedest4='pieces/'.$fgFile;
        $filedest5='pieces/'.$kiFile;
    }
    // die;

    if ($comment != "") {
        move_uploaded_file($urlImage1,$filedest1);
        move_uploaded_file($urlImage2,$filedest2);
        move_uploaded_file($urlImage3,$filedest3);
        move_uploaded_file($urlFg,$filedest4);
        move_uploaded_file($urlKi,$filedest5);
        $bdTpm = new Tpm();

        if (1) {
            if ($bdTpm->addTpm($affectationId, $comment, $image1, $image2, $image3, $fgFile, $kiFile)) {
                $bdTpm->disableAffectation($affectationId);

                $bdSupervisor = new Supervisor();
                $supervisors = $bdSupervisor->getSupervisorByAffectation($affectationId);
                foreach ($supervisors as $supervisor) {
                    $mail->addAddress($supervisor['email']);     //Add a recipient
                }

                $mail->isHTML(true);

                $mail->Subject = "IES-TPM Services Notification";

                $mail->Body = '
                            <h4><strong>'. 'New Incoming TPM Report</strong></h4><hr>
                            <p>Dear IES Supervisor, You have just received a TPM Report from a Proxy Monitor.</p>
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

    MainRoutes::myWay('tpmreport', 'start', 'tpmreport', $reponse, false, false, true, false);
    die;
}

if (isset($_POST['edit_tpm'])) {

    $tpmId = securise($_POST['tpmId']);;
    $comment = securise($_POST['comment']);

    if ( (isset($_FILES['image1']['tmp_name']))) {
        $urlImage1=$_FILES['image1']['tmp_name'];
        $image1=basename($_FILES['image1']['name']);
        $urlImage2=$_FILES['image2']['tmp_name'];
        $image2=basename($_FILES['image2']['name']);
        $urlImage3=$_FILES['image3']['tmp_name'];
        $image3=basename($_FILES['image3']['name']);
        $urlFg=$_FILES['fgFile']['tmp_name'];
        $fgFile=basename($_FILES['fgFile']['name']);
        $urlKi=$_FILES['kiFile']['tmp_name'];
        $kiFile=basename($_FILES['kiFile']['name']);
        $filedest1='pieces/'.$image1;
        $filedest2='pieces/'.$image2;
        $filedest3='pieces/'.$image3;
        $filedest4='pieces/'.$fgFile;
        $filedest5='pieces/'.$kiFile;
    }
    // die;

    if ($comment != "") {
        move_uploaded_file($urlImage1,$filedest1);
        move_uploaded_file($urlImage2,$filedest2);
        move_uploaded_file($urlImage3,$filedest3);
        move_uploaded_file($urlFg,$filedest4);
        move_uploaded_file($urlKi,$filedest5);
        $bdTpm = new Tpm();

        if (1) {
            if ($bdTpm->editTpm($comment, $image1, $image2, $image3, $fgFile, $kiFile, $tpmId)) {
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

if (isset($_POST['add_final_report'])) {

    $phaseId = securise($_POST['phaseId']);;
    $comment = securise($_POST['comment']);

    if ( (isset($_FILES['file']['tmp_name']))) {
        $urlFile=$_FILES['file']['tmp_name'];
        $file=basename($_FILES['file']['name']);
        $filedest='pieces/finalreport/'.$file;
    }
    // die;

    if ($phaseId != "") {
        move_uploaded_file($urlFile,$filedest);
        $bdTpm = new Tpm();

        if (1) {
            if ($bdTpm->addFinalReport($file, $comment, $phaseId)) {
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

    MainRoutes::myWay('finalreport', 'start', 'finalreport', $reponse, false, false, true, false);
    die;
}
