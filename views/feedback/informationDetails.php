<div class="m-4 p-4 sectionPanel">
    <div class="h5">
        <i style="color: dodgerblue;" class="fas fa-file" aria-hidden="true"></i> Report Details
        <hr>
    </div>
    <div>
        <?php

            $levelSensibilite=0;
            $bdPointfocal=new Pointfocal();
            $pointfocals=$bdPointfocal->getPointfocalActiveByCompteId($_SESSION['compteId']);
            foreach ($pointfocals as $pointfocal) {
                $levelSensibilite=$pointfocal['levelSensibilite'];
                $projectId=$pointfocal['prId'];
            }

            $n = 0;
            $bdSoumission = new Soumission();
            $soumissions = $bdSoumission->getSoumissionByLevelSensibiliteInfByProjectIdById($levelSensibilite,$projectId,$_GET['use_soumission']);
            foreach ($soumissions as $soumission) {
                $n++;
                $donneeSoumission=$soumission['dosValeur'];
                $rapportageSelected=$soumission['raId'];
                $remonteSelected=$soumission['reId'];
                $projectSelected=$soumission['prId'];
        ?>
        <div class="card m-4 p-4">
            <div class="row" style="background-color:#E1F4FF;">
                <h6 class="col"><i style="color: blue;" class="fas fa-file" aria-hidden="true"></i> Subject : <?=$soumission['subject'] ?></h6>   
                <h6 class="col"><i style="color: blue;" class="fas fa-folder" aria-hidden="true"></i> Project : <?= $soumission['prDesignation']." / ".$soumission['ogDesignation'] ?></h6>
                <h6 class="col"><i style="color: teal;" class="fas fa-map-marker" aria-hidden="true"></i> Location : <?=$soumission['infLieu'] ?></h6>
                <h6 class="col"><i style="color: #4C708C;" class="fas fa-reply" aria-hidden="true"></i> Need of feedback ? : <?=$soumission['needFeedback'] ?></h6>    
            </div><hr>
            <p><?= $donneeSoumission ?></p>
            <table class="table table-bordered table-striped">
                <thead>
                    <th>Event Date</th>
                    <th>Event Time</th>
                    <th>Submitted on</th>
                    <th>Reported on</th>
                    <th>Sensibility</th>  
                </thead>
                <tbody>
                    <!--  -->
                    <tr>
                        <td><?= $soumission['dateEvent'] ?></td>
                        <td><?= $soumission['infHeure'] ?></td>
                        <td><?= $soumission['soDateHeure'] ?></td>
                        <td><?= $soumission['raDateHeure'] ?></td>
                        <td><?= "Level: ".$soumission['levelSensibilite']." / ".$soumission['seDesignation'] ?></td>       
                    </tr>
                </tbody>
            </table>
        </div>
        <?php
            }
        ?>
        <div class="row">
            
            <div class="col-lg-8">
                    
                    
            </div>
            
        </div>
        
    </div>
</div>