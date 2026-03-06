<div class="m-4 p-4 sectionPanel">
    <div>
        <i class="fa fa-align-left" aria-hidden="true" style="color: #b1b1b1;"></i>
        <hr>
    </div>
    <div>
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Level</th>
                    <th>Name</th>
                    <th>For validation</th>
                    
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $n = 0;
                $bdNiveau = new Niveau();
                $niveaus = $bdNiveau->getNiveauAll();
                foreach ($niveaus as $niveau) {
                    $n++;
                ?>
                    <tr>
                        <td><?= $n ?></td>
                        <td><?= $niveau['levelNiveau'] ?></td>
                        <td><?= $niveau['designation'] ?></td>
                        <td><?= $niveau['forValidation'] ?></td>
                        
                        <td>
                            <form action="../controllers/niveau/niveauController.php" method="POST">

                                <input type="hidden" name="tb_niveauId" value="<?= $niveau['id'] ?>">
                                <button class="btn btn-primary" name="bt_for_update" type="submit"><i class="fas fa-pen" aria-hidden="true"></i></button>

                            </form>
                        </td>
                        <td>
                            <form action="../controllers/niveau/niveauController.php" method="POST">

                                <input type="hidden" name="tb_niveauId" value="<?= $niveau['id'] ?>">
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