<?php
    if ((isset($_SESSION['identite'])) && ($_SESSION['typeCompte'] == "TPM Proxy Monitor")) {
        if (isset($_GET['affectationId']) && isset($_GET['project']) && isset($_GET['org'])) {
            $proj = $_GET['project'];
            $affectationId = $_GET['affectationId'];
            $village = $_GET['village'];
            $territoire = $_GET['nameaxe'];
            $province = $_GET['prov'];
            $phasename = $_GET['phasename'];
            $phasetype = $_GET['phasetype'];
            $nameip = $_GET['nameip'];
            $act = $_GET['act'];
            $org = $_GET['org'];
        } else {
            $proj = "";
            $affectationId = 0;
            $org = "";
        }
    ?>
    <div class="card">
        <div class="card-header h5" style="color: #2A6569; font-family:Georgia, 'Times New Roman', Times, serif;">
            <i class="fa fa-edit" aria-hidden="true" style="color: #2A6569;"></i> Writing TPM Report
        </div>
        <div class="card-body m-2 p-2">

            <table class="table table-bordered table-condensed table-sm table-responsive-sm">
                <tbody>
                    <tr>
                        <td style="width: 25%;"><b>Project</b></td>
                        <td style="width: 75%;"><?= $proj ?> OF <?= $org ?></td>
                    </tr>
                    <tr>
                        <td style="width: 25%;"><b>Activity</b></td>
                        <td style="width: 75%;"><?= $act ?></td>
                    </tr>
                    <tr>
                        <td style="width: 25%;"><b>Performing</b></td>
                        <td style="width: 75%;"><?= $nameip ?></td>
                    </tr>
                    <tr>
                        <td style="width: 25%;"><b>Phase</b></td>
                        <td style="width: 75%;"><?= $phasename ?> (<?= $phasetype ?>)</td>
                    </tr>
                    <tr>
                        <td style="width: 25%;"><b>Place</b></td>
                        <td style="width: 75%;"><?= $village ?> / <?= $territoire ?> /<?= $province ?> </td>
                    </tr>
                </tbody>
            </table>
            <div class="alert alert-primary" role="alert">
                <h5 class="alert-heading">Instructions</h5><hr>
                <p class="mb-0"><?= $_GET['instruction'] ?></p>
            </div>
            <div class="alert alert-secondary" role="alert">
                <h5 class="alert-heading">Write content</h5><hr>
                <form action="../controllers/tpmreport/tpmreportController.php" method="POST" enctype="multipart/form-data">
                    <input hidden type="text" class="form-control" value="<?= $act ?>" name="activity" id="activity">
                    <input hidden type="text" class="form-control" value="<?= $affectationId ?>" name="affectationId" id="affectationId">
                <div class="form-group m-1 p-1">
                    <textarea class="form-control" id="comment" name="comment" rows="7" placeholder="Write your report here..." required></textarea>
                </div>
                <div class="form-group custom-file m-1 p-1">
                    <label class="custom-file-label" for="image1">Image 1 (required)</label>
                    <input type="file" class="form-control" name="image1" id="image1" accept=".jpg, .jpeg, .png" required>
                </div>
                <div class="form-group custom-file m-1 p-1">
                    <label class="custom-file-label" for="image2">Image 2 (optional)</label>
                    <input type="file" class="form-control" name="image2" id="image2" accept=".jpg, .jpeg, .png">
                </div>
                <div class="form-group custom-file m-1 p-1">
                    <label class="custom-file-label" for="image3">Image 3 (optional)</label>
                    <input type="file" class="form-control" name="image3" id="image3" accept=".jpg, .jpeg, .png">
                </div>
                <div class="form-group custom-file m-1 p-1">
                    <label class="custom-file-label" for="fgFile">Focus group transcripts (optional)</label>
                    <input type="file" class="form-control" name="fgFile" id="fgFile" accept=".pdf, .PDF, .docx, .doc">
                </div>
                <div class="form-group custom-file m-1 p-1">
                    <label class="custom-file-label" for="kiFile">Interview transcripts (optional)</label>
                    <input type="file" class="form-control" name="kiFile" id="kiFile" accept=".pdf, .PDF, .docx, .doc">
                </div>
                <div class="form-group custom-file m-1 p-1">
                    <label class="custom-file-label" for="kiFile">Other files (optional)</label>
                    <input type="file" multiple class="form-control" name="kiFile" id="kiFile" accept=".pdf, .PDF, .docx, .doc">
                </div>
                <div class="form-group m-1 p-1">
                    <button class="btn btn-success btn-md" name="add_tpm" type="submit">
                    <i class="fa fa-paper-plane" aria-hidden="true"></i> Submit the report
                </button>
                </div>
            </form>
                
            </div>
        </div>
    </div> <hr>
    <?php
        }
    ?>