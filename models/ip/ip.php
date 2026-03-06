<?php

class Ip
{
    function addIp($name)
    {
        try {
            $query = iespConnection::connect()->prepare("INSERT INTO ip(name) VALUES(?)");
            $query->execute([$name]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    function getIpAll()
    {
        try {
            $data = iespConnection::connect()->query("SELECT * FROM ip ORDER BY name");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    // function getIpActiveAll()
    // {
    //     try {
    //         $data = iespConnection::connect()->query("SELECT SE.id as seId,SE.levelIp,SE.designation as seDesignation,SE.emergency,PR.id as prId,PR.dateEnreg as prDate,PR.designation as prDesignation,PR.comment as prComment,OG.designation as ogDesignation,OG.color as ogColor FROM axe SE INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(SE.projectId=PR.id) WHERE SE.active=1 ORDER BY SE.id DESC");
    //         return $data->fetchAll();
    //     } catch (Exception $e) {
    //         return null;
    //     }
    // }

    // function getIpByProjectId($projectId)
    // {
    //     try {
    //         $data = iespConnection::connect()->query("SELECT SE.id as seId,SE.levelIp,SE.designation as seDesignation,SE.emergency,PR.id as prId,PR.dateEnreg as prDate,PR.designation as prDesignation,PR.comment as prComment,OG.designation as ogDesignation,OG.color as ogColor FROM axe SE INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(SE.projectId=PR.id) WHERE SE.active=1 AND PR.id='{$projectId}' ORDER BY SE.id DESC");
    //         return $data->fetchAll();
    //     } catch (Exception $e) {
    //         return null;
    //     }
    // }

    // function getIpByProjectIdByLevel($projectId)
    // {
    //     try {
    //         $data = iespConnection::connect()->query("SELECT SE.id as seId,SE.levelIp,SE.designation as seDesignation,SE.emergency,PR.id as prId,PR.dateEnreg as prDate,PR.designation as prDesignation,PR.comment as prComment,OG.designation as ogDesignation,OG.color as ogColor FROM axe SE INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(SE.projectId=PR.id) WHERE SE.active=1 AND PR.id='{$projectId}' ORDER BY SE.id DESC");
    //         return $data->fetchAll();
    //     } catch (Exception $e) {
    //         return null;
    //     }
    // }

    // function getIpById($axeId)
    // {
    //     try {
    //         $data = iespConnection::connect()->query("SELECT SE.id as seId,SE.levelIp,SE.designation as seDesignation,SE.emergency,PR.id as prId,PR.dateEnreg as prDate,PR.designation as prDesignation,PR.comment as prComment,OG.designation as ogDesignation,OG.color as ogColor FROM axe SE INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(SE.projectId=PR.id) WHERE SE.active=1 AND SE.id='{$axeId}' ORDER BY SE.id DESC");
    //         return $data->fetchAll();
    //     } catch (Exception $e) {
    //         return null;
    //     }
    // }

    
}