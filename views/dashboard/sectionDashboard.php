<?php
$bdProgramme = new Programme();
$programmes = $bdProgramme->getProgrammeAll();
foreach ($programmes as $programme) {
?>
    <div class="card mt-4">
        <div class="card-header">
            <?= $programme['designation'] ?>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <?php
                $bdIndicateur = new Indicateur();
                $indicateurs = $bdIndicateur->getIndicateurByProgramme($programme['id']);
                foreach ($indicateurs as $indicateur) {
                    $natureIndicateur = $indicateur['nature'];
                    $typeIndicateur = $indicateur['typeIndicateur'];
                ?>
                    <tr>
                        <td>
                            <?= $indicateur['designation'] ?>

                        </td>
                        <td>
                            <table class="table table-bordered">
                                <?php
                                $valeurObjectif = 0;
                                $valeurConstatInitial = 0;

                                $bdPlanification = new Planification();
                                $planifications = $bdPlanification->getPlanificationByIndicateur($indicateur['id']);
                                foreach ($planifications as $planification) {
                                ?>
                                    <tr>
                                        <td>
                                            <span><strong style="color: #008acc;"><?= $planification['typePlanification'] ?></strong> : </span><span><?= $planification['valeur'] ?></span>
                                        </td>

                                    </tr>
                                <?php
                                    if ($planification['typePlanification'] == "objectif") {
                                        $valeurObjectif = $planification['valeur'];
                                    } else {
                                        $valeurConstatInitial = $planification['valeur'];
                                    }
                                }
                                ?>
                            </table>
                        </td>
                        <td>
                            <span><strong style="color: #bf6000;">Nature de donnée</strong> : </span><span><?= $natureIndicateur ?></span>
                        </td>
                        <td>
                            <span><strong style="color: #008040;">Type d'entrée</strong> : </span><span><?= $typeIndicateur ?></span>
                        </td>
                        <td>
                            <table class="table table-bordered">
                                <?php
                                $bdDonnee = new Donnee();
                                $sommeDonnee = 0;
                                $nb = 0;

                                $recentADateExacte = "";
                                $donnees = $bdDonnee->getRecentDonneeByIndicateurByDateActivite($indicateur['id']);
                                foreach ($donnees as $donnee) {
                                    $recentADateExacte = $donnee['recentADateExacte'];
                                }

                                $donnees = $bdDonnee->getDonneeByIndicateur($indicateur['id']);
                                foreach ($donnees as $donnee) {

                                ?>
                                    <tr>
                                        <td>
                                            <span><strong style="color: #008acc;">Date</strong> : </span><span><?= dateFrench($donnee['aDateExacte']) ?></span>
                                        </td>
                                        <td>
                                            <span><strong style="color: #008acc;"><?= $donnee['typeDonnee'] ?></strong> : </span><span><?= $donnee['valeur'] ?></span>
                                        </td>
                                        
                                        <td>
                                            <span><strong style="color: #008040;">Projet</strong> : </span><span><?= $donnee['pDesignation'] ?></span>
                                        </td>
                                        <?php
                                        if ($donnee['aDateExacte'] == $recentADateExacte) {
                                            $nb++;
                                            $sommeDonnee = $sommeDonnee + $donnee['valeur'];
                                        }

                                        ?>
                                    </tr>
                                <?php
                                }

                                ?>
                            </table>
                        </td>
                        <?php
                        if (($indicateur['typeIndicateur'] == "discret") && (1) && (1)) {
                        ?>
                            <td>
                                <table class="table table-bordered">


                                    <?php
                                    $bdDonnee = new Donnee();
                                    $donnees = $bdDonnee->getDonneeByIndicateur($indicateur['id']);
                                    $nombreRealisation = 0;
                                    $nombreConstat = 0;
                                    $cumul_valeur_realisation = 0;
                                    $cumul_valeur_constat = 0;
                                    foreach ($donnees as $donnee) {

                                        if ($donnee['typeDonnee'] == "realisation") {
                                            if (($indicateur['nature'] == "pourcentage")) {
                                                if ($donnee['aDateExacte'] == $recentADateExacte) {
                                                    $nombreRealisation++;
                                                    $cumul_valeur_realisation = $cumul_valeur_realisation + $donnee['valeur'];
                                                }
                                            } else {
                                                $nombreRealisation++;
                                                $cumul_valeur_realisation = $cumul_valeur_realisation + $donnee['valeur'];
                                            }
                                        } else {
                                            if (($indicateur['nature'] == "pourcentage")) {
                                                if ($donnee['aDateExacte'] == $recentADateExacte) {
                                                    $nombreConstat++;
                                                    $cumul_valeur_constat = $cumul_valeur_constat + $donnee['valeur'];
                                                }
                                            } else {
                                                $nombreConstat++;
                                                $cumul_valeur_constat = $cumul_valeur_constat + $donnee['valeur'];
                                            }
                                        }
                                    }

                                    $moyenneRealisation = 0;
                                    $moyenneConstat = 0;

                                    if ($nombreRealisation > 0) {
                                        $moyenneRealisation = ($cumul_valeur_realisation / $nombreRealisation);
                                    }
                                    if ($nombreConstat > 0) {
                                        $moyenneConstat = ($cumul_valeur_constat / $nombreConstat);
                                    }

                                    if ($indicateur['nature'] == "ordinal") {
                                    ?>
                                        <tr>
                                            <td>
                                                <p><span><strong style="color: #008acc;">Réalisations | Total</strong> : </span><span><?= $cumul_valeur_realisation ?></span></p>
                                            </td>
                                            <td>
                                                <p><span><strong style="color: #008acc;">Constats | Total</strong> : </span><span><?= $cumul_valeur_constat ?></span></p>
                                            </td>
                                        </tr>
                                    <?php

                                    }

                                    ?>

                                    <tr>
                                        <td>
                                            <p><span><strong style="color: #008acc;">Réalisations | Moyenne</strong> : </span><span><?= $moyenneRealisation ?></span></p>
                                        </td>
                                        <td>
                                            <p><span><strong style="color: #008acc;">Constats | Moyenne</strong> : </span><span><?= $moyenneConstat ?></span></p>
                                        </td>
                                    </tr>

                                </table>
                            </td>
                        <?php
                        }
                        if (($indicateur['typeIndicateur'] == "cumul")) {
                        ?>
                            <td>
                                <?php
                                $moyenneDonnee = 0;

                                if ($nb > 0) {
                                    $moyenneDonnee = ($sommeDonnee / $nb);
                                }
                                ?>

                                <span><strong style="color: #008acc;">Moyenne</strong> : </span><span><?= $moyenneDonnee ?></span>

                            </td>
                        <?php
                        }
                        ?>
                        <td>
                            <table class="table table-bordered">

                                <?php
                                // $bdDonnee = new Donnee();
                                // $donnees = $bdDonnee->getDonneeByIndicateur($indicateur['id']);
                                // $nombreRealisation = 0;
                                // $nombreConstat = 0;
                                // $cumul_valeur_realisation = 0;
                                // $cumul_valeur_constat = 0;
                                // foreach ($donnees as $donnee) {

                                //     if ($donnee['typeDonnee'] == "realisation") {
                                //         $nombreRealisation++;
                                //         $cumul_valeur_realisation = $cumul_valeur_realisation + $donnee['valeur'];
                                //     } else {
                                //         $nombreConstat++;
                                //         $cumul_valeur_constat = $cumul_valeur_constat + $donnee['valeur'];
                                //     }
                                // }

                                // $moyenneRealisation = 0;
                                // $moyenneConstat = 0;

                                // if ($nombreRealisation > 0) {
                                //     $moyenneRealisation = ($cumul_valeur_realisation / $nombreRealisation);
                                // }
                                // if ($nombreConstat > 0) {
                                //     $moyenneConstat = ($cumul_valeur_constat / $nombreConstat);
                                // }
                                $pourcentage = 0;
                                if ($indicateur['typeIndicateur'] == "cumul") {
                                ?>
                                    <tr>
                                        <td>
                                            <?php

                                            $ecart = ($valeurObjectif - $moyenneDonnee);
                                            if ($valeurObjectif != 0) {
                                                $pourcentage = abs(($moyenneDonnee / $valeurObjectif) * 100);
                                            } else {
                                                if ($moyenneDonnee > 0)
                                                    $pourcentage = 100;
                                            }

                                            ?>
                                            <p><span><strong style="color: #008acc;">Ecart | Objectif</strong> : </span><span><?= abs($ecart) ?></span></p>
                                            <div class="progress">
                                                <div class="progress-bar <?php if ($valeurObjectif > 0) {
                                                                                echo 'bg-success';
                                                                            } else {
                                                                                echo 'bg-danger';
                                                                            } ?>" role="progressbar" style="width: <?= $pourcentage ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?= $pourcentage ?>%</div>
                                            </div>
                                            <span> <?= $pourcentage ?> % </span>
                                        </td>
                                    </tr>
                                    <?php
                                } else if (($indicateur['typeIndicateur'] == "discret") && ($indicateur['nature'] == "ordinal")) {
                                    if ($indicateur['estMoyenne'] == 0) {
                                    ?>
                                        <tr>
                                            <td>
                                                <p><span><strong style="color: #008acc;">Ecart | Objectif</strong> : </span><span><?= ($valeurObjectif - $cumul_valeur_realisation) ?></span></p>
                                            </td>
                                            <td>
                                                <p><span><strong style="color: #008acc;">V. actuelle | Calculé</strong> : </span><span><?= ($valeurConstatInitial + $cumul_valeur_realisation) ?></span></p>
                                            </td>
                                        </tr>
                                    <?php
                                    } else {
                                    ?>
                                        <tr>
                                            <td>
                                                <?php

                                                $ecart = ($valeurObjectif - $moyenneRealisation);
                                                if ($valeurObjectif != 0) {
                                                    $pourcentage = round(abs(($moyenneRealisation / $valeurObjectif) * 100));
                                                } else {
                                                    if ($moyenneRealisation > 0)
                                                        $pourcentage = 100;
                                                }

                                                ?>
                                                <p><span><strong style="color: #008acc;">Ecart moyen | Objectif</strong> : </span><span><?= abs($valeurObjectif - $moyenneRealisation) ?></span></p>
                                                <div class="progress">
                                                    <div class="progress-bar <?php if ($valeurObjectif > 0) {
                                                                                    echo 'bg-success';
                                                                                } else {
                                                                                    echo 'bg-danger';
                                                                                } ?>" role="progressbar" style="width: <?= $pourcentage ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?= $pourcentage ?>%</div>
                                                </div>
                                            </td>
                                            <td>
                                                <p><span><strong style="color: #008acc;">V. actuelle | Calculé</strong> : </span><span><?= ($valeurConstatInitial + $cumul_valeur_realisation) ?></span></p>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>

                                <?php
                                }

                                ?>



                            </table>
                        </td>
                        <td>
                            <p>
                            <form action="../controllers/donnee/donneeController.php" method="POST">
                                <input type="hidden" name="tb_indicateurId" value="<?= $indicateur['id'] ?>">
                                <button type="submit" name="bt_view_chart" class="btn btn-outline-secondary">voir graphique</button>
                            </form>

                            </p>
                        </td>
                    </tr>
                <?php
                }
                ?>

            </table>
        </div>
    </div>
<?php
}
?>