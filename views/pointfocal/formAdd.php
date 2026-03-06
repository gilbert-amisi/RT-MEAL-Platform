<div class="m-4 p-4 sectionPanel card">
    <div class="card-header h5">
        <i class="fas fa-handshake" aria-hidden="true"></i> Setting Focal Point for Partner
        <hr>
    </div>
    <div>
        <form action="../controllers/pointfocal/pointfocalController.php" method="POST">
            <div class="form-group m-1 p-1">
                <label class="control-label" for="organisationId">Partner (Client Organization)</label>
                <select class="form-control select2" name="organisationId">
                    <option value="0">Choose</option>
                    <?php
                    $bdOrganization = new Organization();
                    $organizations = $bdOrganization->getOrganizationAll();
                    foreach ($organizations as $organization) {
                    ?>
                        <option value="<?= $organization['id'] ?>"><?= $organization['designation'] ?></option>
                    <?php
                    }
                    ?>

                </select>
            </div>

            <div class="form-group m-1 p-1">
                <label class="control-label" for="my-select">Name of Focal Point</label>
                <input class="form-control" type="text" name="tb_identite" required>
            </div>

            <div class="form-group m-1 p-1">
                <label class="control-label" for="my-select">Associated User Account</label>
                <select class="form-control select2" name="cb_compte">
                    <option value="0">Choose</option>
                    <?php
                    $bdCompte = new Compte();
                    $comptes = $bdCompte->getComptePFActiveAll();
                    foreach ($comptes as $compte) {
                    ?>
                        <option value="<?= $compte['id'] ?>"><?= $compte['identite'] ?></option>
                    <?php
                    }
                    ?>

                </select>
            </div>

            <div class="form-group m-1 p-1">
                <label class="control-label" for="my-select">Sensibility of reports to receive (optional)</label>
                <select class="form-control select2" name="cb_sensibilite">
                    <option value="All">All types of reports</option>
                    <?php
                    $bdSensibilite = new Sensibilite();
                    $sensibilites = $bdSensibilite->getSensibiliteActiveAll();
                    foreach ($sensibilites as $sensibilite) {
                    ?>
                        <option value="<?= $sensibilite['seId'] ?>"><?= "Level: ".$sensibilite['levelSensibilite']." / ".$sensibilite['seDesignation']." / Project: ".$sensibilite['prDesignation']." / Organization: ".$sensibilite['ogDesignation'] ?></option>
                    <?php
                    }
                    ?>

                </select>
            </div>
            
            <hr>
            <div class="form-group">
                <button class="btn btn-success" name="bt_add" type="submit">
                <i class="fas fa-save" aria-hidden="true"></i> Save focal point
            </button>
            </div>
        </form>
    </div>


</div>