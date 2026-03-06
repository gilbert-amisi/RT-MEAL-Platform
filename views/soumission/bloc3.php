<div class="col">
        <div class="m-4 p-4 sectionPanel">
            <div>
                <i style="color: red;" class="fas fa-list" aria-hidden="true"></i> Reporting List
                <hr>
            </div>
            <div>
                <div class="row">
                    
                    <div class="col-lg-12">
                        <table class="table table-bordered">
                            <thead>
                                <th>#</th>
                                <th>Reporting</th>
                                <th>Event Date</th>
                                <th>Event Time</th>
                                <th>Location</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </thead>
                            <tbody>
                                <?php
                                $n = 0;
                                $bdRapportage = new Rapportage();
                                $rapportages = $bdRapportage->getRapportageByProjectId($projectSelected);
                                foreach ($rapportages as $rapportage) {
                                    $n++;
                                ?>
                                    <tr>
                                        <td><?= $n ?></td>
                                        <td><?= $rapportage['raDateHeure'] ?></td>
                                        <td><?= $rapportage['dateEvent'] ?></td>
                                        <td><?= $rapportage['infHeure'] ?></td>
                                        <td><?= $rapportage['infLieu'] ?></td>
                                        
                                        
                                        <td>
                                            <form action="../controllers/rapportage/rapportageController.php" method="POST">

                                                <input type="hidden" name="tb_rapportageId" value="<?= $rapportage['raId'] ?>">
                                                <input type="hidden" name="tb_projectId" value="<?= $projectSelected ?>">
                                                <button class="btn btn-primary" name="bt_for_view" type="submit"><i class="fa fa-file" aria-hidden="true"></i></button>

                                            </form>
                                        </td>
                                        <td>
                                            <form action="../controllers/rapportage/rapportageController.php" method="POST">

                                                <input type="hidden" name="tb_rapportageId" value="<?= $rapportage['raId'] ?>">
                                                <input type="hidden" name="tb_projectId" value="<?= $projectSelected ?>">
                                                <button class="btn btn-warning" name="bt_for_triangulation" type="submit"><i class="fa fa-plus" aria-hidden="true"></i></button>

                                            </form>
                                        </td>
                                        <td>
                                            <form action="../controllers/rapportage/rapportageController.php" method="POST">

                                                <input type="hidden" name="tb_rapportageId" value="<?= $rapportage['raId'] ?>">
                                                <button class="btn btn-danger" name="bt_delete" type="submit"><i class="fas fa-trash" aria-hidden="true"></i></button>

                                            </form>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
    </div>