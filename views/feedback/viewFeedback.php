<div class="col">
    <div class="m-4 p-4 sectionPanel">
        <div>
            <i style="color: dodgerblue;" class="fas fa-file" aria-hidden="true"></i> Feedback List
            <hr>
        </div>
        <div>
            <div class="row">

                <div class="col">
                    <table class="table table-bordered">
                        <thead>
                            <th>#</th>
                            <th>Feedback</th>
                            <th>Author</th>
                            <th>Author Level</th>
                            <th>Submission</th>
                            <th>Reporting</th>
                            <th>Event Date</th>
                            <th>Event Time</th>
                            <th>Location</th>
                            <th>Sensibility</th>
                            <th>Project</th>

                            <th></th>
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
                            $bdFeedback = new Feedback();
                            if ($_SESSION['typeCompte'] == "Partner") {
                                $feedbacks = $bdFeedback->getFeedbackByLevelSensibiliteInfByProjectId($levelSensibilite, $projectId);
                            } else {
                                $feedbacks = $bdFeedback->getFeedbackAll();
                            }

                            foreach ($feedbacks as $feedback) {
                                $n++;
                            ?>
                                <tr>
                                    <td><?php
                                        $bdAjuste = new Ajuste();
                                        $ajusteId = 0;
                                        $ajustes = $bdAjuste->getAjusteByFeedbackId($feedback['feId']);
                                        foreach ($ajustes as $ajuste) {
                                            $ajusteId = $ajuste['afId'];
                                        }

                                        if ($ajusteId != 0) {
                                        ?>
                                            <i style="color: forestgreen;" class="fa fa-check" aria-hidden="true"></i>
                                        <?php
                                        }
                                        echo $n
                                        ?>
                                    </td>
                                    <td><strong style="color:dodgerblue"><?= $feedback['feDateHeure'] ?></strong></td>
                                    <td><?= $feedback['pfIdentite'] ?></td>
                                    <td><?= $feedback['pfseLevelSensibilite'] ?></td>
                                    <td><?= $feedback['soDateHeure'] ?></td>
                                    <td><?= $feedback['raDateHeure'] ?></td>
                                    <td><?= $feedback['dateEvent'] ?></td>
                                    <td><?= $feedback['infHeure'] ?></td>
                                    <td><?= $feedback['infLieu'] ?></td>
                                    <td><?= "Level: " . $feedback['levelSensibilite'] . " / " . $feedback['seDesignation'] ?></td>
                                    <td><?= $feedback['prDesignation'] . " / " . $feedback['ogDesignation'] ?></td>

                                    <td>
                                        <form action="../controllers/feedback/feedbackController.php" method="POST">

                                            <input type="hidden" name="tb_rapportageId" value="<?= $feedback['raId'] ?>">
                                            <input type="hidden" name="tb_remonteId" value="<?= $feedback['reId'] ?>">
                                            <input type="hidden" name="tb_projectId" value="<?= $feedback['prId'] ?>">
                                            <input type="hidden" name="tb_soumissionId" value="<?= $feedback['soId'] ?>">
                                            <input type="hidden" name="tb_feedbackId" value="<?= $feedback['feId'] ?>">
                                            <button class="btn btn-primary" name="bt_for_view_information_feedback" type="submit"><i class="fa fa-file" aria-hidden="true"></i> View details</button>

                                        </form>
                                    </td>
                                    <td>
                                        <?php
                                        if ($_SESSION['typeCompte'] == "Partner") {
                                            if ($feedback['needFeedback'] == 'yes') {
                                        ?>
                                                <form action="../controllers/feedback/feedbackController.php" method="POST">

                                                    <input type="hidden" name="tb_rapportageId" value="<?= $feedback['raId'] ?>">
                                                    <input type="hidden" name="tb_remonteId" value="<?= $feedback['reId'] ?>">
                                                    <input type="hidden" name="tb_projectId" value="<?= $feedback['prId'] ?>">
                                                    <input type="hidden" name="tb_soumissionId" value="<?= $feedback['soId'] ?>">
                                                    <input type="hidden" name="tb_feedbackId" value="<?= $feedback['feId'] ?>">
                                                    <button class="btn btn-success" name="bt_for_add" type="submit">Add Feedback</button>

                                                </form>
                                            <?php
                                            } else if ($feedback['needFeedback'] == 'no') {
                                            ?>
                                                <p>No feedback needed</p>
                                            <?php
                                            }
                                        } else {
                                            if (1) {
                                                $bdAjuste = new Ajuste();
                                                $ajusteId = 0;
                                                $ajustes = $bdAjuste->getAjusteByFeedbackId($feedback['feId']);
                                                foreach ($ajustes as $ajuste) {
                                                    $ajusteId = $ajuste['afId'];
                                                }

                                                if ($ajusteId == 0) {
                                                }
                                            ?>
                                                <form action="../controllers/feedback/feedbackController.php" method="POST">

                                                    <input type="hidden" name="tb_rapportageId" value="<?= $feedback['raId'] ?>">
                                                    <input type="hidden" name="tb_remonteId" value="<?= $feedback['reId'] ?>">
                                                    <input type="hidden" name="tb_projectId" value="<?= $feedback['prId'] ?>">
                                                    <input type="hidden" name="tb_soumissionId" value="<?= $feedback['soId'] ?>">
                                                    <input type="hidden" name="tb_feedbackId" value="<?= $feedback['feId'] ?>">
                                                    <?php

                                                    $bdAjuste = new Ajuste();
                                                    $ajusteId = 0;
                                                    $ajustes = $bdAjuste->getAjusteByFeedbackId($feedback['feId']);
                                                    foreach ($ajustes as $ajuste) {
                                                        $ajusteId = $ajuste['afId'];
                                                    }

                                                    if ($ajusteId == 0) {
                                                    ?>
                                                        <button class="btn btn-success" name="bt_for_validate" type="submit">Validate</button>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <button class="btn btn-secondary" name="bt_for_validate" type="submit">View validation</button>
                                                    <?php
                                                    }

                                                    ?>


                                                </form>
                                            <?php
                                            } else if ($feedback['needFeedback'] == 'no') {
                                            ?>
                                                <p>No feedback needed</p>
                                        <?php
                                            }
                                        }

                                        ?>

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