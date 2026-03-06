<?php

session_start();

include '../../routes/MainRoutes.php';
include '../../models/dataBase/legalNoteConnection.php';
include '../../models/compte/Compte.php';


if (isset($_GET['req'])) {

    if ($_GET['req'] == sha1('logout')) {

        session_destroy();

        $reponse = 'success_logout';
        MainRoutes::myWay('accueil', 'start', '', $reponse, false, false, true, false);
        die;
    }

}
