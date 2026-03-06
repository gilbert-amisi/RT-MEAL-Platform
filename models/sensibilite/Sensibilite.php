<?php



class Sensibilite
{
    function addSensibilite($levelSensibilite,$designation,$emergency,$projectId)
    {
        try {
            $query = iespConnection::connect()->prepare("INSERT INTO sensibilite(levelSensibilite,designation,emergency,projectId) VALUES(?,?,?,?)");
            $query->execute([$levelSensibilite,$designation,$emergency,$projectId]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    function getSensibiliteAll()
    {
        try {
            $data = iespConnection::connect()->query("SELECT SE.id as seId,SE.levelSensibilite,SE.designation as seDesignation,SE.emergency,PR.id as prId,PR.dateEnreg as prDate,PR.designation as prDesignation,PR.comment as prComment,OG.designation as ogDesignation,OG.color as ogColor FROM sensibilite SE INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(SE.projectId=PR.id) ORDER BY SE.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getSensibiliteActiveAll()
    {
        try {
            $data = iespConnection::connect()->query("SELECT SE.id as seId,SE.levelSensibilite,SE.designation as seDesignation,SE.emergency,PR.id as prId,PR.dateEnreg as prDate,PR.designation as prDesignation,PR.comment as prComment,OG.designation as ogDesignation,OG.color as ogColor FROM sensibilite SE INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(SE.projectId=PR.id) WHERE SE.active=1 ORDER BY SE.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getSensibiliteByProjectId($projectId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT SE.id as seId,SE.levelSensibilite,SE.designation as seDesignation,SE.emergency,PR.id as prId,PR.dateEnreg as prDate,PR.designation as prDesignation,PR.comment as prComment,OG.designation as ogDesignation,OG.color as ogColor FROM sensibilite SE INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(SE.projectId=PR.id) WHERE SE.active=1 AND PR.id='{$projectId}' ORDER BY SE.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getSensibiliteByProjectIdByLevel($projectId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT SE.id as seId,SE.levelSensibilite,SE.designation as seDesignation,SE.emergency,PR.id as prId,PR.dateEnreg as prDate,PR.designation as prDesignation,PR.comment as prComment,OG.designation as ogDesignation,OG.color as ogColor FROM sensibilite SE INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(SE.projectId=PR.id) WHERE SE.active=1 AND PR.id='{$projectId}' ORDER BY SE.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getSensibiliteById($sensibiliteId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT SE.id as seId,SE.levelSensibilite,SE.designation as seDesignation,SE.emergency,PR.id as prId,PR.dateEnreg as prDate,PR.designation as prDesignation,PR.comment as prComment,OG.designation as ogDesignation,OG.color as ogColor FROM sensibilite SE INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(SE.projectId=PR.id) WHERE SE.active=1 AND SE.id='{$sensibiliteId}' ORDER BY SE.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    
}