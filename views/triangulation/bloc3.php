<div class="col">
    <div class="m-4 p-4 sectionPanel">
        <div>
            <i style="color: dodgerblue;" class="fas fa-list" aria-hidden="true"></i> Tringulation List
            <hr>
        </div>
        <div>
            <div class="row">

                <div class="col-lg-12">
                    <table class="table table-bordered">
                        <thead>
                            <th>#</th>
                            <th>Triangulation</th>
                            <th>Agent</th>
                            <th>Level</th>
                            <th>Key informant</th>
                            <th>Event Date</th>
                            <th>Event Time</th>
                            <th>Location</th>
                            <th></th>
                        </thead>
                        <tbody>
                            <?php
                            $n = 0;
                            $bdTriangulation = new Triangulation();

                            if ((isset($_GET['use_triangulation'])) && ($_GET['use_triangulation']!=0)) {
                                $triangulations = $bdTriangulation->getTriangulationByRapportageIdById($rapportageSelected,$_GET['use_triangulation']);
                            } else {
                                $triangulations = $bdTriangulation->getTriangulationByRapportageId($rapportageSelected);
                            }


                            foreach ($triangulations as $triangulation) {
                                $n++;
                            ?>
                                <tr>
                                    <td><?= $n ?></td>
                                    <td><?= $triangulation['trDateHeure'] ?></td>
                                    <td><p style="font-weight: 600;"><?= $triangulation['tragIdentite'] ?></p></td>
                                    <td><?= $triangulation['nvDesignation'] ?></td>
                                    <td><?= "Location: " . $triangulation['kiAdresse'] . " / Occupation: " . $triangulation['kiProfession'] . " / Gender: " . $triangulation['kiGenre'] ?></td>
                                    <td><?= $triangulation['dateEvent2'] ?></td>
                                    <td><?= $triangulation['infHeure2'] ?></td>
                                    <td><?= $triangulation['infLieu2'] ?></td>


                                    <td>
                                        <form action="../controllers/triangulation/triangulationController.php" method="POST">

                                            <input type="hidden" name="tb_rapportageId" value="<?= $rapportageSelected ?>">
                                            <input type="hidden" name="tb_projectId" value="<?= $projectSelected ?>">
                                            <input type="hidden" name="tb_triangulationId" value="<?= $triangulation['trId'] ?>">
                                            <button class="btn btn-primary" name="bt_for_view" type="submit"><i class="fa fa-file" aria-hidden="true"></i></button>

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