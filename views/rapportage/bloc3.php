<div class="col">
    <div class="m-4 p-4 sectionPanel">
        <div class="h5">
            <i style="color: red;" class="fas fa-list" aria-hidden="true"></i> Your saved reports for this projects
            <hr>
        </div>
        <div>
            <div class="row">

                <div class="col-lg-12">
                    <table class="table table-bordered">
                        <thead>
                            <th>#</th>
                            <th>Subject</th>
                            <th>Reported on</th>
                            <th>Event Date</th>
                            <th>Event Time</th>
                            <th>Location</th>
                            <th>Next level</th>
                            <th>Verify</th>
                        </thead>
                        <tbody>
                            <?php
                            $n = 0;
                            $bdRapportage = new Rapportage();
                            if ((isset($_GET['use_rapportage'])) && ($_GET['use_rapportage'] != 0)) {
                                $rapportages = $bdRapportage->getRapportageByProjectIdById($projectSelected, $_GET['use_rapportage']);
                            } else {
                                $rapportages = $bdRapportage->getRapportageByProjectId($projectSelected);
                            }

                            foreach ($rapportages as $rapportage) {
                                $n++;
                                if ($_SESSION['compteId']==$rapportage['agentId']) {
                                    # code...
                                
                            ?>
                                <tr>
                                    <td><?= $n ?></td>
                                    <td style="color: forestgreen; font-weight: 600;"><?= $rapportage['subject'] ?></td>
                                    <td><?= $rapportage['raDateHeure'] ?></td>
                                    <td><?= $rapportage['dateEvent'] ?></td>
                                    <td><?= $rapportage['infHeure'] ?></td>
                                    <td><?= $rapportage['infLieu'] ?></td>

                                    <td>
                                        <form action="../controllers/rapportage/rapportageController.php" method="POST">

                                            <input type="hidden" name="tb_rapportageId" value="<?= $rapportage['raId'] ?>">
                                            <input type="hidden" name="tb_projectId" value="<?= $projectSelected ?>">
                                            <button class="btn btn-primary" name="bt_for_view" type="submit" title="Save and submit to the next level"><i class="fa fa-file" aria-hidden="true"></i></button>

                                        </form>
                                    </td>
                                    <td>
                                        <form action="../controllers/rapportage/rapportageController.php" method="POST">

                                            <input type="hidden" name="tb_rapportageId" value="<?= $rapportage['raId'] ?>">
                                            <input type="hidden" name="tb_projectId" value="<?= $projectSelected ?>">
                                            <button class="btn btn-warning" name="bt_for_triangulation" type="submit" title="Verify information with the key informant"><i class="fa fa-check" aria-hidden="true"></i></button>

                                        </form>
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
</div>