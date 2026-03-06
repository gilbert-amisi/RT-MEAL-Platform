<?php



class Donnee
{
    function addDonnee($valeur)
    {
        try {
            $query = iespConnection::connect()->prepare("INSERT INTO donnee(valeur) VALUES(?)");
            $query->execute([$valeur]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    function getDonneeRecent()
    {
        try {
            $data = iespConnection::connect()->query("SELECT MAX(id) as recentId FROM donnee");
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

    function updateDonnee($donneeId,$valeur)
    {
        try {
            $query = iespConnection::connect()->prepare("UPDATE donnee SET valeur=? WHERE id=?");
            $query->execute([$valeur,$donneeId]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    
}