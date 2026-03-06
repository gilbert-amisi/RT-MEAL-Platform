<div id="sFilter" class="col-lg-4">
    <hr>
    <div class="row">
        <div class="col">
            <p><strong>Territories</strong></p>
            <form action="../controllers/visualization/visualizationController.php" method="POST">
                <?php

                $nTerr = 0;

                $itemsTe = [];


                if (isset($_GET['filter'])) {
                    $itemsF = explode('$', $_GET['filter']);
                    $partTerritoire = $itemsF[0];
                    $partGroupement = $itemsF[1];
                    $partSen = $itemsF[2];
                    $partDates = $itemsF[3];

                    if ($partTerritoire != "") {
                        $itemsTe = explode('-', $partTerritoire);
                    }
                }


                foreach ($terrs as $terr) {
                    $nTerr++;

                ?>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="chk_territoire_<?= $nTerr ?>" id="" value="<?= $terr ?>" <?php if (in_array($terr, $itemsTe)) echo 'checked'; ?>>
                            <?= $terr ?>
                        </label>
                    </div>
                <?php
                }

                if (isset($_GET['filter'])) {
                ?>
                    <input type="hidden" name="tb_filter" value="<?= $_GET['filter'] ?>">
                <?php
                } else {
                ?>
                    <input type="hidden" name="tb_filter" value="">
                <?php
                }
                ?>

                <input type="hidden" name="tb_nTerr" value="<?= $nTerr ?>">
                <button type="submit" name="bt_for_filter" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i></button>
            </form>
        </div>
        <div class="col">
            <p><strong>Groupements</strong></p>
            <form action="../controllers/visualization/visualizationController.php" method="POST">
                <?php

                $nGrp = 0;

                foreach ($gpms as $gpm) {

                    $bdGroupement = new Groupement();
                    $groupements = $bdGroupement->getGroupementByName($gpm);

                    foreach ($groupements as $groupement) {
                        if (in_array($groupement['territoire'], $itemsTe)) {

                            $nGrp++;

                            $itemsGp = [];

                            if ($partGroupement != "") {
                                $itemsGp = explode('-', $partGroupement);
                            }

                ?>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="chk_groupement_<?= $nGrp ?>" value="<?= $gpm ?>" <?php if (in_array($gpm, $itemsGp)) echo 'checked'; ?>>
                                    <?= $gpm ?>
                                </label>
                            </div>
                    <?php
                        }
                    }
                }

                if (isset($_GET['filter'])) {
                    ?>
                    <input type="hidden" name="tb_filter" value="<?= $_GET['filter'] ?>">
                <?php
                } else {
                ?>
                    <input type="hidden" name="tb_filter" value="">
                <?php
                }

                ?>

                <input type="hidden" name="tb_nGrp" value="<?= $nGrp ?>">
                <button type="submit" name="bt_for_filter" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i></button>
            </form>
        </div>
        <div class="col">
            <p><strong>Cases</strong></p>
            <form action="../controllers/visualization/visualizationController.php" method="POST">
                <?php

                $nSen = 0;

                foreach ($sens as $sen) {


                    if (1) {
                        if (1) {

                            $nSen++;

                            $itemsSen = [];

                            if ($partSen != "") {
                                $itemsSen = explode('-', $partSen);
                            }

                ?>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="chk_sen_<?= $nSen ?>" value="<?= $sen ?>" <?php if (in_array($sen, $itemsSen)) echo 'checked'; ?>>
                                    <?= $sen ?>
                                </label>
                            </div>
                    <?php
                        }
                    }
                }

                if (isset($_GET['filter'])) {
                    ?>
                    <input type="hidden" name="tb_filter" value="<?= $_GET['filter'] ?>">
                <?php
                } else {
                ?>
                    <input type="hidden" name="tb_filter" value="">
                <?php
                }

                ?>

                <input type="hidden" name="tb_nSen" value="<?= $nSen ?>">
                <button type="submit" name="bt_for_filter" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i></button>
            </form>
        </div>
        <div class="col">
            <p><strong>Timeline</strong></p>
            <form action="">
                <table>
                    <tr>
                        <td>
                            <label for="">start</label>
                            <input class="form-control" type="date" name="" id="">
                        </td>

                        <td>
                            <label for="">End</label>
                            <input class="form-control" type="date" name="" id="">
                        </td>
                        <td>
                            <br>
                            <button class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i></button>
                        </td>
                    </tr>
                </table>


            </form>
        </div>

    </div>

</div>