<div class="col">
    <div class="m-4 p-4 sectionPanel">
        <div class="h5">
            <i style="color: dodgerblue;" class="fa fa-pen" aria-hidden="true"></i> Report Edit
            <hr>
        </div>
        <div>

            <?php

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

            if (!(isset($_GET['use_remonte']))) {
            ?>
                <form action="../controllers/information/informationController.php" method="POST">

                    <hr>
                    <div>

                        <?php


                        $bdRemonte = new Remonte();

                        $remontes = $bdRemonte->getRemonteByRapportageIdMaxSelf($rapportageSelected);
                        foreach ($remontes as $remonte) {
                            $recentRemonteId = $remonte['recentId'];
                        }

                        $donneeRemonteRecent = "";
                        $sensibiliteId = "";
                        $subject="";
                        $remontes = $bdRemonte->getRemonteById($recentRemonteId);
                        foreach ($remontes as $remonte) {
                            $remonteId = $remonte['reId'];
                            $dateHeureRemonte = $remonte['reDateHeure'];
                            $donneeRemonte = $remonte['dorValeur'];
                            $emergencyRemonte = $remonte['emergency'];
                            $trustRemonte = $remonte['trust'];
                            $donneeRemonteRecent = $remonte['dorValeur'];
                            $sensibiliteId = $remonte['seSensibiliteId'];
                            $subject = $remonte['subject'];
                        }

                        if (!(isset($remonteId))) {
                            $donneeRemonte = $eventData;
                        }

                        $remontes = $bdRemonte->getRemonteByRapportageIdDifferentNiveau($rapportageSelected, $niveauId);

                        $remonteIdTest = 0;
                        foreach ($remontes as $remonte) {
                            $remonteIdTest = $remonte['reId'];
                        }

                        if ($remonteIdTest == 0) {
                        ?>
                            <div class="card m-2 p-2">
                                <p class="h6"><strong>Subject: </strong><?= $subject ?></p>
                                <div class="form-group">
                                    <label class="control-label" for="my-select">Data</label>
                                    <textarea class="form-control" name="tb_donnee"><?= $donneeRemonte ?></textarea>
                                </div>
                                <hr>

                                <?php
                                if ($levelNiveauAgent == 1) {
                                ?>
                                    <div class="form-group">
                                        <label class="control-label" for="my-select">Sensibility level</label>
                                        <select class="form-control" name="cb_sensibilite">
                                            <option value="0">Choose</option>
                                            <?php
                                            $bdSensibilite = new Sensibilite();
                                            $sensibilites = $bdSensibilite->getSensibiliteByProjectId($projectSelected);
                                            foreach ($sensibilites as $sensibilite) {
                                            ?>
                                                <option value="<?= $sensibilite['seId'] ?>"><?= "Level: " . $sensibilite['levelSensibilite'] . " / " . $sensibilite['seDesignation'] . " / Emergency: " . $sensibilite['emergency'] . " / Project: " . $sensibilite['prDesignation'] . " / " . $sensibilite['ogDesignation'] ?></option>
                                            <?php
                                            }
                                            ?>

                                        </select>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label class="control-label" for="my-select"><strong style="color:orange;">Trust level </strong></label>
                                        <?php
                                        $bdTriangulation = new Triangulation();
                                        $nTriangulation = 0;
                                        $triangulations = $bdTriangulation->getTriangulationByRapportageId($rapportageSelected);
                                        foreach ($triangulations as $triangulation) {
                                            $nTriangulation++;
                                        }

                                        if ($nTriangulation == 0) {
                                        ?>
                                            <input checked type="radio" name="rb_trust" value="Low"> Low
                                        <?php
                                        } else if (($nTriangulation >= 1) && ($nTriangulation <= 2)) {
                                        ?>
                                            <input checked type="radio" name="rb_trust" value="Medium" checked> Medium
                                        <?php
                                        } else if (($nTriangulation > 2)) {
                                        ?>
                                            <input checked type="radio" name="rb_trust" value="High"> High
                                        <?php
                                        }

                                        ?>


                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="form-group">
                                        <label class="control-label" for="my-select">Sensibility level and emergency</label>
                                        <select class="form-control" name="cb_sensibilite">
                                            <option value="0">Choose</option>
                                            <?php
                                            $bdSensibilite = new Sensibilite();
                                            $sensibilites = $bdSensibilite->getSensibiliteByProjectId($projectSelected);
                                            foreach ($sensibilites as $sensibilite) {
                                            ?>
                                                <option <?php
                                                        if ($sensibiliteId == $sensibilite['seId']) {
                                                            echo 'selected';
                                                        }
                                                        ?> value="<?= $sensibilite['seId'] ?>"><?= "Level: " . $sensibilite['levelSensibilite'] . " / " . $sensibilite['seDesignation'] . " / Emergency: " . $sensibilite['emergency'] . " / Project: " . $sensibilite['prDesignation'] . " / " . $sensibilite['ogDesignation'] ?></option>
                                            <?php
                                            }
                                            ?>

                                        </select>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label class="control-label" for="my-select"><strong style="color:orange;">Trust level </strong></label>
                                        <input type="radio" name="rb_trust" value="Low"> Low </input>
                                        <input type="radio" name="rb_trust" value="Medium"> Medium </input>
                                        <input type="radio" name="rb_trust" value="High" > High </input>
                                    </div>
                                <?php
                                }
                                ?>

                                <hr>
                                <div>
                                    <div class="form-group">
                                        <input type="hidden" name="tb_projectId" value="<?= ($projectSelected) ?>">
                                        <input type="hidden" name="tb_rapportageId" value="<?= ($rapportageSelected) ?>">
                                        <?php
                                        if ($forValidationNiveauAgent != "yes") {
                                        ?>
                                            <button class="btn btn-warning" name="bt_remonte" type="submit"><i class="fa fa-check-circle" aria-hidden="true"></i> Save and Submit to a next level</button>
                                        <?php
                                        }
                                        ?>

                                    </div>
                                </div>
                            <?php
                        } else {
                            ?>

                                <div class="card m-2 p-2">
                                    <label class="h6"> Subject: <?= $subject ?></p> <hr>
                                    <p class="h6"><strong style="color:orange;">Status : <i style="color: dodgerblue;" class="fas fa-check" aria-hidden="true"></i> Already submitted</strong></p>
                                    <p class="h6"><strong style="color:orange;">Date Time: <?= $dateHeureRemonte ?></strong></p>
                                    <hr>
                                    <p class="h6"><strong style="color:gray;">Emergency: <?= $emergencyRemonte ?></strong></p>
                                    <p class="h6"><strong style="color:gray;">Trust Level: <?= $trustRemonte ?></strong></p>
                                    <hr>
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>
                                                <p><strong>Data: </strong></p>
                                                <p><?= $donneeRemonteRecent ?></p>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            <?php
                        }
                            ?>

                            </div>
                </form>
                <?php
            } else {

                $soumissionId = 0;
                $subject="";
                $bdSoumission = new Soumission();
                $soumissions = $bdSoumission->getSoumissionByRemonteId($_GET['use_remonte']);
                foreach ($soumissions as $soumission) {
                    $soumissionId = $soumission['soId'];
                    $dateHeureSoumission = $soumission['soDateHeure'];
                    $donneeSoumission = $soumission['dosValeur'];
                    $emergencySoumission = $soumission['soEmergency'];
                    $trustSoumission = $soumission['soTrust'];
                    $subject = $soumission['subject'];
                }

                if ($soumissionId == 0) {
                ?>
                    <form action="../controllers/soumission/soumissionController.php" method="POST">

                        <hr>
                        <div class="row">

                            <?php


                            $bdRemonte = new Remonte();

                            $remontes = $bdRemonte->getRemonteByRapportageIdMaxSelf($rapportageSelected);
                            foreach ($remontes as $remonte) {
                                $recentRemonteId = $remonte['recentId'];
                            }

                            $sensibiliteId = "";

                            $remontes = $bdRemonte->getRemonteById($_GET['use_remonte']);
                            foreach ($remontes as $remonte) {
                                $remonteId = $remonte['reId'];
                                $dateHeureRemonte = $remonte['reDateHeure'];
                                $donneeRemonte = $remonte['dorValeur'];
                                $emergencyRemonte = $remonte['emergency'];
                                $trustRemonte = $remonte['trust'];
                                $sensibiliteId = $remonte['seSensibiliteId'];
                                $subject = $remonte['subject'];
                            }


                            if (1) {
                            ?>
                                <div class="col-lg-9">
                                <p class="h5"><strong>Subject: </strong><?= $subject ?></p>
                                    <p class="h4">Event details</p>
                                    <div class="form-group">
                                        <label class="control-label" for="my-select">Data</label>
                                        <textarea class="form-control" name="tb_donnee"><?= $donneeRemonte ?></textarea>
                                    </div>
                                    <hr>

                                    <div class="col-lg-9">
                                        <div class="form-group">
                                            <label class="control-label" for="my-select">Sensibility level</label>
                                            <select class="form-control" name="cb_sensibilite">
                                                <option value="0">Choose</option>
                                                <?php
                                                $bdSensibilite = new Sensibilite();
                                                $sensibilites = $bdSensibilite->getSensibiliteByProjectId($projectSelected);
                                                foreach ($sensibilites as $sensibilite) {
                                                ?>
                                                    <option <?php
                                                            if ($sensibiliteId == $sensibilite['seId']) {
                                                                echo "selected style=' color:forestgreen; font-weight:bold;'";
                                                            }
                                                            ?> value="<?= $sensibilite['seId'] ?>"><?= "Level: " . $sensibilite['levelSensibilite'] . " / " . $sensibilite['seDesignation'] . " / Emergency: " . $sensibilite['emergency'] . " / Project: " . $sensibilite['prDesignation'] . " / " . $sensibilite['ogDesignation'] ?></option>
                                                <?php
                                                }
                                                ?>

                                            </select>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label class="control-label" for="my-select"><strong style="color:orange;">Need Feedback? </strong></label>
                                            <input type="radio" name="rb_needFeedback" value="no" checked>No
                                            <input type="radio" name="rb_needFeedback" value="yes">Yes
                                        </div>
                                        <hr>
                                        <?php
                                        if ($levelNiveauAgent == 1) {

                                        ?>

                                            <div class="form-group">
                                                <label class="control-label" for="my-select"><strong style="color:orange;">Trust level </strong></label>
                                                <input type="radio" name="rb_trust" value="Low"> Low
                                                <input type="radio" name="rb_trust" value="Medium" checked> Medium
                                                <input type="radio" name="rb_trust" value="High"> High
                                            </div>
                                        <?php
                                        } else {
                                        ?>

                                            <div class="form-group">
                                                <label class="control-label" for="my-select"><strong style="color:orange;">Trust level: </strong></label>
                                                <input type="radio" name="rb_trust" value="Low" <?php if ($trustRemonte == "Low") {
                                                                                                    echo 'checked';
                                                                                                } ?>> Low
                                                <input type="radio" name="rb_trust" value="Medium" <?php if ($trustRemonte == "Medium") {
                                                                                                        echo 'checked';
                                                                                                    } ?>> Medium
                                                <input type="radio" name="rb_trust" value="High" <?php if ($trustRemonte == "High") {
                                                                                                        echo 'checked';
                                                                                                    } ?>> High
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <hr>
                                        <div class="form-group">
                                            <input type="hidden" name="tb_projectId" value="<?= ($projectSelected) ?>">
                                            <input type="hidden" name="tb_rapportageId" value="<?= ($rapportageSelected) ?>">
                                            <input type="hidden" name="tb_remonteId" value="<?= ($_GET['use_remonte']) ?>">
                                            <button class="btn btn-warning" name="bt_add" type="submit"><i class="fa fa-check-circle" aria-hidden="true"></i> Save and Submit to partner</button>
                                        </div>
                                    </div>
                                <?php
                            }
                                ?>

                                </div>
                    </form>
                <?php
                } else {
                ?>
                    <div class="col-lg-9">
                    <p class="h5"><strong>Subject: </strong><?= $subject ?></p>
                        <p class="h6"><strong style="color:orange;">Already submitted to a partner</strong></p>
                        <p class="h5"><strong style="color:orange;">Date Time: <?= $dateHeureSoumission ?></strong></p>
                        <hr>
                        <p class="h6"><strong style="color:gray;">Emergency: <?= $emergencySoumission ?></strong></p>
                        <p class="h6"><strong style="color:gray;">Trust Level: <?= $trustSoumission ?></strong></p>
                        <hr>
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    <p><strong>Data: </strong></p>
                                    <p><?= $donneeSoumission ?></p>
                                </td>
                            </tr>
                        </table>

                    </div>
                <?php
                }

                ?>

            <?php
            }
            ?>



        </div>

    </div>

</div>