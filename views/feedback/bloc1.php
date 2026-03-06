<div class="col">
    <div class="m-4 p-4 sectionPanel">
        <div class="h5">
            <i style="color: dodgerblue;" class="fas fa-file" aria-hidden="true"></i> Complaints list
            <hr>
        </div>
        <div>
            <div class="card m-2 p-2">
                <h5>Filter complaint by</h5>
                <div class="row">
                    <form action="../controllers/feedback/feedbackController.php" method="POST" class="col">
                        <div class="form-group row">
                            <select class="select2 col-8" name="cb_sensibilite">
                                <option value="0">Sensibility</option>
                                <?php

                                $projectId = 0;
                                $levelSensibilite = 0;
                                $bdPointfocal = new Pointfocal();
                                $pointfocals = $bdPointfocal->getPointfocalActiveByCompteId($_SESSION['compteId']);
                                foreach ($pointfocals as $pointfocal) {
                                    $levelSensibilite = $pointfocal['levelSensibilite'];
                                    $projectId = $pointfocal['prId'];
                                }

                                $bdSensibilite = new Sensibilite();
                                $sensibilites = $bdSensibilite->getSensibiliteByProjectId($projectId);
                                foreach ($sensibilites as $sensibilite) {
                                    if ($levelSensibilite >= $sensibilite['levelSensibilite']) {
                                ?>
                                        <option value="<?= $sensibilite['seId'] ?>"><?= "Level: " . $sensibilite['levelSensibilite'] . " / " . $sensibilite['seDesignation'] . " / Project: " . $sensibilite['prDesignation'] . " / Organization: " . $sensibilite['ogDesignation'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                            <button class="btn btn-warning col-4" name="bt_search_soumission_bySensibiliteId" type="submit"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                        </div>
                    </form>
                    <form action="../controllers/feedback/feedbackController.php" method="POST" class="col">
                        <table class="table table-bordered row">
                                <select class="select2 col-4" name="cb_emergency">
                                    <option value="none"> Emergency</option>
                                    <option value="yes">Urgent cases</option>
                                    <option value="no">Not urgent cases</option>
                                </select>
                                <select class="select2 col-4" name="cb_trustLevel">
                                    <option value="none">Trust level</option>
                                    <option value="Low">Low</option>
                                    <option value="Medium">Medium</option>
                                    <option value="High">High</option>
                                </select>
                            <button class="btn btn-danger col-4" name="bt_search_soumission_byEmergencyByTrustLevel" type="submit"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                        </table>
                    </form>
                    <form action="../controllers/feedback/feedbackController.php" method="POST" class="col">
                        <table class="table table-bordered row">
                            <span class="col">Date1</span><input type="date" class="col-4" name="tb_date1">
                            <span class="col">Date2</span><input type="date" class="col-4" name="tb_date2">
                            <button class="btn btn-primary col" name="bt_search_soumission_byDates" type="submit"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                        </table>
                    </form>
                </div>
            </div>
                    <table class="table table-bordered table-condensed table-striped">
                        <thead>
                            <th>N°</th>
                            <th>Emergency</th>
                            <th>Trust Level</th>
                            <th>Need of Feedback</th>
                            <th>Submission</th>
                            <th>Reporting</th>
                            <th>Subject</th>
                            <th>Event Date</th>
                            <th>Event Time</th>
                            <th>Territory</th>
                            <th>Groupement</th>
                            <th>Sensibility</th>
                            <th>Project</th>
                            <th>Content</th>
                            <th>Reply</th>
                            <th>Process</th>
                        </thead>
                        <tbody>
                            <?php

                            $bdTerritoire = new Territoire();

                            $levelSensibilite = 0;
                            $bdPointfocal = new Pointfocal();
                            $pointfocals = $bdPointfocal->getPointfocalActiveByCompteId($_SESSION['compteId']);
                            foreach ($pointfocals as $pointfocal) {
                                $levelSensibilite = $pointfocal['levelSensibilite'];
                                $projectId = $pointfocal['prId'];
                            }

                            $useTerritory = 0;

                            if (isset($_GET['territory'])) {
                                $useTerritory = $_GET['territory'];
                            }

                            $territoires = $bdTerritoire->getTerritoireByName($useTerritory);


                            $projectId = 0;
                            $levelSensibilite = 0;
                            $bdPointfocal = new Pointfocal();
                            $pointfocals = $bdPointfocal->getPointfocalActiveByCompteId($_SESSION['compteId']);
                            foreach ($pointfocals as $pointfocal) {
                                $levelSensibilite = $pointfocal['levelSensibilite'];
                                $projectId = $pointfocal['prId'];
                            }

                            $n = 0;
                            $bdSoumission = new Soumission();

                            if ((isset($_GET['use_sensibilite'])) && ($_GET['use_sensibilite'] != 0)) {
                                $soumissions = $bdSoumission->getSoumissionByLevelSensibiliteInfByProjectIdBySensibiliteId($levelSensibilite, $projectId, $_GET['use_sensibilite']);
                            } else {
                                $soumissions = $bdSoumission->getSoumissionByLevelSensibiliteInfByProjectId($levelSensibilite, $projectId);
                            }

                            if ((isset($_GET['use_emergency']))) {
                                if (($_GET['use_emergency'] != "none")) {
                                    if (($_GET['use_trustLevel'] != "none")) {
                                        $soumissions = $bdSoumission->getSoumissionByLevelSensibiliteInfByProjectIdByEmergencyByTrustLevel($levelSensibilite, $projectId, $_GET['use_emergency'], $_GET['use_trustLevel']);
                                    } else {
                                        $soumissions = $bdSoumission->getSoumissionByLevelSensibiliteInfByProjectIdByEmergency($levelSensibilite, $projectId, $_GET['use_emergency']);
                                    }
                                } else {
                                    if (($_GET['use_trustLevel'] != "none")) {
                                        $soumissions = $bdSoumission->getSoumissionByLevelSensibiliteInfByProjectIdByTrustLevel($levelSensibilite, $projectId, $_GET['use_trustLevel']);
                                    } else {
                                        $soumissions = $bdSoumission->getSoumissionByLevelSensibiliteInfByProjectId($levelSensibilite, $projectId);
                                    }
                                }
                            }

                            foreach ($soumissions as $soumission) {
                                $justDateSoumission = dateTimeFrenchItem($soumission['soDateHeure'], 0);
                                if ((!isset($_GET['use_date1'])) || ((isset($_GET['use_date1'])) && ($justDateSoumission >= $_GET['use_date1']) && ($justDateSoumission <= $_GET['use_date2']))) {
                                    // echo $soumission['seId'];
                                    // echo "-";
                                    // echo $_GET['use_category'];
                                    if (((isset($_GET['use_category'])) && (($territoires[0]['id'] == $soumission['territoireId']) && ($_GET['use_category'] == $soumission['seId']))) || (!(isset($_GET['use_category'])))) {
                                        $n++;
                            ?>
                                        <tr>
                                            <td <?php
                                                if ($soumission['soEmergency'] == "yes") {
                                                    echo " style='border-left:solid red 10px;' ";
                                                }
                                                ?>>
                                                <?= $n ?>
                                            </td>
                                            <td><?= $soumission['soEmergency'] ?></td>
                                            <td <?php
                                                if ($soumission['soTrust'] == "High") {
                                                    echo " style='color:forestgreen;font-weight:bold;' ";
                                                } else if ($soumission['soTrust'] == "Medium") {
                                                    echo " style='color:orange;font-weight:bold;' ";
                                                } else if ($soumission['soTrust'] == "Low") {
                                                    echo " style='color:red;font-weight:bold;' ";
                                                }
                                                ?>>
                                                <?= $soumission['soTrust'] ?>
                                            </td>
                                            <td><strong style="color:dodgerblue"><?= $soumission['needFeedback'] ?></strong></td>
                                            <td><?= $soumission['soDateHeure'] ?></td>
                                            <td><?= $soumission['raDateHeure'] ?></td>
                                            <td style="font-weight: 500;"><?= $soumission['subject'] ?></td>
                                            <td><?= $soumission['dateEvent'] ?></td>
                                            <td><?= $soumission['infHeure'] ?></td>
                                            <td style="font-weight: 600; color: #0063c6;">
                                                <?php
                                                $territoires2 = $bdTerritoire->getTerritoireById($soumission['territoireId']);
                                                if (isset($territoires2[0])) {
                                                    echo $territoires2[0]['terr']." / ".$territoires2[0]['province'];
                                                }
                                                
                                                ?>
                                            </td>
                                            <td><?= $soumission['infLieu'] ?></td>
                                            <td><?= "Level: " . $soumission['levelSensibilite'] . " / " . $soumission['seDesignation'] ?></td>
                                            <td><?= $soumission['prDesignation'] . " / " . $soumission['ogDesignation'] ?></td>



                                            <td>
                                                <form action="../controllers/feedback/feedbackController.php" method="POST">

                                                    <input type="hidden" name="tb_rapportageId" value="<?= $soumission['raId'] ?>">
                                                    <input type="hidden" name="tb_remonteId" value="<?= $soumission['reId'] ?>">
                                                    <input type="hidden" name="tb_projectId" value="<?= $soumission['prId'] ?>">
                                                    <input type="hidden" name="tb_soumissionId" value="<?= $soumission['soId'] ?>">
                                                    <button class="btn btn-primary btn-sm" name="bt_for_view_information" type="submit"><i class="fa fa-file" aria-hidden="true"></i> View details</button>

                                                </form>
                                            </td>
                                            <td>
                                                <?php
                                                if ($soumission['needFeedback'] == 'yes') {
                                                ?>
                                                    <form action="../controllers/feedback/feedbackController.php" method="POST">

                                                        <input type="hidden" name="tb_rapportageId" value="<?= $soumission['raId'] ?>">
                                                        <input type="hidden" name="tb_remonteId" value="<?= $soumission['reId'] ?>">
                                                        <input type="hidden" name="tb_projectId" value="<?= $soumission['prId'] ?>">
                                                        <input type="hidden" name="tb_soumissionId" value="<?= $soumission['soId'] ?>">
                                                        <button class="btn btn-success btn-sm" name="bt_for_add" type="submit"><i class="fa fa-reply" aria-hidden="true"></i> Add Feedback</button>

                                                    </form>
                                                <?php
                                                } else if ($soumission['needFeedback'] == 'no') {
                                                ?>
                                                    <p>No feedback needed</p>
                                                <?php
                                                }
                                                ?>

                                            </td>
                                            <td>
                                                <form action="../controllers/feedback/feedbackController.php" method="POST">

                                                    <input type="hidden" name="tb_rapportageId" value="<?= $soumission['raId'] ?>">
                                                    <input type="hidden" name="tb_remonteId" value="<?= $soumission['reId'] ?>">
                                                    <input type="hidden" name="tb_projectId" value="<?= $soumission['prId'] ?>">
                                                    <input type="hidden" name="tb_soumissionId" value="<?= $soumission['soId'] ?>">
                                                    <button class="btn btn-warning btn-sm" name="bt_for_view_triangulation" type="submit"><i class="fa fa-filter" aria-hidden="true"></i> View triangulations</button>

                                                </form>
                                            </td>

                                        </tr>
                            <?php
                                    }
                                }
                            }
                            ?>

                        </tbody>
                    </table>
        </div>
    </div>
</div>