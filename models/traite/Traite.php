<?php



class Traite
{
    function addTraite($etat,$commentaire,$agentId,$ajusteFeedbackId)
    {
        try {
            $query = iespConnection::connect()->prepare("INSERT INTO traitefeedback(dateHeureEnreg,etat,commentaire,agentId,ajusteFeedbackId) VALUES(?,?,?,?,?)");
            $query->execute([date('Y-m-d H:i:s'),$etat,$commentaire,$agentId,$ajusteFeedbackId]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function getTraiteAll()
    {
        try {
            $data = iespConnection::connect()->query("SELECT TF.id as tfId,TF.dateHeureEnreg as tfDateHeure,TF.commentaire as tfCommentaire,TF.etat as tfEtat,AF.id as afId,AF.dateHeureEnreg as afDateHeure,AF.niveauId as afNiveauId,DOAF.valeur as doafValeur,FE.id as feId,FE.dateHeureEnreg as feDateHeure,SO.id as soId,SO.dateHeureEnreg as soDateHeure,SO.needFeedback,RE.id as reId,RE.dateHeureEnreg as reDateHeure,RE.oldNiveauId,RE.newNiveauId,DOR.valeur as dorValeur,RA.id as raId,RA.dateHeureEnreg as raDateHeure,RA.subject,INF.id as infId,INF.dateEvent,INF.heure as infHeure,INF.lieu as infLieu,SC.id as scId,DO.id as doId,DO.valeur,PR.designation as prDesignation,PR.id as prId,OG.designation as ogDesignation,OG.id as ogId,DOS.valeur as dosValeur,SE.id as seId,SE.levelSensibilite,SE.designation as seDesignation,DOFE.valeur as dofeValeur,PF.identite as pfIdentite,PFSE.id as pfseId,PFSE.levelSensibilite as pfseLevelSensibilite,PFSE.designation as pfseDesignation,AG.identite as agIdentite,AGTF.identite as agtfIdentite FROM traitefeedback TF INNER JOIN agent AGTF ON(TF.agentId=AGTF.id) INNER JOIN (ajustefeedback AF INNER JOIN donnee DOAF ON(AF.donneeId=DOAF.id) INNER JOIN (feedback FE INNER JOIN donnee DOFE ON(FE.donneeId=DOFE.id) INNER JOIN (pointfocal PF INNER JOIN sensibilite PFSE ON(PF.sensibiliteId=PFSE.id)) ON(FE.pointfocalId=PF.id) INNER JOIN (soumission SO INNER JOIN sensibilite SE ON(SO.sensibiliteId=SE.id) INNER JOIN donnee DOS ON(SO.donneeId=DOS.id) INNER JOIN (remonte RE INNER JOIN donnee DOR ON(RE.donneeId=DOR.id) INNER JOIN (rapportage RA INNER JOIN agent AG ON(RA.agentId=AG.id) INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(RA.projectId=PR.id) INNER JOIN (information INF INNER JOIN source SC ON(INF.sourceId=SC.id) INNER JOIN donnee DO ON(INF.donneeId=DO.id)) ON(RA.informationId=INF.id)) ON(RE.rapportageId=RA.id)) ON(SO.remonteId=RE.id)) ON(FE.soumissionId=SO.id)) ON(AF.feedbackId=FE.id)) ON(TF.ajusteFeedbackId=AF.id) ORDER BY TF.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getTraiteById($traiteId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT TF.id as tfId,TF.dateHeureEnreg as tfDateHeure,TF.commentaire as tfCommentaire,AF.id as afId,AF.id as afId,AF.dateHeureEnreg as afDateHeure,AF.niveauId as afNiveauId,DOAF.valeur as doafValeur,FE.id as feId,FE.dateHeureEnreg as feDateHeure,SO.id as soId,SO.dateHeureEnreg as soDateHeure,SO.needFeedback,RE.id as reId,RE.dateHeureEnreg as reDateHeure,RE.oldNiveauId,RE.newNiveauId,DOR.valeur as dorValeur,RA.id as raId,RA.dateHeureEnreg as raDateHeure,RA.subject,INF.id as infId,INF.dateEvent,INF.heure as infHeure,INF.lieu as infLieu,SC.id as scId,DO.id as doId,DO.valeur,PR.designation as prDesignation,PR.id as prId,OG.designation as ogDesignation,OG.id as ogId,DOS.valeur as dosValeur,SE.id as seId,SE.levelSensibilite,SE.designation as seDesignation,DOFE.valeur as dofeValeur,PF.identite as pfIdentite,PFSE.id as pfseId,PFSE.levelSensibilite as pfseLevelSensibilite,PFSE.designation as pfseDesignation,AG.identite as agIdentite,AGTF.identite as agtfIdentite FROM traitefeedback TF INNER JOIN agent AGTF ON(TF.agentId=AGTF.id) INNER JOIN (ajustefeedback AF INNER JOIN donnee DOAF ON(AF.donneeId=DOAF.id) INNER JOIN (feedback FE INNER JOIN donnee DOFE ON(FE.donneeId=DOFE.id) INNER JOIN (pointfocal PF INNER JOIN sensibilite PFSE ON(PF.sensibiliteId=PFSE.id)) ON(FE.pointfocalId=PF.id) INNER JOIN (soumission SO INNER JOIN sensibilite SE ON(SO.sensibiliteId=SE.id) INNER JOIN donnee DOS ON(SO.donneeId=DOS.id) INNER JOIN (remonte RE INNER JOIN donnee DOR ON(RE.donneeId=DOR.id) INNER JOIN (rapportage RA INNER JOIN agent AG ON(RA.agentId=AG.id) INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(RA.projectId=PR.id) INNER JOIN (information INF INNER JOIN source SC ON(INF.sourceId=SC.id) INNER JOIN donnee DO ON(INF.donneeId=DO.id)) ON(RA.informationId=INF.id)) ON(RE.rapportageId=RA.id)) ON(SO.remonteId=RE.id)) ON(FE.soumissionId=SO.id)) ON(AF.feedbackId=FE.id)) ON(TF.ajusteFeedbackId=AF.id) WHERE TF.id='{$traiteId}' ORDER BY TF.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getTraiteByAjusteId($ajusteId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT TF.id as tfId,TF.dateHeureEnreg as tfDateHeure,TF.commentaire as tfCommentaire,TF.etat as tfEtat,AF.id as afId,AF.dateHeureEnreg as afDateHeure,AF.niveauId as afNiveauId,DOAF.valeur as doafValeur,FE.id as feId,FE.dateHeureEnreg as feDateHeure,SO.id as soId,SO.dateHeureEnreg as soDateHeure,SO.needFeedback,RE.id as reId,RE.dateHeureEnreg as reDateHeure,RE.oldNiveauId,RE.newNiveauId,DOR.valeur as dorValeur,RA.id as raId,RA.dateHeureEnreg as raDateHeure,RA.subject,INF.id as infId,INF.dateEvent,INF.heure as infHeure,INF.lieu as infLieu,SC.id as scId,DO.id as doId,DO.valeur,PR.designation as prDesignation,PR.id as prId,OG.designation as ogDesignation,OG.id as ogId,DOS.valeur as dosValeur,SE.id as seId,SE.levelSensibilite,SE.designation as seDesignation,DOFE.valeur as dofeValeur,PF.identite as pfIdentite,PFSE.id as pfseId,PFSE.levelSensibilite as pfseLevelSensibilite,PFSE.designation as pfseDesignation,AG.identite as agIdentite,AGTF.identite as agtfIdentite FROM traitefeedback TF INNER JOIN agent AGTF ON(TF.agentId=AGTF.id) INNER JOIN (ajustefeedback AF INNER JOIN donnee DOAF ON(AF.donneeId=DOAF.id) INNER JOIN (feedback FE INNER JOIN donnee DOFE ON(FE.donneeId=DOFE.id) INNER JOIN (pointfocal PF INNER JOIN sensibilite PFSE ON(PF.sensibiliteId=PFSE.id)) ON(FE.pointfocalId=PF.id) INNER JOIN (soumission SO INNER JOIN sensibilite SE ON(SO.sensibiliteId=SE.id) INNER JOIN donnee DOS ON(SO.donneeId=DOS.id) INNER JOIN (remonte RE INNER JOIN donnee DOR ON(RE.donneeId=DOR.id) INNER JOIN (rapportage RA INNER JOIN agent AG ON(RA.agentId=AG.id) INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(RA.projectId=PR.id) INNER JOIN (information INF INNER JOIN source SC ON(INF.sourceId=SC.id) INNER JOIN donnee DO ON(INF.donneeId=DO.id)) ON(RA.informationId=INF.id)) ON(RE.rapportageId=RA.id)) ON(SO.remonteId=RE.id)) ON(FE.soumissionId=SO.id)) ON(AF.feedbackId=FE.id)) ON(TF.ajusteFeedbackId=AF.id) WHERE AF.id='{$ajusteId}' ORDER BY TF.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getTraiteByProjectId($projectId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT TF.id as tfId,TF.dateHeureEnreg as tfDateHeure,TF.commentaire as tfCommentaire,TF.etat as tfEtat,AF.id as afId,AF.dateHeureEnreg as afDateHeure,AF.niveauId as afNiveauId,DOAF.valeur as doafValeur,FE.id as feId,FE.dateHeureEnreg as feDateHeure,SO.id as soId,SO.dateHeureEnreg as soDateHeure,SO.needFeedback,RE.id as reId,RE.dateHeureEnreg as reDateHeure,RE.oldNiveauId,RE.newNiveauId,DOR.valeur as dorValeur,RA.id as raId,RA.dateHeureEnreg as raDateHeure,RA.subject,INF.id as infId,INF.dateEvent,INF.heure as infHeure,INF.lieu as infLieu,SC.id as scId,DO.id as doId,DO.valeur,PR.designation as prDesignation,PR.id as prId,OG.designation as ogDesignation,OG.id as ogId,DOS.valeur as dosValeur,SE.id as seId,SE.levelSensibilite,SE.designation as seDesignation,DOFE.valeur as dofeValeur,PF.identite as pfIdentite,PFSE.id as pfseId,PFSE.levelSensibilite as pfseLevelSensibilite,PFSE.designation as pfseDesignation,AG.identite as agIdentite,AGTF.identite as agtfIdentite FROM traitefeedback TF INNER JOIN agent AGTF ON(TF.agentId=AGTF.id) INNER JOIN (ajustefeedback AF INNER JOIN donnee DOAF ON(AF.donneeId=DOAF.id) INNER JOIN (feedback FE INNER JOIN donnee DOFE ON(FE.donneeId=DOFE.id) INNER JOIN (pointfocal PF INNER JOIN sensibilite PFSE ON(PF.sensibiliteId=PFSE.id)) ON(FE.pointfocalId=PF.id) INNER JOIN (soumission SO INNER JOIN sensibilite SE ON(SO.sensibiliteId=SE.id) INNER JOIN donnee DOS ON(SO.donneeId=DOS.id) INNER JOIN (remonte RE INNER JOIN donnee DOR ON(RE.donneeId=DOR.id) INNER JOIN (rapportage RA INNER JOIN agent AG ON(RA.agentId=AG.id) INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(RA.projectId=PR.id) INNER JOIN (information INF INNER JOIN source SC ON(INF.sourceId=SC.id) INNER JOIN donnee DO ON(INF.donneeId=DO.id)) ON(RA.informationId=INF.id)) ON(RE.rapportageId=RA.id)) ON(SO.remonteId=RE.id)) ON(FE.soumissionId=SO.id)) ON(AF.feedbackId=FE.id)) ON(TF.ajusteFeedbackId=AF.id) WHERE PR.id='{$projectId}' ORDER BY TF.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getTraiteByProjectIdByEtat($projectId,$etat)
    {
        try {
            $data = iespConnection::connect()->query("SELECT TF.id as tfId,TF.dateHeureEnreg as tfDateHeure,TF.commentaire as tfCommentaire,TF.etat as tfEtat,AF.id as afId,AF.dateHeureEnreg as afDateHeure,AF.niveauId as afNiveauId,DOAF.valeur as doafValeur,FE.id as feId,FE.dateHeureEnreg as feDateHeure,SO.id as soId,SO.dateHeureEnreg as soDateHeure,SO.needFeedback,RE.id as reId,RE.dateHeureEnreg as reDateHeure,RE.oldNiveauId,RE.newNiveauId,DOR.valeur as dorValeur,RA.id as raId,RA.dateHeureEnreg as raDateHeure,RA.subject,INF.id as infId,INF.dateEvent,INF.heure as infHeure,INF.lieu as infLieu,SC.id as scId,DO.id as doId,DO.valeur,PR.designation as prDesignation,PR.id as prId,OG.designation as ogDesignation,OG.id as ogId,DOS.valeur as dosValeur,SE.id as seId,SE.levelSensibilite,SE.designation as seDesignation,DOFE.valeur as dofeValeur,PF.identite as pfIdentite,PFSE.id as pfseId,PFSE.levelSensibilite as pfseLevelSensibilite,PFSE.designation as pfseDesignation,AG.identite as agIdentite,AGTF.identite as agtfIdentite FROM traitefeedback TF INNER JOIN agent AGTF ON(TF.agentId=AGTF.id) INNER JOIN (ajustefeedback AF INNER JOIN donnee DOAF ON(AF.donneeId=DOAF.id) INNER JOIN (feedback FE INNER JOIN donnee DOFE ON(FE.donneeId=DOFE.id) INNER JOIN (pointfocal PF INNER JOIN sensibilite PFSE ON(PF.sensibiliteId=PFSE.id)) ON(FE.pointfocalId=PF.id) INNER JOIN (soumission SO INNER JOIN sensibilite SE ON(SO.sensibiliteId=SE.id) INNER JOIN donnee DOS ON(SO.donneeId=DOS.id) INNER JOIN (remonte RE INNER JOIN donnee DOR ON(RE.donneeId=DOR.id) INNER JOIN (rapportage RA INNER JOIN agent AG ON(RA.agentId=AG.id) INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(RA.projectId=PR.id) INNER JOIN (information INF INNER JOIN source SC ON(INF.sourceId=SC.id) INNER JOIN donnee DO ON(INF.donneeId=DO.id)) ON(RA.informationId=INF.id)) ON(RE.rapportageId=RA.id)) ON(SO.remonteId=RE.id)) ON(FE.soumissionId=SO.id)) ON(AF.feedbackId=FE.id)) ON(TF.ajusteFeedbackId=AF.id) WHERE PR.id='{$projectId}' AND TF.etat='{$etat}' ORDER BY TF.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getTraiteByEtat($etat)
    {
        try {
            $data = iespConnection::connect()->query("SELECT TF.id as tfId,TF.dateHeureEnreg as tfDateHeure,TF.commentaire as tfCommentaire,TF.etat as tfEtat,AF.id as afId,AF.dateHeureEnreg as afDateHeure,AF.niveauId as afNiveauId,DOAF.valeur as doafValeur,FE.id as feId,FE.dateHeureEnreg as feDateHeure,SO.id as soId,SO.dateHeureEnreg as soDateHeure,SO.needFeedback,RE.id as reId,RE.dateHeureEnreg as reDateHeure,RE.oldNiveauId,RE.newNiveauId,DOR.valeur as dorValeur,RA.id as raId,RA.dateHeureEnreg as raDateHeure,RA.subject,INF.id as infId,INF.dateEvent,INF.heure as infHeure,INF.lieu as infLieu,SC.id as scId,DO.id as doId,DO.valeur,PR.designation as prDesignation,PR.id as prId,OG.designation as ogDesignation,OG.id as ogId,DOS.valeur as dosValeur,SE.id as seId,SE.levelSensibilite,SE.designation as seDesignation,DOFE.valeur as dofeValeur,PF.identite as pfIdentite,PFSE.id as pfseId,PFSE.levelSensibilite as pfseLevelSensibilite,PFSE.designation as pfseDesignation,AG.identite as agIdentite,AGTF.identite as agtfIdentite FROM traitefeedback TF INNER JOIN agent AGTF ON(TF.agentId=AGTF.id) INNER JOIN (ajustefeedback AF INNER JOIN donnee DOAF ON(AF.donneeId=DOAF.id) INNER JOIN (feedback FE INNER JOIN donnee DOFE ON(FE.donneeId=DOFE.id) INNER JOIN (pointfocal PF INNER JOIN sensibilite PFSE ON(PF.sensibiliteId=PFSE.id)) ON(FE.pointfocalId=PF.id) INNER JOIN (soumission SO INNER JOIN sensibilite SE ON(SO.sensibiliteId=SE.id) INNER JOIN donnee DOS ON(SO.donneeId=DOS.id) INNER JOIN (remonte RE INNER JOIN donnee DOR ON(RE.donneeId=DOR.id) INNER JOIN (rapportage RA INNER JOIN agent AG ON(RA.agentId=AG.id) INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(RA.projectId=PR.id) INNER JOIN (information INF INNER JOIN source SC ON(INF.sourceId=SC.id) INNER JOIN donnee DO ON(INF.donneeId=DO.id)) ON(RA.informationId=INF.id)) ON(RE.rapportageId=RA.id)) ON(SO.remonteId=RE.id)) ON(FE.soumissionId=SO.id)) ON(AF.feedbackId=FE.id)) ON(TF.ajusteFeedbackId=AF.id) WHERE TF.etat='{$etat}' ORDER BY TF.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getTraiteByAgentId($agentId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT TF.id as tfId,TF.dateHeureEnreg as tfDateHeure,TF.commentaire as tfCommentaire,TF.etat as tfEtat,AF.id as afId,AF.dateHeureEnreg as afDateHeure,AF.niveauId as afNiveauId,DOAF.valeur as doafValeur,FE.id as feId,FE.dateHeureEnreg as feDateHeure,SO.id as soId,SO.dateHeureEnreg as soDateHeure,SO.needFeedback,RE.id as reId,RE.dateHeureEnreg as reDateHeure,RE.oldNiveauId,RE.newNiveauId,DOR.valeur as dorValeur,RA.id as raId,RA.dateHeureEnreg as raDateHeure,RA.subject,INF.id as infId,INF.dateEvent,INF.heure as infHeure,INF.lieu as infLieu,SC.id as scId,DO.id as doId,DO.valeur,PR.designation as prDesignation,PR.id as prId,OG.designation as ogDesignation,OG.id as ogId,DOS.valeur as dosValeur,SE.id as seId,SE.levelSensibilite,SE.designation as seDesignation,DOFE.valeur as dofeValeur,PF.identite as pfIdentite,PFSE.id as pfseId,PFSE.levelSensibilite as pfseLevelSensibilite,PFSE.designation as pfseDesignation,AG.identite as agIdentite,AGTF.identite as agtfIdentite FROM traitefeedback TF INNER JOIN agent AGTF ON(TF.agentId=AGTF.id) INNER JOIN (ajustefeedback AF INNER JOIN donnee DOAF ON(AF.donneeId=DOAF.id) INNER JOIN (feedback FE INNER JOIN donnee DOFE ON(FE.donneeId=DOFE.id) INNER JOIN (pointfocal PF INNER JOIN sensibilite PFSE ON(PF.sensibiliteId=PFSE.id)) ON(FE.pointfocalId=PF.id) INNER JOIN (soumission SO INNER JOIN sensibilite SE ON(SO.sensibiliteId=SE.id) INNER JOIN donnee DOS ON(SO.donneeId=DOS.id) INNER JOIN (remonte RE INNER JOIN donnee DOR ON(RE.donneeId=DOR.id) INNER JOIN (rapportage RA INNER JOIN agent AG ON(RA.agentId=AG.id) INNER JOIN (project PR INNER JOIN organisation OG ON(PR.organisationId=OG.id)) ON(RA.projectId=PR.id) INNER JOIN (information INF INNER JOIN source SC ON(INF.sourceId=SC.id) INNER JOIN donnee DO ON(INF.donneeId=DO.id)) ON(RA.informationId=INF.id)) ON(RE.rapportageId=RA.id)) ON(SO.remonteId=RE.id)) ON(FE.soumissionId=SO.id)) ON(AF.feedbackId=FE.id)) ON(TF.ajusteFeedbackId=AF.id) WHERE AGTF.id='{$agentId}' ORDER BY TF.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    

    
        
}