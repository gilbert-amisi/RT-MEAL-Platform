<?php
if ((isset($_SESSION['identite'])) && ($_SESSION['typeCompte'] == "admin" || $_SESSION['typeCompte'] == "TPM Coordinator")) {
?>
<div class="row m-2 p-2">

    <div class="col-6 card" style="height: 70vh;overflow:scroll;">
        <div class="h5">
            <i style="color: green;" class="fas fa-plus" aria-hidden="true"></i> ADD NEW PROJECT IMPLEMENTATION PARTNER
            <hr>
        </div>
        <div>
            <form action="../controllers/ip/ipController.php" method="POST">

                <div class="form-group">
                    <label class="control-label" for="name">Name of Implementation partner</label>
                    <input class="form-control" type="text" name="name" required>
                </div> <br>
                <hr>
                <div class="form-group">
                    <button class="btn btn-success" name="bt_add" type="submit">
                    <i class="fas fa-save" aria-hidden="true"></i> Save the partner
                </button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-6 card" style="height: 70vh;overflow:scroll;">
        <div class="h5">
            <i style="color: grey;" class="fas fa-list" aria-hidden="true"></i> LIST OF PROJECTS IMPLEMENTATION PARTNERS
            <hr>
        </div>
        <div>
        <table class="table table-bordered table-condensed table-striped">
            <thead class="thead">
                <tr>
                    <th>N°</th>
                    <th>Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $n = 0;
                $bdIp = new Ip();
                $ips = $bdIp->getIpAll();
                foreach ($ips as $ip) {
                    $n++;
                ?>
                    <tr>
                        <td><?= $n ?></td>
                        <td><?= $ip['name'] ?></td>
                        
                        <td>
                            <form action="../controllers/ip/ipController.php" method="POST">

                                <input type="hidden" name="tb_ipId" value="<?= $ip['id'] ?>">
                                <button class="btn btn-outline-primary btn-sm" name="bt_for_update" type="submit"><i class="fas fa-pen" aria-hidden="true"></i> Edit</button>

                            </form>
                        </td>
                        <td>

                            <form action="../controllers/ip/ipController.php" method="POST">

                                <input type="hidden" name="tb_ipId" value="<?= $ip['id'] ?>">
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
