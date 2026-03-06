<?php

class Phase
{
    function addPhase($projectId, $name, $type, $start, $end)
    {
        try {
            $query = iespConnection::connect()->prepare("INSERT INTO phase(projectId,name,type,start,end) VALUES(?,?,?,?,?)");
            $query->execute([$projectId, $name,$type, $start, $end]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function disablePhase($phaseId)
    {
        try {
            $query = iespConnection::connect()->prepare("UPDATE phase SET status='Disabled' WHERE id=?");
            $query->execute([$phaseId]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function activatePhase($phaseId)
    {
        try {
            $query = iespConnection::connect()->prepare("UPDATE phase SET status='Active' WHERE id=?");
            $query->execute([$phaseId]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    function getPhaseAll()
    {
        try {
            $data = iespConnection::connect()->query("SELECT ph.*, p.designation AS proj, o.designation AS org, pf.compteId
                                                      FROM phase ph
                                                      LEFT JOIN project p ON ph.projectId=p.id
                                                      LEFT JOIN pointfocal pf ON p.pointfocalId=pf.id
                                                      LEFT JOIN organisation o ON p.organisationId=o.id
                                                      ORDER BY id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }
    function getPhaseByProject($projectId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT ph.*, p.designation AS proj, o.designation AS org, pf.compteId
                                                      FROM phase ph
                                                      LEFT JOIN project p ON ph.projectId=p.id
                                                      LEFT JOIN pointfocal pf ON p.pointfocalId=pf.id
                                                      LEFT JOIN organisation o ON p.organisationId=o.id
                                                      WHERE ph.projectId=$projectId
                                                      ORDER BY id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    
}