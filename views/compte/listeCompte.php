<div class="card mt-4">
    <div class="card-header h5">
        List of Users account
    </div>
    <div class="card-body">
        <table class="table table-bordered table-condesed table-striped">
            <thead class="thead">
                <tr>
                    <th>#</th>
                    <th>Identity</th>
                    <th>Account type</th>
                    <th>E-mail</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $n = 0;
                $bdCompte = new Compte();
                $comptes = $bdCompte->getCompteAll();
                foreach ($comptes as $compte) {
                    $n++;
                ?>
                    <tr>
                        <td><?= $n ?></td>
                        <td><?= $compte['identite'] ?></td>
                        <td><?= $compte['typeCompte'] ?></td>
                        <td><?= $compte['email'] ?></td>
                        <td>
                            <form action="../controllers/compte/compteController.php" method="POST">
                                <input type="hidden" name="tb_compteId" value="<?= $compte['id'] ?>">
                                <button class="btn btn-primary btn-sm" name="bt_for_update" type="submit"><i class="fas fa-pen" aria-hidden="true"></i></button>
                            </form>
                        </td>
                        <td>
                            <form action="../controllers/compte/compteController.php" method="POST">

                                <input type="hidden" name="tb_compteId" value="<?= $compte['id'] ?>">
                                <button class="btn btn-danger btn-sm" name="bt_active" type="submit"><i class="fas fa-trash" aria-hidden="true"></i></button>

                            </form>
                        </td>
                    </tr>
                <?php
                }
                ?>

            </tbody>
            <span style="background-color: #0063c6; padding: 8px; color: whitesmoke; border-radius: 10px;">#: <strong><?= $n ?></strong></span>
            <tfoot>
                <tr>
                    <th>#</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>