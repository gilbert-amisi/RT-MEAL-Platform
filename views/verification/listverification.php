<?php
if (isset($_SESSION['identite'])) {
    $bdProject = new Project();
    $projects = $bdProject->getProjectAll();
    $bdPhase = new Phase();
    $phases = $bdPhase->getPhaseAll();
    $bdVerification = new Verification();
    // $verifications = $bdVerification->getVerificationAll();
?>
<div class="card m-2 p-2">
    <div class="card-header" style="color: #305286;">
     <?php
     if ($_SESSION['typeCompte'] == "TPM Coordinator") {
        ?>
        <h5><i class="fa fa-list" aria-hidden="true" style="color: #305286;"></i> THIRD PARTY MONITORING REPORT YOU HAVE SUBMITTED TO THE PARTNER</h5>
        <hr>
        <?php
     }
     if ($_SESSION['typeCompte'] == "TPM Supervisor") {
        ?>
        <h5><i class="fa fa-list" aria-hidden="true" style="color: #305286;"></i> THIRD PARTY MONITORING REPORT YOU HAVE SUBMITTED TO IES COORDINATOR</h5>
        <hr>
        <?php
     }
     if ($_SESSION['typeCompte'] == "Partner") {
        ?>
        <h5><i class="fa fa-list" aria-hidden="true" style="color: #305286;"></i> THIRD PARTY MONITORING REPORTS FROM IES-CONGO</h5>
        <hr>
        <?php
     }
     ?>

        <form method="POST">
            <div class="form-group" style="float: left; width:80%;">
                <select name="projectId" class="form-control select2" id="projectId" style="width:98%;">
                
                    <option value="0">Filter reports by project</option>
                    <?php
                        foreach ($projects as $project) {
                            if ($_SESSION['typeCompte'] == "Partner") {
                                if ($_SESSION['compteId'] == $project['compteId']) {
                                    ?>
                                        <option value="<?= $project['prId'] ?>">Project <?= $project['prDesignation'] ?> of <?= $project['ogDesignation'] ?></option>
                                    <?php
                                }
                            } else {
                                ?>
                                <option value="<?= $project['prId'] ?>">Project <?= $project['prDesignation'] ?> of <?= $project['ogDesignation'] ?></option>
                            <?php
                            }
                        
                        }
                        ?>
                </select>
            </div>
            <div class="form-group" style="float: left; width:20%;">
                <button class="btn btn-outline-info btn-sm" name="filter_tpm_project" type="submit" title="Filter reports by project">
                    <i class="fa fa-search" aria-hidden="true"></i> Search
                </button>
            </div>
        </form> <br> <br>
        <?php
        if (isset($_POST['filter_tpm_project'])) {
            $getProject = $_POST['projectId'];
            if ($_SESSION['typeCompte'] == "admin" || $_SESSION['typeCompte'] == "TPM Coordinator" || $_SESSION['typeCompte'] == "Partner") {
            $verifications = $bdVerification->getVerificationByProject($getProject);
            } else {
                $verifications = $bdVerification->getVerificationByProject($getProject);
            }
        }
        ?>
     
     <form method="POST">
         <div class="form-group" style="float: left; width:80%;">
             <select name="phaseId" class="form-control select2" id="phaseId" style="width:98%;">
                 <option value="0">Filter by reporting phase </option>
                     <?php
                     foreach ($phases as $phase) {
                         if ($phase['projectId']== $getProject) {
                             ?>
                                 <option value="<?= $phase['id'] ?>"><?= $phase['name'] ?> (<?= $phase['type'] ?>)</option>
                             <?php
                         }
                     }
                     ?>
             </select>
         </div>
         <div class="form-group" style="float: left; width:20%;">
             <button class="btn btn-outline-primary btn-sm" name="filter_tpm_phase" type="submit" title="Filter reports by reporting phase">
                 <i class="fa fa-search" aria-hidden="true"></i> Search
             </button>
         </div>
     </form> <br> <br>

        <?php
        if (isset($_POST['filter_tpm_phase'])) {
            $getPhase = $_POST['phaseId'];
            if ($_SESSION['typeCompte'] == "admin" || $_SESSION['typeCompte'] == "TPM Coordinator" || $_SESSION['typeCompte'] == "Partner") {
                $verifications = $bdVerification->getVerificationByPhase($getPhase);
                ?>
                    <form method="POST">
                        <div class="form-group" style="float: left; width:80%;">
                            <input hidden type="text" name="phaseId" value="<?= $getPhase?>">
                            <select name="color" class="form-control select2" id="color" style="width:98%;">
                            
                                <option value="0">Filter by Rating color</option>
                                <option value="red">Red : Serious issue identified that could impact programming</option>
                                <option value="orange">Orange : Important problem identified, but does not seriously affect the programming</option>
                                <option value="green">Green : Excellent performance, No issues requiring intervention were identified</option>
                            </select>
                        </div>
                        <div class="form-group" style="float: left; width:20%;">
                            <button class="btn btn-outline-warning btn-sm" name="filter_tpm_rating" type="submit" title="Filter report by Rating Color">
                                <i class="fa fa-search" aria-hidden="true"></i> Search
                            </button>
                        </div>
                    </form>
                <?php
            } else {
                $verifications = $bdVerification->getVerificationAll1($getPhase);
            }
            ?>
            <a class="btn btn-primary text-center m-1 p-1" href="home.php?render=<?= sha1("tpmtable") ?>&sub=<?= sha1("start") ?>&phaseId=<?= $getPhase ?>">
                <i class="fa fa-star" aria-hidden="true"></i> View Activities rating table
            </a>
            
        <?php
               
        }
        
        if (isset($_POST['filter_tpm_rating'])) {
            $getPhase2 = $_POST['phaseId'];
            $rating = $_POST['color'];
            $verifications = $bdVerification->getVerificationByRating($getPhase2, $rating);
        }
        ?>
        
    </div>
    <div class="card-body list-group">
    <!-- List for TPM Coordinator -->
        <?php

    if (empty($verifications)) {
        ?>
        <h5 class="text-center text-danger"> <i class="fa fa-exclamation-triangle"></i> No data for your selection, Please select a project</h5>

        <?php
    } else {
        if ((isset($_SESSION['identite'])) && ($_SESSION['typeCompte'] == "admin" || $_SESSION['typeCompte'] == "TPM Coordinator")) {
            foreach ($verifications as $verification) {
                if ($verification['mention'] == "Final" && $verification['status'] == "Submitted to partner") {
            ?>  
                <div class="card list-group-item list-group-item-action breadcrumb" style="height: 100vh; overflow: scroll;">
                    <div class="card-header" style="border-left: solid <?= $verification['rating'] ?> 15px; color: #305286; text-align: justify;">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1 text-center">REPORT FOR PROJECT <?= $verification['proj'] ?> OF <?= $verification['org'] ?></h5>
                        </div>
                        <table class="table table-bordered table-condensed table-responsive-sm">
                            <tbody>
                                <tr>
                                    <td style="width: 20%;">Phase</td>
                                    <td style="width: 80%;"><h6><?= $verification['phasename'] ?> (<?= $verification['phasetype'] ?>)</h6></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;">Activity</td>
                                    <td style="width: 80%;"><?= $verification['activ'] ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;">Place</td>
                                    <td style="width: 80%;"><?= $verification['village'] ?> / <?= $verification['territ'] ?> / <?= $verification['province'] ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;">Performing by</td>
                                    <td style="width: 80%;"><?= $verification['nameip'] ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;">Submitted on</td>
                                    <td style="width: 80%;"><?= $verification['date'] ?></td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                    <div class="card-body" style="background-color: transparent;">
                        <table class="table table-bordered table-condensed table-responsive table-sm">
                            <thead>
                                <th>Attached evidences</th>
                                <th>Report content</th>
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
                                                <img src="../controllers/tpmreport/pieces/<?= $verification['image1'] ?>" height="300px" width="100%" class="d-block w-100" alt="...">
                                                <div class="carousel-caption d-none d-md-block" style="background-color: #EA5C2B; opacity:0.9">
                                                    <h5><?= $verification['activ'] ?> at <?= $verification['village'] ?></h5>
                                                </div>
                                                </div>
                                                <div class="carousel-item">
                                                <img src="../controllers/tpmreport/pieces/<?= $verification['image2'] ?>" height="300px" width="100%" class="d-block w-100" alt="...">
                                                <div class="carousel-caption d-none d-md-block" style="background-color: dodgerblue; opacity:0.9">
                                                    <h5><?= $verification['activ'] ?> at <?= $verification['village'] ?></h5>
                                                </div>
                                                </div>
                                                <div class="carousel-item">
                                                <img src="../controllers/tpmreport/pieces/<?= $verification['image3'] ?>" height="300px" width="100%" class="d-block w-100" alt="...">
                                                <div class="carousel-caption d-none d-md-block" style="background-color: #95CD41; opacity:0.9">
                                                    <h5><?= $verification['activ'] ?> at <?= $verification['village'] ?></h5>
                                                </div>
                                                </div>
                                                <div class="carousel-item">
                                                <img src="../controllers/tpmreport/pieces/<?= $verification['image1'] ?>" height="300px" width="100%" style="left: auto; right: auto;" class="d-block w-100" alt="...">
                                                <div class="carousel-caption d-none d-md-block" style="background-color: #664E88; opacity:0.9">
                                                    <h5><?= $verification['activ'] ?> at <?= $verification['village'] ?></h5>
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
                                    </div>
                                    <div class="card-footer col">
                                        <?php
                                        if ($verification['fgTranscript'] != "") {
                                            ?>
                                            <a class="btn btn-outline-danger" title="View Focus group transcript" href="../controllers/tpmreport/pieces/<?= $verification['fgTranscript'] ?>">
                                                <i class="fa fa-paperclip" ></i> Focus Group Transcript
                                            </a>
                                        <?php
                                        }
                                        if ($verification['kiTranscript'] != "") {
                                            ?>
                                            <a class="btn btn-outline-primary" title="View interview transcript" href="../controllers/tpmreport/pieces/<?= $verification['kiTranscript'] ?>">
                                                <i class="fa fa-paperclip" ></i> Interviews Transcript
                                            </a>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                    
                                </td>
                                <td>
                                    <div class="card">
                                        <div class="card-header d-flex w-100 justify-content-between">
                                            Author : IES Coordinator
                                            <div>
                                                <!-- <a class="btn btn-outline-primary btn-sm" href=""> <i class="fa fa-edit"></i> Edit this report</a> -->
                                            </div>
                                        </div>
                                        <div class="card-body">
                                        <p class="card-text" style="text-align: justify;"><?= $verification['comment'] ?></p>
                                        </div>
                                        <div class="card-footer">
                                        <div class="row">
                                                <h6 class="col-3">Activity rating </h6>
                                                <h6 class="col-1">: </h6>
                                                <div class="col-8">
                                                    <?php
                                                        if ($verification['rating']=="red") {
                                                            ?>
                                                            <p class="card h6 m-1 p-1" style="border-left: solid <?= $verification['rating'] ?> 15px;"> Serious issue identified that could impact programming <i class="fa fa-exclamation-triangle" aria-hidden="true" style="color: <?= $verification['rating'] ?>;"></i></p>
                                                            <?php
                                                        }
                                                        if ($verification['rating']=="orange") {
                                                            ?>
                                                            <p class="card h6 m-1 p-1" style="border-left: solid <?= $verification['rating'] ?> 15px;"> Important problem identified, but does not seriously affect the programming <i class="fa fa-bell" aria-hidden="true" style="width: 24px; color: <?= $verification['rating'] ?>;"></i>
                                                            <?php
                                                        }
                                                        if ($verification['rating']=="green") {
                                                            ?>
                                                            <p class="card h6 m-1 p-1" style="border-left: solid <?= $verification['rating'] ?> 15px;">Excellent performance, no issues identified <i class="fa fa-thumbs-up" aria-hidden="true" style="width: 24px; color: <?= $verification['rating'] ?>;"></i>
                                                            <?php
                                                        }
                                                    ?>
                                                </div>
                                            </div> <hr>
                                            <div class="row">
                                                <h6 class="col-3">Problem identified</h6>
                                                <h6 class="col-1">:</h6>
                                                <div class="col-8">
                                                <?= $verification['issue'] ?>
                                                </div>
                                            </div> <hr>
                                            <div class="row">
                                                <h6 class="col-3">Action recommended</h6>
                                                <h6 class="col-1">:</h6>
                                                <div class="col-8">
                                                <?= $verification['action'] ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tbody>

                        </table>
                    </div>  
                </div>
            <?php
                }
            }
        }
        if ((isset($_SESSION['identite'])) && ($_SESSION['typeCompte'] == "Partner")) {
            foreach ($verifications as $verification) {
                if ($verification['mention'] == "Final" && $verification['status'] == "Submitted to partner" && $verification['pfId'] == $_SESSION['compteId']) {
            ?>  
                <div class="card list-group-item list-group-item-action breadcrumb" style="height: 100vh; overflow: scroll;">
                    <div class="card-header" style="border-left: solid <?= $verification['rating'] ?> 15px; color: #305286; text-align: justify;">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">REPORT FOR PROJECT <?= $verification['proj'] ?> OF <?= $verification['org'] ?></h5>
                            <small><b> Submitted on <?= $verification['date'] ?></b></small>
                        </div>

                        <table class="table table-bordered table-condensed table-responsive-sm">
                            <tbody>
                                <tr>
                                    <td style="width: 20%;">Phase</td>
                                    <td style="width: 80%;"><h6><?= $verification['phasename'] ?> (<?= $verification['phasetype'] ?>)</h6></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;">Activity</td>
                                    <td style="width: 80%;"><h6><?= $verification['activ'] ?></h6></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;">Place</td>
                                    <td style="width: 80%;"><h6><?= $verification['village'] ?> / <?= $verification['territ'] ?> / <?= $verification['province'] ?></h6></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;">Performing by</td>
                                    <td style="width: 80%;"><h6><?= $verification['nameip'] ?></h6></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;">Submitted on</td>
                                    <td style="width: 80%;"><h6><?= $verification['date'] ?></h6></td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                    <div class="card-body" style="background-color: transparent;">
                        <table class="table table-bordered table-condensed table-responsive table-sm">
                            <thead>
                                <th>Attached evidences</th>
                                <th>Report content</th>
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
                                                <img src="../controllers/tpmreport/pieces/<?= $verification['image1'] ?>" height="300px" width="100%" class="d-block w-100" alt="...">
                                                <div class="carousel-caption d-none d-md-block" style="background-color: #EA5C2B; opacity:0.9">
                                                    <h5><?= $verification['activ'] ?> at <?= $verification['village'] ?></h5>
                                                </div>
                                                </div>
                                                <div class="carousel-item">
                                                <img src="../controllers/tpmreport/pieces/<?= $verification['image2'] ?>" height="300px" width="100%" class="d-block w-100" alt="...">
                                                <div class="carousel-caption d-none d-md-block" style="background-color: dodgerblue; opacity:0.9">
                                                    <h5><?= $verification['activ'] ?> at <?= $verification['village'] ?></h5>
                                                </div>
                                                </div>
                                                <div class="carousel-item">
                                                <img src="../controllers/tpmreport/pieces/<?= $verification['image3'] ?>" height="300px" width="100%" class="d-block w-100" alt="...">
                                                <div class="carousel-caption d-none d-md-block" style="background-color: #95CD41; opacity:0.9">
                                                    <h5><?= $verification['activ'] ?> at <?= $verification['village'] ?></h5>
                                                </div>
                                                </div>
                                                <div class="carousel-item">
                                                <img src="../controllers/tpmreport/pieces/<?= $verification['image1'] ?>" height="300px" width="100%" style="left: auto; right: auto;" class="d-block w-100" alt="...">
                                                <div class="carousel-caption d-none d-md-block" style="background-color: #664E88; opacity:0.9">
                                                    <h5><?= $verification['activ'] ?> at <?= $verification['village'] ?></h5>
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
                                    </div>
                                    <div class="card-footer col">
                                        
                                    </div>
                                </div>
                                    
                                </td>
                                <td>
                                    <div class="card">
                                        <div class="card-header">
                                            Author : IES Coordinator
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text" style="text-align: justify;"><?= $verification['comment'] ?></p>
                                        </div>
                                        <div class="card-footer">
                                            <div class="row">
                                                <h6 class="col-3">Activity rating </h6>
                                                <h6 class="col-1">: </h6>
                                                <div class="col-8">
                                                    <?php
                                                        if ($verification['rating']=="red") {
                                                            ?>
                                                            <p class="card h6 m-1 p-1" style="border-left: solid <?= $verification['rating'] ?> 15px;"> Serious issue identified that could impact programming <i class="fa fa-exclamation-triangle" aria-hidden="true" style="color: <?= $verification['rating'] ?>;"></i></p>
                                                            <?php
                                                        }
                                                        if ($verification['rating']=="orange") {
                                                            ?>
                                                            <p class="card h6 m-1 p-1" style="border-left: solid <?= $verification['rating'] ?> 15px;"> Important problem identified, but does not seriously affect the programming <i class="fa fa-bell" aria-hidden="true" style="width: 24px; color: <?= $verification['rating'] ?>;"></i>
                                                            <?php
                                                        }
                                                        if ($verification['rating']=="green") {
                                                            ?>
                                                            <p class="card h6 m-1 p-1" style="border-left: solid <?= $verification['rating'] ?> 15px;">Excellent performance, no issues identified <i class="fa fa-thumbs-up" aria-hidden="true" style="width: 24px; color: <?= $verification['rating'] ?>;"></i>
                                                            <?php
                                                        }
                                                    ?>
                                                </div>
                                            </div> <hr>
                                            <div class="row">
                                                <h6 class="col-3">Problem identified</h6>
                                                <h6 class="col-1">:</h6>
                                                <div class="col-8">
                                                <?= $verification['issue'] ?>
                                                </div>
                                            </div> <hr>
                                            <div class="row">
                                                <h6 class="col-3">Action recommended</h6>
                                                <h6 class="col-1">:</h6>
                                                <div class="col-8">
                                                <?= $verification['action'] ?>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </td>
                            </tbody>

                        </table>
                    </div>  
                </div>
            <?php
                }
            }
        }

        if ((isset($_SESSION['identite'])) && ($_SESSION['typeCompte'] == "TPM Supervisor")) {
            foreach ($verifications as $verification) {
                if ($verification['mention'] == "Intermediate" && $_SESSION['compteId'] == $verification['supId']) {
            ?>  
                <div class="card list-group-item list-group-item-action breadcrumb" style="height: 100vh; overflow: scroll;">
                    <div class="card-header" style="border-left: solid teal 15px; color: #305286; text-align: justify;">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">REPORT FOR PROJECT <?= $verification['proj'] ?> OF <?= $verification['org'] ?></h6>
                            
                        </div>
                        <table class="table table-bordered table-condensed table-responsive-sm">
                            <tbody>
                                <tr>
                                    <td style="width: 20%;">Phase</td>
                                    <td style="width: 80%;"><h6><?= $verification['phasename'] ?> (<?= $verification['phasetype'] ?>)</h6></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;">Activity</td>
                                    <td style="width: 80%;"><h6><?= $verification['activ'] ?></h6></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;">Place</td>
                                    <td style="width: 80%;"><h6><?= $verification['village'] ?> / <?= $verification['territ'] ?> / <?= $verification['province'] ?></h6></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;">Performing by</td>
                                    <td style="width: 80%;"><h6><?= $verification['nameip'] ?></h6></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;">Submitted on</td>
                                    <td style="width: 80%;"><h6><?= $verification['date'] ?></h6></td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                    <div class="card-body" style="background-color: transparent;">
                        <table class="table table-bordered table-condensed table-responsive table-sm">
                            <thead>
                                <th>Attached evidences</th>
                                <th>Report content</th>
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
                                                <img src="../controllers/tpmreport/pieces/<?= $verification['image1'] ?>" height="300px" width="100%" class="d-block w-100" alt="...">
                                                <div class="carousel-caption d-none d-md-block" style="background-color: #EA5C2B; opacity:0.9">
                                                    <h5><?= $verification['activ'] ?> at <?= $verification['village'] ?></h5>
                                                </div>
                                                </div>
                                                <div class="carousel-item">
                                                <img src="../controllers/tpmreport/pieces/<?= $verification['image2'] ?>" height="300px" width="100%" class="d-block w-100" alt="...">
                                                <div class="carousel-caption d-none d-md-block" style="background-color: dodgerblue; opacity:0.9">
                                                    <h5><?= $verification['activ'] ?> at <?= $verification['village'] ?></h5>
                                                </div>
                                                </div>
                                                <div class="carousel-item">
                                                <img src="../controllers/tpmreport/pieces/<?= $verification['image3'] ?>" height="300px" width="100%" class="d-block w-100" alt="...">
                                                <div class="carousel-caption d-none d-md-block" style="background-color: #95CD41; opacity:0.9">
                                                    <h5><?= $verification['activ'] ?> at <?= $verification['village'] ?></h5>
                                                </div>
                                                </div>
                                                <div class="carousel-item">
                                                <img src="../controllers/tpmreport/pieces/<?= $verification['image1'] ?>" height="300px" width="100%" style="left: auto; right: auto;" class="d-block w-100" alt="...">
                                                <div class="carousel-caption d-none d-md-block" style="background-color: #664E88; opacity:0.9">
                                                    <h5><?= $verification['activ'] ?> at <?= $verification['village'] ?></h5>
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
                                    </div>
                                    <div class="card-footer col">
                                        <?php
                                        if ($verification['fgTranscript'] != "") {
                                            ?>
                                            <a class="btn btn-outline-danger" title="View Focus group transcript" href="../controllers/tpmreport/pieces/<?= $verification['fgTranscript'] ?>">
                                                <i class="fa fa-paperclip" ></i> Focus Group Transcript
                                            </a>
                                        <?php
                                        }
                                        if ($verification['kiTranscript'] != "") {
                                            ?>
                                            <a class="btn btn-outline-primary" title="View interview transcript" href="../controllers/tpmreport/pieces/<?= $verification['kiTranscript'] ?>">
                                                <i class="fa fa-paperclip" ></i> Interviews Transcript
                                            </a>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                    
                                </td>
                                <td>
                                    <div class="card">
                                        <div class="card-header d-flex w-100 justify-content-between">
                                            Author : <?= $verification['sup'] ?>
                                            <?php
                                                if ($verification['status'] != "Submitted to partner") {
                                                    ?>
                                                    <a class="btn btn-outline-primary btn-sm" href="home.php?render=<?= sha1("editverification") ?>&sub=<?= sha1("start") ?>&verificationId=<?= $verification['id'] ?>&comment=<?= $verification['comment'] ?>"> 
                                                        <i class="fa fa-edit"></i> Edit this report
                                                    </a>
                                                    <?php
                                                }
                                            ?>
                                            
                                        </div>
                                        <div class="card-body">
                                        <p class="card-text" style="text-align: justify;"><?= $verification['comment'] ?></p>
                                        </div>
                                        <div class="card-footer">
                                        </div>
                                    </div>
                                </td>
                            </tbody>

                        </table>
                    </div>  
                </div>
            <?php
                }
            }
        }
        
    }
        
        ?>
    </div>
</div>
<?php
}
