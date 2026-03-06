<?php
if ((isset($_SESSION['identite'])) && ($_SESSION['typeCompte'] == "admin" || $_SESSION['typeCompte'] == "TPM Coordinator")) {
?>
<div class="row m-2 p-2">

    <div class="col-6 card" style="height: 70vh;overflow:scroll;">
        <div class="h5">
            <i style="color: green;" class="fas fa-plus" aria-hidden="true"></i> ADD NEW TPM SUPERVISOR
            <hr>
        </div>
        <div>
            <form action="../controllers/supervisor/supervisorController.php" method="POST">

                <div class="form-group">
                    <label class="control-label" for="tb_name">Supervisor's Name</label>
                    <input class="form-control" type="text" name="tb_name" required>
                </div>
                <div class="form-group">
                    <label class="control-label" for="tb_phone">Supervisor's Phone number</label>
                    <input class="form-control" type="tel" name="tb_phone">
                </div>
                <div class="form-group">
                    <label class="control-label" for="tb_email">Supervisor's E-mail</label>
                    <input class="form-control" type="email" name="tb_email">
                </div>
                <div class="form-group">
                    <label class="control-label" for="tb_compte">Related User Account</label>
                    <select class="form-control select2" name="tb_compte">
                        <option value="0">Choose</option>
                        <?php
                        $bdCompte = new Compte();
                        $comptes = $bdCompte->getCompteSupervisor();
                        foreach ($comptes as $compte) {
                        ?>
                            <option value="<?= $compte['id'] ?>"><?= $compte['identite'] ?></option>
                        <?php
                        }
                        ?>

                    </select>
                </div>
                <hr>
                <div class="form-group">
                    <button class="btn btn-success" name="bt_add" type="submit">
                    <i class="fas fa-save" aria-hidden="true"></i> Save TPM Supervisor
                </button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-6 card" style="height: 70vh;overflow:scroll;">
        <div class="h5">
            <i style="color: grey;" class="fas fa-list" aria-hidden="true"></i> TPM SUPERVISORS LIST
            <hr>
        </div>
        <div>
        <table class="table table-bordered table-condensed table-striped">
            <thead class="thead">
                <tr>
                    <th>N°</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>E-mail</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $n = 0;
                $bdSupervisor = new Supervisor();
                $supervisors = $bdSupervisor->getSupervisorAll();
                foreach ($supervisors as $supervisor) {
                    $n++;
                ?>
                    <tr>
                        <td><?= $n ?></td>
                        <td><?= $supervisor['name'] ?></td>
                        <td><?= $supervisor['phone'] ?></td>
                        <td><?= $supervisor['email'] ?></td>
                        
                        <td class="row">
                            <form action="../controllers/supervisor/supervisorController.php" method="POST" class="col">

                                <input type="hidden" name="tb_supervisorId" value="<?= $supervisor['id'] ?>">
                                <button class="btn btn-primary" name="bt_for_update" type="submit"><i class="fas fa-pen" aria-hidden="true"></i></button>

                            </form>

                            <form action="../controllers/supervisor/supervisorController.php" method="POST" class="col">

                                <input type="hidden" name="tb_supervisorId" value="<?= $supervisor['id'] ?>">
                                <button class="btn btn-danger" name="bt_delete" type="submit"><i class="fas fa-trash" aria-hidden="true"></i></button>

                            </form>
                        </td>
                    </tr>
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
</div>
<?php
}
