<?php
if (isset($_SESSION['identite'])) {
    $bdTpmfd = new Tpm();
    if (isset($_GET['tpmId']) && $_SESSION['typeCompte'] == "TPM Proxy Monitor") {
        $fds = $bdTpmfd->getFeedbackByTpm($_GET['tpmId']);
    } 
    if (!isset($_GET['tpmId']) && $_SESSION['typeCompte'] == "TPM Proxy Monitor") {
        $fds = $bdTpmfd->getTpmFeedbackByProxy($_SESSION['compteId']);
    }
        
    if ($_SESSION['typeCompte'] == "TPM Supervisor") {
        $fds = $bdTpmfd->getTpmFeedbackAll($_SESSION['compteId']);
    }
?>

        <div class="h6 p-2 m-2" style="font-family: Georgia, 'Times New Roman', Times, serif"><b>TPM FEEDBACK FROM SUPERVISOR</b></div><hr>
        <?php
        if (empty($fds)) {
            ?>
                <div class="h4 text-center text-danger">No feedback data for your reports</div>
            <?php
        }
        else {
           
        foreach ($fds as $fd) {
            ?>
            <div class="card p-2 m-2">
                <table class="table table-bordered table-condensed table-responsive-sm">
                    <tbody>
                        <tr>
                            <td style="width: 20%;">Project</td>
                            <td style="width: 80%;"><b><?= $fd['proj'] ?> OF <?= $fd['org'] ?> - <?= $fd['phasename'] ?> (<?= $fd['phasetype'] ?>)</td></b>
                        </tr>
                        <tr>
                            <td style="width: 20%;">Activity</td>
                            <td style="width: 80%;"><?= $fd['activ'] ?></td>
                        </tr>
                        <tr>
                            <td style="width: 20%;">Performed by</td>
                            <td style="width: 80%;"><?= $fd['implementor'] ?> at <?= $fd['village'] ?>/<?= $fd['terr'] ?>/<?= $fd['province'] ?></td>
                        </tr>
                        <tr>
                            <td style="width: 20%;">Proxy Monitor</td>
                            <td style="width: 80%;"><?= $fd['prx'] ?> (<?= $fd['proxphone'] ?>)</td>
                        </tr>
                        <tr>
                            <td style="width: 20%;">Submission</td>
                            <td style="width: 80%;"><?= $fd['date'] ?></td>
                        </tr>
                        <tr>
                            <td style="width: 20%;">Feedback date</td>
                            <td style="width: 80%;"><?= $fd['fddate'] ?></td>
                        </tr>
                        <?php
                        if ($_SESSION['typeCompte'] == "TPM Proxy Monitor") {
                            ?>
                            <tr>
                                <td style="width: 20%;">Action</td>
                                <td style="width: 80%;">
                                    <a class="btn btn-outline-primary btn-sm" title="Improve the report according to Supervisor's feedback" href="home.php?render=<?= sha1("edittpmreport") ?>&sub=<?= sha1("start") ?>&tpmId=<?= $fd['tpmId'] ?>&image1=<?= $fd['image1'] ?>&image2=<?= $fd['image2'] ?>&image3=<?= $fd['image3'] ?>&fg=<?= $fd['fgTranscript'] ?>&ki=<?= $fd['kiTranscript'] ?>&comment=<?= $fd['comment'] ?>&instruction=<?= $fd['instruction'] ?>">
                                        <i class="fa fa-edit"></i> Improve report
                                    </a>
                                </td>
                            </tr>

                            <?php
                        }

                        ?>
                        
                    </tbody>
                </table>
                <div class="row p-2 m-2">
                    <div class="alert alert-danger col mt-2" role="alert">
                        <b class="alert-heading">Original report</b><hr>
                        <p><?= $fd['comment'] ?></p>

                    </div>
                    <div class="alert alert-primary col mt-2" role="alert">
                        <b class="alert-heading">Supervisor's feedback </b><hr>
                        <p><?= $fd['instruction'] ?></p>
                    </div>    
                </div>

            </div>          
        <?php
        }
    }

}
?>

