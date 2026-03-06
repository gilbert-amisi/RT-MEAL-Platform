<div class="m-4 p-4 sectionPanel">
    <div class="h5">
        <i class="fa fa-align-left" aria-hidden="true" style="color: #b1b1b1;"></i> Saved reports sensibilities
        <hr>
    </div>
    <div>
        <table class="table table-bordered table-condensed table-striped">
            <thead class="thead">
                <tr>
                    <th>Sensiility level</th>
                    <th>Description</th>
                    <th>Project</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $n = 0;
                $bdSensibilite = new Sensibilite();
                $sensibilites = $bdSensibilite->getSensibiliteAll();
                foreach ($sensibilites as $sensibilite) {
                    $n++;
                ?>
                    <tr>
                        <td><?= $sensibilite['levelSensibilite'] ?></td>
                        <td><?= $sensibilite['seDesignation'] ?></td>
                        <td><?= $sensibilite['prDesignation']." / ".$sensibilite['ogDesignation'] ?></td>
                        
                        <td>
                            <form action="../controllers/sensibilite/sensibiliteController.php" method="POST">

                                <input type="hidden" name="tb_sensibiliteId" value="<?= $sensibilite['seId'] ?>">
                                <button class="btn btn-primary" name="bt_for_update" type="submit"><i class="fas fa-pen" aria-hidden="true"></i></button>

                            </form>
                        </td>
                        <td>
                            <form action="../controllers/sensibilite/sensibiliteController.php" method="POST">

                                <input type="hidden" name="tb_sensibiliteId" value="<?= $sensibilite['seId'] ?>">
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