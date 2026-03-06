<?php



class Ajuste
{
    function addAjuste($agentId,$feedbackId,$donneeId,$niveauId)
    {
        try {
            $query = iespConnection::connect()->prepare("INSERT INTO ajustefeedback(dateHeureEnreg,agentId,feedbackId,donneeId,niveauId) VALUES(?,?,?,?,?)");
            $query->execute([date('Y-m-d H:i:s'),$agentId,$feedbackId,$donneeId,$niveauId]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function getAjusteAll()
    {
        try {
            $data = iespConnection::connect()->query("SELECT AF.id as afId,AF.dateHeureEnreg as afDateHeure,AF.niveauId as afNiveauId,DOAF.valeur as doafValeur,FE.id as feId,FE.dateHeureEnreg as feDateHeure,SO.id as soId,SO.dateHeureEnreg as soDateHeure,SO.needFeedback,RE.id as reId,RE.dateHeureEnreg as reDateHeure,RE.oldNiveauId,RE.newNiveauId,DOR.valeur as dorValeur,RA.id as raId,RA.dateHeureEnreg as raDateHeure,RA.subject,INF.id as infId,INF.dateEvent,INF.heure as infHeure,INF.lieu as infLieu,SC.id as scId,DO.id as doId,DO.valeur,PR.designation as prDesignation,PR.id as prId,OG.designation as ogDesignation,OG.id as ogId,DOS.valeur as dosValeur,SE.id as seId,SE.levelSensibilite,SE.designation as seDesignation,DOFE.valeur as dofeValeur,PF.identite as pfIdentite,PFSE.id as pfseId,PFSE.levelSensibilite as pfseLevelSensibilite,PFSE.designation as pfseDesignation,RA.subject FROM ajustefeedback AF INNER JOIN donnee DOAF ON(AF.donneeId=DOAF.id) INNER JOIN (feedback FE INNER JOIN donnee DOFE ON(FE.donneeId=DOFE.id) INNER JOIN (pointfocal PF INNER JOIN sensibilite PFSE ON(PF.sensibiliteId=PFSE.id)) ON(FE.pointfocalId=PF.id) INNER JOIN (soumission SO INNER JOIN sensibilite SE ON(SO.sensibiliteId=SE.id) INNER JOIN donnee DOS ON(SO.donneeId=DOS.id) INNER JOIN (remonte RE INNER JOIN donnee DOR ON(RE.donneeId=DOR.id) INNER JOIN (rapportage RA INNER JOIN agent AG ON(RA.agentId=AG.id) INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(RA.projectId=PR.id) INNER JOIN (information INF INNER JOIN source SC ON(INF.sourceId=SC.id) INNER JOIN donnee DO ON(INF.donneeId=DO.id)) ON(RA.informationId=INF.id)) ON(RE.rapportageId=RA.id)) ON(SO.remonteId=RE.id)) ON(FE.soumissionId=SO.id)) ON(AF.feedbackId=FE.id) ORDER BY AF.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getAjusteByFeedbackId($feedbackId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT AF.id as afId,AF.dateHeureEnreg as afDateHeure,AF.niveauId as afNiveauId,DOAF.valeur as doafValeur,FE.id as feId,FE.dateHeureEnreg as feDateHeure,SO.id as soId,SO.dateHeureEnreg as soDateHeure,SO.needFeedback,RE.id as reId,RE.dateHeureEnreg as reDateHeure,RE.oldNiveauId,RE.newNiveauId,DOR.valeur as dorValeur,RA.id as raId,RA.dateHeureEnreg as raDateHeure,RA.subject,INF.id as infId,INF.dateEvent,INF.heure as infHeure,INF.lieu as infLieu,SC.id as scId,SC.contact as scContact,DO.id as doId,DO.valeur,PR.designation as prDesignation,PR.id as prId,OG.designation as ogDesignation,OG.id as ogId,DOS.valeur as dosValeur,SE.id as seId,SE.levelSensibilite,SE.designation as seDesignation,DOFE.valeur as dofeValeur,PF.identite as pfIdentite,PFSE.id as pfseId,PFSE.levelSensibilite as pfseLevelSensibilite,PFSE.designation,RA.subject as pfseDesignation FROM ajustefeedback AF INNER JOIN donnee DOAF ON(AF.donneeId=DOAF.id) INNER JOIN (feedback FE INNER JOIN donnee DOFE ON(FE.donneeId=DOFE.id) INNER JOIN (pointfocal PF INNER JOIN sensibilite PFSE ON(PF.sensibiliteId=PFSE.id)) ON(FE.pointfocalId=PF.id) INNER JOIN (soumission SO INNER JOIN sensibilite SE ON(SO.sensibiliteId=SE.id) INNER JOIN donnee DOS ON(SO.donneeId=DOS.id) INNER JOIN (remonte RE INNER JOIN donnee DOR ON(RE.donneeId=DOR.id) INNER JOIN (rapportage RA INNER JOIN agent AG ON(RA.agentId=AG.id) INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(RA.projectId=PR.id) INNER JOIN (information INF INNER JOIN source SC ON(INF.sourceId=SC.id) INNER JOIN donnee DO ON(INF.donneeId=DO.id)) ON(RA.informationId=INF.id)) ON(RE.rapportageId=RA.id)) ON(SO.remonteId=RE.id)) ON(FE.soumissionId=SO.id)) ON(AF.feedbackId=FE.id) WHERE FE.id='{$feedbackId}' ORDER BY AF.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getAjusteById($ajusteId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT AF.id as afId,AF.dateHeureEnreg as afDateHeure,AF.niveauId as afNiveauId,DOAF.valeur as doafValeur,FE.id as feId,FE.dateHeureEnreg as feDateHeure,SO.id as soId,SO.dateHeureEnreg as soDateHeure,SO.needFeedback,RE.id as reId,RE.dateHeureEnreg as reDateHeure,RE.oldNiveauId,RE.newNiveauId,DOR.valeur as dorValeur,RA.id as raId,RA.dateHeureEnreg as raDateHeure,RA.subject,INF.id as infId,INF.dateEvent,INF.heure as infHeure,INF.lieu as infLieu,SC.id as scId,DO.id as doId,DO.valeur,PR.designation as prDesignation,PR.id as prId,OG.designation as ogDesignation,OG.id as ogId,DOS.valeur as dosValeur,SE.id as seId,SE.levelSensibilite,SE.designation as seDesignation,DOFE.valeur as dofeValeur,PF.identite as pfIdentite,PFSE.id as pfseId,PFSE.levelSensibilite as pfseLevelSensibilite,PFSE.designation as pfseDesignation,DOAF.valeur as doafValeur,RA.subject FROM ajustefeedback AF INNER JOIN donnee DOAF ON(AF.donneeId=DOAF.id) INNER JOIN (feedback FE INNER JOIN donnee DOFE ON(FE.donneeId=DOFE.id) INNER JOIN (pointfocal PF INNER JOIN sensibilite PFSE ON(PF.sensibiliteId=PFSE.id)) ON(FE.pointfocalId=PF.id) INNER JOIN (soumission SO INNER JOIN sensibilite SE ON(SO.sensibiliteId=SE.id) INNER JOIN donnee DOS ON(SO.donneeId=DOS.id) INNER JOIN (remonte RE INNER JOIN donnee DOR ON(RE.donneeId=DOR.id) INNER JOIN (rapportage RA INNER JOIN agent AG ON(RA.agentId=AG.id) INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(RA.projectId=PR.id) INNER JOIN (information INF INNER JOIN source SC ON(INF.sourceId=SC.id) INNER JOIN donnee DO ON(INF.donneeId=DO.id)) ON(RA.informationId=INF.id)) ON(RE.rapportageId=RA.id)) ON(SO.remonteId=RE.id)) ON(FE.soumissionId=SO.id)) ON(AF.feedbackId=FE.id) WHERE AF.id='{$ajusteId}' ORDER BY AF.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getAjusteByNiveauId($niveauId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT AF.id as afId,AF.dateHeureEnreg as afDateHeure,AF.niveauId as afNiveauId,DOAF.valeur as doafValeur,FE.id as feId,FE.dateHeureEnreg as feDateHeure,SO.id as soId,SO.dateHeureEnreg as soDateHeure,SO.needFeedback,RE.id as reId,RE.dateHeureEnreg as reDateHeure,RE.oldNiveauId,RE.newNiveauId,DOR.valeur as dorValeur,RA.id as raId,RA.dateHeureEnreg as raDateHeure,RA.subject,AG.identite as agIdentite,INF.id as infId,INF.dateEvent,INF.heure as infHeure,INF.lieu as infLieu,SC.id as scId,DO.id as doId,DO.valeur,PR.designation as prDesignation,PR.id as prId,OG.designation as ogDesignation,OG.id as ogId,DOS.valeur as dosValeur,SE.id as seId,SE.levelSensibilite,SE.designation as seDesignation,DOFE.valeur as dofeValeur,PF.identite as pfIdentite,PFSE.id as pfseId,PFSE.levelSensibilite as pfseLevelSensibilite,PFSE.designation as pfseDesignation,DOAF.valeur as doafValeur,RA.subject FROM ajustefeedback AF INNER JOIN donnee DOAF ON(AF.donneeId=DOAF.id) INNER JOIN (feedback FE INNER JOIN donnee DOFE ON(FE.donneeId=DOFE.id) INNER JOIN (pointfocal PF INNER JOIN sensibilite PFSE ON(PF.sensibiliteId=PFSE.id)) ON(FE.pointfocalId=PF.id) INNER JOIN (soumission SO INNER JOIN sensibilite SE ON(SO.sensibiliteId=SE.id) INNER JOIN donnee DOS ON(SO.donneeId=DOS.id) INNER JOIN (remonte RE INNER JOIN donnee DOR ON(RE.donneeId=DOR.id) INNER JOIN (rapportage RA INNER JOIN agent AG ON(RA.agentId=AG.id) INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(RA.projectId=PR.id) INNER JOIN (information INF INNER JOIN source SC ON(INF.sourceId=SC.id) INNER JOIN donnee DO ON(INF.donneeId=DO.id)) ON(RA.informationId=INF.id)) ON(RE.rapportageId=RA.id)) ON(SO.remonteId=RE.id)) ON(FE.soumissionId=SO.id)) ON(AF.feedbackId=FE.id) WHERE AF.niveauId='{$niveauId}' ORDER BY AF.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getAjusteByNiveauIdByProjectId($niveauId,$projectId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT AF.id as afId,AF.dateHeureEnreg as afDateHeure,AF.niveauId as afNiveauId,DOAF.valeur as doafValeur,FE.id as feId,FE.dateHeureEnreg as feDateHeure,SO.id as soId,SO.dateHeureEnreg as soDateHeure,SO.needFeedback,RE.id as reId,RE.dateHeureEnreg as reDateHeure,RE.oldNiveauId,RE.newNiveauId,DOR.valeur as dorValeur,RA.id as raId,RA.dateHeureEnreg as raDateHeure,RA.subject,AG.identite as agIdentite,INF.id as infId,INF.dateEvent,INF.heure as infHeure,INF.lieu as infLieu,SC.id as scId,DO.id as doId,DO.valeur,PR.designation as prDesignation,PR.id as prId,OG.designation as ogDesignation,OG.id as ogId,DOS.valeur as dosValeur,SE.id as seId,SE.levelSensibilite,SE.designation as seDesignation,DOFE.valeur as dofeValeur,PF.identite as pfIdentite,PFSE.id as pfseId,PFSE.levelSensibilite as pfseLevelSensibilite,PFSE.designation as pfseDesignation,DOAF.valeur as doafValeur,RA.subject FROM ajustefeedback AF INNER JOIN donnee DOAF ON(AF.donneeId=DOAF.id) INNER JOIN (feedback FE INNER JOIN donnee DOFE ON(FE.donneeId=DOFE.id) INNER JOIN (pointfocal PF INNER JOIN sensibilite PFSE ON(PF.sensibiliteId=PFSE.id)) ON(FE.pointfocalId=PF.id) INNER JOIN (soumission SO INNER JOIN sensibilite SE ON(SO.sensibiliteId=SE.id) INNER JOIN donnee DOS ON(SO.donneeId=DOS.id) INNER JOIN (remonte RE INNER JOIN donnee DOR ON(RE.donneeId=DOR.id) INNER JOIN (rapportage RA INNER JOIN agent AG ON(RA.agentId=AG.id) INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(RA.projectId=PR.id) INNER JOIN (information INF INNER JOIN source SC ON(INF.sourceId=SC.id) INNER JOIN donnee DO ON(INF.donneeId=DO.id)) ON(RA.informationId=INF.id)) ON(RE.rapportageId=RA.id)) ON(SO.remonteId=RE.id)) ON(FE.soumissionId=SO.id)) ON(AF.feedbackId=FE.id) WHERE AF.niveauId='{$niveauId}' AND PR.id='{$projectId}' ORDER BY AF.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getAjusteByNiveauIdById($niveauId,$ajusteId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT AF.id as afId,AF.dateHeureEnreg as afDateHeure,AF.niveauId as afNiveauId,DOAF.valeur as doafValeur,FE.id as feId,FE.dateHeureEnreg as feDateHeure,SO.id as soId,SO.dateHeureEnreg as soDateHeure,SO.needFeedback,RE.id as reId,RE.dateHeureEnreg as reDateHeure,RE.oldNiveauId,RE.newNiveauId,DOR.valeur as dorValeur,RA.id as raId,RA.dateHeureEnreg as raDateHeure,RA.subject,AG.identite as agIdentite,INF.id as infId,INF.dateEvent,INF.heure as infHeure,INF.lieu as infLieu,SC.id as scId,DO.id as doId,DO.valeur,PR.designation as prDesignation,PR.id as prId,OG.designation as ogDesignation,OG.id as ogId,DOS.valeur as dosValeur,SE.id as seId,SE.levelSensibilite,SE.designation as seDesignation,DOFE.valeur as dofeValeur,PF.identite as pfIdentite,PFSE.id as pfseId,PFSE.levelSensibilite as pfseLevelSensibilite,PFSE.designation as pfseDesignation,DOAF.valeur as doafValeur,RA.subject FROM ajustefeedback AF INNER JOIN donnee DOAF ON(AF.donneeId=DOAF.id) INNER JOIN (feedback FE INNER JOIN donnee DOFE ON(FE.donneeId=DOFE.id) INNER JOIN (pointfocal PF INNER JOIN sensibilite PFSE ON(PF.sensibiliteId=PFSE.id)) ON(FE.pointfocalId=PF.id) INNER JOIN (soumission SO INNER JOIN sensibilite SE ON(SO.sensibiliteId=SE.id) INNER JOIN donnee DOS ON(SO.donneeId=DOS.id) INNER JOIN (remonte RE INNER JOIN donnee DOR ON(RE.donneeId=DOR.id) INNER JOIN (rapportage RA INNER JOIN agent AG ON(RA.agentId=AG.id) INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(RA.projectId=PR.id) INNER JOIN (information INF INNER JOIN source SC ON(INF.sourceId=SC.id) INNER JOIN donnee DO ON(INF.donneeId=DO.id)) ON(RA.informationId=INF.id)) ON(RE.rapportageId=RA.id)) ON(SO.remonteId=RE.id)) ON(FE.soumissionId=SO.id)) ON(AF.feedbackId=FE.id) WHERE AF.niveauId='{$niveauId}' AND AF.id='{$ajusteId}' ORDER BY AF.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getAjusteByNiveauIdByIdByProjectId($niveauId,$ajusteId,$projectId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT AF.id as afId,AF.dateHeureEnreg as afDateHeure,AF.niveauId as afNiveauId,DOAF.valeur as doafValeur,FE.id as feId,FE.dateHeureEnreg as feDateHeure,SO.id as soId,SO.dateHeureEnreg as soDateHeure,SO.needFeedback,RE.id as reId,RE.dateHeureEnreg as reDateHeure,RE.oldNiveauId,RE.newNiveauId,DOR.valeur as dorValeur,RA.id as raId,RA.dateHeureEnreg as raDateHeure,RA.subject,AG.identite as agIdentite,INF.id as infId,INF.dateEvent,INF.heure as infHeure,INF.lieu as infLieu,SC.id as scId,DO.id as doId,DO.valeur,PR.designation as prDesignation,PR.id as prId,OG.designation as ogDesignation,OG.id as ogId,DOS.valeur as dosValeur,SE.id as seId,SE.levelSensibilite,SE.designation as seDesignation,DOFE.valeur as dofeValeur,PF.identite as pfIdentite,PFSE.id as pfseId,PFSE.levelSensibilite as pfseLevelSensibilite,PFSE.designation as pfseDesignation,DOAF.valeur as doafValeur,RA.subject FROM ajustefeedback AF INNER JOIN donnee DOAF ON(AF.donneeId=DOAF.id) INNER JOIN (feedback FE INNER JOIN donnee DOFE ON(FE.donneeId=DOFE.id) INNER JOIN (pointfocal PF INNER JOIN sensibilite PFSE ON(PF.sensibiliteId=PFSE.id)) ON(FE.pointfocalId=PF.id) INNER JOIN (soumission SO INNER JOIN sensibilite SE ON(SO.sensibiliteId=SE.id) INNER JOIN donnee DOS ON(SO.donneeId=DOS.id) INNER JOIN (remonte RE INNER JOIN donnee DOR ON(RE.donneeId=DOR.id) INNER JOIN (rapportage RA INNER JOIN agent AG ON(RA.agentId=AG.id) INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(RA.projectId=PR.id) INNER JOIN (information INF INNER JOIN source SC ON(INF.sourceId=SC.id) INNER JOIN donnee DO ON(INF.donneeId=DO.id)) ON(RA.informationId=INF.id)) ON(RE.rapportageId=RA.id)) ON(SO.remonteId=RE.id)) ON(FE.soumissionId=SO.id)) ON(AF.feedbackId=FE.id) WHERE AF.niveauId='{$niveauId}' AND AF.id='{$ajusteId}' AND PR.id='{$projectId}' ORDER BY AF.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }
        
}