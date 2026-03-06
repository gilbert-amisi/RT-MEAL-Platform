<div class="col">
        <div class="m-4 p-4 sectionPanel">
            <div>
                <i style="color: forestgreen;" class="fa fa-file" aria-hidden="true"></i> Validation Details                <hr>
            </div>
            <div>
                <div class="row">
                    
                    <div class="col">
                        <table class="table table-bordered">
                            <thead>
                                <th>#</th>
                                <th>Feedback validation</th>
                                <th>Submission</th>
                                <th>Reporting</th>
                                <th>Event Date</th>
                                <th>Event Time</th>
                                <th>Location</th>
                                <th>Project</th>
                                
                                <th></th>
                                <th></th>
                                <th></th>
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
                                $bdAjuste = new Ajuste();
                               
                                $ajustes = $bdAjuste->getAjusteById($_GET['use_ajuste']);
                                
                                $donneeRemonte="";
                                foreach ($ajustes as $ajuste) {
                                    $n++;
                                    $donneeSoumission=$ajuste['dosValeur'];
                                    $donneeValidation=$ajuste['doafValeur'];
                                    $donneeRemonte=$ajuste['valeur'];

                                ?>
                                    <tr>
                                        <td><?= $n ?></td>
                                        <td><strong style="color:dodgerblue"><?= $ajuste['afDateHeure'] ?></strong></td>
                                        
                                        <td><?= $ajuste['soDateHeure'] ?></td>
                                        <td><?= $ajuste['raDateHeure'] ?></td>
                                        <td><?= $ajuste['dateEvent'] ?></td>
                                        <td><?= $ajuste['infHeure'] ?></td>
                                        <td><?= $ajuste['infLieu'] ?></td>
                                        <td><?= $ajuste['prDesignation']." / ".$ajuste['ogDesignation'] ?></td>
                                        
                                        
                                        
                                    </tr>
                                <?php
                                }
                                ?>

                            </tbody>
                        </table>
                        <table class="table table-bordered">
                                <tr>
                                    <td>
                                        <p><strong style="color:forestgreen;">Original Data: </strong></p>
                                        <p><?= $donneeRemonte ?></p>
                                    </td>
                                    <td>
                                        <p><strong style="color:orange;">Report Data: </strong></p>
                                        <p><?= $donneeSoumission ?></p>
                                    </td>
                                    <td>
                                        <p><strong style="color:dodgerblue;">Feedback Data: </strong></p>
                                        <p><?= $donneeValidation ?></p>
                                    </td>
                                </tr>
                            </table>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>