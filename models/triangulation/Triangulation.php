<?php



class Triangulation
{
    function addTriangulation($agentId,$niveauId,$keyinformantId,$forInformationId,$gainInformationId)
    {
        try {
            $query = iespConnection::connect()->prepare("INSERT INTO triangulation(dateHeureEnreg,agentId,niveauId,keyinformantId,forInformationId,gainInformationId) VALUES(?,?,?,?,?,?)");
            $query->execute([date('Y-m-d H:i:s'),$agentId,$niveauId,$keyinformantId,$forInformationId,$gainInformationId]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    function getTriangulationAll()
    {
        try {
            $data = iespConnection::connect()->query("SELECT TR.id as trId,TR.dateHeureEnreg as trDateHeure,INF1.id as infId1,INF1.dateEvent as dateEvent1,INF1.heure as infHeure1,INF1.lieu as infLieu1,SC1.id as scId1,DO1.id as doId1,DO1.valeur as doValeur1,INF2.id as infId2,INF2.dateEvent as dateEvent2,INF2.heure as infHeure2,INF2.lieu as infLieu2,SC2.id as scId2,DO2.id as doId2,DO2.valeur as doValeur2,KI.id as kiId,KI.identite as kiIdentite,KI.contact as kiContact,KI.genre as kiGenre,KI.adresse as kiAdresse,KI.profession as kiProfession,NV.id as nvId,NV.levelNiveau,NV.designation as nvDesignation,NV.forValidation,RA.subject,AG.id as tragId,AG.identite as tragIdentite FROM triangulation TR INNER JOIN agent AG ON(TR.agentId=AG.id) INNER JOIN niveau NV ON(TR.niveauId=NV.id) INNER JOIN keyinformant KI ON(TR.keyinformantId=KI.id) INNER JOIN rapportage RA ON(TR.forInformationId=RA.informationId) INNER JOIN (information INF1 INNER JOIN source SC1 ON(INF1.sourceId=SC1.id) INNER JOIN donnee DO1 ON(INF1.donneeId=DO1.id)) ON(TR.forInformationId=INF1.id) INNER JOIN (information INF2 INNER JOIN source SC2 ON(INF2.sourceId=SC2.id) INNER JOIN donnee DO2 ON(INF2.donneeId=DO2.id)) ON(TR.gainInformationId=INF2.id) ORDER BY TR.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getTriangulationByRapportageId($rapportageId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT TR.id as trId,TR.dateHeureEnreg as trDateHeure,INF1.id as infId1,INF1.dateEvent as dateEvent1,INF1.heure as infHeure1,INF1.lieu as infLieu1,SC1.id as scId1,DO1.id as doId1,DO1.valeur as doValeur1,INF2.id as infId2,INF2.dateEvent as dateEvent2,INF2.heure as infHeure2,INF2.lieu as infLieu2,SC2.id as scId2,DO2.id as doId2,DO2.valeur as doValeur2,KI.id as kiId,KI.identite as kiIdentite,KI.contact as kiContact,KI.genre as kiGenre,KI.adresse as kiAdresse,KI.profession as kiProfession,NV.id as nvId,NV.levelNiveau,NV.designation as nvDesignation,NV.forValidation,RA.subject,AG.id as tragId,AG.identite as tragIdentite FROM triangulation TR INNER JOIN agent AG ON(TR.agentId=AG.id) INNER JOIN niveau NV ON(TR.niveauId=NV.id) INNER JOIN keyinformant KI ON(TR.keyinformantId=KI.id) INNER JOIN rapportage RA ON(TR.forInformationId=RA.informationId) INNER JOIN (information INF1 INNER JOIN source SC1 ON(INF1.sourceId=SC1.id) INNER JOIN donnee DO1 ON(INF1.donneeId=DO1.id)) ON(TR.forInformationId=INF1.id) INNER JOIN (information INF2 INNER JOIN source SC2 ON(INF2.sourceId=SC2.id) INNER JOIN donnee DO2 ON(INF2.donneeId=DO2.id)) ON(TR.gainInformationId=INF2.id) WHERE RA.id='{$rapportageId}' ORDER BY TR.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    

    function getTriangulationByRapportageIdById($rapportageId,$triangulationId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT TR.id as trId,TR.dateHeureEnreg as trDateHeure,INF1.id as infId1,INF1.dateEvent as dateEvent1,INF1.heure as infHeure1,INF1.lieu as infLieu1,SC1.id as scId1,DO1.id as doId1,DO1.valeur as doValeur1,INF2.id as infId2,INF2.dateEvent as dateEvent2,INF2.heure as infHeure2,INF2.lieu as infLieu2,SC2.id as scId2,DO2.id as doId2,DO2.valeur as doValeur2,KI.id as kiId,KI.identite as kiIdentite,KI.contact as kiContact,KI.genre as kiGenre,KI.adresse as kiAdresse,KI.profession as kiProfession,NV.id as nvId,NV.levelNiveau,NV.designation as nvDesignation,NV.forValidation,RA.subject,AG.id as tragId,AG.identite as tragIdentite FROM triangulation TR INNER JOIN agent AG ON(TR.agentId=AG.id) INNER JOIN niveau NV ON(TR.niveauId=NV.id) INNER JOIN keyinformant KI ON(TR.keyinformantId=KI.id) INNER JOIN rapportage RA ON(TR.forInformationId=RA.informationId) INNER JOIN (information INF1 INNER JOIN source SC1 ON(INF1.sourceId=SC1.id) INNER JOIN donnee DO1 ON(INF1.donneeId=DO1.id)) ON(TR.forInformationId=INF1.id) INNER JOIN (information INF2 INNER JOIN source SC2 ON(INF2.sourceId=SC2.id) INNER JOIN donnee DO2 ON(INF2.donneeId=DO2.id)) ON(TR.gainInformationId=INF2.id) WHERE RA.id='{$rapportageId}' AND TR.id='{$triangulationId}' ORDER BY TR.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    

    function getTriangulationById($triangulationId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT TR.id as trId,TR.dateHeureEnreg as trDateHeure,INF1.id as infId1,INF1.dateEvent as dateEvent1,INF1.heure as infHeure1,INF1.lieu as infLieu1,SC1.id as scId1,DO1.id as doId1,DO1.valeur as doValeur1,INF2.id as infId2,INF2.dateEvent as dateEvent2,INF2.heure as infHeure2,INF2.lieu as infLieu2,SC2.id as scId2,DO2.id as doId2,DO2.valeur as doValeur2,KI.id as kiId,KI.identite as kiIdentite,KI.contact as kiContact,KI.genre as kiGenre,KI.adresse as kiAdresse,KI.profession as kiProfession,NV.id as nvId,NV.levelNiveau,NV.designation as nvDesignation,NV.forValidation,RA.subject,AG.id as tragId,AG.identite as tragIdentite FROM triangulation TR INNER JOIN agent AG ON(TR.agentId=AG.id) INNER JOIN niveau NV ON(TR.niveauId=NV.id) INNER JOIN keyinformant KI ON(TR.keyinformantId=KI.id) INNER JOIN rapportage RA ON(TR.forInformationId=RA.informationId) INNER JOIN (information INF1 INNER JOIN source SC1 ON(INF1.sourceId=SC1.id) INNER JOIN donnee DO1 ON(INF1.donneeId=DO1.id)) ON(TR.forInformationId=INF1.id) INNER JOIN (information INF2 INNER JOIN source SC2 ON(INF2.sourceId=SC2.id) INNER JOIN donnee DO2 ON(INF2.donneeId=DO2.id)) ON(TR.gainInformationId=INF2.id) WHERE TR.id='{$triangulationId}' ORDER BY TR.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    
}