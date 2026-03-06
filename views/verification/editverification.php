<?php
    if ((isset($_SESSION['identite'])) && ($_SESSION['typeCompte'] == "TPM Supervisor")) {
        if (isset($_GET['verificationId']) && isset($_GET['comment'])) {
            $verificationId = $_GET['verificationId'];
            $comment = $_GET['comment'];
        } 
    ?>
    <div class="card">
        <div class="card-header h5" style="color: #2A6569; font-family:Georgia, 'Times New Roman', Times, serif;">
            <i class="fa fa-edit" aria-hidden="true" style="color: #2A6569;"></i> Improving TPM Report
        </div>
        <div class="card-body m-2 p-2">
            <div class="alert alert-primary" role="alert">
                <h5 class="alert-heading">Edit content</h5><hr>
                <form action="../controllers/verification/verificationController.php" method="POST" enctype="multipart/form-data">
                    <input hidden type="text" class="form-control" value="<?= $verificationId ?>" name="verificationId" id="verificationId">
                <div class="form-group m-1 p-1">
                    <textarea class="form-control" id="comment" name="comment" rows="5" placeholder="Write your report here..." required><?= $comment ?></textarea>
                </div>
                <div class="form-group m-1 p-1">
                    <button class="btn btn-success btn-md" name="edit_verification" type="submit">
                    <i class="fa fa-paper-plane" aria-hidden="true"></i> Submit the report
                </button>
                </div>
            </form>
                
            </div>
        </div>
    </div>
    <?php
        }
    ?>