<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h4 class="m-2 titreSpecial">Event's Reporting</h4>
    <div class="row">
        <?php
        if ((isset($_GET['sub']))) {
            if ($_GET['sub'] == sha1('start')) {
        ?>
                <div class="col-lg-6" style="height: 70vh;overflow:scroll;">
                    
                            <?php

                            if (1) {
                                include 'panel1.php';
                            }

                            ?>
                </div>
                <div class="col-lg-6" style="height: 70vh;overflow:scroll;">
                            <?php

                            if (1) {
                                include 'panel2.php';
                            }

                            ?>
                </div>
                    
                
            <?php
            }
        }
        ?>


    </div>

</div>