<div style="background-color: #f8f8f8;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h4 class="m-2 titreSpecial">User Account</h4>
    <div style="height: 69vh;overflow:scroll;">
        <?php

        if ($_GET['sub'] == sha1('register')) {
            include 'formRegister.php';
            include 'listeCompte.php';
        } else if ($_GET['sub'] == sha1('login')) {
            include 'formLogin.php';
        } else if ($_GET['sub'] == sha1('updateSelf')) {
            include 'formUpdateSelf.php';
        }

        ?>

    </div>

</div>