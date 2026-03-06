<?php

include '../../routes/MainRoutes.php';
include '../../models/dataBase/iespConnection.php';
include '../../models/keyinformant/Keyinformant.php';

if (isset($_POST['bt_add'])) {

    $identite = securise($_POST['tb_identite']);
    $contact = securise($_POST['tb_contact']);
    $genre = securise($_POST['cb_genre']);
    $adresse = securise($_POST['tb_adresse']);
    $profession = securise($_POST['tb_profession']);
    $niveauId = securise($_POST['cb_niveau']);

    if ($contact != "" && $genre != "none" && $adresse != "" && $profession != "" && $niveauId != 0) {
        $bdKeyinformant = new Keyinformant();

        if (1) {
            if ($bdKeyinformant->addKeyinformant($identite, $contact,$genre,$adresse,$profession,$niveauId)) {
                $reponse = "success";
            } else {
                $reponse = "traitement_error";
            }
        } else {
            $reponse = "doublons_error";
        }
    } else {
        $reponse = "remplissage_error";
    }

    MainRoutes::myWay('keyinformant', 'start', 'menuProjet', $reponse, false, false, true, false);
    die;
}

