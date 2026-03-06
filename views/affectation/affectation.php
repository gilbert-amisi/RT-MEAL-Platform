<?php
if ((isset($_SESSION['identite']))) {
    $bdProject = new Project();
    $projects = $bdProject->getProjectAll();
?>
<div class="m-2 p-2">
    <?php
    if ((isset($_SESSION['identite'])) && ($_SESSION['typeCompte'] == "admin" || $_SESSION['typeCompte'] == "TPM Coordinator")) {
    ?>
        <div class="card" style="overflow:scroll;">
            <div class="card-header" style="color: #46799E;">
                <h5><i style="color: green;" class="fas fa-plus" aria-hidden="true"></i> NEW TPM ASSIGNEMENT </h5><hr>
                <form method="POST">
                    <div class="form-group h6" style="float: left; width:80%;">
                        <select name="projectId" class="form-control select2" id="projectId" style="width:98%;">
                        
                            <option value="0">Select the project to monitore</option>
                            <?php
                                foreach ($projects as $project) {
                                    ?>
                                        <option value="<?= $project['prId'] ?>">Project <?= $project['prDesignation'] ?> of <?= $project['ogDesignation'] ?></option>
                                    <?php
                                
                                }
                                ?>
                        </select>
                    </div>
                    <div class="form-group h6" style="float: left; width:20%;">
                        <button class="btn btn-outline-primary btn-sm" name="filter_tpm_project" type="submit" title="Confirm the selected project">
                            <i class="fa fa-search" aria-hidden="true"></i> Confirm the project
                        </button>
                    </div>
                </form>
            </div>
            <div class="card-body ">
                <?php
                if (isset($_POST['filter_tpm_project'])) {
                    $getProject = $_POST['projectId'];
                    $bdPhase = new Phase();
                    $phases = $bdPhase->getPhaseByProject($getProject);
                    $bdResult = new Result();
                    $activities = $bdResult->getActivityByProject($getProject);

                    if (empty($phases) || empty($activities)) {
                        ?>
                        <h4 class="text-center text-danger">Sorry! There is no reporting phase or activity setted for the selected project</h4>
                        <?php
                    } else {
                        ?>

                        <form action="../controllers/affectation/affectationController.php" method="POST" class="row">
                            <div class="col" style="overflow:scroll;">
                                <div class="form-group m-1 p-1">
                                    <label class="control-label" for="phaseId">Phase of reporting</label>
                                    <select class="form-control select2" style="width: 100%;" name="phaseId" required>
                                        <option value="0">Choose</option>
                                        <?php
                                        foreach ($phases as $phase) {
                                            if ($phase['status'] == "Active") {
                                                ?>
                                            <option value="<?= $phase['id'] ?>"><?= $phase['name'] ?> (Project <?= $phase['proj'] ?> of <?= $phase['org'] ?>)</option>
                                            <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group m-1 p-1">
                                    <label class="control-label" for="activityId">Activity to monitore</label>
                                    <select class="form-control select2" style="width: 100%;" name="activityId" require>
                                        <option value="0">Choose</option>
                                        <?php
                                        foreach ($activities as $activity) {
                                        ?>
                                            <option value="<?= $activity['id'] ?>"><?= $activity['name'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group m-1 p-1">
                                    <label class="control-label" for="axeId">Territory of intervention</label>
                                    <select class="form-control select2" style="width: 100%;" name="axeId" require>
                                        <option value="0">Choose</option>
                                        <?php
                                        $bdAxe = new Axe();
                                        $axes = $bdAxe->getAxeAll();
                                        foreach ($axes as $axe) {
                                        ?>
                                            <option value="<?= $axe['id'] ?>"><?= $axe['terr'] ?> / <?= $axe['province'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group m-1 p-1">
                                    <label class="control-label" for="village">Village or Town</label>
                                    <input class="form-control" type="text" name="village" require>
                                </div>

                                <div class="form-group m-1 p-1">
                                    <label class="control-label" for="ipId">Implementation partner</label>
                                    <select class="form-control select2" style="width: 100%;" name="ipId" require>
                                        <option value="0">Choose</option>
                                        <?php
                                        $bdIp = new Ip();
                                        $ips = $bdIp->getIpAll();
                                        foreach ($ips as $ip) {
                                        ?>
                                            <option value="<?= $ip['id'] ?>"><?= $ip['name'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col" style="overflow:scroll;">

                            <div class="form-group m-1 p-1">
                                    <label class="control-label" for="supervisorId">TPM Supervisor</label>
                                    <select class="form-control select2" style="width: 100%;" name="supervisorId" require>
                                        <option value="0">Choose</option>
                                        <?php
                                        $bdSupervisor = new Supervisor();
                                        $supervisors = $bdSupervisor->getSupervisorAll();
                                        foreach ($supervisors as $supervisor) {
                                        ?>
                                            <option value="<?= $supervisor['id'] ?>"><?= $supervisor['name'] ?> / <?= $supervisor['phone'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                
                                <div class="form-group m-1 p-1">
                                    <label class="control-label" for="start">Start date</label>
                                    <input class="form-control" type="date" name="start" require>
                                </div>
                                <div class="form-group m-1 p-1">
                                    <label class="control-label" for="end">End date</label>
                                    <input class="form-control" type="date" name="end" require>
                                </div>
                                <div class="form-group m-1 p-1">
                                    <label class="control-label" for="end">Instructions</label>
                                    <textarea class="form-control" name="instruction" id="instruction" placeholder="Give instructions here" rows="4"></textarea>
                                </div>
                                <hr>
                                <div class="form-group m-1 p-1">
                                    <button class="btn btn-success" name="add_affectation" type="submit">
                                    <i class="fas fa-save" aria-hidden="true"></i> Save Assignment
                                </button>
                                </div>
                            </div>
                        </form>

                    <?php
                    }

                } else {
                    ?>
                        <h4 class="text-center text-primary">To assign new TPM collectors you need to select the project first!!!</h4>
                    <?php
                }
                ?>

                
            </div>
        </div> <hr>

    <?php
    }
    ?>

    <div class="card">
        <div class="h5 card-header" style="color: #6D799E;">
            <?php
                if ($_SESSION['typeCompte'] == "TPM Coordinator" || $_SESSION['typeCompte'] == "admin") {
                    ?>
                    <i style="color: grey;" class="fas fa-list" aria-hidden="true"></i> TPM ASSIGNMENTS NOT YET PERFORMED
                    <?php
                }
                if ($_SESSION['typeCompte'] == "TPM Supervisor" || $_SESSION['typeCompte'] == "TPM Proxy Monitor") {
                    ?>
                    <i style="color: grey;" class="fas fa-list" aria-hidden="true"></i> YOUR TPM ASSIGNMENTS NOT YET PERFORMED
                    <?php
                }
            ?>
            
        </div>
        <div class="card-body">
            <?php
            if ($_SESSION['typeCompte'] == "TPM Supervisor" || $_SESSION['typeCompte'] == "TPM Coordinator" || $_SESSION['typeCompte'] == "admin") {
                ?>
            
                <table class="table table-bordered table-condensed table-striped">
                    <thead class="thead">
                        <tr>
                            <th>N°</th>
                            <th>Project</th>
                            <th>Phase</th>
                            <th>Territory</th>
                            <th>Village</th>
                            <th>Result</th>
                            <th>Product</th>
                            <th>Activity</th>
                            <th>Impl. Partner</th>
                            <th>Supervisor</th>
                            <th>Proxy Monitor</th>
                            <th>Instructions</th>
                            <th>Duration</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $n = 0;
                        $bdAffectation = new Affectation();
                        $affectations = $bdAffectation->getAffectationAll();
                        foreach ($affectations as $affectation) {
                            if ($affectation['status'] == "Active") {
                            $n++;
                            if ((isset($_SESSION['identite'])) && ($_SESSION['typeCompte'] == "admin" || $_SESSION['typeCompte'] == "TPM Coordinator")) {
                        ?>
                            <tr>
                                <td><?= $n ?></td>
                                <td><?= $affectation['proj'] ?> / <?= $affectation['org'] ?></td>
                                <td><?= $affectation['phasename'] ?></td>
                                <td><?= $affectation['nameaxe'] ?> / <?= $affectation['prov'] ?></td>
                                <td><?= $affectation['village'] ?></td>
                                <td><?= $affectation['res'] ?></td>
                                <td><?= $affectation['prod'] ?></td>
                                <td><?= $affectation['act'] ?></td>
                                <td><?= $affectation['nameip'] ?></td>
                                <td><?= $affectation['namesup'] ?> / <?= $affectation['phonesup'] ?></td>
                                <td>
                                    <?php
                                        if ($affectation['nameprox'] != "") {
                                            echo $affectation['nameprox'] ?> / <?= $affectation['locprox'] ?> / <?= $affectation['phoneprox'];
                                        } else {
                                            ?>
                                                <p class="text-danger">Not yet assigned</p>
                                            <?php
                                        }
                                    ?>
                                </td>
                                <td><?= $affectation['instruction'] ?></td>
                                <td> <b><?= $affectation['duration'] ?> days</b> (From <?= $affectation['start'] ?> To <?= $affectation['end'] ?>)</td>
                                
                                <td>
                                <form action="../controllers/affectation/affectationController.php" method="POST">
                                    <input type="hidden" name="affectationId" value="<?= $affectation['id'] ?>">
                                    <button class="btn btn-danger btn-sm" name="bt_delete" type="submit" title="Delete this assignment"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                                </form>

                                </td>
                            </tr>
                        <?php
                            }
                            if ((isset($_SESSION['identite'])) && $_SESSION['typeCompte'] == "TPM Supervisor" && $affectation['comptesup'] == $_SESSION['compteId']) {
                                ?>
                            <tr>
                                <td><?= $n ?></td>
                                <td><?= $affectation['proj'] ?> / <?= $affectation['org'] ?></td>
                                <td><?= $affectation['phasename'] ?> (<?= $affectation['phasetype'] ?>)</td>
                                <td><?= $affectation['nameaxe'] ?> / <?= $affectation['prov'] ?></td>
                                <td><?= $affectation['village'] ?></td>
                                <td><?= $affectation['res'] ?></td>
                                <td><?= $affectation['prod'] ?></td>
                                <td><?= $affectation['act'] ?></td>
                                <td><?= $affectation['nameip'] ?></td>
                                <td><?= $affectation['namesup'] ?> / <?= $affectation['phonesup'] ?></td>
                                <td>
                                    <?php
                                        if ($affectation['nameprox'] != "") {
                                            echo $affectation['nameprox'] ?> / <?= $affectation['locprox'] ?> / <?= $affectation['phoneprox'];
                                        } else {
                                            ?>
                                                <p class="text-danger">Not yet assigned</p>
                                            <?php
                                        }
                                    ?>
                                </td>
                                <td><?= $affectation['instruction'] ?></td>
                                <td> <b><?= $affectation['duration'] ?> days</b> (From <?= $affectation['start'] ?> To <?= $affectation['end'] ?>)</td>
                                
                                <td>
                                <a href="home.php?render=<?= sha1("affectationproxy") ?>&sub=<?= sha1("start") ?>&affectationId=<?= $affectation['id'] ?>&village=<?= $affectation['village'] ?>&start=<?= $affectation['start'] ?>&end=<?= $affectation['end'] ?>&instruction=<?= $affectation['instruction'] ?>" class="btn btn-success btn-sm" title="Assign Proxy Monitor to this activity" name="add_tpm" type="submit"><i class="fa fa-user" aria-hidden="true"></i> Add Proxy Monitor</a>
                                </td>
                            </tr>
                            <?php
                            }

                            }
                        }
                        ?>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                        </tr>
                    </tfoot>
                </table>
                <?php

            }

            // For Proxy
            $n = 0;
            $bdAffectation = new Affectation();
            $affectations = $bdAffectation->getAffectationAll();
            foreach ($affectations as $affectation) {
                if ($affectation['status'] == "Active") {
                $n++;
                    if ((isset($_SESSION['identite'])) && $_SESSION['typeCompte'] == "TPM Proxy Monitor" && $affectation['compteprox'] == $_SESSION['compteId']) {
                        ?>
                        <div class="card m-1 p-1">
                            <div class="card-header" style="border-left: solid teal 15px;">
                                <h5><?= $n ?>. Project <?= $affectation ['proj'] ?> of <?= $affectation['org'] ?></h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-condensed table-sm table-responsive-sm">
                                    <tbody>
                                        <tr>
                                            <td style="width: 25%;"><b>Activity</b></td>
                                            <td style="width: 75%;"><?= $affectation['act'] ?></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 25%;"><b>Performing</b></td>
                                            <td style="width: 75%;"><?= $affectation['nameip'] ?></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 25%;"><b>Phase</b></td>
                                            <td style="width: 75%;"><?= $affectation['phasename'] ?> (<?= $affectation['phasetype'] ?>)</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 25%;"><b>Place</b></td>
                                            <td style="width: 75%;"><?= $affectation['village'] ?> / <?= $affectation['nameaxe'] ?> / <?= $affectation['prov'] ?></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 25%;"><b>Duration</b></td>
                                            <td style="width: 75%;"><b><?= $affectation['duration'] ?> days</b> (From <?= $affectation['start'] ?> To <?= $affectation['end'] ?>)</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 25%;"><b>Collector</b></td>
                                            <td style="width: 75%;"><b><?= $affectation['nameprox'] ?></b>, supervised by <b><?= $affectation['namesup'] ?></b> (<?= $affectation['phonesup'] ?>)</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="alert alert-primary" role="alert">
                                    <h5 class="alert-heading">Instructions</h5><hr>
                                    <p class="mb-0"><?= $affectation['instruction'] ?></p>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <a href="home.php?render=<?= sha1("addtpmreport") ?>&sub=<?= sha1("start") ?>&affectationId=<?= $affectation['id'] ?>&project=<?= $affectation['proj'] ?> &org=<?= $affectation['org'] ?> &phasename=<?= $affectation['phasename'] ?> &phasetype=<?= $affectation['phasetype'] ?> &village=<?= $affectation['village'] ?> &nameip=<?= $affectation['nameip'] ?> &nameaxe=<?= $affectation['nameaxe'] ?> &prov=<?= $affectation['prov'] ?> &act=<?= $affectation['act'] ?> &instruction=<?= $affectation['instruction'] ?>" class="btn btn-outline-primary btn-sm" name="add_tpm" type="submit"><i class="fa fa-edit" aria-hidden="true"></i> Write the report of this assignment</a>
                            </div>

                        </div>
                        <?php
                    }
                }
            }
            ?>

        </div>
    </div>
</div>
<?php
}
