<div class="mt-2">
    <?php
    if (isset($_GET['reponse'])) {
        if ($_GET['reponse'] == sha1('success')) {
    ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <p>Success processing</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }
        if ($_GET['reponse'] == sha1('success_deleted')) {
        ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <p>Success deleted</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }
        if ($_GET['reponse'] == sha1('remplissage_error')) {
        ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <p>Data fill error</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }
        if ($_GET['reponse'] == sha1('traitement_error')) {
        ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <p>Processing Error</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }
        if ($_GET['reponse'] == sha1('concordance_error')) {
        ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <p>Password don't match</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }
        if ($_GET['reponse'] == sha1('success_login')) {
        ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <p>You're connected</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }
        if ($_GET['reponse'] == sha1('error_login')) {
        ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <p>Fake username or password</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }
        if (0) {
        ?>
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <p>You're success disconnected</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }
        if ($_GET['reponse'] == sha1('doublons_error')) {
        ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <p>Duplication error</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }
        if ($_GET['reponse'] == sha1('doublonsEmail_error')) {
        ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <p>Username already in use . Duplication error</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }
        

    }
    ?>
</div>