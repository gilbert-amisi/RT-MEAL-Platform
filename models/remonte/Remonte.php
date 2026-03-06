<?php



class Remonte
{
    function addRemonte($oldNiveauId,$emergency,$trust,$newNiveauId,$rapportageId,$donneeId,$agentId,$sensibiliteId)
    {
        try {
            $query = iespConnection::connect()->prepare("INSERT INTO remonte(dateHeureEnreg,emergency,trust,oldNiveauId,newNiveauId,rapportageId,donneeId,agentId,sensibiliteId) VALUES(?,?,?,?,?,?,?,?,?)");
            $query->execute([date('Y-m-d H:i:s'),$emergency,$trust,$oldNiveauId,$newNiveauId,$rapportageId,$donneeId,$agentId,$sensibiliteId]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    function getRemonteAll()
    {
        try {
            $data = iespConnection::connect()->query("SELECT RE.id as reId,RE.dateHeureEnreg as reDateHeure,RE.oldNiveauId,RE.newNiveauId,RE.agentId,DOR.valeur as dorValeur,RE.emergency,RE.trust,RE.sensibiliteId as seSensibiliteId,RA.id as raId,RA.dateHeureEnreg as raDateHeure,RA.subject,INF.id as infId,INF.dateEvent,INF.heure as infHeure,INF.lieu as infLieu,SC.id as scId,DO.id as doId,DO.valeur,PR.designation as prDesignation,PR.id as prId,OG.designation as ogDesignation,OG.id as ogId FROM remonte RE INNER JOIN donnee DOR ON(RE.donneeId=DOR.id) INNER JOIN (rapportage RA INNER JOIN agent AG ON(RA.agentId=AG.id) INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(RA.projectId=PR.id) INNER JOIN (information INF INNER JOIN source SC ON(INF.sourceId=SC.id) INNER JOIN donnee DO ON(INF.donneeId=DO.id)) ON(RA.informationId=INF.id)) ON(RE.rapportageId=RA.id) ORDER BY RE.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getRemonteByRapportageId($rapportageId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT RE.id as reId,RE.dateHeureEnreg as reDateHeure,RE.oldNiveauId,RE.newNiveauId,RE.agentId,DOR.valeur as dorValeur,RE.emergency,RE.trust,RE.sensibiliteId as seSensibiliteId,RA.id as raId,RA.dateHeureEnreg as raDateHeure,RA.subject,INF.id as infId,INF.dateEvent,INF.heure as infHeure,INF.lieu as infLieu,SC.id as scId,DO.id as doId,DO.valeur,PR.designation as prDesignation,PR.id as prId,OG.designation as ogDesignation,OG.id as ogId FROM remonte RE INNER JOIN donnee DOR ON(RE.donneeId=DOR.id) INNER JOIN (rapportage RA INNER JOIN agent AG ON(RA.agentId=AG.id) INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(RA.projectId=PR.id) INNER JOIN (information INF INNER JOIN source SC ON(INF.sourceId=SC.id) INNER JOIN donnee DO ON(INF.donneeId=DO.id)) ON(RA.informationId=INF.id)) ON(RE.rapportageId=RA.id) WHERE RA.id='{$rapportageId}' ORDER BY RE.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getRemonteByRapportageIdMax($rapportageId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT MAX(RE.id) as recentId,RE.id as reId,RE.dateHeureEnreg as reDateHeure,RE.oldNiveauId,RE.newNiveauId,RE.agentId,DOR.valeur as dorValeur,RE.emergency,RE.trust,RE.sensibiliteId as seSensibiliteId,RA.id as raId,RA.dateHeureEnreg as raDateHeure,RA.subject,INF.id as infId,INF.dateEvent,INF.heure as infHeure,INF.lieu as infLieu,SC.id as scId,DO.id as doId,DO.valeur,PR.designation as prDesignation,PR.id as prId,OG.designation as ogDesignation,OG.id as ogId FROM remonte RE INNER JOIN donnee DOR ON(RE.donneeId=DOR.id) INNER JOIN (rapportage RA INNER JOIN agent AG ON(RA.agentId=AG.id) INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(RA.projectId=PR.id) INNER JOIN (information INF INNER JOIN source SC ON(INF.sourceId=SC.id) INNER JOIN donnee DO ON(INF.donneeId=DO.id)) ON(RA.informationId=INF.id)) ON(RE.rapportageId=RA.id) WHERE RA.id='{$rapportageId}' ORDER BY RE.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getRemonteByRapportageIdMaxSelf($rapportageId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT MAX(RE.id) as recentId FROM remonte RE INNER JOIN donnee DOR ON(RE.donneeId=DOR.id) INNER JOIN (rapportage RA INNER JOIN agent AG ON(RA.agentId=AG.id) INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(RA.projectId=PR.id) INNER JOIN (information INF INNER JOIN source SC ON(INF.sourceId=SC.id) INNER JOIN donnee DO ON(INF.donneeId=DO.id)) ON(RA.informationId=INF.id)) ON(RE.rapportageId=RA.id) WHERE RA.id='{$rapportageId}' ORDER BY RE.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getRemonteByRapportageIdDifferentNiveau($rapportageId,$agentNiveauId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT RE.id as reId,RE.dateHeureEnreg as reDateHeure,RE.oldNiveauId,RE.newNiveauId,RE.agentId,DOR.valeur as dorValeur,RE.emergency,RE.trust,RE.sensibiliteId as seSensibiliteId,RA.id as raId,RA.dateHeureEnreg as raDateHeure,RA.subject,INF.id as infId,INF.dateEvent,INF.heure as infHeure,INF.lieu as infLieu,SC.id as scId,DO.id as doId,DO.valeur,PR.designation as prDesignation,PR.id as prId,OG.designation as ogDesignation,OG.id as ogId FROM remonte RE INNER JOIN donnee DOR ON(RE.donneeId=DOR.id) INNER JOIN (rapportage RA INNER JOIN agent AG ON(RA.agentId=AG.id) INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(RA.projectId=PR.id) INNER JOIN (information INF INNER JOIN source SC ON(INF.sourceId=SC.id) INNER JOIN donnee DO ON(INF.donneeId=DO.id)) ON(RA.informationId=INF.id)) ON(RE.rapportageId=RA.id) WHERE RA.id='{$rapportageId}' AND RE.oldNiveauId='{$agentNiveauId}' ORDER BY RE.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getRemonteById($remonteId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT RE.id as reId,RE.dateHeureEnreg as reDateHeure,RE.oldNiveauId,RE.newNiveauId,RE.agentId,DOR.valeur as dorValeur,RE.emergency,RE.trust,RE.sensibiliteId as seSensibiliteId,RA.id as raId,RA.dateHeureEnreg as raDateHeure,RA.subject,INF.id as infId,INF.dateEvent,INF.heure as infHeure,INF.lieu as infLieu,SC.id as scId,DO.id as doId,DO.valeur,PR.designation as prDesignation,PR.id as prId,OG.designation as ogDesignation,OG.id as ogId FROM remonte RE INNER JOIN donnee DOR ON(RE.donneeId=DOR.id) INNER JOIN (rapportage RA INNER JOIN agent AG ON(RA.agentId=AG.id) INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(RA.projectId=PR.id) INNER JOIN (information INF INNER JOIN source SC ON(INF.sourceId=SC.id) INNER JOIN donnee DO ON(INF.donneeId=DO.id)) ON(RA.informationId=INF.id)) ON(RE.rapportageId=RA.id) WHERE RE.id='{$remonteId}' ORDER BY RE.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getRemonteByNewNiveauId($niveauAgentId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT RE.id as reId,RE.dateHeureEnreg as reDateHeure,RE.oldNiveauId,RE.newNiveauId,RE.agentId,DOR.valeur as dorValeur,RE.emergency,RE.trust,RE.sensibiliteId as seSensibiliteId,RA.id as raId,RA.dateHeureEnreg as raDateHeure,RA.subject,INF.id as infId,INF.dateEvent,INF.heure as infHeure,INF.lieu as infLieu,SC.id as scId,DO.id as doId,DO.valeur,PR.designation as prDesignation,PR.id as prId,OG.designation as ogDesignation,OG.id as ogId FROM remonte RE INNER JOIN donnee DOR ON(RE.donneeId=DOR.id) INNER JOIN (rapportage RA INNER JOIN agent AG ON(RA.agentId=AG.id) INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(RA.projectId=PR.id) INNER JOIN (information INF INNER JOIN source SC ON(INF.sourceId=SC.id) INNER JOIN donnee DO ON(INF.donneeId=DO.id)) ON(RA.informationId=INF.id)) ON(RE.rapportageId=RA.id) WHERE RE.newNiveauId='{$niveauAgentId}' ORDER BY RE.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getRemonteByNewNiveauIdByProjectId($niveauAgentId,$projectId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT RE.id as reId,RE.dateHeureEnreg as reDateHeure,RE.oldNiveauId,RE.newNiveauId,RE.agentId,DOR.valeur as dorValeur,RE.emergency,RE.trust,RE.sensibiliteId as seSensibiliteId,RA.id as raId,RA.dateHeureEnreg as raDateHeure,RA.subject,INF.id as infId,INF.dateEvent,INF.heure as infHeure,INF.lieu as infLieu,SC.id as scId,DO.id as doId,DO.valeur,PR.designation as prDesignation,PR.id as prId,OG.designation as ogDesignation,OG.id as ogId FROM remonte RE INNER JOIN donnee DOR ON(RE.donneeId=DOR.id) INNER JOIN (rapportage RA INNER JOIN agent AG ON(RA.agentId=AG.id) INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(RA.projectId=PR.id) INNER JOIN (information INF INNER JOIN source SC ON(INF.sourceId=SC.id) INNER JOIN donnee DO ON(INF.donneeId=DO.id)) ON(RA.informationId=INF.id)) ON(RE.rapportageId=RA.id) WHERE RE.newNiveauId='{$niveauAgentId}' AND PR.id='{$projectId}' ORDER BY RE.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getRemonteByNewNiveauIdByEmergency($niveauAgentId,$emergency)
    {
        try {
            $data = iespConnection::connect()->query("SELECT RE.id as reId,RE.dateHeureEnreg as reDateHeure,RE.oldNiveauId,RE.newNiveauId,RE.agentId,DOR.valeur as dorValeur,RE.emergency,RE.trust,RE.sensibiliteId as seSensibiliteId,RA.id as raId,RA.dateHeureEnreg as raDateHeure,RA.subject,INF.id as infId,INF.dateEvent,INF.heure as infHeure,INF.lieu as infLieu,SC.id as scId,DO.id as doId,DO.valeur,PR.designation as prDesignation,PR.id as prId,OG.designation as ogDesignation,OG.id as ogId FROM remonte RE INNER JOIN donnee DOR ON(RE.donneeId=DOR.id) INNER JOIN (rapportage RA INNER JOIN agent AG ON(RA.agentId=AG.id) INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(RA.projectId=PR.id) INNER JOIN (information INF INNER JOIN source SC ON(INF.sourceId=SC.id) INNER JOIN donnee DO ON(INF.donneeId=DO.id)) ON(RA.informationId=INF.id)) ON(RE.rapportageId=RA.id) WHERE RE.newNiveauId='{$niveauAgentId}' AND RE.emergency='{$emergency}' ORDER BY RE.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getRemonteByNewNiveauIdByEmergencyByTrustLevel($niveauAgentId,$emergency,$trustLevel)
    {
        try {
            $data = iespConnection::connect()->query("SELECT RE.id as reId,RE.dateHeureEnreg as reDateHeure,RE.oldNiveauId,RE.newNiveauId,RE.agentId,DOR.valeur as dorValeur,RE.emergency,RE.trust,RE.sensibiliteId as seSensibiliteId,RA.id as raId,RA.dateHeureEnreg as raDateHeure,RA.subject,INF.id as infId,INF.dateEvent,INF.heure as infHeure,INF.lieu as infLieu,SC.id as scId,DO.id as doId,DO.valeur,PR.designation as prDesignation,PR.id as prId,OG.designation as ogDesignation,OG.id as ogId FROM remonte RE INNER JOIN donnee DOR ON(RE.donneeId=DOR.id) INNER JOIN (rapportage RA INNER JOIN agent AG ON(RA.agentId=AG.id) INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(RA.projectId=PR.id) INNER JOIN (information INF INNER JOIN source SC ON(INF.sourceId=SC.id) INNER JOIN donnee DO ON(INF.donneeId=DO.id)) ON(RA.informationId=INF.id)) ON(RE.rapportageId=RA.id) WHERE RE.newNiveauId='{$niveauAgentId}' AND RE.emergency='{$emergency}' AND RE.trust='{$trustLevel}' ORDER BY RE.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getRemonteByNewNiveauIdByTrustLevel($niveauAgentId,$trustLevel)
    {
        try {
            $data = iespConnection::connect()->query("SELECT RE.id as reId,RE.dateHeureEnreg as reDateHeure,RE.oldNiveauId,RE.newNiveauId,RE.agentId,DOR.valeur as dorValeur,RE.emergency,RE.trust,RE.sensibiliteId as seSensibiliteId,RA.id as raId,RA.dateHeureEnreg as raDateHeure,RA.subject,INF.id as infId,INF.dateEvent,INF.heure as infHeure,INF.lieu as infLieu,SC.id as scId,DO.id as doId,DO.valeur,PR.designation as prDesignation,PR.id as prId,OG.designation as ogDesignation,OG.id as ogId FROM remonte RE INNER JOIN donnee DOR ON(RE.donneeId=DOR.id) INNER JOIN (rapportage RA INNER JOIN agent AG ON(RA.agentId=AG.id) INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(RA.projectId=PR.id) INNER JOIN (information INF INNER JOIN source SC ON(INF.sourceId=SC.id) INNER JOIN donnee DO ON(INF.donneeId=DO.id)) ON(RA.informationId=INF.id)) ON(RE.rapportageId=RA.id) WHERE RE.newNiveauId='{$niveauAgentId}' AND RE.trust='{$trustLevel}' ORDER BY RE.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

        
}