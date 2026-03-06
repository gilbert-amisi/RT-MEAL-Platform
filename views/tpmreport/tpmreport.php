<?php
if (isset($_SESSION['identite'])) {

    $bdProject = new Project();
    $projects = $bdProject->getProjectAll();
    $bdPhase = new Phase();
    $phases = $bdPhase->getPhaseAll();
    $bdTpm = new Tpm();
    $bdVerification = new Verification();
?>
<div class="card m-4 p-4">
    <div class="m-1 p-1 h6">
        <form method="POST">
            <div class="form-group" style="float: left; width:80%;">
                <select name="projectId" class="form-control select2" id="projectId" style="width:98%;">
                
                    <option value="0">Select the project</option>
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
                    <i class="fa fa-search" aria-hidden="true"></i> Confirm project
                </button>
            </div>
        </form>
    </div>
        <?php
        if (isset($_POST['filter_tpm_project'])) {
            $getProject = $_POST['projectId'];
        }
        ?>
    <div class="m-1 p-1 h6">
        <form method="POST">
            <div class="form-group" style="float: left; width:80%;">
                <select name="phaseId" class="form-control select2" id="phaseId" style="width:98%;">
                    <option value="0">Select reporting phase </option>
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
                    <i class="fa fa-search" aria-hidden="true"></i> Confirm phase
                </button>
            </div>
        </form>
    </div>
         <hr>
    <?php
        if (isset($_POST['filter_tpm_phase'])) {
            $getPhase = $_POST['phaseId'];
            $tpms = $bdTpm->getTpmAll($getPhase);
            $verifications = $bdVerification->getVerificationAll1($getPhase);

            if (empty($tpms)) {
                ?>
                    <div class="card text-center text-danger h4">
                        No data for your selection!!!
                    </div>
                <?php
            } else {
                if ((isset($_SESSION['identite'])) && ($_SESSION['typeCompte'] == "TPM Supervisor")) {
                    ?>
                    <div class="card">
                        <div class="card-header" style="color: #305286;">
                            <h5><i class="fa fa-list" aria-hidden="true" style="color: #305286;"></i> TPM REPORTS FROM PROXY MONITORS </h5>
                            <hr>
                        </div>
                        <div class="card-body">
                            <?php
                            foreach ($tpms as $tpm) {
                                if ($tpm['supId']== $_SESSION['compteId'] && $tpm['status'] != "Submitted to coordinator") {
                                    $data=1;
                            ?>
                                <div class="card" style="height: 90vh; overflow:scroll; color: #305286;">
                
                                    <div class="card-header" style="border-left: solid teal 15px; color: #305286; text-align: justify;">
                                        <table class="table table-bordered table-condensed table-sm table-responsive-sm table-light">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 20%;">Project</td>
                                                    <td style="width: 80%;"><b><?= $tpm['proj'] ?> OF <?= $tpm['org'] ?> - <?= $tpm['phasename'] ?> (<?= $tpm['phasetype'] ?>)</td></b>
                                                </tr>
                                                <tr>
                                                    <td style="width: 20%;">Activity</td>
                                                    <td style="width: 80%;"><?= $tpm['activ'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 20%;">Performed by</td>
                                                    <td style="width: 80%;"><?= $tpm['implementor'] ?> at <?= $tpm['village'] ?>/<?= $tpm['terr'] ?>/<?= $tpm['province'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 20%;">Submission</td>
                                                    <td style="width: 80%;"><?= $tpm['date'] ?> vs <?= $tpm['endAf'] ?> (<?= $tpm['nbj'] ?> days)</td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 20%;">Note</td>
                                                    <td style="width: 80%;">
                                                    <?php
                                                        if ($tpm['note'] == 'Validated') {
                                                            ?>
                                                                <b class="mb-1 text-success"><i class="fa fa-check" style="color: green;"></i> <?= $tpm['note'] ?></b>
                                                            <?php
                                                        }
                                                        if ($tpm['note'] == 'Unvalidated') {
                                                            ?>
                                                                <b class="mb-1 text-danger"> <i class="fa fa-window-close" style="color: red;"></i> <?= $tpm['note'] ?></b>
                                                            <?php
                                                        }
                                                        if ($tpm['note'] == 'Not checked yet') {
                                                            ?>
                                                                <b class="mb-1 text-warning"><i class="fa fa-window-question" style="color: orange;"></i> <?= $tpm['note'] ?></b>
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                
                                                <tr>
                                                    <td style="width: 20%;">Action</td>
                                                    <td style="width: 80%;">
                                                        <div>
                                                            <a class="btn btn-outline-primary btn-sm" title="Send feedback to Proxy Monitor" href="home.php?render=<?= sha1("tpmfeedback") ?>&sub=<?= sha1("start") ?>&tpmId=<?= $tpm['id'] ?>&tpmactivity=<?= $tpm['activ'] ?>&tpmproject=<?= $tpm['proj'] ?>&tpmvillage=<?= $tpm['village'] ?>&tpmterritoire=<?= $tpm['terr'] ?>&tpmphase=<?= $tpm['phasename'] ?>&phasetype=<?= $tpm['phasetype'] ?>&tpmsup=<?= $tpm['sup'] ?>&tpmprox=<?= $tpm['prx'] ?>&tpmdate=<?= $tpm['date'] ?>&tpmdue=<?= $tpm['endAf'] ?>&tpmvillage=<?= $tpm['village'] ?>&tpmimage1=<?= $tpm['image1'] ?>&tpmimage2=<?= $tpm['image2'] ?>&tpmimage3=<?= $tpm['image3'] ?>&tpmfg=<?= $tpm['fgTranscript'] ?>&tpmki=<?= $tpm['kiTranscript'] ?>&tpmorg=<?= $tpm['org'] ?>&tpmcomment=<?= $tpm['comment'] ?>">
            
                                                            </i> Give feedback
                                                        </a>
                                                            <a class="btn btn-outline-success btn-sm" title="Vérify with a key informant" href="home.php?render=<?= sha1("verification") ?>&sub=<?= sha1("start") ?>&tpmId=<?= $tpm['id'] ?>&tpmactivity=<?= $tpm['activ'] ?>&tpmproject=<?= $tpm['proj'] ?>&tpmvillage=<?= $tpm['village'] ?>&tpmterritoire=<?= $tpm['terr'] ?>&tpmphase=<?= $tpm['phasename'] ?>&phasetype=<?= $tpm['phasetype'] ?>&tpmsup=<?= $tpm['sup'] ?>&tpmprox=<?= $tpm['prx'] ?>&tpmdate=<?= $tpm['date'] ?>&tpmdue=<?= $tpm['endAf'] ?>&tpmvillage=<?= $tpm['village'] ?>&tpmimage1=<?= $tpm['image1'] ?>&tpmimage2=<?= $tpm['image2'] ?>&tpmimage3=<?= $tpm['image3'] ?>&tpmfg=<?= $tpm['fgTranscript'] ?>&tpmki=<?= $tpm['kiTranscript'] ?>&tpmorg=<?= $tpm['org'] ?>&tpmcomment=<?= $tpm['comment'] ?>">
                                                                <i class="fa fa-check"></i> Improve the report
                                                            </a>
                                                        </div>
                                                    </td>
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
                                                                <img src="../controllers/tpmreport/pieces/<?= $tpm['image1'] ?>" height="300px" width="100%" class="d-block w-100" alt="...">
                                                                <div class="carousel-caption d-none d-md-block" style="background-color: #EA5C2B; opacity:0.9">
                                                                    <h5><?= $tpm['activ'] ?> at <?= $tpm['village'] ?> - <?= $tpm['terr'] ?></h5>
                                                                </div>
                                                                </div>
                                                                <div class="carousel-item">
                                                                <img src="../controllers/tpmreport/pieces/<?= $tpm['image2'] ?>" height="300px" width="100%" class="d-block w-100" alt="...">
                                                                <div class="carousel-caption d-none d-md-block" style="background-color: dodgerblue; opacity:0.9">
                                                                    <h5><?= $tpm['activ'] ?> at <?= $tpm['village'] ?> - <?= $tpm['terr'] ?></h5>
                                                                </div>
                                                                </div>
                                                                <div class="carousel-item">
                                                                <img src="../controllers/tpmreport/pieces/<?= $tpm['image3'] ?>" height="300px" width="100%" class="d-block w-100" alt="...">
                                                                <div class="carousel-caption d-none d-md-block" style="background-color: #95CD41; opacity:0.9">
                                                                    <h5><?= $tpm['activ'] ?> at <?= $tpm['village'] ?> - <?= $tpm['terr'] ?></h5>
                                                                </div>
                                                                </div>
                                                                <div class="carousel-item">
                                                                <img src="../controllers/tpmreport/pieces/<?= $tpm['image1'] ?>" height="300px" width="100%" style="left: auto; right: auto;" class="d-block w-100" alt="...">
                                                                <div class="carousel-caption d-none d-md-block" style="background-color: #664E88; opacity:0.9">
                                                                    <h5><?= $tpm['activ'] ?> at <?= $tpm['village'] ?> - <?= $tpm['terr'] ?></h5>
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
                                                    <div class="card-footer d-flex w-100 justify-content-between">
                                                        <?php
                                                        if ($tpm['fgTranscript'] != "") {
                                                            ?>
                                                            <a class="btn btn-outline-info" title="View Focus group transcript" href="../controllers/tpmreport/pieces/<?= $tpm['fgTranscript'] ?>">
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
                                                        if ($tpm['kiTranscript'] != "") {
                                                            ?>
                                                            <a class="btn btn-outline-primary" title="View interview transcript" href="../controllers/tpmreport/pieces/<?= $tpm['kiTranscript'] ?>">
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
                                                        <div class="card-header d-flex w-100 justify-content-between">
                                                            Author : <?= $tpm['prx'] ?> (<?= $tpm['proxphone'] ?>)
                                                        </div>
                                                        <div class="card-body">
                                                            <p class="card-text" style="text-align: justify;"><?= $tpm['comment'] ?></p>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tbody>
                
                                        </table>
                                    </div>  
                                        
                                </div>
                                
                            <?php
                                } else {
                                    $data=0;
                                }
                            }
                            if ($data==0) {
                                ?>
                                    <h6 class="text-center text-danger">
                                        No incoming TPM Report from Proxy monitor!!!
                                    </h6>
                                <?php
                            }
                            ?>

                
                        </div>
                    </div>
                    <?php
                }
                if ((isset($_SESSION['identite'])) && ($_SESSION['typeCompte'] == "TPM Proxy Monitor")) {
                    ?>
                    <div class="card">
                        <div class="card-header" style="color: #305286;">
                            <h4><i class="fa fa-list" aria-hidden="true" style="color: #305286;"></i> TPM REPORTS YOU HAVE SUBMITTED</h4>
                            <hr>
                        </div>
                        <div class="card-body">
                        <?php
                            foreach ($tpms as $tpm) {
                                if ($tpm['proxId']== $_SESSION['compteId']) {
                                
                            ?>
                                <div class="card" style="height: 90vh; overflow:scroll;">
                                    <div class="card-header" style="border-left: solid teal 8px; color: #305286;">
                                        <table class="table table-bordered table-condensed table-sm table-responsive-sm table-light">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 20%;">Project</td>
                                                    <td style="width: 80%;"><b><?= $tpm['proj'] ?> OF <?= $tpm['org'] ?> - <?= $tpm['phasename'] ?> (<?= $tpm['phasetype'] ?>)</td></b>
                                                </tr>
                                                <tr>
                                                    <td style="width: 20%;">Activity</td>
                                                    <td style="width: 80%;"><?= $tpm['activ'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 20%;">Performed by</td>
                                                    <td style="width: 80%;"><?= $tpm['implementor'] ?> at <?= $tpm['village'] ?>/<?= $tpm['terr'] ?>/<?= $tpm['province'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 20%;">Submission</td>
                                                    <td style="width: 80%;"><?= $tpm['date'] ?> vs <?= $tpm['endAf'] ?> (<?= $tpm['nbj'] ?> days)</td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 20%;">Note from your supervisor</td>
                                                    <td style="width: 80%;">
                                                    <?php
                                                        if ($tpm['note'] == 'Validated') {
                                                            ?>
                                                                <b class="mb-1 text-success"><i class="fa fa-check" style="color: green;"></i> <?= $tpm['note'] ?></b>
                                                            <?php
                                                        }
                                                        if ($tpm['note'] == 'Unvalidated') {
                                                            ?>
                                                                <b class="mb-1 text-danger"> <i class="fa fa-window-close" style="color: red;"></i> <?= $tpm['note'] ?></b>
                                                            <?php
                                                        }
                                                        if ($tpm['note'] == 'Not checked yet') {
                                                            ?>
                                                                <b class="mb-1 text-warning"><i class="fa fa-window-question" style="color: orange;"></i> <?= $tpm['note'] ?></b>
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                
                                                <tr>
                                                    <td style="width: 20%;">Action</td>
                                                    <td style="width: 80%;">
                                                    <?php
                                                        if ($tpm['note'] == 'Validated') {
                                                            ?>
                                                                <b class="mb-1 text-success"><i class="fa fa-none" style="color: green;"></i> No action needed</b>
                                                            <?php
                                                        }
                                                        if ($tpm['note'] == 'Unvalidated') {
                                                            ?>
                                                            <div class="d-flex w-100 justify-content-between">
                                                                <a class="btn btn-outline-primary btn-sm" title="Improve the report according to Supervisor's feedback" href="home.php?render=<?= sha1("edittpmreport") ?>&sub=<?= sha1("start") ?>&tpmId=<?= $tpm['id'] ?>&image1=<?= $tpm['image1'] ?>&image2=<?= $tpm['image2'] ?>&image3=<?= $tpm['image3'] ?>&fg=<?= $tpm['fgTranscript'] ?>&ki=<?= $tpm['kiTranscript'] ?>&comment=<?= $tpm['comment'] ?>">
                                                                    <i class="fa fa-edit"></i> Improve report
                                                                </a>
                                                                <a class="btn btn-outline-primary btn-sm" title="View Supervisor's feedback" href="home.php?render=<?= sha1("listtpmfeedback") ?>&sub=<?= sha1("start") ?>&tpmId=<?= $tpm['id'] ?>">
                                                                    <i class="fa fa-reply"></i> View feedback
                                                                </a>
                                                            </div>
                                                                
                                                            <?php
                                                        }
                                                        if ($tpm['note'] == 'Not checked yet') {
                                                            ?>
                                                                <a class="btn btn-outline-primary btn-sm" title="Improve the report according to Supervisor's feedback" href="home.php?render=<?= sha1("edittpmreport") ?>&sub=<?= sha1("start") ?>&tpmId=<?= $tpm['id'] ?>&image1=<?= $tpm['image1'] ?>&image2=<?= $tpm['image2'] ?>&image3=<?= $tpm['image3'] ?>&fg=<?= $tpm['fgTranscript'] ?>&ki=<?= $tpm['kiTranscript'] ?>&comment=<?= $tpm['comment'] ?>">
                                                                    <i class="fa fa-edit"></i> Improve report
                                                                </a>
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-body m-2 p-2" style="text-align: justify;">
                                        <div class="alert alert-primary"><?= $tpm['comment'] ?></div>
                                       
                                        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-indicators">
                                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
                                            </div>
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                <img src="../controllers/tpmreport/pieces/<?= $tpm['image1'] ?>" height="300px" width="100%" class="d-block w-100" alt="...">
                                                <div class="carousel-caption d-none d-md-block" style="background-color: #EA5C2B; opacity:0.9">
                                                    <h5><?= $tpm['activ'] ?> at <?= $tpm['village'] ?> - <?= $tpm['terr'] ?></h5>
                                                </div>
                                                </div>
                                                <div class="carousel-item">
                                                <img src="../controllers/tpmreport/pieces/<?= $tpm['image2'] ?>" height="300px" width="100%" class="d-block w-100" alt="...">
                                                <div class="carousel-caption d-none d-md-block" style="background-color: dodgerblue; opacity:0.9">
                                                    <h5><?= $tpm['activ'] ?> at <?= $tpm['village'] ?> - <?= $tpm['terr'] ?></h5>
                                                </div>
                                                </div>
                                                <div class="carousel-item">
                                                <img src="../controllers/tpmreport/pieces/<?= $tpm['image3'] ?>" height="300px" width="100%" class="d-block w-100" alt="...">
                                                <div class="carousel-caption d-none d-md-block" style="background-color: #95CD41; opacity:0.9">
                                                    <h5><?= $tpm['activ'] ?> at <?= $tpm['village'] ?> - <?= $tpm['terr'] ?></h5>
                                                </div>
                                                </div>
                                                <div class="carousel-item">
                                                <img src="../controllers/tpmreport/pieces/<?= $tpm['image1'] ?>" height="300px" width="100%" style="left: auto; right: auto;" class="d-block w-100" alt="...">
                                                <div class="carousel-caption d-none d-md-block" style="background-color: #664E88; opacity:0.9">
                                                    <h5><?= $tpm['activ'] ?> at <?= $tpm['village'] ?> - <?= $tpm['terr'] ?></h5>
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
                                        <div class="card-footer d-flex w-100 justify-content-between">
                                            <?php
                                            if ($tpm['fgTranscript'] != "") {
                                                ?>
                                                <a class="btn btn-outline-info" title="View Focus group transcript" href="../controllers/tpmreport/pieces/<?= $tpm['fgTranscript'] ?>">
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
                                            if ($tpm['kiTranscript'] != "") {
                                                ?>
                                                <a class="btn btn-outline-primary" title="View interview transcript" href="../controllers/tpmreport/pieces/<?= $tpm['kiTranscript'] ?>">
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
                                
                            <?php
                                }
                            }
                            ?>
                
                        </div>
                    </div>
                    <?php
                    }
            }

            if (!empty($verifications)) {
                if ((isset($_SESSION['identite'])) && ($_SESSION['typeCompte'] == "admin" || $_SESSION['typeCompte'] == "TPM Coordinator")) {
                    ?>
                    <div class="card">
                        <div class="card-header" style="color: #305286;">
                            <h5><i class="fa fa-list" aria-hidden="true" style="color: #305286;"></i> TPM REPORTS FROM SUPERVISORS</h5>
                            <hr>    
                        </div>
                        <div class="card-body">
                            <?php
                            foreach ($verifications as $verification) {
                                if ($verification['mention'] == "Intermediate" && $verification['status'] != "Submitted to partner") {
                                    $data1=1;
                            ?>  
                                <div class="card" style="overflow: scroll;">
                                    <div class="card-header" style="border-left: solid teal 15px; color: #305286; text-align: justify;">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">Report for project <?= $verification['proj'] ?> OF <?= $verification['org'] ?> - <?= $verification['phasename'] ?> (<?= $verification['phasetype'] ?>)</h5>
                                            <small>Submitted on <?= $verification['date'] ?></small>
                                        </div><hr>
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1"><i class="fa fa-bath" style="color: blue; width: 60px;"></i>Activity: <?= $verification['activ'] ?></h6>
                                        </div><hr>
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1"><i class="fa fa-handshake" style="color: green; width: 60px;"></i>Implementation Partner : <?= $verification['nameip'] ?></h6>
                                            <small><i class="fa fa-map-marker" aria-hidden="true" style="color: #C15286;"></i> <b>Place : <?= $verification['village'] ?> - <?= $verification['territ'] ?> - <?= $verification['province'] ?></b> </small>
                                        </div>
                                    </div>
                                    <div class="card-body" style="background-color: transparent;">
                                        <table class="table table-bordered table-condensed table-responsive table-sm">
                                            <thead>
                                                <th>Report From Supervisor <?= $verification['sup'] ?></th>
                                                <th>Write the final report</th>
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
                                                                    <img src="../controllers/tpmreport/pieces/<?= $verification['image1'] ?>" height="320px" width="100%" class="d-block w-100" alt="...">
                                                                    <div class="carousel-caption d-none d-md-block" style="background-color: #EA5C2B; opacity:0.9">
                                                                        <h5><?= $verification['activ'] ?> at <?= $verification['village'] ?></h5>
                                                                    </div>
                                                                    </div>
                                                                    <div class="carousel-item">
                                                                    <img src="../controllers/tpmreport/pieces/<?= $verification['image2'] ?>" height="320px" width="100%" class="d-block w-100" alt="...">
                                                                    <div class="carousel-caption d-none d-md-block" style="background-color: dodgerblue; opacity:0.9">
                                                                        <h5><?= $verification['activ'] ?> at <?= $verification['village'] ?></h5>
                                                                    </div>
                                                                    </div>
                                                                    <div class="carousel-item">
                                                                        <img src="../controllers/tpmreport/pieces/<?= $verification['image3'] ?>" height="320px" width="100%" class="d-block w-100" alt="...">
                                                                        <div class="carousel-caption d-none d-md-block" style="background-color: #95CD41; opacity:0.9">
                                                                            <h5><?= $verification['activ'] ?> at <?= $verification['village'] ?></h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="carousel-item">
                                                                        <img src="../controllers/tpmreport/pieces/<?= $verification['image1'] ?>" height="320px" width="100%" style="left: auto; right: auto;" class="d-block w-100" alt="...">
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
                                                            <p class="card-text" style="text-align: justify;"><?= $verification['comment'] ?></p>
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
                                                    <form action="../controllers/verification/verificationController.php" method="POST">
                                                        <div class="form-group">
                                                            <input hidden type="text" class="form-control" value="<?= $verification['tpmId'] ?>" name="tpmId" id="tpmId">
                                                        </div>
                                                        <div class="form-group">
                                                            <input hidden type="text" class="form-control" value="<?= $verification['id'] ?>" name="verificationId" id="verificationId">
                                                        </div>
                                                        <div class="form-group">
                                                            <input hidden type="text" class="form-control" value="<?= $_SESSION['compteId'] ?>" name="compteId" id="tpmId">
                                                        </div>
                                                        <div class="form-group m-1 p-1">
                                                            <label for="keyinformantId"> Key informant (optional)</label>
                                                            <div class="row">
                                                                <select class="form-control select2 col" name="keyinformantId" style="float: left; width: 75%">
                                                                    <option>None</option>
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
                                                            <label for="comment">Final comment</label>
                                                            <textarea required class="form-control" id="comment" name="comment" rows="8" placeholder="Write your report here..."></textarea>
                                                        </div>
                        
                                                        <div class="form-group m-1 p-1">
                                                            <label for="issue"> Problem(s) identified (multiple choices possible) </label>
                                                            <select class="form-control select2" style="width: 100%;" name="issue[]" multiple>
                                                                <optgroup label="Excellent performance (Success)">
                                                                    <option value="No issues requiring intervention were identified"> No issues requiring intervention were identified</option>
                                                                </optgroup>
                                                                <optgroup label="Some problems are identified, but do not seriously affect the programming (Warning)">
                                                                    <option value="Delay in the implementation of activities">Delay in the implementation of activities</option>
                                                                    <option value="Carrying out part of the planned activities">Carrying out part of the planned activities</option>
                                                                    <option value="Some other concerns identified in the implementation of the activity"> Some other concerns identified in the implementation of the activity</option>
                                                                </optgroup>
                
                                                                <optgroup label="Serious issues identified that could impact the programming (Danger)">
                                                                    <option value="Identification of a case of fraud">Identification of a case of fraud</option>
                                                                    <option value="Activity reported but not carried out">Activity reported but not carried out</option>
                                                                    <option value="Non-acceptance of staff or implementing organization in the community"> Non-acceptance of staff or implementing organization in the community</option>
                                                                </optgroup>
                                                                
                                                            </select>
                                                        </div>
                                                        <div class="form-group m-1 p-1">
                                                            <label for="issueAnalysis">Problem(s) analysis</label>
                                                            <textarea required class="form-control" id="issueAnalysis" name="issueAnalysis" rows="3" placeholder="Analyse the problem identified"></textarea>
                                                        </div>
                                                        <div class="form-group m-1 p-1">
                                                            <label for="action">Action recommanded</label>
                                                            <textarea required class="form-control" id="action" name="action" rows="3" placeholder="Write your recommandation here"></textarea>
                                                        </div>
                                                            <input hidden type="text" class="form-control" value="Final" name="mention" id="mention">
                                                            <input hidden type="text" class="form-control" value="Submitted to partner" name="status" id="status">
                
                                                        <div class="form-group m-1 p-1">
                                                            <button class="btn btn-success" name="add_verification2" type="submit">
                                                            <i class="fa fa-paper-plane" aria-hidden="true"></i> Submit to partner
                                                        </button>
                                                        </div>
                                                    </form>
                                                </td>
                                            </tbody>
                
                                        </table>
                                    </div>
                                    
                                </div>
                            <?php
                                } else {
                                    $data1=0;
                                }
                            }
                            if ($data1==0) {
                                ?>
                                <h5 class="text-danger text-center">No incoming TPM reports from supervisors for your selection!!!</h5>
                                    
                                <?php
                            }
                            ?>
                        </div>
                
                    </div>
                    <?php
                    }
                
            }
        } else {
            ?>
                <div class="card text-center text-primary h5">
                    To show TPM Reports, you need to select The project then the reporting phase first!!! <br><br>
                    <p class="h6 text-secondary"> For each selection, click on the button <b>Confim</b> below to confim it.</p>
                </div>
            <?php
        }
        ?>
</div>
<?php
}
