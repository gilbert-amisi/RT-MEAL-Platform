<?php



class Soumission
{
    function addSoumission($emergency,$trust,$needFeedback,$sensibiliteId,$donneeId,$remonteId)
    {
        try {
            $query = iespConnection::connect()->prepare("INSERT INTO soumission(dateHeureEnreg,emergency,trust,needFeedback,sensibiliteId,donneeId,remonteId) VALUES(?,?,?,?,?,?,?)");
            $query->execute([date('Y-m-d H:i:s'),$emergency,$trust,$needFeedback,$sensibiliteId,$donneeId,$remonteId]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    function getSoumissionAll()
    {
        try {
            $data = iespConnection::connect()->query("SELECT SO.dateHeureEnreg as soDateHeure,SO.emergency as soEmergency,SO.trust as soTrust,SO.needFeedback,RE.id as reId,RE.dateHeureEnreg as reDateHeure,RE.oldNiveauId,RE.newNiveauId,DOR.valeur as dorValeur,RA.id as raId,RA.dateHeureEnreg as raDateHeure,RA.subject,INF.id as infId,INF.dateEvent,INF.heure as infHeure,INF.lieu as infLieu,INF.territoireId,SC.id as scId,DO.id as doId,DO.valeur,PR.designation as prDesignation,PR.id as prId,OG.designation as ogDesignation,OG.id as ogId,DOS.valeur as dosValeur,SE.id as seId,SE.levelSensibilite,SE.designation as seDesignation FROM remonte RE INNER JOIN sensibilite SE ON(RE.sensibiliteId=SE.id) INNER JOIN donnee DOS ON(RE.donneeId=DOS.id) INNER JOIN donnee DOR ON(RE.donneeId=DOR.id) INNER JOIN (rapportage RA INNER JOIN agent AG ON(RA.agentId=AG.id) INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(RA.projectId=PR.id) INNER JOIN (information INF INNER JOIN source SC ON(INF.sourceId=SC.id) INNER JOIN donnee DO ON(INF.donneeId=DO.id)) ON(RA.informationId=INF.id)) ON(RE.rapportageId=RA.id) ORDER BY RE.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getSoumissionByRemonteId($remonteId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT SO.id as soId,SO.dateHeureEnreg as soDateHeure,SO.emergency as soEmergency,SO.trust as soTrust,SO.needFeedback,RE.id as reId,RE.dateHeureEnreg as reDateHeure,RE.oldNiveauId,RE.newNiveauId,DOR.valeur as dorValeur,RA.id as raId,RA.dateHeureEnreg as raDateHeure,RA.subject,INF.id as infId,INF.dateEvent,INF.heure as infHeure,INF.lieu as infLieu,INF.territoireId,SC.id as scId,DO.id as doId,DO.valeur,PR.designation as prDesignation,PR.id as prId,OG.designation as ogDesignation,OG.id as ogId,DOS.valeur as dosValeur,SE.id as seId,SE.levelSensibilite,SE.designation as seDesignation FROM soumission SO INNER JOIN sensibilite SE ON(SO.sensibiliteId=SE.id) INNER JOIN donnee DOS ON(SO.donneeId=DOS.id) INNER JOIN (remonte RE INNER JOIN donnee DOR ON(RE.donneeId=DOR.id) INNER JOIN (rapportage RA INNER JOIN agent AG ON(RA.agentId=AG.id) INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(RA.projectId=PR.id) INNER JOIN (information INF INNER JOIN source SC ON(INF.sourceId=SC.id) INNER JOIN donnee DO ON(INF.donneeId=DO.id)) ON(RA.informationId=INF.id)) ON(RE.rapportageId=RA.id)) ON(SO.remonteId=RE.id) WHERE SO.remonteId='{$remonteId}' ORDER BY SO.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getSoumissionByLevelSensibiliteInfByProjectId($levelSensibilite,$projectId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT SO.id as soId,SO.dateHeureEnreg as soDateHeure,SO.emergency as soEmergency,SO.trust as soTrust,SO.needFeedback,RE.id as reId,RE.dateHeureEnreg as reDateHeure,RE.oldNiveauId,RE.newNiveauId,DOR.valeur as dorValeur,RA.id as raId,RA.dateHeureEnreg as raDateHeure,RA.subject,INF.id as infId,INF.dateEvent,INF.heure as infHeure,INF.lieu as infLieu,INF.territoireId,SC.id as scId,DO.id as doId,DO.valeur,PR.designation as prDesignation,PR.id as prId,OG.designation as ogDesignation,OG.id as ogId,DOS.valeur as dosValeur,SE.id as seId,SE.levelSensibilite,SE.designation as seDesignation FROM soumission SO INNER JOIN sensibilite SE ON(SO.sensibiliteId=SE.id) INNER JOIN donnee DOS ON(SO.donneeId=DOS.id) INNER JOIN (remonte RE INNER JOIN donnee DOR ON(RE.donneeId=DOR.id) INNER JOIN (rapportage RA INNER JOIN agent AG ON(RA.agentId=AG.id) INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(RA.projectId=PR.id) INNER JOIN (information INF INNER JOIN source SC ON(INF.sourceId=SC.id) INNER JOIN donnee DO ON(INF.donneeId=DO.id)) ON(RA.informationId=INF.id)) ON(RE.rapportageId=RA.id)) ON(SO.remonteId=RE.id) WHERE SE.levelSensibilite<='{$levelSensibilite}' AND RA.projectId='{$projectId}' ORDER BY SO.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getSoumissionByProjectId($projectId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT SO.id as soId,SO.dateHeureEnreg as soDateHeure,SO.emergency as soEmergency,SO.trust as soTrust,SO.needFeedback,RE.id as reId,RE.dateHeureEnreg as reDateHeure,RE.oldNiveauId,RE.newNiveauId,DOR.valeur as dorValeur,RA.id as raId,RA.dateHeureEnreg as raDateHeure,RA.subject,INF.id as infId,INF.dateEvent,INF.heure as infHeure,INF.lieu as infLieu,INF.territoireId,SC.id as scId,DO.id as doId,DO.valeur,PR.designation as prDesignation,PR.id as prId,OG.designation as ogDesignation,OG.id as ogId,DOS.valeur as dosValeur,SE.id as seId,SE.levelSensibilite,SE.designation as seDesignation FROM soumission SO INNER JOIN sensibilite SE ON(SO.sensibiliteId=SE.id) INNER JOIN donnee DOS ON(SO.donneeId=DOS.id) INNER JOIN (remonte RE INNER JOIN donnee DOR ON(RE.donneeId=DOR.id) INNER JOIN (rapportage RA INNER JOIN agent AG ON(RA.agentId=AG.id) INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(RA.projectId=PR.id) INNER JOIN (information INF INNER JOIN source SC ON(INF.sourceId=SC.id) INNER JOIN donnee DO ON(INF.donneeId=DO.id)) ON(RA.informationId=INF.id)) ON(RE.rapportageId=RA.id)) ON(SO.remonteId=RE.id) WHERE RA.projectId='{$projectId}' ORDER BY SO.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getSoumissionByProjectIdBySensibiliteId($projectId,$sensibiliteId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT SO.id as soId,SO.dateHeureEnreg as soDateHeure,SO.emergency as soEmergency,SO.trust as soTrust,SO.needFeedback,RE.id as reId,RE.dateHeureEnreg as reDateHeure,RE.oldNiveauId,RE.newNiveauId,DOR.valeur as dorValeur,RA.id as raId,RA.dateHeureEnreg as raDateHeure,RA.subject,INF.id as infId,INF.dateEvent,INF.heure as infHeure,INF.lieu as infLieu,INF.territoireId,SC.id as scId,DO.id as doId,DO.valeur,PR.designation as prDesignation,PR.id as prId,OG.designation as ogDesignation,OG.id as ogId,DOS.valeur as dosValeur,SE.id as seId,SE.levelSensibilite,SE.designation as seDesignation FROM soumission SO INNER JOIN sensibilite SE ON(SO.sensibiliteId=SE.id) INNER JOIN donnee DOS ON(SO.donneeId=DOS.id) INNER JOIN (remonte RE INNER JOIN donnee DOR ON(RE.donneeId=DOR.id) INNER JOIN (rapportage RA INNER JOIN agent AG ON(RA.agentId=AG.id) INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(RA.projectId=PR.id) INNER JOIN (information INF INNER JOIN source SC ON(INF.sourceId=SC.id) INNER JOIN donnee DO ON(INF.donneeId=DO.id)) ON(RA.informationId=INF.id)) ON(RE.rapportageId=RA.id)) ON(SO.remonteId=RE.id) WHERE RA.projectId='{$projectId}' AND SE.id='{$sensibiliteId}' ORDER BY SO.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getSoumissionByLevelSensibiliteInfByProjectIdByEmergency($levelSensibilite,$projectId,$emergency)
    {
        try {
            $data = iespConnection::connect()->query("SELECT SO.id as soId,SO.dateHeureEnreg as soDateHeure,SO.emergency as soEmergency,SO.trust as soTrust,SO.needFeedback,RE.id as reId,RE.dateHeureEnreg as reDateHeure,RE.oldNiveauId,RE.newNiveauId,DOR.valeur as dorValeur,RA.id as raId,RA.dateHeureEnreg as raDateHeure,RA.subject,INF.id as infId,INF.dateEvent,INF.heure as infHeure,INF.lieu as infLieu,INF.territoireId,SC.id as scId,DO.id as doId,DO.valeur,PR.designation as prDesignation,PR.id as prId,OG.designation as ogDesignation,OG.id as ogId,DOS.valeur as dosValeur,SE.id as seId,SE.levelSensibilite,SE.designation as seDesignation FROM soumission SO INNER JOIN sensibilite SE ON(SO.sensibiliteId=SE.id) INNER JOIN donnee DOS ON(SO.donneeId=DOS.id) INNER JOIN (remonte RE INNER JOIN donnee DOR ON(RE.donneeId=DOR.id) INNER JOIN (rapportage RA INNER JOIN agent AG ON(RA.agentId=AG.id) INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(RA.projectId=PR.id) INNER JOIN (information INF INNER JOIN source SC ON(INF.sourceId=SC.id) INNER JOIN donnee DO ON(INF.donneeId=DO.id)) ON(RA.informationId=INF.id)) ON(RE.rapportageId=RA.id)) ON(SO.remonteId=RE.id) WHERE SE.levelSensibilite<='{$levelSensibilite}' AND RA.projectId='{$projectId}' AND SO.emergency='{$emergency}' ORDER BY SO.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getSoumissionByLevelSensibiliteInfByProjectIdByEmergencyByTrustLevel($levelSensibilite,$projectId,$emergency,$trustLevel)
    {
        try {
            $data = iespConnection::connect()->query("SELECT SO.id as soId,SO.dateHeureEnreg as soDateHeure,SO.emergency as soEmergency,SO.trust as soTrust,SO.needFeedback,RE.id as reId,RE.dateHeureEnreg as reDateHeure,RE.oldNiveauId,RE.newNiveauId,DOR.valeur as dorValeur,RA.id as raId,RA.dateHeureEnreg as raDateHeure,RA.subject,INF.id as infId,INF.dateEvent,INF.heure as infHeure,INF.lieu as infLieu,INF.territoireId,SC.id as scId,DO.id as doId,DO.valeur,PR.designation as prDesignation,PR.id as prId,OG.designation as ogDesignation,OG.id as ogId,DOS.valeur as dosValeur,SE.id as seId,SE.levelSensibilite,SE.designation as seDesignation FROM soumission SO INNER JOIN sensibilite SE ON(SO.sensibiliteId=SE.id) INNER JOIN donnee DOS ON(SO.donneeId=DOS.id) INNER JOIN (remonte RE INNER JOIN donnee DOR ON(RE.donneeId=DOR.id) INNER JOIN (rapportage RA INNER JOIN agent AG ON(RA.agentId=AG.id) INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(RA.projectId=PR.id) INNER JOIN (information INF INNER JOIN source SC ON(INF.sourceId=SC.id) INNER JOIN donnee DO ON(INF.donneeId=DO.id)) ON(RA.informationId=INF.id)) ON(RE.rapportageId=RA.id)) ON(SO.remonteId=RE.id) WHERE SE.levelSensibilite<='{$levelSensibilite}' AND RA.projectId='{$projectId}' AND SO.emergency='{$emergency}' AND SO.trust='{$trustLevel}' ORDER BY SO.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getSoumissionByLevelSensibiliteInfByProjectIdByTrustLevel($levelSensibilite,$projectId,$trustLevel)
    {
        try {
            $data = iespConnection::connect()->query("SELECT SO.id as soId,SO.dateHeureEnreg as soDateHeure,SO.emergency as soEmergency,SO.trust as soTrust,SO.needFeedback,RE.id as reId,RE.dateHeureEnreg as reDateHeure,RE.oldNiveauId,RE.newNiveauId,DOR.valeur as dorValeur,RA.id as raId,RA.dateHeureEnreg as raDateHeure,RA.subject,INF.id as infId,INF.dateEvent,INF.heure as infHeure,INF.lieu as infLieu,INF.territoireId,SC.id as scId,DO.id as doId,DO.valeur,PR.designation as prDesignation,PR.id as prId,OG.designation as ogDesignation,OG.id as ogId,DOS.valeur as dosValeur,SE.id as seId,SE.levelSensibilite,SE.designation as seDesignation FROM soumission SO INNER JOIN sensibilite SE ON(SO.sensibiliteId=SE.id) INNER JOIN donnee DOS ON(SO.donneeId=DOS.id) INNER JOIN (remonte RE INNER JOIN donnee DOR ON(RE.donneeId=DOR.id) INNER JOIN (rapportage RA INNER JOIN agent AG ON(RA.agentId=AG.id) INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(RA.projectId=PR.id) INNER JOIN (information INF INNER JOIN source SC ON(INF.sourceId=SC.id) INNER JOIN donnee DO ON(INF.donneeId=DO.id)) ON(RA.informationId=INF.id)) ON(RE.rapportageId=RA.id)) ON(SO.remonteId=RE.id) WHERE SE.levelSensibilite<='{$levelSensibilite}' AND RA.projectId='{$projectId}' AND SO.trust='{$trustLevel}' ORDER BY SO.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getSoumissionByLevelSensibiliteInfByProjectIdBySensibiliteId($levelSensibilite,$projectId,$sensibiliteId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT SO.id as soId,SO.dateHeureEnreg as soDateHeure,SO.emergency as soEmergency,SO.trust as soTrust,SO.needFeedback,RE.id as reId,RE.dateHeureEnreg as reDateHeure,RE.oldNiveauId,RE.newNiveauId,DOR.valeur as dorValeur,RA.id as raId,RA.dateHeureEnreg as raDateHeure,RA.subject,INF.id as infId,INF.dateEvent,INF.heure as infHeure,INF.lieu as infLieu,INF.territoireId,SC.id as scId,DO.id as doId,DO.valeur,PR.designation as prDesignation,PR.id as prId,OG.designation as ogDesignation,OG.id as ogId,DOS.valeur as dosValeur,SE.id as seId,SE.levelSensibilite,SE.designation as seDesignation FROM soumission SO INNER JOIN sensibilite SE ON(SO.sensibiliteId=SE.id) INNER JOIN donnee DOS ON(SO.donneeId=DOS.id) INNER JOIN (remonte RE INNER JOIN donnee DOR ON(RE.donneeId=DOR.id) INNER JOIN (rapportage RA INNER JOIN agent AG ON(RA.agentId=AG.id) INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(RA.projectId=PR.id) INNER JOIN (information INF INNER JOIN source SC ON(INF.sourceId=SC.id) INNER JOIN donnee DO ON(INF.donneeId=DO.id)) ON(RA.informationId=INF.id)) ON(RE.rapportageId=RA.id)) ON(SO.remonteId=RE.id) WHERE SE.levelSensibilite<='{$levelSensibilite}' AND RA.projectId='{$projectId}' AND SO.sensibiliteId='{$sensibiliteId}' ORDER BY SO.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getSoumissionByLevelSensibiliteInfByProjectIdById($levelSensibilite,$projectId,$soumissionId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT SO.id as soId,SO.dateHeureEnreg as soDateHeure,SO.emergency as soEmergency,SO.trust as soTrust,SO.needFeedback,RE.id as reId,RE.dateHeureEnreg as reDateHeure,RE.oldNiveauId,RE.newNiveauId,DOR.valeur as dorValeur,RA.id as raId,RA.dateHeureEnreg as raDateHeure,RA.subject,INF.id as infId,INF.dateEvent,INF.heure as infHeure,INF.lieu as infLieu,INF.territoireId,SC.id as scId,DO.id as doId,DO.valeur,PR.designation as prDesignation,PR.id as prId,OG.designation as ogDesignation,OG.id as ogId,DOS.valeur as dosValeur,SE.id as seId,SE.levelSensibilite,SE.designation as seDesignation FROM soumission SO INNER JOIN sensibilite SE ON(SO.sensibiliteId=SE.id) INNER JOIN donnee DOS ON(SO.donneeId=DOS.id) INNER JOIN (remonte RE INNER JOIN donnee DOR ON(RE.donneeId=DOR.id) INNER JOIN (rapportage RA INNER JOIN agent AG ON(RA.agentId=AG.id) INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(RA.projectId=PR.id) INNER JOIN (information INF INNER JOIN source SC ON(INF.sourceId=SC.id) INNER JOIN donnee DO ON(INF.donneeId=DO.id)) ON(RA.informationId=INF.id)) ON(RE.rapportageId=RA.id)) ON(SO.remonteId=RE.id) WHERE SE.levelSensibilite<='{$levelSensibilite}' AND RA.projectId='{$projectId}' AND SO.id='{$soumissionId}' ORDER BY SO.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

        
}