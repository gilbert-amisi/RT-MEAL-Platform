<?php
if ((isset($_SESSION['identite'])) && ($_SESSION['typeCompte'] == "admin" || $_SESSION['typeCompte'] == "TPM Coordinator")) {
?>
<div class="row m-2 p-2">

    <div class="col-5 card" style="height: 80vh;overflow:scroll;">
        <div class="h5">
            <i style="color: green;" class="fas fa-plus" aria-hidden="true"></i> ADD NEW TPM PROXY MONITOR
            <hr>
        </div>
        <div>
            <form action="../controllers/proxymonitor/proxymonitorController.php" method="POST">

                <div class="form-group m-1 p-1">
                    <label class="control-label" for="tb_name">Proxy Monitor's Name</label>
                    <input class="form-control" type="text" name="tb_name" required>
                </div>
                <div class="form-group m-1 p-1">
                    <label class="control-label" for="tb_phone">Proxy Monitor's Phone number</label>
                    <input class="form-control" type="tel" name="tb_phone">
                </div>
                <div class="form-group m-1 p-1">
                    <label class="control-label" for="tb_email">Proxy Monitor's E-mail</label>
                    <input class="form-control" type="email" name="tb_email">
                </div>
                <div class="form-group m-1 p-1">
                    <label class="control-label" for="tb_email">Proxy Monitor's Location</label>
                    <input class="form-control" type="text" name="tb_location" placeholder="Town or village">
                </div>
                <div class="form-group m-1 p-1">
                    <label class="control-label" for="tb_province">Proxy Monitor's Province</label>
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
                </div>
                <div class="form-group m-1 p-1">
                    <label class="control-label" for="tb_compte">Related User Account</label>
                    <select class="form-control select2" name="tb_compte">
                        <option value="0">Choose</option>
                        <?php
                        $bdCompte = new Compte();
                        $comptes = $bdCompte->getCompteProxy();
                        foreach ($comptes as $compte) {
                        ?>
                            <option value="<?= $compte['id'] ?>"><?= $compte['identite'] ?></option>
                        <?php
                        }
                        ?>

                    </select>
                </div>
                <hr>
                <div class="form-group m-1 p-1">
                    <button class="btn btn-success" name="bt_add" type="submit">
                    <i class="fas fa-save" aria-hidden="true"></i> Save TPM Proxy Monitor
                </button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-7 card" style="height: 80vh;overflow:scroll;">
        <div class="h5">
            <i style="color: grey;" class="fas fa-list" aria-hidden="true"></i> TPM PROXY MONITORS LIST
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
                    <th>Location</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $n = 0;
                $bdProxyMonitor = new ProxyMonitor();
                $proxymonitors = $bdProxyMonitor->getProxyMonitorAll();
                foreach ($proxymonitors as $proxymonitor) {
                    $n++;
                ?>
                    <tr>
                        <td><?= $n ?></td>
                        <td><?= $proxymonitor['name'] ?></td>
                        <td><?= $proxymonitor['phone'] ?></td>
                        <td><?= $proxymonitor['email'] ?></td>
                        <td><?= $proxymonitor['location'] ?> / <?= $proxymonitor['province'] ?></td>
                        
                        <td class="row">
                            <form action="../controllers/proxymonitor/proxymonitorController.php" method="POST" class="col">

                                <input type="hidden" name="tb_proxymonitorId" value="<?= $proxymonitor['id'] ?>">
                                <button class="btn btn-primary" name="bt_for_update" type="submit"><i class="fas fa-pen" aria-hidden="true"></i></button>

                            </form>

                            <form action="../controllers/proxymonitor/proxymonitorController.php" method="POST" class="col">

                                <input type="hidden" name="tb_proxymonitorId" value="<?= $proxymonitor['id'] ?>">
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
