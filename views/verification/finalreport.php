<?php
if (isset($_SESSION['identite'])) {
    if (isset($_GET['phaseId']) && isset($_GET['phaseName']) && isset($_GET['phaseType']) && isset($_GET['projectName']) && isset($_GET['org'])) {
        $phaseId=$_GET['phaseId'];
        $phaseName=$_GET['phaseName'];
        $phaseType=$_GET['phaseType'];
        $projectName=$_GET['projectName'];
        $org=$_GET['org'];

        ?>
        <div class="card m-2 p-2">
            <div class="card-header h5">Loading TPM Final Report</div>
            <div class="card-body">
                <table class="table table-bordered table-condensed table-responsive-sm">
                    <tbody>
                        <tr>
                            <td style="width: 20%;">Organisation</td>
                            <td style="width: 80%;"><h6><?= $org ?></h6></td>
                        </tr>
                        <tr>
                            <td style="width: 20%;">Project</td>
                            <td style="width: 80%;"><h6><?= $projectName ?></h6></td>
                        </tr>
                        <tr>
                            <td style="width: 20%;">Phase</td>
                            <td style="width: 80%;"><h6><?= $phaseName ?> (<?= $phaseType ?>)</h6></td>
                        </tr>
                    </tbody>
                </table>
                <?php
                    if ($_SESSION['typeCompte'] == "admin" || $_SESSION['typeCompte'] == "TPM Coordinator" || $_SESSION['typeCompte'] == "Partner") {
                       ?>
                            <div class="row">
                                <div class="card col-6" role="alert" style="overflow:scroll;">
                                    <div class="card-header h5">                               
                                        <?php
                                            if ($_SESSION['typeCompte'] == "TPM Coordinator") {
                                                echo 'Add final report for '. $phaseName;
                                            } else {
                                                echo 'Add report Feedback for '. $phaseName;
                                            }
                                        ?>
                                    </div>
                                    <div class="card-body">
                                        <form action="../controllers/tpmreport/tpmreportController.php" method="POST" enctype="multipart/form-data">
                                            <input hidden class="form-control" type="text" value="<?= $phaseId ?>" name="phaseId" required>
                                            <div class="form-group custom-file m-1 p-1">
                                                <label class="custom-file-label" for="file">File</label>
                                                <input type="file" class="form-control" name="file" id="file" accept=".pdf, .PDF, .docx, .doc" required>
                                            </div>
                                            <div class="form-group m-1 p-1">
                                                <label class="control-label" for="comment">Comment (Optional)</label>
                                                <textarea class="form-control" name="comment" rows="4" placeholder="Comment the final report here..."></textarea>
                                            </div>
                                            <div class="form-group m-1 p-1">
                                                <button class="btn btn-success" name="add_final_report" type="submit">
                                                <i class="fas fa-send" aria-hidden="true"></i> 
                                                <?php
                                                    if ($_SESSION['typeCompte'] == "TPM Coordinator") {
                                                        echo 'Send final report';
                                                    } else {
                                                        echo 'Send report Feedback';
                                                    }
                                                ?>
                                                </button>
                                            </div>   
                                        </form>
                                    </div>

                                </div>

                                <div class="card col-6" style="overflow:scroll;">
                                    <div class="card-header h5">TPM Final Report Saved (<?= $phaseName ?>)</div>
                                    <div class="card-body">
                                        <table class="table table-bordered table-striped table-condensed table-sm table-responsive">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Comment</th>
                                                    <th>File</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $n = 0;
                                                $bdReport = new Tpm();
                                                $reports = $bdReport->getFinalReport($phaseId);
                                                if (!empty($reports)) {
                                                    foreach ($reports as $report) {
                                                        $n++;
                                                    ?>
                                                        <tr>
                                                            <td><?= $n ?></td>
                                                            <td><?= $report['comment'] ?></td>
                                                            <td>
                                                                <a class="btn btn-outline-primary btn-sm" title="View TPM Final report" href="../controllers/tpmreport/pieces/finalreport/<?= $report['file'] ?>">
                                                                    <i class="fa fa-paperclip" ></i> <?= $report['file'] ?>
                                                                </a>
                                                            </td>
                                                            <td><?= $report['date'] ?></td>
                                                            
                                                        </tr>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>
                                                        <div class="h5 text-danger text-center">No TPM Final Report saved for this phase.</div>
                                                    <?php
                                                }
                                                ?>

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                </tr>
                                            </tfoot>
                                        </table> 
                                    </div>

                                </div>
                            </div>
                       <?php
                    } else {
                        ?>
                            <div class="card" style="overflow:scroll;">
                                <div class="card-header h5">TPM Final Report Saved (<?= $phaseName ?>)</div>
                                <div class="card-body">
                                    <table class="table table-bordered table-striped table-condensed table-sm table-responsive">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Comment</th>
                                                <th>File</th>
                                                <th>Uploading Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $n = 0;
                                            $bdReport = new Tpm();
                                            $reports = $bdReport->getFinalReport($phaseId);
                                            if (!empty($reports)) {
                                                foreach ($reports as $report) {
                                                    $n++;
                                                ?>
                                                    <tr>
                                                        <td><?= $n ?></td>
                                                        <td><?= $report['comment'] ?></td>
                                                        <td>
                                                            <a class="btn btn-outline-secondary" title="View TPM Final report" href="../controllers/tpmreport/pieces/finalreport/<?= $report['file'] ?>">
                                                                <i class="fa fa-paperclip" ></i> Open file
                                                            </a>
                                                        </td>
                                                        <td><?= $report['date'] ?></td>
                                                        
                                                    </tr>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                    <div class="h5 text-danger text-center">No TPM Final Report saved for this phase.</div>
                                                <?php
                                            }
                                            ?>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                            </tr>
                                        </tfoot>
                                    </table> 
                                </div>

                            </div>
                        <?php
                    }

                    ?>

            </div>
        </div>
        <?php
    }
}
?>
