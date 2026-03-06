<?php
    if ((isset($_SESSION['identite'])) && ($_SESSION['typeCompte'] == "TPM Proxy Monitor")) {
        if (isset($_GET['tpmId']) && isset($_GET['comment']) && isset($_GET['image1'])) {
            $tpmId = $_GET['tpmId'];
            $comment = $_GET['comment'];
            $image1 = $_GET['image1'];
            $image2 = $_GET['image2'];
            $image3 = $_GET['image3'];
            $fg = $_GET['fg'];
            $ki = $_GET['ki'];
        } 
    ?>
    <div class="card">
        <div class="card-header h5" style="color: #2A6569; font-family:Georgia, 'Times New Roman', Times, serif;">
            <i class="fa fa-edit" aria-hidden="true" style="color: #2A6569;"></i> Improving TPM Report
        </div>
        <div class="card-body m-2 p-2">
            <table class="table table-bordered table-condensed table-sm table-responsive-sm">
                <tbody>
                    <?php
                        if (isset($_GET['instruction'])) {
                            ?>
                                    <tr>
                                        <td style="width: 25%;"><b>New instructions</b></td>
                                        <td style="width: 75%;"><?= $_GET['instruction'] ?></td>
                                    </tr>

                            <?php
                        }
                    ?>
                    <tr>
                        <td style="width: 25%;"><b>Evidences in images</b></td>
                        <td style="width: 75%;">
                            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
                                </div>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                    <img src="../controllers/tpmreport/pieces/<?= $image1 ?>" height="200px" width="100%" class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                    <img src="../controllers/tpmreport/pieces/<?= $image2 ?>" height="200px" width="100%" class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                    <img src="../controllers/tpmreport/pieces/<?= $image3 ?>" height="200px" width="100%" class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                    <img src="../controllers/tpmreport/pieces/<?= $image1 ?>" height="200px" width="100%" style="left: auto; right: auto;" class="d-block w-100" alt="...">
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div
                    
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 25%;"><b>Transcripts</b></td>
                        <td style="width: 75%;">
                            <div class="d-flex w-100 justify-content-between">
                                <?php
                                if ($fg != "") {
                                    ?>
                                    <a class="btn btn-outline-info" title="View Focus group transcript" href="../controllers/tpmreport/pieces/<?= $f ?>">
                                        <i class="fa fa-paperclip" ></i> Focus Group Transcript
                                    </a>
                                <?php
                                } else {
                                    ?>
                                        <button class="btn btn-outline-danger"><i class="fa fa-exclamation-triangle"></i> No Focus Group Transcript </button>
                                    <?php
                                }
                                if ($ki != "") {
                                    ?>
                                    <a class="btn btn-outline-primary" title="View interview transcript" href="../controllers/tpmreport/pieces/<?= $ki ?>">
                                        <i class="fa fa-paperclip" ></i> Interviews Transcript
                                    </a>
                                <?php
                                } else {
                                    ?>
                                        <button class="btn btn-outline-danger"><i class="fa fa-exclamation-triangle"></i> No Interviews Transcript</button>
                                    <?php
                                }
                                ?>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="alert alert-primary" role="alert">
                <h5 class="alert-heading">Edit content</h5><hr>
                <form action="../controllers/tpmreport/tpmreportController.php" method="POST" enctype="multipart/form-data">
                    <input hidden type="text" class="form-control" value="<?= $tpmId ?>" name="tpmId" id="tpmId">
                <div class="form-group m-1 p-1">
                    <textarea class="form-control" id="comment" name="comment" rows="5" placeholder="Write your report here..." required><?= $comment ?></textarea>
                </div>
                <h5>Add new files</h5><hr>
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
                
                <div class="form-group m-1 p-1">
                    <button class="btn btn-success btn-md" name="edit_tpm" type="submit">
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