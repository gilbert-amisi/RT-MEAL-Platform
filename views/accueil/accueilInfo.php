
    <div class="col-lg-12">
        
        <div>
            <?php

            if (isset($_SESSION['typeCompte'])) {
                include 'stat/listeStatGlobal.php';
            } else {
                include 'compte/formLogin.php';
            }

            



            ?>

        </div>

    </div>
