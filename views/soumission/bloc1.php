<div class="col">
    <div class="m-4 p-4 sectionPanel">
        <div>
            <i style="color: dodgerblue;" class="fas fa-file" aria-hidden="true"></i> Reporting List
            <hr>
        </div>
        <div>
            <div class="row" style="background-color: whitesmoke;">
                <div class="col">
                    <form action="../controllers/information/informationController.php" method="POST">
                        <table class="table table-bordered">

                            <td>
                                <p style="font-weight: 600;">Search by project</p>
                            </td>

                            <td>
                                <div class="form-group">
                                    <select class="form-control select2" name="cb_project">
                                        <option value="0">Choose</option>
                                        <?php
                                        $bdProject = new Project();
                                        $projects = $bdProject->getProjectAllActive();
                                        foreach ($projects as $project) {
                                        ?>
                                            <option value="<?= $project['prId'] ?>"><?= $project['prDesignation'] . " / Organization: " . $project['ogDesignation'] ?></option>
                                        <?php
                                        }
                                        ?>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control select2" name="cb_etat">
                                        <option value="all">All category</option>
                                        <option value="Submited">Submited</option>
                                        <option value="Not submited">Not submited</option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">

                                    <button class="btn btn-warning" name="bt_search_soumission_byProjectIdByEtat" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                </div>
                            </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div class="col">
                    <form action="../controllers/information/informationController.php" method="POST">
                        <table class="table table-bordered">

                            <td>
                                <p style="font-weight: 600;">Search by situation</p>
                            </td>

                            <td>
                                <div class="form-group">
                                    <select class="form-control select2" name="cb_emergency">
                                        <option value="none"> Choose by emergency</option>
                                        <option value="yes">Emergency</option>
                                        <option value="no">No emergency</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control select2" name="cb_trustLevel">
                                        <option value="none"> Choose by trust level</option>
                                        <option value="Low">Low</option>
                                        <option value="Medium">Medium</option>
                                        <option value="High">High</option>

                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">

                                    <button class="btn btn-warning" name="bt_search_soumission_byEmergencyByTrustLevel" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                </div>
                            </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div class="col">
                    <form action="../controllers/information/informationController.php" method="POST">
                        <table class="table table-bordered">

                            <td>
                                <p style="font-weight: 600;">Search by date</p>
                            </td>

                            <td>
                                <div class="form-group">
                                    <div class="form-group">
                                        <span>Date1</span><input type="date" class="form-control" name="tb_date1">
                                        <span>Date2</span><input type="date" class="form-control" name="tb_date2">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">

                                    <button class="btn btn-warning" name="bt_search_soumission_byDates" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                </div>
                            </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
            <div class="row">

                <div class="col">
                    <table class="table table-bordered">
                        <thead>
                            <th>#</th>
                            <th>Emergency</th>
                            <th>Trust Level</th>
                            <th>From agent</th>
                            <th>Recent level</th>
                            <th>From low level</th>
                            <th>Reporting</th>
                            <th>Subject</th>
                            <th>Event Date</th>
                            <th>Event Time</th>
                            <th>Location</th>
                            <th>Project</th>

                            <th></th>
                            <th></th>
                            <th></th>
                        </thead>
                        <tbody>
                            <?php

                            $bdNiveau=new Niveau();

                            $agentId = 0;
                            $niveauId = 0;
                            $levelNiveauAgent = 0;
                            $forValidationNiveauAgent = "";
                            $bdAgent = new Agent();
                            $agents = $bdAgent->getAgentActiveByCompteId($_SESSION['compteId']);
                            foreach ($agents as $agent) {
                                $agentId = $agent['agId'];
                                $niveauId = $agent['nvId'];
                                $levelNiveauAgent = $agent['levelNiveau'];
                                $forValidationNiveauAgent = $agent['forValidation'];
                            }

                            $n = 0;
                            $bdRemonte = new Remonte();

                            if ((isset($_GET['use_project']))) {
                                if (($_GET['use_project'] != 0)) {
                                    $remontes = $bdRemonte->getRemonteByNewNiveauIdByProjectId($niveauId, $_GET['use_project']);
                                } else {
                                    $remontes = $bdRemonte->getRemonteByNewNiveauId($niveauId);
                                }
                            } else {
                                $remontes = $bdRemonte->getRemonteByNewNiveauId($niveauId);
                            }

                            if ((isset($_GET['use_emergency']))) {
                                if (($_GET['use_emergency'] != "none")) {
                                    if (($_GET['use_trustLevel'] != "none")) {
                                        $remontes = $bdRemonte->getRemonteByNewNiveauIdByEmergencyByTrustLevel($niveauId, $_GET['use_emergency'], $_GET['use_trustLevel']);
                                    } else {
                                        $remontes = $bdRemonte->getRemonteByNewNiveauIdByEmergency($niveauId, $_GET['use_emergency']);
                                    }
                                } else {
                                    if (($_GET['use_trustLevel'] != "none")) {
                                        $remontes = $bdRemonte->getRemonteByNewNiveauIdByTrustLevel($niveauId, $_GET['use_trustLevel']);
                                    } else {
                                        $remontes = $bdRemonte->getRemonteByNewNiveauId($niveauId, $_GET['use_emergency']);
                                    }
                                }
                            }



                            foreach ($remontes as $remonte) {

                                $remontes2 = $bdRemonte->getRemonteByRapportageIdDifferentNiveau($remonte['raId'], $niveauId);

                                $remonteIdTest = 0;
                                foreach ($remontes2 as $remonte2) {
                                    $remonteIdTest = $remonte2['reId'];
                                }

                                $soumissionId = 0;
                                $bdSoumission = new Soumission();
                                $soumissions = $bdSoumission->getSoumissionByRemonteId($remonte['reId']);
                                foreach ($soumissions as $soumission) {
                                    $soumissionId = $soumission['soId'];
                                }

                                $justDateRemonte = dateTimeFrenchItem($remonte['reDateHeure'], 0);



                                if (((!isset($_GET['use_emergency'])) && (!isset($_GET['use_project'])) &&  (!isset($_GET['use_date1']))) || (((isset($_GET['use_emergency']))) || ((isset($_GET['use_date1'])) && ($justDateRemonte >= $_GET['use_date1']) && ($justDateRemonte <= $_GET['use_date2'])) || (((isset($_GET['use_etat'])) && ((($_GET['use_etat'] == "all")) || (($forValidationNiveauAgent == "no") && ($_GET['use_etat'] == "Not submited") && ($remonteIdTest == 0)) || (($forValidationNiveauAgent == "no") && ($_GET['use_etat'] == "Submited") && ($remonteIdTest != 0)) || (($forValidationNiveauAgent == "yes") && ($_GET['use_etat'] == "Submited") && ($soumissionId != 0)) || (($forValidationNiveauAgent == "yes") && ($_GET['use_etat'] == "Not submited") && ($soumissionId == 0))))))) {

                                    
                                    $n++;
                                    $identiteAgent="";
                                    $agents = $bdAgent->getAgentById($remonte['agentId']);
                                    foreach ($agents as $agent) {
                                        $identiteAgent = $agent['agIdentite'];
                                    }

                                    $levelNiveauLast="";
                                    $niveaus=$bdNiveau->getNiveauById($remonte['oldNiveauId']);
                                    foreach ($niveaus as $niveau) {
                                        $levelNiveauLast=$niveau['levelNiveau'];
                                    }


                            ?>
                                    <tr>
                                        <td <?php
                                            if ($remonte['emergency'] == "yes") {
                                                echo " style='border-left:solid red 10px;' ";
                                            }
                                            ?>>
                                            <?php

                                            if ((($forValidationNiveauAgent == "yes") && ($soumissionId != 0)) || (($forValidationNiveauAgent == "no") && ($remonteIdTest != 0))) {
                                            ?>
                                                <i style="color: forestgreen;" class="fa fa-check" aria-hidden="true"></i>
                                            <?php
                                            }

                                            echo $n;

                                            ?>
                                        </td>
                                        <td><?= $remonte['emergency'] ?></td>
                                        <td <?php
                                            if ($remonte['trust'] == "High") {
                                                echo " style='color:forestgreen;font-weight:bold;' ";
                                            } else if ($remonte['trust'] == "Medium") {
                                                echo " style='color:orange;font-weight:bold;' ";
                                            } else if ($remonte['trust'] == "Low") {
                                                echo " style='color:red;font-weight:bold;' ";
                                            }
                                            ?>>
                                            <?= $remonte['trust'] ?>
                                        </td>
                                        <td><?= $identiteAgent ?></td>
                                        <td><?= $levelNiveauLast ?></td>
                                        <td style="font-weight: 600; color: #0063c9;"><?= $remonte['reDateHeure'] ?></td>
                                        <td><?= $remonte['raDateHeure'] ?></td>
                                        <td style="font-weight: 600;"><?= $remonte['subject'] ?></td>
                                        
                                        <td><?= $remonte['dateEvent'] ?></td>
                                        <td><?= $remonte['infHeure'] ?></td>
                                        <td><?= $remonte['infLieu'] ?></td>
                                        <td><?= $remonte['prDesignation'] . " / " . $remonte['ogDesignation'] ?></td>

                                        <?php

                                        ?>

                                        <td>
                                            <?php
                                            if ($forValidationNiveauAgent == "yes") {
                                            ?>
                                                <form action="../controllers/soumission/soumissionController.php" method="POST">

                                                    <input type="hidden" name="tb_rapportageId" value="<?= $remonte['raId'] ?>">
                                                    <input type="hidden" name="tb_remonteId" value="<?= $remonte['reId'] ?>">
                                                    <input type="hidden" name="tb_projectId" value="<?= $remonte['prId'] ?>">
                                                    <?php
                                                    if ((($forValidationNiveauAgent == "yes") && ($soumissionId == 0)) || (($forValidationNiveauAgent == "no") && ($remonteIdTest == 0))) {
                                                    ?>
                                                        <button class="btn btn-primary" name="bt_for_view" type="submit"><i class="fa fa-file" aria-hidden="true"></i> View and Submit to partner</button>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <button class="btn btn-secondary" name="bt_for_view" type="submit">View</button>
                                                    <?php
                                                    }
                                                    ?>

                                                </form>
                                            <?php
                                            }
                                            ?>

                                        </td>
                                        <td>
                                            <?php
                                            if (1) {
                                            ?>
                                                <form action="../controllers/remonte/remonteController.php" method="POST">

                                                    <input type="hidden" name="tb_rapportageId" value="<?= $remonte['raId'] ?>">
                                                    <input type="hidden" name="tb_remonteId" value="<?= $remonte['reId'] ?>">
                                                    <input type="hidden" name="tb_projectId" value="<?= $remonte['prId'] ?>">
                                                    <button class="btn btn-warning" name="bt_for_triangulation" type="submit"><i class="fa fa-plus" aria-hidden="true"></i> Triangulation</button>

                                                </form>
                                            <?php
                                            }
                                            ?>

                                        </td>

                                        <td>
                                            <?php
                                            if (($niveauId == $remonte['newNiveauId']) && ($forValidationNiveauAgent == "no")) {
                                            ?>

                                                <form action="../controllers/rapportage/rapportageController.php" method="POST">

                                                    <input type="hidden" name="tb_rapportageId" value="<?= $remonte['raId'] ?>">
                                                    <input type="hidden" name="tb_projectId" value="<?= $remonte['prId'] ?>">

                                                    <?php
                                                    if ((($forValidationNiveauAgent == "yes") && ($soumissionId == 0)) || (($forValidationNiveauAgent == "no") && ($remonteIdTest == 0))) {
                                                    ?>
                                                        <button class="btn btn-success" name="bt_for_view" type="submit"><i class="fa fa-file" aria-hidden="true"></i> Submit to next Level</button>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <button class="btn btn-secondary" name="bt_for_view" type="submit"> View</button>
                                                    <?php
                                                    }
                                                    ?>


                                                </form>
                                            <?php
                                            }
                                            ?>
                                        </td>

                                    </tr>
                            <?php
                                }
                            }
                            ?>

                        </tbody>

                        <span style="background-color: #0063c6; padding: 8px; color: whitesmoke; border-radius: 10px;">#: <strong><?= $n ?></strong></span>

                    </table>
                </div>

            </div>

        </div>
    </div>
</div>