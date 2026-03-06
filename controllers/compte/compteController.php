<?php

session_start();

include '../../routes/MainRoutes.php';
include '../../models/dataBase/iespConnection.php';

include '../../models/compte/Compte.php';


if (isset($_POST['bt_add'])) {

    $identite = securise($_POST['tb_identite']);
    $typeCompte = securise($_POST['cb_typeCompte']);
    $nomUtilisateur = securise($_POST['tb_nomUtilisateur']);
    $email = securise($_POST['tb_email']);
    $motDePasse = securise($_POST['tb_motDePasse']);
    $motDePasseSecond = securise($_POST['tb_motDePasseSecond']);

    if ($identite != "" && $typeCompte != "none" && $nomUtilisateur != "" && $motDePasse != "" && $motDePasseSecond != "" && $email != "") {
        if ($motDePasse == $motDePasseSecond) {
            $bdCompte = new Compte();
            $comptes = $bdCompte->getCompteByNomUtilisateur(sha1($nomUtilisateur));
            $trouve = false;
            foreach ($comptes as $compte) {
                $trouve = true;
            }
            if (!$trouve) {
                if ($bdCompte->addCompte($identite, $typeCompte, sha1($nomUtilisateur), sha1($motDePasse),$email)) {
                    $reponse = "success";
                } else {
                    $reponse = "traitement_error";
                }
            } else {
                $reponse = "doublonsEmail_error";
            }
        } else {
            $reponse = "concordance_error";
        }
    } else {
        $reponse = "remplissage_error";
    }

    MainRoutes::myWay('utilisateur', 'register', '', $reponse, false, false, true, false);
    die;
}

if (isset($_POST['bt_for_update'])) {

    $compteId = securise($_POST['tb_compteId']);

    if ($compteId != "") {
        $reponse = "";
    }
    $render = 'utilisateur';
    $sub = 'updateSelf';
    $op = 'menuProgramme';

    header('Location:../../views/home.php?render=' . sha1($render) . '&sub=' . sha1($sub) . '&op=' . sha1($op) . '&use_compte=' . ($compteId) . '&reponse=' . sha1($reponse));
    die;
}


if (isset($_POST['bt_update'])) {

    $typeCompte="";
    $emailCompte="";
    if ($_SESSION['typeCompte']=="admin") {
        $identite = securise($_POST['tb_identite']);
        $typeCompte = securise($_POST['cb_typeCompte']);
        $emailCompte = securise($_POST['tb_email']);
    } else {
        $identite = securise($_SESSION['identite']);
        $emailCompte = securise($_POST['tb_emailLast']);
        $typeCompte = securise($_SESSION['typeCompte']);
    }
    
    $nomUtilisateur = securise($_POST['tb_nomUtilisateur']);
    $motDePasse = securise($_POST['tb_motDePasse']);
    $motDePasseSecond = securise($_POST['tb_motDePasseSecond']);
    $compteId = securise($_POST['tb_compteId']);

    if ($identite != "" && $typeCompte != "none" && $nomUtilisateur != "") {
        $bdCompte = new Compte();
        if ($motDePasse == $motDePasseSecond) {
            if ($motDePasse != "" && $motDePasseSecond != "") {
                if ($nomUtilisateur != "same") {
                    if ($bdCompte->updateCompteAllItems($compteId, $identite, $typeCompte, sha1($nomUtilisateur), sha1($motDePasse),$emailCompte)) {
                        
                        $reponse = "success";
                        $sub = 'register';
                    } else {
                        $sub = 'updateSelf';
                        $reponse = "traitement_error";
                    }
                } else {
                    
                    if ($bdCompte->updateCompteWithoutNomUtilisateur($compteId, $identite, $typeCompte, sha1($motDePasse),$emailCompte)) {
                        $reponse = "success";
                        $sub = 'register';
                    } else {
                        $reponse = "traitement_error";
                        $sub = 'updateSelf';
                    }
                }
            } else {
                if ($nomUtilisateur != "same") {
                    if ($bdCompte->updateCompteWithoutMotDePasse($compteId, $identite, $typeCompte, sha1($nomUtilisateur),$emailCompte)) {
                        $reponse = "success";
                        $sub = 'register';
                    } else {
                        $reponse = "traitement_error";
                        $sub = 'updateSelf';
                    }
                } else {
                    if ($bdCompte->updateCompteWithoutNomUtilisateurWithoutMotDePasse($compteId, $identite, $typeCompte,$emailCompte)) {
                        $reponse = "success";
                        $sub = 'register';
                    } else {
                        $reponse = "traitement_error";
                        $sub = 'updateSelf';
                    }
                }
            }
        } else {
            $reponse = "concordance_error";
            $sub = 'updateSelf';
        }
    } else {
        $reponse = "remplissage_error";
        $sub = 'updateSelf';
    }

    $render = 'utilisateur';

    if (($reponse=="success") && ($_SESSION['typeCompte']!="admin")) {
        $render="accueil";
        $sub="";
    }
    
    $op = 'menuProgramme';
    
    header('Location:../../views/home.php?render=' . sha1($render) . '&sub=' . sha1($sub) . '&op=' . sha1($op) . '&use_compte=' . ($compteId) . '&reponse=' . sha1($reponse));
    die;
    
}
