<div class="col">
    <div class="m-4 p-4 sectionPanel">
        <div>
            <i style="color: forestgreen;" class="fa fa-check" aria-hidden="true"></i> Feedback validated
            <hr>
        </div>
        <div>
            <div class="row" style="background-color: whitesmoke;">
                <div class="col-lg-5">
                    <form action="../controllers/feedback/feedbackController.php" method="POST">
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
                            </td>
                            <td>
                                <div class="form-group">

                                    <button class="btn btn-warning" name="bt_search_validation_byProjectId" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                </div>
                            </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div class="col-lg-7">
                    <form action="../controllers/feedback/feedbackController.php" method="POST">
                        <table class="table table-bordered">

                            <td>
                                <p style="font-weight: 600;">Search validation</p>
                            </td>

                            <td>
                                <div class="form-group">
                                    <select class="form-control select2" name="cb_ajuste">
                                        <option value="0">Choose</option>
                                        <?php
                                        $bdAjuste = new Ajuste();
                                        $agentId = 0;
                                        $niveauId = 0;
                                        $bdAgent = new Agent();
                                        $agents = $bdAgent->getAgentActiveByCompteId($_SESSION['compteId']);
                                        foreach ($agents as $agent) {
                                            $agentId = $agent['agId'];
                                            $niveauId = $agent['nvId'];
                                        }

                                        $ajustes = $bdAjuste->getAjusteByNiveauId($niveauId);

                                        foreach ($ajustes as $ajuste) {
                                        ?>
                                            <option value="<?= $ajuste['afId'] ?>"><?= "Validation: " . $ajuste['afDateHeure'] . " / Subject: " . $ajuste['subject'] . " / Event: " . $ajuste['dateEvent'] . " / " . $ajuste['infLieu'] . " / " . $ajuste['infHeure'] . " / Project: " . $ajuste['prDesignation'] . " / " . $ajuste['ogDesignation'] ?></option>
                                        <?php
                                        }
                                        ?>

                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">

                                    <button class="btn btn-warning" name="bt_search_validation" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
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
                            <th>Feedback validation</th>
                            <th>Submission</th>
                            <th>Reporting</th>
                            <th>Subject</th>
                            <th>Reporting by </th>
                            <th>Event Date</th>
                            <th>Event Time</th>
                            <th>Location</th>
                            <th>Project</th>

                            <th></th>
                            <th></th>
                        </thead>
                        <tbody>
                            <?php

                            $levelSensibilite = 0;
                            $bdPointfocal = new Pointfocal();
                            $pointfocals = $bdPointfocal->getPointfocalActiveByCompteId($_SESSION['compteId']);
                            foreach ($pointfocals as $pointfocal) {
                                $levelSensibilite = $pointfocal['levelSensibilite'];
                                $projectId = $pointfocal['prId'];
                            }

                            $n = 0;
                            $bdAjuste = new Ajuste();

                            $agentId = 0;
                            $niveauId = 0;
                            $bdAgent = new Agent();
                            $agents = $bdAgent->getAgentActiveByCompteId($_SESSION['compteId']);
                            foreach ($agents as $agent) {
                                $agentId = $agent['agId'];
                                $niveauId = $agent['nvId'];
                            }

                            if ((isset($_GET['use_project'])) && ($_GET['use_project'] != 0)) {
                                if ((isset($_GET['use_ajuste'])) && ($_GET['use_ajuste'] != 0)) {
                                    $ajustes = $bdAjuste->getAjusteByNiveauIdByIdByProjectId($niveauId, $_GET['use_ajuste'], $_GET['use_project']);
                                } else {
                                    $ajustes = $bdAjuste->getAjusteByNiveauIdByProjectId($niveauId, $_GET['use_project']);
                                }
                            } else {
                                if ((isset($_GET['use_ajuste'])) && ($_GET['use_ajuste'] != 0)) {
                                    $ajustes = $bdAjuste->getAjusteByNiveauIdById($niveauId, $_GET['use_ajuste']);
                                } else {
                                    $ajustes = $bdAjuste->getAjusteByNiveauId($niveauId);
                                }
                            }



                            foreach ($ajustes as $ajuste) {
                                $n++;
                            ?>
                                <tr>
                                    <td>
                                        <?php

                                        $traiteId = 0;

                                        $bdTraite = new Traite();
                                        $traites = $bdTraite->getTraiteByAjusteId($ajuste['afId']);
                                        foreach ($traites as $traite) {
                                            $traiteId = $traite['tfId'];
                                        }

                                        if ($traiteId != 0) {
                                        ?>
                                            <i class="fa fa-check" aria-hidden="true" style="color: forestgreen;"></i>
                                        <?php
                                        }

                                        echo $n;

                                        ?>
                                    </td>
                                    <td><strong style="color:dodgerblue"><?= $ajuste['afDateHeure'] ?></strong></td>

                                    <td><?= $ajuste['soDateHeure'] ?></td>
                                    <td><?= $ajuste['raDateHeure'] ?></td>
                                    <td><?= $ajuste['subject'] ?></td>
                                    <td><?= $ajuste['agIdentite'] ?></td>
                                    <td><?= $ajuste['dateEvent'] ?></td>
                                    <td><?= $ajuste['infHeure'] ?></td>
                                    <td><?= $ajuste['infLieu'] ?></td>
                                    <td><?= $ajuste['prDesignation'] . " / " . $ajuste['ogDesignation'] ?></td>



                                    <td>
                                        <form action="../controllers/feedback/feedbackController.php" method="POST">

                                            <input type="hidden" name="tb_rapportageId" value="<?= $ajuste['raId'] ?>">
                                            <input type="hidden" name="tb_remonteId" value="<?= $ajuste['reId'] ?>">
                                            <input type="hidden" name="tb_projectId" value="<?= $ajuste['prId'] ?>">
                                            <input type="hidden" name="tb_soumissionId" value="<?= $ajuste['soId'] ?>">
                                            <input type="hidden" name="tb_feedbackId" value="<?= $ajuste['feId'] ?>">
                                            <input type="hidden" name="tb_ajusteId" value="<?= $ajuste['afId'] ?>">
                                            <button class="btn btn-primary" name="bt_for_view_information_validation" type="submit"><i class="fa fa-file" aria-hidden="true"></i> View details</button>

                                        </form>
                                    </td>

                                    <td>
                                        <form action="../controllers/feedback/feedbackController.php" method="POST">

                                            <input type="hidden" name="tb_rapportageId" value="<?= $ajuste['raId'] ?>">
                                            <input type="hidden" name="tb_remonteId" value="<?= $ajuste['reId'] ?>">
                                            <input type="hidden" name="tb_projectId" value="<?= $ajuste['prId'] ?>">
                                            <input type="hidden" name="tb_soumissionId" value="<?= $ajuste['soId'] ?>">
                                            <input type="hidden" name="tb_feedbackId" value="<?= $ajuste['feId'] ?>">
                                            <input type="hidden" name="tb_ajusteId" value="<?= $ajuste['afId'] ?>">
                                            <?php

                                            $traiteId = 0;

                                            $bdTraite = new Traite();
                                            $traites = $bdTraite->getTraiteByAjusteId($ajuste['afId']);
                                            foreach ($traites as $traite) {
                                                $traiteId = $traite['tfId'];
                                            }

                                            if ($traiteId == 0) {
                                            ?>
                                                <button class="btn btn-success" name="bt_for_traite" type="submit"><i class="fa fa-check" aria-hidden="true"></i> Post Feedback</button>
                                            <?php
                                            } else {
                                            ?>
                                                <button class="btn btn-secondary" name="bt_for_traite" type="submit">view post</button>
                                            <?php
                                            }
                                            ?>


                                        </form>
                                    </td>

                                </tr>
                            <?php
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