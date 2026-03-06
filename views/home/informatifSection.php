<div class="col" style="background-color: whitesmoke;">
    <div class="row" style="height: 85vh; overflow: auto;">
        <div class="col">
            <div class="row">
                <?php
                include 'home/carouselHome.php'
                ?>
            </div>
            <div class="row">
                <div class="col-lg-12 mt-4 mb-4">
                    <h3 class="myCenter">Nos services</h3>
                </div>
            </div>
            <div class="row mb-4">
                <?php
                include 'home/servicesPanel.php';
                ?>
            </div>
            <div class="row">
                <div class="col-lg-12 mt-4 mb-4">
                    <h3 class="myCenter"><i class="fa fa-bank" aria-hidden="true"></i> Les institutions utilisant le portail</h3>
                </div>
            </div>
            <div class="row mb-4">
                <?php
                include 'home/institutionPanel.php';
                ?>
            </div>
            <div class="row">
                <div class="col-lg-12 mt-4 mb-4">
                    <h3 class="myCenter"><i class="fa fa-file-text-o" aria-hidden="true"></i> Les documents disponibles</h3>
                </div>
            </div>
            <div class="row mb-4">
                <?php
                include 'home/documentPanel.php';
                ?>
            </div>
            <div class="row">
                <div class="col-lg-12 mt-4 mb-4">
                    <h3 class="myCenter">A propos</h3>
                </div>
            </div>
            <div class="row mb-4">
                <?php
                include 'home/apropos.php';
                ?>
            </div>
        </div>
    </div>

</div>