<?php

include '../../routes/MainRoutes.php';
include '../../models/dataBase/iespConnection.php';
include '../../models/proxyMonitor/proxyMonitor.php';

if (isset($_POST['bt_add'])) {

    $compte = securise($_POST['tb_compte']);
    $name = securise($_POST['tb_name']);
    $phone = securise($_POST['tb_phone']);
    $email = securise($_POST['tb_email']);
    $location = securise($_POST['tb_location']);
    $province = securise($_POST['tb_province']);

    // die;

    if ($name != "" && $compte!=0) {
        $bdProxyMonitor = new ProxyMonitor();

        if (1) {
            if ($bdProxyMonitor->addProxyMonitor($name, $phone, $email, $location,  $province, $compte)) {
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

    MainRoutes::myWay('proxyMonitor', 'start', 'menuProjet', $reponse, false, false, true, false);
    die;
}

