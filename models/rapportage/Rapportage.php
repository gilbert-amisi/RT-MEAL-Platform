<?php



class Rapportage
{
    function addRapportage($dateHeureEnreg,$subject,$informationId,$agentId,$projectId)
    {
        try {
            $query = iespConnection::connect()->prepare("INSERT INTO rapportage(dateHeureEnreg,subject,informationId,agentId,projectId) VALUES(?,?,?,?,?)");
            $query->execute([$dateHeureEnreg,$subject,$informationId,$agentId,$projectId]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    function getRapportageAll()
    {
        try {
            $data = iespConnection::connect()->query("SELECT RA.id as raId,RA.dateHeureEnreg as raDateHeure,RA.subject,INF.id as infId,INF.dateEvent,INF.heure as infHeure,INF.lieu as infLieu,SC.id as scId,DO.id as doId,DO.valeur FROM rapportage RA INNER JOIN agent AG ON(RA.agentId=AG.id) INNER JOIN project PR ON(RA.projectId=PR.id) INNER JOIN (information INF INNER JOIN source SC ON(INF.sourceId=SC.id) INNER JOIN donnee DO ON(INF.donneeId=DO.id)) ON(RA.informationId=INF.id) ORDER BY RA.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getRapportageByProjectId($projectId)
    {
        try {
            // $data = iespConnection::connect()->query("SELECT RA.id as raId,RA.dateHeureEnreg as raDateHeure,RA.subject,INF.id as infId,INF.dateEvent,INF.heure as infHeure,INF.lieu as infLieu,SC.id as scId,DO.id as doId,DO.valeur FROM rapportage RA INNER JOIN agent AG ON(RA.agentId=AG.id) INNER JOIN project PR ON(RA.projectId=PR.id) INNER JOIN (information INF INNER JOIN source SC ON(INF.sourceId=SC.id) INNER JOIN donnee DO ON(INF.donneeId=DO.id)) ON(RA.informationId=INF.id) WHERE RA.projectId='{$projectId}' ORDER BY RA.id DESC");
            $data = iespConnection::connect()->query("SELECT RA.id as raId,RA.dateHeureEnreg as raDateHeure,RA.subject,INF.id as infId,INF.dateEvent,INF.heure as infHeure,INF.lieu as infLieu,SC.id as scId,DO.id as doId,DO.valeur, AG.compteId as agentId FROM rapportage RA INNER JOIN agent AG ON(RA.agentId=AG.id) INNER JOIN project PR ON(RA.projectId=PR.id) INNER JOIN (information INF INNER JOIN source SC ON(INF.sourceId=SC.id) INNER JOIN donnee DO ON(INF.donneeId=DO.id)) ON(RA.informationId=INF.id) WHERE RA.projectId='{$projectId}' ORDER BY RA.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getRapportageByProjectIdById($projectId,$rapportageId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT RA.id as raId,RA.dateHeureEnreg as raDateHeure,RA.subject,INF.id as infId,INF.dateEvent,INF.heure as infHeure,INF.lieu as infLieu,SC.id as scId,DO.id as doId,DO.valeur FROM rapportage RA INNER JOIN agent AG ON(RA.agentId=AG.id) INNER JOIN project PR ON(RA.projectId=PR.id) INNER JOIN (information INF INNER JOIN source SC ON(INF.sourceId=SC.id) INNER JOIN donnee DO ON(INF.donneeId=DO.id)) ON(RA.informationId=INF.id) WHERE RA.projectId='{$projectId}' AND RA.id='{$rapportageId}' ORDER BY RA.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    
}