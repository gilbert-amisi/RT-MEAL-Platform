<div style="background-color: #f8f8f8;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h4 class="m-2 titreSpecial">Focal Point</h4>
    <div class="row">
        <?php
        if ((isset($_GET['sub']))) {
            if ($_GET['sub'] == sha1('start')) {
        ?>
                <div class="col" style="height: 70vh;overflow:scroll;">
                    <?php

                    if (1) {
                        include 'formAdd.php';
                    }

                    ?>
                </div>
                <div class="col" style="height: 70vh;overflow:scroll;">
                    <?php

                    if (1) {
                        include 'listePointfocal.php';
                    }

                    ?>
                </div>
            <?php
            }
        }
        ?>


    </div>

</div>