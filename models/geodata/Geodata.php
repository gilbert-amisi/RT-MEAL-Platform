<?php


class Geodata
{
    // function addFeedback($soumissionId,$donneeId,$pointfocalId)
    // {
    //     try {
    //         $query = iespConnection::connect()->prepare("INSERT INTO feedback(dateHeureEnreg,soumissionId,donneeId,pointfocalId) VALUES(?,?,?,?)");
    //         $query->execute([date('Y-m-d H:i:s'),$soumissionId,$donneeId,$pointfocalId]);
    //         return true;
    //     } catch (Exception $e) {
    //         return false;
    //     }
    // }

    function getGeodata()
    {
        try {
            $data = DrcgeojsonConnection::connect()->query("SELECT * FROM geo");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getFeedbackByLevelSensibiliteInfByProjectIdById($levelSensibilite,$projectId,$feedbackId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT FE.id as feId,FE.dateHeureEnreg as feDateHeure,SO.id as soId,SO.dateHeureEnreg as soDateHeure,SO.needFeedback,RE.id as reId,RE.dateHeureEnreg as reDateHeure,RE.oldNiveauId,RE.newNiveauId,DOR.valeur as dorValeur,RA.id as raId,RA.dateHeureEnreg as raDateHeure,RA.subject,INF.id as infId,INF.dateEvent,INF.heure as infHeure,INF.lieu as infLieu,SC.id as scId,DO.id as doId,DO.valeur,PR.designation as prDesignation,PR.id as prId,OG.designation as ogDesignation,OG.id as ogId,DOS.valeur as dosValeur,SE.id as seId,SE.levelSensibilite,SE.designation as seDesignation,DOFE.valeur as dofeValeur,PF.identite as pfIdentite,PFSE.id as pfseId,PFSE.levelSensibilite as pfseLevelSensibilite,PFSE.designation as pfseDesignation FROM feedback FE INNER JOIN donnee DOFE ON(FE.donneeId=DOFE.id) INNER JOIN (pointfocal PF INNER JOIN sensibilite PFSE ON(PF.sensibiliteId=PFSE.id)) ON(FE.pointfocalId=PF.id) INNER JOIN (soumission SO INNER JOIN sensibilite SE ON(SO.sensibiliteId=SE.id) INNER JOIN donnee DOS ON(SO.donneeId=DOS.id) INNER JOIN (remonte RE INNER JOIN donnee DOR ON(RE.donneeId=DOR.id) INNER JOIN (rapportage RA INNER JOIN agent AG ON(RA.agentId=AG.id) INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(RA.projectId=PR.id) INNER JOIN (information INF INNER JOIN source SC ON(INF.sourceId=SC.id) INNER JOIN donnee DO ON(INF.donneeId=DO.id)) ON(RA.informationId=INF.id)) ON(RE.rapportageId=RA.id)) ON(SO.remonteId=RE.id)) ON(FE.soumissionId=SO.id) WHERE SE.levelSensibilite>='{$levelSensibilite}' AND SE.projectId='{$projectId}' AND FE.id='{$feedbackId}' ORDER BY FE.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getFeedbackById($feedbackId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT FE.id as feId,FE.dateHeureEnreg as feDateHeure,SO.id as soId,SO.dateHeureEnreg as soDateHeure,SO.needFeedback,RE.id as reId,RE.dateHeureEnreg as reDateHeure,RE.oldNiveauId,RE.newNiveauId,DOR.valeur as dorValeur,RA.id as raId,RA.dateHeureEnreg as raDateHeure,RA.subject,INF.id as infId,INF.dateEvent,INF.heure as infHeure,INF.lieu as infLieu,SC.id as scId,DO.id as doId,DO.valeur,PR.designation as prDesignation,PR.id as prId,OG.designation as ogDesignation,OG.id as ogId,DOS.valeur as dosValeur,SE.id as seId,SE.levelSensibilite,SE.designation as seDesignation,DOFE.valeur as dofeValeur,PF.identite as pfIdentite,PFSE.id as pfseId,PFSE.levelSensibilite as pfseLevelSensibilite,PFSE.designation as pfseDesignation FROM feedback FE INNER JOIN donnee DOFE ON(FE.donneeId=DOFE.id) INNER JOIN (pointfocal PF INNER JOIN sensibilite PFSE ON(PF.sensibiliteId=PFSE.id)) ON(FE.pointfocalId=PF.id) INNER JOIN (soumission SO INNER JOIN sensibilite SE ON(SO.sensibiliteId=SE.id) INNER JOIN donnee DOS ON(SO.donneeId=DOS.id) INNER JOIN (remonte RE INNER JOIN donnee DOR ON(RE.donneeId=DOR.id) INNER JOIN (rapportage RA INNER JOIN agent AG ON(RA.agentId=AG.id) INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(RA.projectId=PR.id) INNER JOIN (information INF INNER JOIN source SC ON(INF.sourceId=SC.id) INNER JOIN donnee DO ON(INF.donneeId=DO.id)) ON(RA.informationId=INF.id)) ON(RE.rapportageId=RA.id)) ON(SO.remonteId=RE.id)) ON(FE.soumissionId=SO.id) WHERE FE.id='{$feedbackId}' ORDER BY FE.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getFeedbackRecent()
    {
        try {
            $data = iespConnection::connect()->query("SELECT MAX(FE.id) as recentId FROM feedback FE");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getFeedbackAll()
    {
        try {
            $data = iespConnection::connect()->query("SELECT FE.id as feId,FE.dateHeureEnreg as feDateHeure,SO.id as soId,SO.dateHeureEnreg as soDateHeure,SO.needFeedback,RE.id as reId,RE.dateHeureEnreg as reDateHeure,RE.oldNiveauId,RE.newNiveauId,DOR.valeur as dorValeur,RA.id as raId,RA.dateHeureEnreg as raDateHeure,RA.subject,INF.id as infId,INF.dateEvent,INF.heure as infHeure,INF.lieu as infLieu,SC.id as scId,DO.id as doId,DO.valeur,PR.designation as prDesignation,PR.id as prId,OG.designation as ogDesignation,OG.id as ogId,DOS.valeur as dosValeur,SE.id as seId,SE.levelSensibilite,SE.designation as seDesignation,DOFE.valeur as dofeValeur,PF.identite as pfIdentite,PFSE.id as pfseId,PFSE.levelSensibilite as pfseLevelSensibilite,PFSE.designation as pfseDesignation FROM feedback FE INNER JOIN donnee DOFE ON(FE.donneeId=DOFE.id) INNER JOIN (pointfocal PF INNER JOIN sensibilite PFSE ON(PF.sensibiliteId=PFSE.id)) ON(FE.pointfocalId=PF.id) INNER JOIN (soumission SO INNER JOIN sensibilite SE ON(SO.sensibiliteId=SE.id) INNER JOIN donnee DOS ON(SO.donneeId=DOS.id) INNER JOIN (remonte RE INNER JOIN donnee DOR ON(RE.donneeId=DOR.id) INNER JOIN (rapportage RA INNER JOIN agent AG ON(RA.agentId=AG.id) INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(RA.projectId=PR.id) INNER JOIN (information INF INNER JOIN source SC ON(INF.sourceId=SC.id) INNER JOIN donnee DO ON(INF.donneeId=DO.id)) ON(RA.informationId=INF.id)) ON(RE.rapportageId=RA.id)) ON(SO.remonteId=RE.id)) ON(FE.soumissionId=SO.id) ORDER BY FE.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getFeedbackBySoumissionId($soumissionId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT FE.id as feId,FE.dateHeureEnreg as feDateHeure,SO.id as soId,SO.dateHeureEnreg as soDateHeure,SO.needFeedback,RE.id as reId,RE.dateHeureEnreg as reDateHeure,RE.oldNiveauId,RE.newNiveauId,DOR.valeur as dorValeur,RA.id as raId,RA.dateHeureEnreg as raDateHeure,RA.subject,INF.id as infId,INF.dateEvent,INF.heure as infHeure,INF.lieu as infLieu,SC.id as scId,DO.id as doId,DO.valeur,PR.designation as prDesignation,PR.id as prId,OG.designation as ogDesignation,OG.id as ogId,DOS.valeur as dosValeur,SE.id as seId,SE.levelSensibilite,SE.designation as seDesignation,DOFE.valeur as dofeValeur,PF.identite as pfIdentite,PFSE.id as pfseId,PFSE.levelSensibilite as pfseLevelSensibilite,PFSE.designation as pfseDesignation FROM feedback FE INNER JOIN donnee DOFE ON(FE.donneeId=DOFE.id) INNER JOIN (pointfocal PF INNER JOIN sensibilite PFSE ON(PF.sensibiliteId=PFSE.id)) ON(FE.pointfocalId=PF.id) INNER JOIN (soumission SO INNER JOIN sensibilite SE ON(SO.sensibiliteId=SE.id) INNER JOIN donnee DOS ON(SO.donneeId=DOS.id) INNER JOIN (remonte RE INNER JOIN donnee DOR ON(RE.donneeId=DOR.id) INNER JOIN (rapportage RA INNER JOIN agent AG ON(RA.agentId=AG.id) INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(RA.projectId=PR.id) INNER JOIN (information INF INNER JOIN source SC ON(INF.sourceId=SC.id) INNER JOIN donnee DO ON(INF.donneeId=DO.id)) ON(RA.informationId=INF.id)) ON(RE.rapportageId=RA.id)) ON(SO.remonteId=RE.id)) ON(FE.soumissionId=SO.id) WHERE SO.id='{$soumissionId}' ORDER BY FE.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

        
}