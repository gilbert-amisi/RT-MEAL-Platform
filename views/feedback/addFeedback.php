<div class="m-4 p-4 sectionPanel">
    <div class="h5">
        <i style="color: red;" class="fa fa-list" aria-hidden="true"></i> Feedback to submitted report
        <hr>
    </div>
    <div class="row">
        <div class="card m-2 p-2 col">
            <?php

                $levelSensibilite=0;
                $projectId=0;
                $pointfocalId=0;
                $bdPointfocal=new Pointfocal();
                $pointfocals=$bdPointfocal->getPointfocalActiveByCompteId($_SESSION['compteId']);
                foreach ($pointfocals as $pointfocal) {
                    $levelSensibilite=$pointfocal['levelSensibilite'];
                    $projectId=$pointfocal['prId'];
                    $pointfocalId=$pointfocal['pfId'];
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
                    $soumissionSelected=$soumission['soId'];
                    }
                ?>
            <div class="h5">
                <i style="color: red;" class="fa fa-inbox" aria-hidden="true"></i> Report data
                <hr>
            </div>
            <div class="h6 row">
                <label class="col"> Subject : <?= $soumission['subject'] ?></label>
                <label class="col"> Project : <?= $soumission['prDesignation']." / ".$soumission['ogDesignation'] ?></label>
            </div> <hr>
            <p>
                <?= $donneeSoumission ?>
            </p>
            <table class="table table-bordered table-condensed table-striped">
                    <thead>
                        <th>Need of Feedback</th>
                        <th>Submitted on</th>
                        <th>Reported on</th>
                        <th>Event Date</th>
                        <th>Location</th>
                        <th>Sensibility</th>   
                    </thead>
                    <tbody>
                        <?php

                        $levelSensibilite=0;
                        $projectId=0;
                        $pointfocalId=0;
                        $bdPointfocal=new Pointfocal();
                        $pointfocals=$bdPointfocal->getPointfocalActiveByCompteId($_SESSION['compteId']);
                        foreach ($pointfocals as $pointfocal) {
                            $levelSensibilite=$pointfocal['levelSensibilite'];
                            $projectId=$pointfocal['prId'];
                            $pointfocalId=$pointfocal['pfId'];
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
                            $soumissionSelected=$soumission['soId'];

                        ?>
                            <tr>
                                <td><strong style="color:dodgerblue"><?= $soumission['needFeedback'] ?></strong></td>
                                <td><?= $soumission['soDateHeure'] ?></td>
                                <td><?= $soumission['raDateHeure'] ?></td>
                                <td><?= $soumission['dateEvent'] ?> at <?= $soumission['infHeure'] ?></td>
                                <td><?= $soumission['infLieu'] ?></td>
                                <td><?= "Level: ".$soumission['levelSensibilite']." / ".$soumission['seDesignation'] ?></td> 
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
        </div>
        <div class="card m-2 p-2 col-6">
            <div class="h5">
                <i style="color: red;" class="fa fa-reply" aria-hidden="true"></i> Give feedback
                <hr>
            </div>
            <?php
                include 'addForm.php';
            ?>
        </div>
    </div>
    <table class="table table-bordered">
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

            $feedbacks = $bdFeedback->getFeedbackBySoumissionId($_GET['use_soumission']);

            foreach ($feedbacks as $feedback) {
                $n++;
                $donneeFeedback=$feedback['dofeValeur'];
                $dateHeureFeedback=$feedback['feDateHeure'];
                $donneeSoumission=$feedback['dosValeur'];

                ?>
                <?php

            }
            ?>
            <tr>
                <td>
                    <h6><strong>Your sent feedbacks</strong></h6>
                    <table class="table table-bordered">
                        <tr>
                            <td>
                                <p>Date Time: <?= $dateHeureFeedback ?></p>
                            </td>
                            <td>
                                <p><strong style="color:dodgerblue;">Feedback Data: </strong></p>
                                <p><?= $donneeFeedback ?></p>
                            </td>
                        </tr>
                    </table>    
                    
                </td>
            </tr>
        </table>

    </div>
</div>