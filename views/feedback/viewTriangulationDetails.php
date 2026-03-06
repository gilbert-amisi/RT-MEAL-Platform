<div class="col">
        
        <?php
        include 'informationDetails.php';
        ?>

        <div class="m-4 p-4 sectionPanel">
            <div>
                <i style="color: dodgerblue;" class="fas fa-list" aria-hidden="true"></i> Triangulation Details
                <hr>
            </div>
            <div>
                <div class="row">
                    
                    <div class="col-lg-8">
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
                                $bdTriangulation = new Triangulation();
                                $triangulations = $bdTriangulation->getTriangulationByRapportageIdById($rapportageSelected,$_GET['use_triangulation']);
                                foreach ($triangulations as $triangulation) {
                                    $n++;
                                    $donneeTriangulation=$triangulation['doValeur2'];
                                ?>
                                    <tr>
                                        <td><?= $n ?></td>
                                        <td><?= $triangulation['trDateHeure'] ?></td>
                                        <td><?= $triangulation['nvDesignation'] ?></td>
                                        <td><?= "Location: ".$triangulation['kiAdresse']." / Occupation: ".$triangulation['kiProfession']." / Gender: ".$triangulation['kiGenre'] ?></td>
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
                    <div class="col-lg-4">
                        <table class="table table-bordered">
                            <thead>
                                <th>Data</th>
                                
                            </thead>
                            <tbody>
                                
                                    <tr>
                                        <td><?= $donneeTriangulation ?></td>
                                       
                                    </tr>
                                

                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
    </div>