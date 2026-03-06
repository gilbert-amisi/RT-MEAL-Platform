<div class="col">
        <div class="m-4 p-4 sectionPanel">
            <div>
                <div class="row">
                    
                    <div>
                        <div>
                            <?php
                                $projectSelected=0;
                                $bdProject=new Project();
                                $projects=$bdProject->getProjectAllActive();
                                foreach ($projects as $project) {
                                    if ($_GET['use_project']==sha1($project['prId'])) {
                                        $projectSelected=$project['prId'];
                                    }
                                }

                                $projects=$bdProject->getProjectActiveById($projectSelected);
                                foreach ($projects as $project) {
                                    ?>
                                        <div class="card" style="border-left: solid <?= $project['ogColor'] ?> 8px;">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-10" >
                                                        <p class="h4"><?= $project['ogDesignation'] ?></p>
                                                        
                                                        <p class="h6" class="mt-2"><strong>Project : <?= $project['prDesignation'] ?></strong></p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                }
                            ?>
                            
                        </div>
                    </div> <hr>
                    <div class="card">
                        <div class="h5">
                            <i style="color: dodgerblue;" class="fas fa-file" aria-hidden="true"></i> Original data
                            <hr>
                        </div>
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
                                $rapportageId=$_GET['use_rapportage'];
                                $bdRapportage = new Rapportage();
                                $rapportages = $bdRapportage->getRapportageByProjectIdById($projectSelected,$rapportageId);
                                foreach ($rapportages as $rapportage) {
                                    $eventData=$rapportage['valeur'];
                                    $rapportageSelected=$rapportage['raId'];
                                    $n++;
                                ?>
                                <label class="h6">Subject : <?= $rapportage['subject'] ?></label> <hr>
                                <p><?= $eventData ?></p>
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
                    </div>
                </div>

                <hr>
                <div class="row">
                    <div class="col">
                        <p class="h6"><i style="color: dodgerblue;" class="fas fa-filter" aria-hidden="true"></i> Triangulations data</p>
                        <table class="table table-bordered">
                            <thead>
                                <th>#</th>
                                <th>Triangulation</th>
                                <th>Level</th>
                                <th>Key informant</th>
                                <th>Event Date</th>
                                <th>Event Time</th>
                                <th>Location</th>
                                <th>Data</th>
                            </thead>
                            <tbody>
                                <?php
                                $n = 0;
                                $bdTriangulation = new Triangulation();
                                $triangulations = $bdTriangulation->getTriangulationByRapportageId($rapportageSelected);
                                foreach ($triangulations as $triangulation) {
                                    $n++;
                                ?>
                                    <tr>
                                        <td><?= $n ?></td>
                                        <td><?= $triangulation['trDateHeure'] ?></td>
                                        <td><?= $triangulation['nvDesignation'] ?></td>
                                        <td><?= "Location: ".$triangulation['kiAdresse']." / Occupation: ".$triangulation['kiProfession']." / Gender: ".$triangulation['kiGenre'] ?></td>
                                        <td><?= $triangulation['dateEvent2'] ?></td>
                                        <td><?= $triangulation['infHeure2'] ?></td>
                                        <td><?= $triangulation['infLieu2'] ?></td>
                                        
                                        <td>
                                            <p><?= $triangulation['doValeur2'] ?></p>
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