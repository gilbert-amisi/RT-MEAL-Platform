<div class="col">
    <div class="m-4 p-4 sectionPanel" style="background-color: whitesmoke;">
        <div>
            <i style="color: dodgerblue;" class="fas fa-file" aria-hidden="true"></i> Organisation / Project / Event
            <hr>
        </div>
        <div>
            <div class="row">

                <div class="col-lg-3">
                    <div>
                        <?php
                        $projectSelected = 0;
                        $bdProject = new Project();
                        $projects = $bdProject->getProjectAllActive();
                        foreach ($projects as $project) {
                            if ($_GET['use_project'] == sha1($project['prId'])) {
                                $projectSelected = $project['prId'];
                            }
                        }

                        $projects = $bdProject->getProjectActiveById($projectSelected);
                        foreach ($projects as $project) {
                        ?>
                            <div class="card" style="border-left: solid <?= $project['ogColor'] ?> 8px;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <p class="h4"><?= $project['ogDesignation'] ?></p>

                                            <p class="h6" class="mt-2"><strong><?= $project['prDesignation'] ?></strong></p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                    </div>
                </div>
                <div class="col-lg-5">
                    <table class="table table-bordered">
                        <thead>
                            <th>Reporting</th>
                            <th>Event Date</th>
                            <th>Event Time</th>
                            <th>Location</th>
                        </thead>
                        <tbody>
                            <?php
                            $n = 0;
                            $rapportageId = $_GET['use_rapportage'];
                            $bdRapportage = new Rapportage();
                            $rapportages = $bdRapportage->getRapportageByProjectIdById($projectSelected, $rapportageId);
                            foreach ($rapportages as $rapportage) {
                                $eventData = $rapportage['valeur'];
                                $rapportageSelected = $rapportage['raId'];
                                $n++;
                            ?>
                                <tr>
                                    <td><?= $rapportage['raDateHeure'] ?></td>
                                    <td><?= $rapportage['dateEvent'] ?></td>
                                    <td><?= $rapportage['infHeure'] ?></td>
                                    <td><?= $rapportage['infLieu'] ?></td>


                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>

                    </table>
                    <table class="table table-bordered">

                        <tr>
                            <td><strong>Data: </strong><?= $eventData ?></td>
                        </tr>


                    </table>
                </div>
                <div class="col-lg-4">
                    <form action="../controllers/triangulation/triangulationController.php" method="POST">
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    <p style="font-weight: 600;">Search triangulation</p>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <select class="form-control select2" name="cb_triangulation">
                                            <option value="0">Choose</option>
                                            <?php
                                            $bdTriangulation = new Triangulation();
                                            $triangulations = $bdTriangulation->getTriangulationByRapportageId($rapportageSelected);
                                            foreach ($triangulations as $triangulation) {
                                            ?>
                                                <option value="<?= $triangulation['trId'] ?>"><?= "Triangulation: " . $triangulation['trDateHeure'] . " / Subject: " . $triangulation['subject'] . " / Source: " . $triangulation['kiAdresse'] . " / Occupation: " . $triangulation['kiProfession'] . " / Gender: " . $triangulation['kiGenre'] ?></option>
                                            <?php
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="hidden" name="tb_projectId" value="<?= $projectSelected ?>">
                                        <input type="hidden" name="tb_rapportageId" value="<?= $_GET['use_rapportage'] ?>">
                                        <button class="btn btn-warning" name="bt_search_triangulation" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>

            </div>

        </div>
    </div>
</div>