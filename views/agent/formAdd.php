<div class="m-4 p-4 sectionPanel card mt-4">
    <div class="h5">
        <i class="fas fa-plus" aria-hidden="true"></i> Add new agent
        <hr>
    </div>
    <div>
        <form action="../controllers/agent/agentController.php" method="POST">

            <div class="form-group">
                <label class="control-label" for="my-select">Agent name</label>
                <input class="form-control" type="text" name="tb_identite">
            </div>
            <br>
            <div class="form-group">
                <label class="control-label" for="my-select">Associated user account</label>
                <select class="form-control select2" name="cb_compte">
                    <option value="0">Choose</option>
                    <?php
                    $bdCompte = new Compte();
                    $comptes = $bdCompte->getCompteActiveAll();
                    foreach ($comptes as $compte) {
                    ?>
                        <option value="<?= $compte['id'] ?>"><?= $compte['identite'] ?></option>
                    <?php
                    }
                    ?>

                </select>
            </div>
            <br>
            <div class="form-group">
                <label class="control-label" for="my-select">Agent Level</label>
                <select class="form-control select2" name="cb_niveau">
                    <option value="0">Choose</option>
                    <?php
                    $bdNiveau = new Niveau();
                    $niveaus = $bdNiveau->getNiveauActiveAll();
                    foreach ($niveaus as $niveau) {
                    ?>
                        <option value="<?= $niveau['id'] ?>"><?= "Level Id: ".$niveau['levelNiveau']." / ".$niveau['designation'] ?></option>
                    <?php
                    }
                    ?>

                </select>
            </div>
            
            <hr>
            <div class="form-group">
                <button class="btn btn-success" name="bt_add" type="submit">
                    <i class="fas fa-save" aria-hidden="true"></i> Save agent
                </button>
            </div>
        </form>
    </div>


</div>