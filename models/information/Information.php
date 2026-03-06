<?php



class Information
{
    function addInformation($dateEvent,$heure,$lieu,$sourceId,$donneeId,$territoireId)
    {
        try {
            $query = iespConnection::connect()->prepare("INSERT INTO information(dateEvent,heure,lieu,sourceId,donneeId,territoireId) VALUES(?,?,?,?,?,?)");
            $query->execute([$dateEvent,$heure,$lieu,$sourceId,$donneeId,$territoireId]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function getInformationRecent()
    {
        try {
            $data = iespConnection::connect()->query("SELECT MAX(id) as recentId FROM information");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getInformationByTerritoireId($territoireId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT * FROM information WHERE territoireId='{$territoireId}'");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }


    function getProjectAll()
    {
        try {
            $data = iespConnection::connect()->query("SELECT PR.id as prId,PR.dateEnreg as prDate,PR.designation as prDesignation,PR.comment as prComment,OG.designation as ogDesignation,OG.color as ogColor FROM project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id) ORDER BY PR.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getProjectAllActive()
    {
        try {
            $data = iespConnection::connect()->query("SELECT PR.id as prId,PR.dateEnreg as prDate,PR.designation as prDesignation,PR.comment as prComment,OG.designation as ogDesignation,OG.color as ogColor FROM project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id) WHERE PR.active=1 ORDER BY PR.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getProjectActiveById($projectId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT PR.id as prId,PR.dateEnreg as prDate,PR.designation as prDesignation,PR.comment as prComment,OG.designation as ogDesignation,OG.color as ogColor FROM project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id) WHERE PR.active=1 AND PR.id='{$projectId}' ORDER BY PR.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getProjectById($projectId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT PR.id as prId,PR.dateEnreg as prDate,PR.designation as prDesignation,PR.comment as prComment,OG.designation as ogDesignation,OG.color as ogColor FROM project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id) WHERE PR.id='{$projectId}' ORDER BY PR.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }   

    
}