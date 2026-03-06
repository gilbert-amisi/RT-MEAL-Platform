<?php
if (isset($_SESSION['identite'])) {
    if (isset($_GET['tpmId']) && isset($_GET['tpmcomment'])) {
        $proj = $_GET['tpmproject'];
        $org = $_GET['tpmorg'];
        $tpmId = $_GET['tpmId'];
        $tpmphase = $_GET['tpmphase'];
        $phasetype = $_GET['phasetype'];
        $village = $_GET['tpmvillage'];
        $act = $_GET['tpmactivity'];
        $comment = $_GET['tpmcomment'];
        $sup = $_GET['tpmsup'];
        $prox = $_GET['tpmprox'];
        $date = $_GET['tpmdate'];
        $due = $_GET['tpmdue'];
        $village = $_GET['tpmvillage'];
        $territoire = $_GET['tpmterritoire'];
        $image1 = $_GET['tpmimage1'];
        $image2 = $_GET['tpmimage2'];
        $image3 = $_GET['tpmimage3'];
        $fg = $_GET['tpmfg'];
        $ki = $_GET['tpmki'];
    }
?>
<div class="card m-4 p-4 sectionPanel">

<?php
    if ((isset($_SESSION['identite'])) && ($_SESSION['typeCompte'] == "TPM Supervisor")) {
    ?>
    <div class="card">

        <div class="card-header" style="border-left: solid teal 15px; color: #305286; text-align: justify;">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1 text-center">FEEDBACKING TPM REPORT FOR PROJECT <?= $proj ?> OF <?= $org ?> - <?= $tpmphase ?> (<?= $phasetype ?>)</h5>
                <small> Submitted on: <?= $date ?><br>
                        Due Date : <?= $due ?>
                </small>
            </div><hr>
            <div class="d-flex w-100 justify-content-between">
                <h6 class="mb-1"><i class="fa fa-share-alt" style="color: blue; width: 60px;"></i>Activity: <?= $act ?></h6>
            </div> <hr>
            <div class="d-flex w-100 justify-content-between">
                <h6 class="mb-1"><i class="fa fa-handshake" style="color: green; width: 60px;"></i>Implementation Partner : </h6>
                <small><i class="fa fa-map-marker" aria-hidden="true" style="color: #C15286;"></i> <b>Place : <?= $village ?> - <?= $territoire ?></b> </small>
            </div>
        </div>

        <div class="card-body">

            <table class="table table-bordered table-condensed table-responsive table-sm">
                <thead>
                    <th>Orignal report (From <?= $prox ?>)</th>
                    <th>Your Feedback (<?= $sup  ?>)</th>
                </thead>
                <tbody>
                    <td style="width: 50%;">
                        <div class="card">
                            <div class="card-header">
                                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-indicators">
                                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
                                    </div>
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                        <img src="../controllers/tpmreport/pieces/<?= $image1 ?>" height="300px" width="100%" class="d-block w-100" alt="...">
                                        <div class="carousel-caption d-none d-md-block" style="background-color: #EA5C2B; opacity:0.9">
                                            <h5><?= $act ?> at <?= $village ?> - <?= $territoire ?></h5>
                                        </div>
                                        </div>
                                        <div class="carousel-item">
                                        <img src="../controllers/tpmreport/pieces/<?= $image2 ?>" height="300px" width="100%" class="d-block w-100" alt="...">
                                        <div class="carousel-caption d-none d-md-block" style="background-color: dodgerblue; opacity:0.9">
                                            <h5><?= $act ?> at <?= $village ?> - <?= $territoire ?></h5>
                                        </div>
                                        </div>
                                        <div class="carousel-item">
                                        <img src="../controllers/tpmreport/pieces/<?= $image3 ?>" height="300px" width="100%" class="d-block w-100" alt="...">
                                        <div class="carousel-caption d-none d-md-block" style="background-color: #95CD41; opacity:0.9">
                                            <h5><?= $act ?> at <?= $village ?> - <?= $territoire ?></h5>
                                        </div>
                                        </div>
                                        <div class="carousel-item">
                                        <img src="../controllers/tpmreport/pieces/<?= $image1 ?>" height="300px" width="100%" style="left: auto; right: auto;" class="d-block w-100" alt="...">
                                        <div class="carousel-caption d-none d-md-block" style="background-color: #664E88; opacity:0.9">
                                            <h5><?= $act ?> at <?= $village ?> - <?= $territoire ?></h5>
                                        </div>
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
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="card-text" style="text-align: justify;"><?= $comment ?></p>
                            </div>
                            <div class="card-footer col">
                                <?php
                                if (!empty($_GET['tpmfg'])) {
                                    ?>
                                    <a class="btn btn-outline-danger" title="View Focus group transcript" href="../controllers/tpmreport/pieces/<?= $fg ?>">
                                        <i class="fa fa-paperclip" ></i> Focus Group Transcript
                                    </a>
                                <?php
                                } else {
                                    ?>
                                    <p class="text-danger">
                                        <i class="fa fa-exclamation-triangle"></i> No Focus Group Transcript
                                    </p>
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
                                    <p class="text-danger">
                                        <i class="fa fa-exclamation-triangle"></i> No Interviews Transcript
                                    </p>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        
                    </td>
                    <td>
                        <div class="card">
                            <div class="card-body">
                                <form action="../controllers/verification/verificationController.php" method="POST" class="m-1 p-1">
                                        <input hidden type="text" class="form-control" value="<?= $tpmId ?>" name="tpmId" id="tpmId">
                                        <input hidden type="text" class="form-control" value="<?= $_SESSION['compteId'] ?>" name="compteId" id="tpmId">
                                        <div class="form-group m-1 p-1">
                                            <label for="keyinformantId"> Note the report</label>
                                            <select class="form-control select2" name="note" style="width: 100%;">
                                                <option value="0">Choose notation</option>
                                                <option value="Unvalidated">Unvalidated (To improve by Proxy Monitor)</option>
                                                <option value="Validated">Validated (To Submit to Coordinator)</option>
                                            </select>
                                        </div>
                                    <div class="form-group m-1 p-1">
                                        <label for="comment">Instructions (comment)</label>
                                        <textarea required class="form-control" id="instruction" name="instruction" rows="8" placeholder="Write instructions or comment here"></textarea>
                                    </div>
                                    <div class="form-group m-1 p-1">
                                        <input hidden type="text" class="form-control" value="Intermediate" name="mention" id="mention">
                                    </div>
                                    <div class="form-group m-1 p-1">
                                        <button class="btn btn-success" name="send_feedback" type="submit">
                                            <i class="fa fa-paper-plane" aria-hidden="true"></i> Send to Proxy Monitor
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </td>
                </tbody>

            </table>
        </div>

    </div>
                
            <?php
            }
            ?>

    <?php
    }
    ?>
</div>
