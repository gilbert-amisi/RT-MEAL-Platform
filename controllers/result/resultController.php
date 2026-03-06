<?php

include '../../routes/MainRoutes.php';
include '../../models/dataBase/iespConnection.php';
include '../../models/result/result.php';

if (isset($_POST['add_result'])) {

    $projectId = securise($_POST['projectId']);
    $res_title = securise($_POST['res_title']);
    $res_comment = securise($_POST['res_comment']);

    // die;

    if ($res_title!="" && $projectId!=0) {
        $bdResult = new Result();

        if (1) {
            if ($bdResult->addResult($res_title, $res_comment, $projectId)) {
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

    MainRoutes::myWay('result', 'start', 'result', $reponse, false, false, true, false);
    die;
}

if (isset($_POST['add_product'])) {

    $resultId = securise($_POST['resultId']);
    $prod_title = securise($_POST['prod_title']);
    $prod_comment = securise($_POST['prod_comment']);

    // die;

    if ($prod_title!="" && $resultId!="") {
        $bdResult = new Result();

        if (1) {
            if ($bdResult->addProduct($prod_title, $prod_comment, $resultId)) {
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

    MainRoutes::myWay('product', 'start', 'menuProjet', $reponse, false, false, true, false);
    die;
}

if (isset($_POST['add_activity'])) {

    $productId = securise($_POST['productId']);
    $act_title = securise($_POST['act_title']);
    $act_comment = securise($_POST['act_comment']);

    // die;

    if ($act_title!="" && $productId!=0) {
        $bdResult = new Result();

        if (1) {
            if ($bdResult->addActivity($act_title, $act_comment, $productId)) {
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
    MainRoutes::myWay('activity', 'start', 'menuProjet', $reponse, false, false, true, false);
    die;
}
