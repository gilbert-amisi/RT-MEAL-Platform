<?php

session_start();

include '../../routes/MainRoutes.php';
include '../../models/dataBase/iespConnection.php';
include '../../models/compte/Compte.php';


if (isset($_POST['bt_login'])) {


    $nomUtilisateur = securise($_POST['tb_nomUtilisateur']);
    $motDePasse = securise($_POST['tb_motDePasse']);

    if ($nomUtilisateur != "" && $motDePasse != "") {

        $bdCompte = new Compte();
        $comptes = $bdCompte->getCompteByLogin(sha1($nomUtilisateur), sha1($motDePasse));
        $n_trouve = 0;
        foreach ($comptes as $compte) {
            $n_trouve++;
        }

        if ($n_trouve == 1) {
            $_SESSION['compteId']=$compte['id'];
            $_SESSION['typeCompte']=$compte['typeCompte'];
            $_SESSION['identite']=$compte['identite'];
            $reponse = 'success_login';
            MainRoutes::myWay('home', 'start', '', $reponse, false, false, true, false);
            die;
        } else if ($n_trouve == 0) {
            $reponse = 'error_login';
            MainRoutes::myWay('utilisateur', 'login', '', $reponse, false, false, true, false);
            die;
        }
    } else {
        $reponse = "remplissage_error";
        MainRoutes::myWay('utilisateur', 'login', '', $reponse, false, false, true, false);
        die;
    }

}
