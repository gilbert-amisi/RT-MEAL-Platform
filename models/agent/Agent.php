<?php



class Agent
{
    function addAgent($identite,$compteId,$niveauId)
    {
        try {
            $query = iespConnection::connect()->prepare("INSERT INTO agent(identite,compteId,niveauId) VALUES(?,?,?)");
            $query->execute([$identite,$compteId,$niveauId]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    function getAgentAll()
    {
        try {
            $data = iespConnection::connect()->query("SELECT AG.id as agId,AG.identite as agIdentite,CO.id as coId,CO.identite as coIdentite,CO.email,NV.id as nvId,NV.levelNiveau,NV.designation as nvDesignation FROM agent AG INNER JOIN compte CO ON(AG.compteId=CO.id) INNER JOIN niveau NV ON(AG.niveauId=NV.id) ORDER BY AG.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getAgentActiveAll()
    {
        try {
            $data = iespConnection::connect()->query("SELECT AG.id as agId,AG.identite as agIdentite,CO.id as coId,CO.identite as coIdentite,CO.email,NV.id as nvId,NV.levelNiveau,NV.designation as nvDesignation FROM agent AG INNER JOIN compte CO ON(AG.compteId=CO.id) INNER JOIN niveau NV ON(AG.niveauId=NV.id) WHERE AG.active=1 ORDER BY AG.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }


    function desactiveAgentByCompteId($compteId)
    {
        try {
            $query = iespConnection::connect()->prepare("UPDATE agent SET active=? WHERE compteId=?");
            $query->execute([0,$compteId]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    function getAgentActiveByCompteId($compteId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT AG.id as agId,AG.identite as agIdentite,CO.id as coId,CO.identite as coIdentite,CO.email,NV.id as nvId,NV.levelNiveau,NV.designation as nvDesignation,NV.forValidation FROM agent AG INNER JOIN compte CO ON(AG.compteId=CO.id) INNER JOIN niveau NV ON(AG.niveauId=NV.id) WHERE AG.active=1 AND AG.compteId='{$compteId}' ORDER BY AG.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getAgentById($agentId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT AG.id as agId,AG.identite as agIdentite,CO.id as coId,CO.identite as coIdentite,CO.email,NV.id as nvId,NV.levelNiveau,NV.designation as nvDesignation,NV.forValidation FROM agent AG INNER JOIN compte CO ON(AG.compteId=CO.id) INNER JOIN niveau NV ON(AG.niveauId=NV.id) WHERE AG.id='{$agentId}' ORDER BY AG.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getAgentActiveByNiveauId($niveauId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT AG.id as agId,AG.identite as agIdentite,CO.id as coId,CO.identite as coIdentite,CO.email,NV.id as nvId,NV.levelNiveau,NV.designation as nvDesignation,NV.forValidation FROM agent AG INNER JOIN compte CO ON(AG.compteId=CO.id) INNER JOIN niveau NV ON(AG.niveauId=NV.id) WHERE AG.active=1 AND AG.niveauId='{$niveauId}' ORDER BY AG.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    

    
}