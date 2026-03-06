<div style="background-color: #f8f8f8;" class="col-lg-11 col-md-11 col-sm-11 col-xs-11">
    <h4 class="m-2 titreSpecial">Tableau de bord</h4>
    <div style="height: 69vh;overflow:scroll;">
        <?php

        if (isset($_GET['sub'])) {
            if ($_GET['sub'] == sha1("start")) {
                include 'sectionDashboard.php';
            } else if ($_GET['sub'] == sha1("viewChart")) {
                $indicateurId = $_GET['use_indicateur'];
                include 'chartBoard.php';
            }
        }

        ?>

    </div>

</div>