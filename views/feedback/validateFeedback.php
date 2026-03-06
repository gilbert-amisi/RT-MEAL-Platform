<div class="col">
    
    <div class="m-4 p-4 sectionPanel">
        <div>
            <i style="color: forestgreen;" class="fa fa-check" aria-hidden="true"></i> Feedback Validation
            <hr>
        </div>
        <div>
            <div class="row">
                
                <div class="col">
                    <table class="table table-bordered">
                        <thead>
                            <th>#</th>
                            <th>Feedback</th>
                            <th>Author</th>
                            <th>Author Level</th>
                            <th>Submission</th>
                            <th>Reporting</th>
                            <th>Event Date</th>
                            <th>Event Time</th>
                            <th>Location</th>
                            <th>Sensibility</th>
                            <th>Project</th>
                        
                        </thead>
                        <tbody>
                            <?php

                            $levelSensibilite=0;
                            $bdPointfocal=new Pointfocal();
                            $pointfocals=$bdPointfocal->getPointfocalActiveByCompteId($_SESSION['compteId']);
                            foreach ($pointfocals as $pointfocal) {
                                $levelSensibilite=$pointfocal['levelSensibilite'];
                                $projectId=$pointfocal['prId'];
                            }

                            $n = 0;
                            $bdFeedback = new Feedback();
                            if ($_SESSION['typeCompte']=="Partner") {
                                $feedbacks = $bdFeedback->getFeedbackByLevelSensibiliteInfByProjectId($levelSensibilite,$projectId);
                            } else {
                                $feedbacks = $bdFeedback->getFeedbackById($_GET['use_feedback']);
                            }
                            
                            $donneeFeedback=0;
                            foreach ($feedbacks as $feedback) {
                                $n++;
                                $donneeFeedback=$feedback['dofeValeur'];
                                $rapportageSelected=$feedback['raId'];
                                $remonteSelected=$feedback['reId'];
                                $projectSelected=$feedback['prId'];
                                $soumissionSelected=$feedback['soId'];
                            ?>
                                <tr>
                                    <td><?= $n ?></td>
                                    <td><strong style="color:dodgerblue"><?= $feedback['feDateHeure'] ?></strong></td>
                                    <td><?= $feedback['pfIdentite'] ?></td>
                                    <td><?= $feedback['pfseLevelSensibilite'] ?></td>
                                    <td><?= $feedback['soDateHeure'] ?></td>
                                    <td><?= $feedback['raDateHeure'] ?></td>
                                    <td><?= $feedback['dateEvent'] ?></td>
                                    <td><?= $feedback['infHeure'] ?></td>
                                    <td><?= $feedback['infLieu'] ?></td>
                                    <td><?= "Level: ".$feedback['levelSensibilite']." / ".$feedback['seDesignation'] ?></td>
                                    <td><?= $feedback['prDesignation']." / ".$feedback['ogDesignation'] ?></td>
                                    
                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                    
                </div>
            
        </div>
        <div class="row">
            <?php
                include 'validateForm.php';
            ?>
        </div>
        
</div>
    
</div>