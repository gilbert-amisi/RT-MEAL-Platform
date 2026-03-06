<div class="m-4 p-4 sectionPanel">
    <div class="h5">
        <i class="fa fa-align-justify" aria-hidden="true" style="color: #b1b1b1;"></i> List of key informants
        <hr>
    </div>
    <div>
        <table class="table table-bordered table-sm table-condensed">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Gender</th>
                    <th>Location</th>
                    <th>Occupation</th>

                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if ($_SESSION['typeCompte']=="admin" || $_SESSION['typeCompte']=="TPM Coordinator") {
                        $bdKeyinformant = new Keyinformant();
                        $keyinformants = $bdKeyinformant->getKeyinformantActiveAll();
                        $n = 0;
                        foreach ($keyinformants as $keyinformant) {
                            $n++
                        ?>
                            <tr>
                                <td><?= $n ?></td>
                                <td><?= $keyinformant['identite'] ?></td>
                                <td><?= $keyinformant['contact'] ?></td>
                                <td><?= $keyinformant['genre'] ?></td>
                                <td><?= $keyinformant['adresse'] ?></td>
                                <td><?= $keyinformant['profession'] ?></td>

                                <td>
                                    <form action="../controllers/keyinformant/keyinformantController.php" method="POST">

                                        <input type="hidden" name="tb_keyinformantId" value="<?= $keyinformant['id'] ?>">
                                        <button class="btn btn-outline-primary" name="bt_for_update" type="submit"><i class="fas fa-pen" aria-hidden="true"></i></button>

                                    </form>
                                </td>
                                <td>
                                    <form action="../controllers/keyinformant/keyinformantController.php" method="POST">

                                        <input type="hidden" name="tb_keyinformantId" value="<?= $keyinformant['id'] ?>">
                                    <button class="btn btn-outline-danger" name="bt_delete" type="submit"><i class="fas fa-trash" aria-hidden="true"></i></button>

                                </form>
                            </td>
                        </tr>
                    <?php
                        }
                    }
                            
                ?>
                <?php
                $n = 0;

                $agentId = 0;
                $niveauId = 0;
                $levelNiveauAgent = 0;
                $forValidationNiveauAgent = "";
                $bdAgent = new Agent();
                $agents = $bdAgent->getAgentActiveByCompteId($_SESSION['compteId']);
                foreach ($agents as $agent) {
                    $agentId = $agent['agId'];
                    $niveauId = $agent['nvId'];
                    $levelNiveauAgent = $agent['levelNiveau'];
                    $forValidationNiveauAgent = $agent['forValidation'];
                }

                $bdKeyinformant = new Keyinformant();
                $bdNiveau = new Niveau();

                $keyinformants = $bdKeyinformant->getKeyinformantAll();
                foreach ($keyinformants as $keyinformant) {
                    $n++;
                    $levelNiveau = "";
                    $niveaus = $bdNiveau->getNiveauById($keyinformant['niveauId']);
                    foreach ($niveaus as $niveau) {
                        $levelNiveau = $niveau['levelNiveau'];
                    }

                    if ($levelNiveauAgent >= $levelNiveau) {
                ?>
                        <tr>
                            <td><?= $n ?></td>
                            <td><?= $keyinformant['identite'] ?></td>
                            <td><?= $keyinformant['contact'] ?></td>
                            <td><?= $keyinformant['genre'] ?></td>
                            <td><?= $keyinformant['adresse'] ?></td>
                            <td><?= $keyinformant['profession'] ?></td>

                            <td>
                                <form action="../controllers/keyinformant/keyinformantController.php" method="POST">

                                    <input type="hidden" name="tb_keyinformantId" value="<?= $keyinformant['id'] ?>">
                                    <button class="btn btn-primary" name="bt_for_update" type="submit"><i class="fas fa-pen" aria-hidden="true"></i></button>

                                </form>
                            </td>
                            <td>
                                <form action="../controllers/keyinformant/keyinformantController.php" method="POST">

                                    <input type="hidden" name="tb_keyinformantId" value="<?= $keyinformant['id'] ?>">
                                    <button class="btn btn-danger" name="bt_delete" type="submit"><i class="fas fa-trash" aria-hidden="true"></i></button>

                                </form>
                            </td>
                        </tr>
                    <?php
                    }

                    ?>

                <?php
                }
                ?>

            </tbody>
            <tfoot>
                <tr>
                    <th>#</th>
                </tr>
            </tfoot>
        </table>
    </div>

</div>