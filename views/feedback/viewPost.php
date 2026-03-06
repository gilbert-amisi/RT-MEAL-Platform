<div class="col">

    <div class="m-4 p-4 sectionPanel">
        <div>
            <i style="color: forestgreen;" class="fa fa-check" aria-hidden="true"></i> Feedback Posted
            <hr>
        </div>
        <div>
            <div class="row" style="background-color: whitesmoke;">
                <div class="col">
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
                                <div class="form-group">
                                    <select class="form-control select2" name="cb_etat">
                                        <option value="all">All category</option>
                                        <option value="Close">Close</option>
                                        <option value="Keep-Open">Keep-Open</option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">

                                    <button class="btn btn-warning" name="bt_search_post_byProjectByEtat" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                </div>
                            </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div class="col">
                    <form action="../controllers/feedback/feedbackController.php" method="POST">
                        <table class="table table-bordered">

                            <td>
                                <p style="font-weight: 600;">Search by Agent</p>
                            </td>

                            <td>
                                <div class="form-group">
                                    <select class="form-control select2" name="cb_agent">
                                        <option value="0">Choose</option>
                                        <?php

                                        $agentId = 0;
                                        $niveauId = 0;
                                        $bdAgent = new Agent();
                                        $agents = $bdAgent->getAgentAll();
                                        foreach ($agents as $agent) {
                                        ?>
                                            <option value="<?= $agent['agId'] ?>"><?= $agent['agIdentite'] . " / Level: " . $agent['levelNiveau'] ?></option>
                                        <?php
                                        }
                                        ?>

                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">

                                    <button class="btn btn-warning" name="bt_search_post_byAgentId" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                </div>
                            </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div class="col">
                    <form action="../controllers/feedback/feedbackController.php" method="POST">
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

                                    <button class="btn btn-warning" name="bt_search_post_byDates" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
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
                            <th>Validation</th>

                            <th>Submission</th>
                            <th>Reporting</th>
                            <th>Subject</th>
                            <th>Reporting Agent</th>
                            <th>Event Date</th>
                            <th>Event Time</th>
                            <th>Location</th>
                            <th>Sensibility</th>
                            <th>Project</th>
                            <th>Feedback Data</th>
                            <th>Post Details</th>

                        </thead>
                        <tbody>
                            <?php

                            $n = 0;
                            $bdFeedback = new Feedback();
                            $bdTraite = new Traite();

                            if ((isset($_GET['use_project']))) {
                                if (($_GET['use_project'] != 0)) {
                                    if (($_GET['use_project'] == "all")) {
                                        $traites = $bdTraite->getTraiteByProjectId($_GET['use_project']);
                                    } else {
                                        $traites = $bdTraite->getTraiteByProjectIdByEtat($_GET['use_project'], $_GET['use_etat']);
                                    }
                                } else {
                                    if (($_GET['use_project'] != "all")) {
                                        $traites = $bdTraite->getTraiteByEtat($_GET['use_etat']);
                                    } else {
                                        $traites = $bdTraite->getTraiteAll();
                                    }
                                }
                            } else {
                                $traites = $bdTraite->getTraiteAll();
                            }

                            if ((isset($_GET['use_agent']))) {
                                $traites = $bdTraite->getTraiteByAgentId($_GET['use_agent']);
                            } else {
                                $traites = $bdTraite->getTraiteAll();
                            }

                            if (isset($_GET['use_date1'])) {
                                if (($_GET['use_date1'] != "") && ($_GET['use_date2'])) {
                                }
                            }


                            $donneeFeedback = 0;
                            foreach ($traites as $traite) {
                                $justDate = dateTimeFrenchItem($traite['tfDateHeure'], 0);
                                if ((((!(isset($_GET['use_date1']))) || (($_GET['use_date1'] != "") && ($_GET['use_date2'] != "") && ($justDate >= $_GET['use_date1']) && ($justDate <= $_GET['use_date2']))))) {
                                    $n++;
                                    $donneeFeedback = $traite['dofeValeur'];
                                    $rapportageSelected = $traite['raId'];
                                    $remonteSelected = $traite['reId'];
                                    $projectSelected = $traite['prId'];
                                    $soumissionSelected = $traite['soId'];
                                    $traiteId = $traite['tfId'];
                                    $traiteDateHeure = $traite['tfDateHeure'];
                                    $traiteCommentaire = $traite['tfCommentaire'];
                                    $traiteEtat = $traite['tfEtat'];
                                    $traiteAgent = $traite['agtfIdentite'];
                            ?>
                                    <tr>
                                        <td><?= $n ?></td>
                                        <td><strong style="color:dodgerblue"><?= $traite['afDateHeure'] ?></strong></td>

                                        <td><?= $traite['soDateHeure'] ?></td>
                                        <td><?= $traite['raDateHeure'] ?></td>
                                        <td><?= $traite['subject'] ?></td>
                                        <td><?= $traite['agIdentite'] ?></td>
                                        <td><?= $traite['dateEvent'] ?></td>
                                        <td><?= $traite['infHeure'] ?></td>
                                        <td><?= $traite['infLieu'] ?></td>
                                        <td><?= "Level: " . $traite['levelSensibilite'] . " / " . $traite['seDesignation'] ?></td>
                                        <td><?= $traite['prDesignation'] . " / " . $traite['ogDesignation'] ?></td>
                                        <td><?= $traite['doafValeur'] ?></td>
                                        <td>
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td>
                                                        <p><strong>Date Time: </strong><?= $traiteDateHeure ?></p>
                                                    </td>
                                                    <td>
                                                        <p><strong>Agent: </strong><?= $traiteAgent ?></p>
                                                    </td>
                                                    <td>
                                                        <p><strong>Comment: </strong><?= $traiteCommentaire ?></p>
                                                    </td>
                                                    <td>
                                                        <p><strong>Situation: </strong><?= $traiteEtat ?></p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>

                        </tbody>
                    </table>

                </div>

            </div>

        </div>

    </div>