<?php

class Axe
{
    function addAxe($name,$province,$vaix,$vaiy)
    {
        try {
            $query = iespConnection::connect()->prepare("INSERT INTO territoire(terr,province,vaIX,vaIY) VALUES(?,?,?,?)");
            $query->execute([$name,$province,$vaix,$vaiy]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    function getAxeAll()
    {
        try {
            $data = iespConnection::connect()->query("SELECT * FROM territoire ORDER BY terr");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    // function getAxeActiveAll()
    // {
    //     try {
    //         $data = iespConnection::connect()->query("SELECT SE.id as seId,SE.levelAxe,SE.designation as seDesignation,SE.emergency,PR.id as prId,PR.dateEnreg as prDate,PR.designation as prDesignation,PR.comment as prComment,OG.designation as ogDesignation,OG.color as ogColor FROM axe SE INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(SE.projectId=PR.id) WHERE SE.active=1 ORDER BY SE.id DESC");
    //         return $data->fetchAll();
    //     } catch (Exception $e) {
    //         return null;
    //     }
    // }

    // function getAxeByProjectId($projectId)
    // {
    //     try {
    //         $data = iespConnection::connect()->query("SELECT SE.id as seId,SE.levelAxe,SE.designation as seDesignation,SE.emergency,PR.id as prId,PR.dateEnreg as prDate,PR.designation as prDesignation,PR.comment as prComment,OG.designation as ogDesignation,OG.color as ogColor FROM axe SE INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(SE.projectId=PR.id) WHERE SE.active=1 AND PR.id='{$projectId}' ORDER BY SE.id DESC");
    //         return $data->fetchAll();
    //     } catch (Exception $e) {
    //         return null;
    //     }
    // }

    // function getAxeByProjectIdByLevel($projectId)
    // {
    //     try {
    //         $data = iespConnection::connect()->query("SELECT SE.id as seId,SE.levelAxe,SE.designation as seDesignation,SE.emergency,PR.id as prId,PR.dateEnreg as prDate,PR.designation as prDesignation,PR.comment as prComment,OG.designation as ogDesignation,OG.color as ogColor FROM axe SE INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(SE.projectId=PR.id) WHERE SE.active=1 AND PR.id='{$projectId}' ORDER BY SE.id DESC");
    //         return $data->fetchAll();
    //     } catch (Exception $e) {
    //         return null;
    //     }
    // }

    // function getAxeById($axeId)
    // {
    //     try {
    //         $data = iespConnection::connect()->query("SELECT SE.id as seId,SE.levelAxe,SE.designation as seDesignation,SE.emergency,PR.id as prId,PR.dateEnreg as prDate,PR.designation as prDesignation,PR.comment as prComment,OG.designation as ogDesignation,OG.color as ogColor FROM axe SE INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(SE.projectId=PR.id) WHERE SE.active=1 AND SE.id='{$axeId}' ORDER BY SE.id DESC");
    //         return $data->fetchAll();
    //     } catch (Exception $e) {
    //         return null;
    //     }
    // }

    
}