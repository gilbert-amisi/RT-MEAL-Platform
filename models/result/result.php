<?php

class Result
{
    function addResult($res_title, $res_comment, $projectId)
    {
        try {
            $query = iespConnection::connect()->prepare("INSERT INTO result(name,comment,projectId) VALUES(?,?,?)");
            $query->execute([$res_title, $res_comment, $projectId]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function addProduct($prod_title, $prod_comment, $resultId)
    {
        try {
            $query = iespConnection::connect()->prepare("INSERT INTO product(name,comment,resultId) VALUES(?,?,?)");
            $query->execute([$prod_title, $prod_comment, $resultId]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function addActivity($act_title, $act_comment, $productId)
    {
        try {
            $query = iespConnection::connect()->prepare("INSERT INTO activity(name,comment,productId) VALUES(?,?,?)");
            $query->execute([$act_title, $act_comment, $productId]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    function getResultAll($projectId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT r.*, p.designation AS proj, o.designation AS org
                                                      FROM result r, project p, organisation o
                                                      WHERE r.projectId=p.id
                                                      AND p.organisationId=o.id
                                                      AND r.projectId=$projectId
                                                      ORDER BY id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getProductAll($resultId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT prod.*, r.name AS res, p.designation AS proj, o.designation AS org
                                                      FROM product prod, result r, project p, organisation o
                                                      WHERE prod.resultId=r.id
                                                      AND r.projectId=p.id
                                                      AND p.organisationId=o.id
                                                      AND prod.resultId=$resultId
                                                      ORDER BY id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getActivityAll($productId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT act.*, prod.name AS prd, r.name AS res, p.designation AS proj, o.designation AS org
                                                      FROM activity act, product prod, result r, project p, organisation o
                                                      WHERE act.productId=prod.id
                                                      AND prod.resultId=r.id
                                                      AND r.projectId=p.id
                                                      AND p.organisationId=o.id
                                                      AND act.productId=$productId
                                                      ORDER BY id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getActivityByProject($projectId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT act.*, prod.name AS prd, r.name AS res, p.designation AS proj, o.designation AS org
                                                      FROM activity act, product prod, result r, project p, organisation o
                                                      WHERE act.productId=prod.id
                                                      AND prod.resultId=r.id
                                                      AND r.projectId=p.id
                                                      AND p.organisationId=o.id
                                                      AND r.projectId=$projectId
                                                      ORDER BY id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    
}