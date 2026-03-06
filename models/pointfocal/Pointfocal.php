<?php



class Pointfocal
{
    function addPointfocal($identite,$compteId,$sensibiliteId,$organisationId)
    {
        try {
            $query = iespConnection::connect()->prepare("INSERT INTO pointfocal(identite,compteId,sensibiliteId,organisationId) VALUES(?,?,?,?)");
            $query->execute([$identite,$compteId,$sensibiliteId,$organisationId]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function addPointfocalTpm($identite,$compteId,$organisationId)
    {
        try {
            $query = iespConnection::connect()->prepare("INSERT INTO pointfocal(identite,compteId,organisationId) VALUES(?,?,?)");
            $query->execute([$identite,$compteId,$organisationId]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function getPointFocal()
    {
        try {
            $data = iespConnection::connect()->query("SELECT pf.*, c.email, o.designation AS org, s.levelSensibilite, s.designation AS sens
                                                    FROM pointfocal pf
                                                    LEFT JOIN compte c ON pf.compteId=c.id
                                                    LEFT JOIN organisation o ON pf.organisationId=o.id
                                                    LEFT JOIN sensibilite s ON pf.sensibiliteId=s.id
                                                    ORDER BY id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getPointFocalAll()
    {
        try {
            $data = iespConnection::connect()->query("SELECT PF.id as pfId,PF.identite as pfIdentite,CO.id as coId,CO.identite as coIdentite,CO.email,SE.id as seId,SE.levelSensibilite,SE.designation as seDesignation,PR.id as prId,PR.dateEnreg as prDate,PR.designation as prDesignation,PR.comment as prComment,OG.designation as ogDesignation,OG.color as ogColor FROM pointfocal PF INNER JOIN compte CO ON(PF.compteId=CO.id) LEFT JOIN (sensibilite SE INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(SE.projectId=PR.id)) ON(PF.sensibiliteId=SE.id) ORDER BY PF.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }


    function getPointFocalActiveAll()
    {
        try {
            $data = iespConnection::connect()->query("SELECT PF.id as pfId,PF.identite as pfIdentite,CO.id as coId,CO.identite as coIdentite,CO.email,SE.id as seId,SE.levelSensibilite,SE.designation as seDesignation,PR.id as prId,PR.dateEnreg as prDate,PR.designation as prDesignation,PR.comment as prComment,OG.designation as ogDesignation,OG.color as ogColor FROM pointfocal PF INNER JOIN compte CO ON(PF.compteId=CO.id) LEFT JOIN (sensibilite SE INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(SE.projectId=PR.id)) ON(PF.sensibiliteId=SE.id) WHERE PF.active=1 ORDER BY PF.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getPointFocalActiveByCompteId($compteId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT PF.id as pfId,PF.identite as pfIdentite,CO.id as coId,CO.identite as coIdentite,CO.email,SE.id as seId,SE.levelSensibilite,SE.designation as seDesignation,PR.id as prId,PR.dateEnreg as prDate,PR.designation as prDesignation,PR.comment as prComment,OG.designation as ogDesignation,OG.color as ogColor FROM pointfocal PF INNER JOIN compte CO ON(PF.compteId=CO.id) INNER JOIN (sensibilite SE INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(SE.projectId=PR.id)) ON(PF.sensibiliteId=SE.id) WHERE PF.active=1 AND PF.compteId='{$compteId}' ORDER BY PF.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getPointFocalActiveBySensibiliteId($sensibiliteId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT PF.id as pfId,PF.identite as pfIdentite,CO.id as coId,CO.identite as coIdentite,CO.email,SE.id as seId,SE.levelSensibilite,SE.designation as seDesignation,PR.id as prId,PR.dateEnreg as prDate,PR.designation as prDesignation,PR.comment as prComment,OG.designation as ogDesignation,OG.color as ogColor FROM pointfocal PF INNER JOIN compte CO ON(PF.compteId=CO.id) INNER JOIN (sensibilite SE INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(SE.projectId=PR.id)) ON(PF.sensibiliteId=SE.id) WHERE PF.active=1 AND PF.sensibiliteId='{$sensibiliteId}' ORDER BY PF.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getPointFocalActiveByProjectId($projectId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT PF.id as pfId,PF.identite as pfIdentite,CO.id as coId,CO.identite as coIdentite,CO.email,SE.id as seId,SE.levelSensibilite,SE.designation as seDesignation,PR.id as prId,PR.dateEnreg as prDate,PR.designation as prDesignation,PR.comment as prComment,OG.designation as ogDesignation,OG.color as ogColor FROM pointfocal PF INNER JOIN compte CO ON(PF.compteId=CO.id) INNER JOIN (sensibilite SE INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(SE.projectId=PR.id)) ON(PF.sensibiliteId=SE.id) WHERE PF.active=1 AND Pr.id='{$projectId}' ORDER BY PF.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getPointFocalbyOrg()
    {
        try {
            $data = iespConnection::connect()->query("SELECT pf.*, o.designation
            FROM pointfocal pf
            LEFT JOIN organisation o ON pf.organisationId=o.id 
            ORDER BY o.designation DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }


    function desactivePointfocalByCompteId($compteId)
    {
        try {
            $query = iespConnection::connect()->prepare("UPDATE pointfocal SET active=? WHERE compteId=?");
            $query->execute([0,$compteId]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function getFocalPointByTpm($tpmId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT v.*, t.id, af.id, act.id, pd.id, res.id, p.id, pf.id, c.email
                                                    FROM tpmverification v
                                                    LEFT JOIN tpm t ON v.tpmId=t.id
                                                    LEFT JOIN affectation af ON t.affectationId=af.id
                                                    LEFT JOIN activity act ON af.activityId=act.id
                                                    LEFT JOIN product pd ON act.productId=pd.id
                                                    LEFT JOIN result res ON pd.resultId=res.id
                                                    LEFT JOIN project p ON res.projectId=p.id
                                                    LEFT JOIN pointfocal pf ON p.pointfocalId=pf.id
                                                    LEFT JOIN compte c ON pf.compteId=c.id
                                                    WHERE t.id=$tpmId
                                                    ORDER BY v.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }
    
    
}