<div class="col">
    <div class="m-4 p-4 sectionPanel">
        <div class="row">
            <h5 class="col-6"> <i style="color: light-blue;" class="fa fa-filter" aria-hidden="true"></i> Vériying information </h5>
            <a class="btn btn-secondary col-6"" href="home.php?render=<?= sha1('keyinformant') ?>&sub=<?= sha1('start') ?>"><i class="fa fa-plus-circle" aria-hidden="true"></i> New key informant</a>
        </div> <hr>
        <div>

            <form action="../controllers/triangulation/triangulationController.php" method="POST">
                <div class="row">

                    <div class="col">

                        <div class="form-group">
                            <label class="control-label h6" for="my-select">Called Key informant</label>
                            <br>
                            <select class="form-control select2" name="cb_keyinformant">
                                <option value="0">Choose</option>
                                <?php

                                $bdNiveau = new Niveau();

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
                                $keyinformants = $bdKeyinformant->getKeyinformantActiveAll();
                                foreach ($keyinformants as $keyinformant) {

                                    $levelNiveauKeyinformant = 0;
                                    $niveaus = $bdNiveau->getNiveauById($keyinformant['niveauId']);
                                    foreach ($niveaus as $niveau) {
                                        $levelNiveauKeyinformant = $niveau['levelNiveau'];
                                    }

                                    if ($levelNiveauAgent >= $levelNiveauKeyinformant) {
                                ?>
                                        <option value="<?= $keyinformant['id'] ?>"><?= "Name: " . $keyinformant['identite'] . " / Level " . $levelNiveauKeyinformant . " / " . $keyinformant['contact'] . " / Gender: " . $keyinformant['genre'] . " / Location: " . $keyinformant['adresse'] . " / Occupation: " . $keyinformant['profession'] ?></option>
                                <?php
                                    }
                                }
                                ?>

                            </select>
                        </div>

                    </div>

                </div>
                <hr>
                <div class="row">

                    <div class="col">
                        <p class="h6">Information from key informant</p>
                        <div class="form-group">
                            <label class="control-label" for="my-select">Event Date</label>
                            <input class="form-control" type="date" name="tb_date">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="my-select">Event Time</label>
                            <input class="form-control" type="time" name="tb_heure">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="my-select">Event place (Groupement or district)</label>
                            <select class="form-control select2" name="cb_groupement">
                                <option value="none">Choose</option>
                                <?php
                                $bdGroupement = new Groupement();
                                $bdTerritoire = new Territoire();

                                $groupements = $bdGroupement->getGroupementAll();
                                foreach ($groupements as $groupement) {
                                    $territoires = $bdTerritoire->getTerritoireByName($groupement['territoire']);
                                    foreach ($territoires as $territoire) {
                                ?>
                                        <option value="<?= $groupement['groupm'] ?>"><?= $groupement['groupm'] . " / " . $groupement['chefferie'] . " / " . $territoire['terr'] . " / " . $territoire['province'] ?></option>
                                <?php
                                    }
                                }
                                ?>

                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="my-select">Data details</label>
                            <textarea class="form-control" name="tb_donnee"></textarea>
                        </div>
                        <hr>

                        <div class="form-group">
                            <input type="hidden" name="tb_projectId" value="<?= ($projectSelected) ?>">
                            <input type="hidden" name="tb_rapportageId" value="<?= ($rapportageId) ?>">
                            <button class="btn btn-success" name="bt_add" type="submit">
                                <i class="fa fa-save" aria-hidden="true"></i>
                                 Save verifications
                            </button>
                        </div>
                    </div>
                </div>
            </form>

        </div>

    </div>

</div>