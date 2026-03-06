<div class="col">
        <div class="m-4 p-4 sectionPanel">
            <div>
                <i style="color: dodgerblue;" class="fas fa-file" aria-hidden="true"></i> Feedback Details
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

                                    $projectId=0;
                                    $levelSensibilite=0;
                                    $bdPointfocal=new Pointfocal();
                                    $pointfocals=$bdPointfocal->getPointfocalActiveByCompteId($_SESSION['compteId']);
                                    foreach ($pointfocals as $pointfocal) {
                                        $levelSensibilite=$pointfocal['levelSensibilite'];
                                        $projectId=$pointfocal['prId'];
                                    }

                                    $n = 0;
                                    $donneeFeedback=0;
                                    $bdFeedback = new Feedback();
                                    if ($_SESSION['typeCompte']=="Partner") {
                                        $feedbacks = $bdFeedback->getFeedbackByLevelSensibiliteInfByProjectIdById($levelSensibilite,$projectId,$_GET['use_feedback']);
                                    } else {
                                        $feedbacks = $bdFeedback->getFeedbackById($_GET['use_feedback']);
                                    }
                                    $donneeRemonte="";
                                    foreach ($feedbacks as $feedback) {
                                        $n++;
                                        $donneeFeedback=$feedback['dofeValeur'];
                                        $donneeSoumission=$feedback['dosValeur'];
                                        $donneeRemonte=$feedback['dorValeur'];
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
                            <table class="table table-bordered">
                                <tr>
                                    
                                    <td>
                                        <p><strong style="color:orange;">Report Data: </strong></p>
                                        <p><?= $donneeSoumission ?></p>
                                    </td>
                                    <td>
                                        <p><strong style="color:dodgerblue;">Feedback Data: </strong></p>
                                        <p><?= $donneeFeedback ?></p>
                                    </td>
                                </tr>
                            </table>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>