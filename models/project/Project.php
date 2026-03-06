<?php



class project
{
    function addProject($designation,$comment,$organisationId,$pointfocalId,$projectDuration,$yearDebut,$monthDebut,$frequency)
    {
        try {
            $query = iespConnection::connect()->prepare("INSERT INTO project(dateEnreg,designation,comment,organisationId,pointfocalId,dureeMonth,yearDebut,monthDebut,frequenceEvaluation) VALUES(?,?,?,?,?,?,?,?,?)");
            $query->execute([date('Y-m-d'),$designation,$comment,$organisationId,$pointfocalId,$projectDuration,$yearDebut,$monthDebut,$frequency]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    function getProjectAll()
    {
        try {
            $data = iespConnection::connect()->query("SELECT PR.id as prId,PR.dateEnreg as prDate,PR.designation as prDesignation,PR.comment as prComment,PR.dureeMonth,PR.yearDebut,PR.monthDebut,PR.frequenceEvaluation, OG.designation as ogDesignation,OG.color as ogColor, pf.compteId, pf.identite AS ptfoc
                                                             FROM project PR
                                                             INNER JOIN organisation OG ON(PR.organisationId=OG.id) 
                                                             LEFT JOIN pointfocal pf ON PR.pointfocalId=pf.id
                                                             ORDER BY PR.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getProjectByPF($compteId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT PR.id as prId,PR.dateEnreg as prDate,PR.designation as prDesignation,PR.comment as prComment,PR.dureeMonth,PR.yearDebut,PR.monthDebut,PR.frequenceEvaluation, OG.designation as ogDesignation,OG.color as ogColor, pf.compteId
                                                             FROM project PR
                                                             INNER JOIN organisation OG ON(PR.organisationId=OG.id) 
                                                             LEFT JOIN pointfocal pf ON PR.pointfocalId=pf.id
                                                             WHERE pf.compteId = $compteId 
                                                             ORDER BY PR.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getProjectAllActive()
    {
        try {
            $data = iespConnection::connect()->query("SELECT PR.id as prId,PR.dateEnreg as prDate,PR.designation as prDesignation,PR.comment as prComment,PR.dureeMonth,PR.yearDebut,PR.monthDebut,PR.frequenceEvaluation,OG.designation as ogDesignation,OG.color as ogColor FROM project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id) WHERE PR.active=1 ORDER BY PR.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getProjectActiveById($projectId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT PR.id as prId,PR.dateEnreg as prDate,PR.designation as prDesignation,PR.comment as prComment,PR.dureeMonth,PR.yearDebut,PR.monthDebut,PR.frequenceEvaluation,OG.designation as ogDesignation,OG.color as ogColor FROM project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id) WHERE PR.active=1 AND PR.id='{$projectId}' ORDER BY PR.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getProjectById($projectId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT PR.id as prId,PR.dateEnreg as prDate,PR.designation as prDesignation,PR.comment as prComment,PR.dureeMonth,PR.yearDebut,PR.monthDebut,PR.frequenceEvaluation,OG.designation as ogDesignation,OG.color as ogColor FROM project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id) WHERE PR.id='{$projectId}' ORDER BY PR.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }   

    
}