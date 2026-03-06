<div class="sectionPanel card">
    <div class="card-header h5">
        <i class="fa fa-align-left" aria-hidden="true" style="color: #b1b1b1;"></i> List of Partner's Focal Points
        <hr>
    </div>
    <div>
        <table class="table table-bordered table-condesed table-striped table-sm table-responsive-sm">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Organisation</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Sensitivity level</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $n = 0;
                $bdPointfocal = new Pointfocal();
                $pointfocals = $bdPointfocal->getPointFocal();
                foreach ($pointfocals as $pointfocal) {
                    $n++;
                ?>
                    <tr>
                        <td><?= $n ?></td>
                        <td><?= $pointfocal['org'] ?></td>
                        <td><?= $pointfocal['identite'] ?></td>
                        <td><?= $pointfocal['email'] ?></td>
                        <td>
                            <?php
                            if ($pointfocal['sens'] == "") {
                                echo 'All';
                            } else {
                                echo 'Level '.$pointfocal['levelSensibilite'].' : '.$pointfocal['sens'];
                            }
                            ?>
                        </td>
                        <td><?= $pointfocal['active'] ?></td>
                        
                        <td>
                            <form action="../controllers/pointfocal/pointfocalController.php" method="POST">
                                <input type="hidden" name="tb_pointfocalId" value="<?= $pointfocal['id'] ?>">
                                <button class="btn btn-outline-warning btn-sm" name="bt_disable" type="submit"><i class="fa fa-window-close" aria-hidden="true"></i> Disable</button>
                            </form>
                            <form action="../controllers/pointfocal/pointfocalController.php" method="POST">
                                <input type="hidden" name="tb_pointfocalId" value="<?= $pointfocal['id'] ?>">
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