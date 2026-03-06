<?php
if ((isset($_SESSION['identite'])) && ($_SESSION['typeCompte'] == "admin" || $_SESSION['typeCompte'] == "TPM Coordinator")) {
?>
<div class="row m-2 p-2">

    <div class="col-6 card" style="height: 70vh;overflow:scroll;">
        <div class="h5">
            <i style="color: green;" class="fas fa-plus" aria-hidden="true"></i> ADD NEW TERRITORY
            <hr>
        </div>
        <div>
            <form action="../controllers/axe/axeController.php" method="POST">

                <div class="form-group">
                    <label class="control-label" for="tb_name">Name of the territory</label>
                    <input class="form-control" type="text" name="tb_name" required>
                </div> <br>
                <div class="form-group">
                    <label class="control-label" for="tb_province">Province</label>
                    <select class="form-control select2" name="tb_province">
                        <option value="0" default>Choose</option>
                        <option value="Bas-Uele">Bas-Uele</option>
                        <option value="Équateur">Équateur</option>
                        <option value="Haut-Katanga">Haut-Katanga</option>
                        <option value="Haut-Lomami">Haut-Lomami</option>
                        <option value="Haut-Uele">Haut-Uele</option>
                        <option value="Ituri">Ituri</option>
                        <option value="Kasaï">Kasaï central</option>
                        <option value="Kasaï oriental">Kasaï oriental</option>
                        <option value="Kinshasa">Kinshasa</option>
                        <option value="Kongo-Central">Kongo-Central</option>
                        <option value="Kwango">Kwango</option>
                        <option value="Kwilu">Kwilu</option>
                        <option value="Lomami">Lomami</option>
                        <option value="Lualaba">Lualaba</option>
                        <option value="Mai-Ndombe">Mai-Ndombe</option>
                        <option value="Maniema">Maniema</option>
                        <option value="Mongala">Mongala</option>
                        <option value="Nord-Kivu">Nord-Kivu</option>
                        <option value="Nord-Ubangi">Nord-Ubangi</option>
                        <option value="Sankuru">Sankuru</option>
                        <option value="Sud-Kivu">Sud-Kivu</option>
                        <option value="Sud-Ubangi">Sud-Ubangi</option>
                        <option value="Tanganyika">Tanganyika</option>
                        <option value="Tshopo">Tshopo</option>
                        <option value="Tshuapa">Tshuapa</option>
                    </select>
                </div> <br>
                <div class="form-group">
                    <label class="control-label" for="vaix">IX GPS Coordinate</label>
                    <input class="form-control" type="text" name="vaix" required>
                </div> <br>
                <div class="form-group">
                    <label class="control-label" for="vaiy">IY GPS Coordinate</label>
                    <input class="form-control" type="text" name="vaiy" required>
                </div>
                <hr>
                <div class="form-group">
                    <button class="btn btn-success" name="bt_add" type="submit">
                    <i class="fas fa-save" aria-hidden="true"></i> Save territory
                </button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-6 card" style="height: 70vh;overflow:scroll;">
        <div class="h5">
            <i style="color: grey;" class="fas fa-list" aria-hidden="true"></i> LIST OF DRC TERRITORIES
            <hr>
        </div>
        <div>
        <table class="table table-bordered table-condensed table-striped">
            <thead class="thead">
                <tr>
                    <th>N°</th>
                    <th>Name</th>
                    <th>Province</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $n = 0;
                $bdAxe = new Axe();
                $axes = $bdAxe->getAxeAll();
                foreach ($axes as $axe) {
                    $n++;
                ?>
                    <tr>
                        <td><?= $n ?></td>
                        <td><?= $axe['terr'] ?></td>
                        <td><?= $axe['province'] ?></td>
                        
                        <td class="row">
                            <form action="../controllers/axe/axeController.php" method="POST" class="col">

                                <input type="hidden" name="tb_axeId" value="<?= $axe['id'] ?>">
                                <button class="btn btn-outline-primary btn-sm" name="bt_for_update" type="submit"><i class="fas fa-pen" aria-hidden="true"></i> Edit</button>

                            </form>

                            <form action="../controllers/axe/axeController.php" method="POST" class="col">

                                <input type="hidden" name="tb_axeId" value="<?= $axe['id'] ?>">
                                <button class="btn btn-outline-danger btn-sm" name="bt_delete" type="submit"><i class="fas fa-trash" aria-hidden="true"></i> Delete</button>

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
