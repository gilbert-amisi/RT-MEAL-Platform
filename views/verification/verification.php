<?php
if (isset($_SESSION['identite'])) {
    if (isset($_GET['tpmId'])) {
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
    else {
        $proj = "";
        $org = "";
        $tpmId = "";
        $tpmphase = "";
        $phasetype = "";
        $village = "";
        $act = "";
        $comment = "";
        $sup = "";
        $prox = "";
        $date = "";
        $due = "";
        $village = "";
        $territoire = "";
        $image1 = "";
        $image2 = "";
        $image3 = "";
        $fg = "";
        $ki = "";
    }
?>
<div class="card m-4 p-4 sectionPanel">

<?php
    if ((isset($_SESSION['identite'])) && ($_SESSION['typeCompte'] == "TPM Supervisor")) {
    ?>
    <div class="card">

        <div class="card-header" style="border-left: solid teal 15px; color: #305286; text-align: justify;">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1 text-center">IMPROVING TPM REPORT FOR PROJECT <?= $proj ?> OF <?= $org ?> - <?= $tpmphase ?> (<?= $phasetype ?>)</h5>
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
                    <th>Your improvments (<?= $sup  ?>)</th>
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
                                    <input hidden type="text" class="form-control" value="Validated" name="note" id="note">
                                    <input hidden type="text" class="form-control" value="<?= $_SESSION['compteId'] ?>" name="compteId" id="tpmId">
                                    <div class="form-group m-1 p-1">
                                        <label for="keyinformantId">Key informant contacted (Optional)</label>
                                        <div class="row">
                                            <select class="form-control col select2" name="keyinformantId" style="width: 75%; float: left;">
                                                <option value="">Choose the key informant you have called</option>
                                                <?php
                                                    $bdKeyinformant = new Keyinformant();
                                                        $keyinformants = $bdKeyinformant->getKeyinformantActiveAll();
                                                        foreach ($keyinformants as $keyinformant) {
                                                        ?>
                                                            <option value="<?= $keyinformant['id'] ?>"><?= "Name: " . $keyinformant['identite'] . " / " . $keyinformant['contact'] . " / Gender: " . $keyinformant['genre'] . " / Location: " . $keyinformant['adresse'] . " / Occupation: " . $keyinformant['profession'] ?></option>
                                                    <?php
                                                    }
                                                ?>

                                            </select>
                                            <a class="btn btn-outline-primary btn-sm col form-control" style="float: left; width: 25%" href="home.php?render=<?= sha1('keyinformant') ?>&sub=<?= sha1('start') ?>"><i class="fa fa-user" aria-hidden="true"></i> Add Key Informant</a>

                                        </div>
                                        
                                    </div>
                                    <div class="form-group m-1 p-1">
                                        <label for="comment">Your report</label>
                                        <textarea required class="form-control" id="comment" name="comment" rows="8" placeholder="Write your report here..."></textarea>
                                    </div>
                                    <div class="form-group m-1 p-1">
                                        <input hidden type="text" class="form-control" value="Intermediate" name="mention" id="mention">
                                    </div>
                                    <div class="form-group m-1 p-1">
                                        <button class="btn btn-success" name="add_verification1" type="submit">
                                            <i class="fa fa-paper-plane" aria-hidden="true"></i> Submit to Coordinator
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
