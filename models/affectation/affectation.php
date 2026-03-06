<?php

class Affectation
{

    function addAffectation4($start, $end, $instruction, $axeId, $village, $ipId, $supervisorId, $activityId, $phaseId)
    {
        try {
            $query = iespConnection::connect()->prepare("INSERT INTO affectation(start,end,instruction,territoireId,village,ipId,supervisorId,activityId,phaseId) 
                                                        VALUES(?,?,?,?,?,?,?,?,?)");
            $query->execute([$start, $end, $instruction, $axeId, $village, $ipId, $supervisorId, $activityId,$phaseId]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function assignProxy($proxyId, $village, $start, $end, $instruction, $affectationId)
    {
        try {
            $query = iespConnection::connect()->prepare("UPDATE affectation SET proxyId=?, village=?, start=?, end=?, instruction=? WHERE id=?");
            $query->execute([$proxyId, $village, $start, $end, $instruction, $affectationId]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function deleteAffectation($affectationId)
    {
        try {
            $query = iespConnection::connect()->prepare("DELETE FROM affectation WHERE id=?");
            $query->execute([$affectationId]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    function getAffectationAll()
    {
        try {
            $data = iespConnection::connect()->query("SELECT af.*, DATEDIFF(af.end, af.start) AS duration, og.designation AS org, pj.designation AS proj, 
                                                       ax.terr AS nameaxe, ax.province AS prov, ph.name AS phasename, ph.type AS phasetype,
                                                       rs.name AS res, pd.name AS prod, ac.name AS act, imp.name AS nameip,
                                                       sp.name AS namesup, sp.phone AS phonesup, sp.compteId AS comptesup,
                                                       px.name AS nameprox, px.location AS locprox, px.phone AS phoneprox, px.compteId AS compteprox
                                                    FROM affectation af
                                                    LEFT JOIN ip imp ON af.ipId=imp.id
                                                    LEFT JOIN phase ph ON af.phaseId=ph.id
                                                    LEFT JOIN activity ac ON af.activityId=ac.id
                                                    LEFT JOIN product pd ON ac.productId=pd.id
                                                    LEFT JOIN result rs ON pd.resultId=rs.id
                                                    LEFT JOIN project pj ON rs.projectId=pj.id
                                                    LEFT JOIN organisation og ON pj.organisationId=og.id
                                                    LEFT JOIN territoire ax ON af.territoireId=ax.id
                                                    LEFT JOIN supervisor sp ON af.supervisorId=sp.id
                                                    LEFT JOIN proxy px ON af.proxyId=px.id
                                                    ORDER BY id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getAffectationByProxy($compteId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT COUNT(af.status) AS nbaf, af.proxyId, px.name AS prx, px.phone AS proxphone, px.compteId AS proxId
                                                        FROM affectation af
                                                        LEFT JOIN proxy px ON af.proxyId=px.id
                                                        WHERE af.status='Active' AND px.compteId=$compteId
                                                        GROUP BY px.compteId");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    
}