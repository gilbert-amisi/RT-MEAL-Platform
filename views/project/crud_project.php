<div style="background-color: #f8f8f8;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h4 class="m-2 titreSpecial">SETTING PROJECTS FOR ACCUNTABILITY AND THIRD PART MONITORING</h4>
    <div>
        <?php
        if ((isset($_GET['sub']))) {
            if ($_GET['sub'] == sha1('start')) {
        ?>
                <div>
                    <?php

                    if (1) {
                        include 'formAdd.php';
                    }

                    ?>
                </div>
                <div>
                    <?php

                    if (1) {
                        include 'listeProject.php';
                    }

                    ?>
                </div>
            <?php
            }
        }
        ?>


    </div>

</div>