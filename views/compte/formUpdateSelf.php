<div class="card mt-4">
    <div class="card-header">
        <i style="color: #005e8a;" class="fas fa-pen" aria-hidden="true"></i> Account update
    </div>
    <div class="card-body">
        <div>
            <?php
            $bdCompte = new Compte();
            if ($_SESSION['typeCompte'] != "admin") {
                $compteId = $_SESSION['compteId'];
            } else {
                $compteId = $_GET['use_compte'];
            }
            $comptes = $bdCompte->getCompteById($compteId);
            foreach ($comptes as $compte) {
                $identiteCompte = $compte['identite'];
                $typeCompte = $compte['typeCompte'];
                $emailCompte = $compte['email'];
            }
            ?>
            <p style="color: #b5b5b5; font-weight: 700;">Selected account: <?= $identiteCompte . " / Type : " . $typeCompte ?></p>
            <hr>
        </div>
        <form action="../controllers/compte/compteController.php" method="POST">

            <?php
            if ($_SESSION['typeCompte'] == "admin") {
            ?>
                <div class="form-group">
                    <label class="control-label" for="my-select">User identity</label>
                    <input class="form-control" type="text" name="tb_identite" value="<?= $identiteCompte  ?>">
                </div>
                <div class="form-group">
                    <label class="control-label" for="my-select">Email</label>
                    <input class="form-control" type="text" name="tb_email" value="<?= $emailCompte  ?>">
                </div>
                <div class="form-group">
                    <label class="control-label" for="my-select">Account type</label>
                    <select class="form-control" id="my-select" class="custom-select" name="cb_typeCompte">
                        <option value="none">Choisir</option>
                        <option value="Call-Center Agent" <?php if ($typeCompte == "Call-Center Agent") echo 'selected' ?>>Call-Center Agent</option>
                        <option value="Partner" <?php if ($typeCompte == "Partner") echo 'selected' ?>>Partner</option>
                        <option value="admin" <?php if ($typeCompte == "admin") echo 'selected' ?>>Syst. Admin.</option>
                    </select>
                </div>
            <?php
            }
            ?>

            <div class="form-group">
                <label class="control-label" for="my-select">New username or email</label>
                <input class="form-control" type="text" name="tb_nomUtilisateur" value="same">
            </div>
            <div class="form-group">
                <table>
                    <tr>
                        <td>
                            <label class="control-label" for="my-select">New password</label>
                            <input class="form-control" type="password" name="tb_motDePasse">
                        </td>
                        <td style="padding-left: 8px;">
                            <label class="control-label" for="my-select">New password again</label>
                            <input class="form-control" type="password" name="tb_motDePasseSecond">
                        </td>
                    </tr>
                </table>

            </div>
            <hr>
            <div class="form-group">
                <input type="hidden" name="tb_compteId" value="<?= $compteId ?>">
                <input type="hidden" name="tb_emailLast" value="<?= $emailCompte ?>">
                <button class="btn btn-success" name="bt_update" type="submit">Save</button>
            </div>
        </form>

    </div>
</div>