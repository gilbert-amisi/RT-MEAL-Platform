<div class="col">
    <div class="m-4 p-4 sectionPanel">
        <div>
            <i style="color: dodgerblue;" class="fas fa-file" aria-hidden="true"></i> Tringulation Details
            <hr>
        </div>
        <div>
            <div class="row">

                <div class="col">
                    <table class="table table-bordered">
                        <thead>
                            <th>#</th>
                            <th>Triangulation</th>
                            <th>Level</th>
                            <th>Key informant</th>
                            <th>Event Date</th>
                            <th>Event Time</th>
                            <th>Location</th>
                        </thead>
                        <tbody>
                            <?php
                            $n = 0;
                            $donneeTriangulation = "";
                            $donneeId = 0;
                            $agentTriangulation = 0;
                            $bdTriangulation = new Triangulation();
                            $triangulations = $bdTriangulation->getTriangulationByRapportageIdById($rapportageSelected, $_GET['use_triangulation']);
                            foreach ($triangulations as $triangulation) {
                                $donneeTriangulation = $triangulation['doValeur2'];
                                $agentTriangulation = $triangulation['tragId'];
                                $donneeId = $triangulation['doId2'];
                                $n++;
                            ?>
                                <tr>
                                    <td><?= $n ?></td>
                                    <td><?= $triangulation['trDateHeure'] ?></td>
                                    <td><?= $triangulation['nvDesignation'] ?></td>
                                    <td><?= "Location: " . $triangulation['kiAdresse'] . " / Occupation: " . $triangulation['kiProfession'] . " / Gender: " . $triangulation['kiGenre'] ?></td>
                                    <td><?= $triangulation['dateEvent2'] ?></td>
                                    <td><?= $triangulation['infHeure2'] ?></td>
                                    <td><?= $triangulation['infLieu2'] ?></td>

                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>

                </div>
            </div>
            <div class="row">
                <div class="col">
                    <table>
                        <tr>
                            <td>
                                <form action="../controllers/triangulation/triangulationController.php" method="POST">
                                    <p><strong>Data: </strong></p>
                                    <textarea class="form-control" name="tb_donnee"><?= $donneeTriangulation ?></textarea>
                                    <hr>
                                    <input type="hidden" name="tb_donneeId" value="<?= $donneeId ?>">
                                    <input type="hidden" name="tb_rapportageId" value="<?= $_GET['use_rapportage'] ?>">
                                    <input type="hidden" name="tb_projectId" value="<?= $projectSelected ?>">
                                    <input type="hidden" name="tb_triangulationId" value="<?= $_GET['use_triangulation'] ?>">
                                    <?php
                                    $agentId = 0;
                                    $niveauId = 0;
                                    $bdAgent = new Agent();
                                    $agents = $bdAgent->getAgentActiveByCompteId($_SESSION['compteId']);
                                    foreach ($agents as $agent) {
                                        $agentId = $agent['agId'];
                                        $niveauId = $agent['nvId'];
                                    }

                                    if ($agentId == $agentTriangulation) {
                                    ?>
                                        <button class="btn btn-primary" name="bt_edit_donnee_triangulation" type="submit">Save</button>
                                    <?php
                                    } else {
                                    ?>
                                        <p style="color: orange;"><strong>Unable to Edit</strong></p>
                                    <?php
                                    }

                                    ?>


                                </form>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>