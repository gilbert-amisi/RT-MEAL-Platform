<?php
if (isset($_SESSION['identite'])) {
    $phaseId = $_GET['phaseId'];
    $bdPhase = new Phase();
    $phases = $bdPhase->getPhaseAll();
    foreach ($phases as $phase) {
        if ($phase['id'] == $_GET['phaseId']) {
            $phaseId = $phase['id'];
            $phaseName = $phase['name'];
            $project = $phase['proj'];
            $phaseType = $phase['type'];
            $org = $phase['org'];
        }
    }

    $bdVerification = new Verification();
    $verifications = $bdVerification->getVerificationByPhase($phaseId);
?>
<div class="m-2 p-2">
    <div class="card container-fluid p-1 m-1">
        <div class="card-header h5"> 
            <h5> TPM Table of Activities : Project <?= $project ?> of <?= $org ?> - <?= $phaseName ?> (<?= $phaseType ?>)</h5> <hr>
            <div class="d-flex w-100 justify-content-between">
                <a class="btn btn-outline-primary btn-md" href="home.php?render=<?= sha1("listverification") ?>&sub=<?= sha1("start") ?>"> <i class="fa fa-file-image"></i> View Report Evidences</a>
                <?php
                    if ($_SESSION['typeCompte'] == "admin" || $_SESSION['typeCompte'] == "TPM Coordinator") {
                        ?>
                            <a class="btn btn-outline-primary btn-md" href="home.php?render=<?= sha1("finalreport") ?>&sub=<?= sha1("start") ?>&phaseId=<?= $phaseId ?>&phaseName=<?= $phaseName ?>&phaseType=<?= $phaseType ?>&projectName=<?= $project ?>&org=<?= $org ?>"> <i class="fa fa-upload"></i> Upload Final Report</a>
                        <?php
                    }
                ?>
                <a class="btn btn-outline-primary btn-md" href="home.php?render=<?= sha1("finalreport") ?>&sub=<?= sha1("start") ?>&phaseId=<?= $phaseId ?>&phaseName=<?= $phaseName ?>&phaseType=<?= $phaseType ?>&projectName=<?= $project ?>&org=<?= $org ?>"> <i class="fa fa-download"></i> Download Final Report</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table table-condensed table-bordered table-sm table-responsive-sm">
                <thead>
                    <th>Activity</th>
                    <th>Place</th>
                    <th>Implementation Partner</th>
                    <th>Rating</th>
                    <th>Problem(s) identified</th>
                    <th>Problem(s) analysis</th>
                    <th>Action recommanded</th>
                </thead>
                <tbody>
                    <?php
                    $nbred=0;
                    $nborange=0;
                    $nbgreen=0;
                    foreach ($verifications as $verification) {
                        //  if ($verification['phaseid'] == $_GET['phaseId']) {
                            if ($verification['rating'] == 'red') {
                                $nbred++;
                            }
                            if ($verification['rating'] == 'orange') {
                                $nborange++;
                            }
                            if ($verification['rating'] == 'green') {
                                $nbgreen++;
                            }
                            ?>
                                <tr>
                                    <td><?= $verification['activ'] ?></td>
                                    <td><?= $verification['village'] ?> - <?= $verification['territ'] ?> - <?= $verification['province'] ?></td>
                                    <td><?= $verification['nameip'] ?></td>
                                    <td><i class="fa fa-circle" style="color: <?= $verification['rating'] ?>;"></i></td>
                                    <td><?= $verification['issue'] ?></td>
                                    <td><?= $verification['issueAnalysis'] ?></td>
                                    <td><?= $verification['action'] ?></td>
                                    
                                </tr>
                            <?php
                            # code...
                        // }

                    }
                    $nbtot=$nbred+$nborange+$nbgreen+0.000001;
                    $pred= round($nbred*100/$nbtot, 2);
                    $porange= round($nborange*100/$nbtot, 2);
                    $pgreen= round($nbgreen*100/$nbtot, 2);

                    ?>
                    
                </tbody>

            </table>
            <div class="row">
                <div class="col-4 h2 text-center" style="font-family: arial;">
                <span class="badge bg-danger"><?= $nbred ?></span>
                </div>
                <div class="col-4 h2 text-center" style="font-family: arial;">
                <span class="badge bg-warning"><?= $nborange ?></span>
                </div>
                <div class="col-4 h2 text-center" style="font-family: arial;">
                    <span class="badge bg-success"><?= $nbgreen ?></span>
                </div>
            </div>

        </div>
        <div class="card-footer">
        <h6>Legend</h6><hr>
            <p><i class="fa fa-circle" style="color: red;"></i> Serious issue identified that could impact programming</p>
            <p><i class="fa fa-circle" style="color: orange;"></i> Important problem identified, but does not seriously affect the programming</p>
            <p><i class="fa fa-circle" style="color: green;"></i> Excellent performance, No issues requiring intervention were identified</p>
        </div>

    </div>
</div>


<?php
}