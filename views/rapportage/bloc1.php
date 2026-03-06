<div class="col">
    <div class="m-4 p-4 sectionPanel" style="background-color: whitesmoke;">
        <div>
            <div class="row">

                <div class="col-lg-8">
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
                <div class="col-lg-4 card">
                <p class="h5" class="mt-2">Today:</p><hr>
                <p class="h5" class="mt-2"><?= date('Y-m-d h:i:s') ?></p>
                </div>
            </div>
            <div>
                    <form action="../controllers/rapportage/rapportageController.php" method="POST">
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    <p style="font-weight: 600;">Search report</p>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <select class="form-control select2" name="cb_rapportage">
                                            <option value="0">Choose</option>
                                            <?php
                                            $bdRapportage = new Rapportage();
                                            $rapportages = $bdRapportage->getRapportageByProjectId($projectSelected);
                                            foreach ($rapportages as $rapportage) {
                                            ?>
                                                <option value="<?= $rapportage['raId'] ?>"><?= "Reporting: " . $rapportage['raDateHeure'] . " / Subject: " . $rapportage['subject'] . " / Event: " . $rapportage['dateEvent'] . " / Location: " . $rapportage['infLieu'] . " / Time: " . $rapportage['infHeure'] ?></option>
                                            <?php
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="hidden" name="tb_projectId" value="<?= $projectSelected ?>">
                                        <button class="btn btn-warning" name="bt_search_rapportage" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
        </div>
    </div>
</div>