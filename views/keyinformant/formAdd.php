<div class="m-4 p-4 sectionPanel">
    <div class="h5">
        <i style="color: red;" class="fa fa-key" aria-hidden="true"></i> Add new key informant
        <hr>
    </div>
    <div>
        <form action="../controllers/keyinformant/keyinformantController.php" method="POST">

            <div class="form-group">
                <label class="control-label" for="my-select">Level</label>
                <select class="form-control select2" name="cb_niveau">
                    <option value="0">Choose</option>
                    <?php


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

                    $bdNiveau = new Niveau();
                    $niveaus = $bdNiveau->getNiveauActiveAll();
                    foreach ($niveaus as $niveau) {
                        if (($levelNiveauAgent>=$niveau['levelNiveau'])) {
                    ?>
                            <option value="<?= $niveau['id'] ?>"><?= "Level Id: " . $niveau['levelNiveau'] . " / " . $niveau['designation'] ?></option>
                    <?php
                        }
                    }
                    ?>

                </select>
            </div>
            <div class="form-group">
                <label class="control-label" for="my-select">Name</label>
                <input class="form-control" type="text" name="tb_identite">
            </div>
            <div class="form-group">
                <label class="control-label" for="my-select">Contact</label>
                <input class="form-control" type="text" name="tb_contact">
            </div>
            <div class="form-group">
                <label class="control-label" for="my-select">Gender</label>
                <select class="form-control" name="cb_genre">
                    <option value="none">Choose</option>
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                </select>
            </div>
            <div class="form-group">
                <label class="control-label" for="my-select">Location</label>
                <input class="form-control" type="text" name="tb_adresse">
            </div>
            <div class="form-group">
                <label class="control-label" for="my-select">Occupation</label>
                <input class="form-control" type="text" name="tb_profession">
            </div>

            <hr>
            <div class="form-group">
                <button class="btn btn-success" name="bt_add" type="submit">Save</button>
            </div>
        </form>
    </div>


</div>