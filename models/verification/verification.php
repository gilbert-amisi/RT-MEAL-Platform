<?php

class Verification
{
    function addVerification($tpmId,$comment,$mention,$compteId)
    {
        try {
            $query = iespConnection::connect()->prepare("INSERT INTO tpmverification(tpmId,comment,mention,compteId) VALUES(?,?,?,?)");
            $query->execute([$tpmId,$comment,$mention,$compteId]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
    function addVerification1($tpmId,$comment,$mention,$status,$compteId,$rating,$issue,$issueAnalysis,$action)
    {
        try {
            $query = iespConnection::connect()->prepare("INSERT INTO tpmverification(tpmId,comment,mention,status,compteId,rating,issue,issueAnalysis,action) VALUES(?,?,?,?,?,?,?,?,?)");
            $query->execute([$tpmId,$comment,$mention,$status,$compteId,$rating,$issue,$issueAnalysis,$action]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function addTpmFeedback($tpmId,$instruction)
    {
        try {
            $query = iespConnection::connect()->prepare("INSERT INTO tpmfeedback(tpmId,instruction) VALUES(?,?)");
            $query->execute([$tpmId,$instruction]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function updateTpm($tpmId, $note)
    {
        try {
            $query = iespConnection::connect()->prepare("UPDATE tpm SET status='Submitted to coordinator', note='$note' WHERE id=?");
            $query->execute([$tpmId]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function updateVerification($verificationId)
    {
        try {
            $query = iespConnection::connect()->prepare("UPDATE tpmverification SET status='Submitted to partner' WHERE id=?");
            $query->execute([$verificationId]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function editVerification($verificationId,$comment)
    {
        try {
            $query = iespConnection::connect()->prepare("UPDATE tpmverification SET comment=? WHERE id=?");
            $query->execute([$comment,$verificationId]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    function getVerificationAll()
    {
        try {
            $data = iespConnection::connect()->query(
                "SELECT v.*, t.image1, t.image2, t.image3, t.fgTranscript, t.kiTranscript, imp.name AS nameip,
                        af.end AS dueDate, af.village AS village, ter.terr AS territ, ter.province AS province, act.name AS activ, p.designation AS proj, o.designation AS org, pf.compteId AS pfId,
                        s.name AS sup, s.compteId AS supId, s.phone AS phonesup, px.name AS prx, px.compteId AS proxId, px.phone AS phonepx, ph.name AS phasename, ph.id AS phaseid, ph.type AS phasetype
                FROM tpmverification v
                LEFT JOIN tpm t ON v.tpmId=t.id
                LEFT JOIN affectation af ON t.affectationId=af.id
                LEFT JOIN ip imp ON af.ipId=imp.id
                LEFT JOIN territoire ter ON af.territoireId=ter.id
                LEFT JOIN phase ph ON af.phaseId = ph.id
                LEFT JOIN activity act ON af.activityId = act.id
                LEFT JOIN product pd ON act.productId = pd.id
                LEFT JOIN result res ON pd.resultId = res.id
                LEFT JOIN project p ON res.projectId=p.id
                LEFT JOIN organisation o ON p.organisationId=o.id
                LEFT JOIN pointfocal pf ON p.pointfocalId=pf.id
                LEFT JOIN supervisor s ON af.supervisorId=s.id
                LEFT JOIN proxy px ON af.proxyId=px.id
                ORDER BY v.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }
    function getVerificationAll1($phaseId)
    {
        try {
            $data = iespConnection::connect()->query(
                "SELECT v.*, t.image1, t.image2, t.image3, t.fgTranscript, t.kiTranscript, imp.name AS nameip,
                        af.end AS dueDate, af.village AS village, ter.terr AS territ, ter.province AS province, act.name AS activ, p.designation AS proj, o.designation AS org, pf.compteId AS pfId,
                        s.name AS sup, s.compteId AS supId, s.phone AS phonesup, px.name AS prx, px.compteId AS proxId, px.phone AS phonepx, ph.name AS phasename, ph.id AS phaseid, ph.type AS phasetype
                FROM tpmverification v
                LEFT JOIN tpm t ON v.tpmId=t.id
                LEFT JOIN affectation af ON t.affectationId=af.id
                LEFT JOIN ip imp ON af.ipId=imp.id
                LEFT JOIN territoire ter ON af.territoireId=ter.id
                LEFT JOIN phase ph ON af.phaseId = ph.id
                LEFT JOIN activity act ON af.activityId = act.id
                LEFT JOIN product pd ON act.productId = pd.id
                LEFT JOIN result res ON pd.resultId = res.id
                LEFT JOIN project p ON res.projectId=p.id
                LEFT JOIN organisation o ON p.organisationId=o.id
                LEFT JOIN pointfocal pf ON p.pointfocalId=pf.id
                LEFT JOIN supervisor s ON af.supervisorId=s.id
                LEFT JOIN proxy px ON af.proxyId=px.id
                WHERE ph.id=$phaseId
                ORDER BY v.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getVerificationByProject($projectId)
    {
        try {
            $data = iespConnection::connect()->query(
                "SELECT v.*, t.image1, t.image2, t.image3, t.fgTranscript, t.kiTranscript, imp.name AS nameip,
                        af.end AS dueDate, af.village AS village, ter.terr AS territ, ter.province AS province, act.name AS activ, p.designation AS proj, o.designation AS org, pf.compteId AS pfId,
                        s.name AS sup, s.compteId AS supId, s.phone AS phonesup, px.name AS prx, px.compteId AS proxId, px.phone AS phonepx, ph.name AS phasename, ph.id AS phaseid, ph.type AS phasetype
                FROM tpmverification v
                LEFT JOIN tpm t ON v.tpmId=t.id
                LEFT JOIN affectation af ON t.affectationId=af.id
                LEFT JOIN ip imp ON af.ipId=imp.id
                LEFT JOIN territoire ter ON af.territoireId=ter.id
                LEFT JOIN phase ph ON af.phaseId = ph.id
                LEFT JOIN activity act ON af.activityId = act.id
                LEFT JOIN product pd ON act.productId = pd.id
                LEFT JOIN result res ON pd.resultId = res.id
                LEFT JOIN project p ON res.projectId=p.id
                LEFT JOIN organisation o ON p.organisationId=o.id
                LEFT JOIN pointfocal pf ON p.pointfocalId=pf.id
                LEFT JOIN supervisor s ON af.supervisorId=s.id
                LEFT JOIN proxy px ON af.proxyId=px.id
                WHERE v.status='Submitted to partner' AND v.mention='Final' AND ph.projectId=$projectId
                ORDER BY v.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getVerificationByPhase($phaseId)
    {
        try {
            $data = iespConnection::connect()->query(
                "SELECT v.*, t.image1, t.image2, t.image3, t.fgTranscript, t.kiTranscript, imp.name AS nameip,
                        af.end AS dueDate, af.village AS village, ter.terr AS territ, ter.province AS province, act.name AS activ, p.designation AS proj, o.designation AS org, pf.compteId AS pfId,
                        s.name AS sup, s.compteId AS supId, s.phone AS phonesup, px.name AS prx, px.compteId AS proxId, px.phone AS phonepx, ph.name AS phasename, ph.id AS phaseid, ph.type AS phasetype
                FROM tpmverification v
                LEFT JOIN tpm t ON v.tpmId=t.id
                LEFT JOIN affectation af ON t.affectationId=af.id
                LEFT JOIN ip imp ON af.ipId=imp.id
                LEFT JOIN territoire ter ON af.territoireId=ter.id
                LEFT JOIN phase ph ON af.phaseId = ph.id
                LEFT JOIN activity act ON af.activityId = act.id
                LEFT JOIN product pd ON act.productId = pd.id
                LEFT JOIN result res ON pd.resultId = res.id
                LEFT JOIN project p ON res.projectId=p.id
                LEFT JOIN organisation o ON p.organisationId=o.id
                LEFT JOIN pointfocal pf ON p.pointfocalId=pf.id
                LEFT JOIN supervisor s ON af.supervisorId=s.id
                LEFT JOIN proxy px ON af.proxyId=px.id
                WHERE v.status='Submitted to partner' AND v.mention='Final' AND af.phaseId=$phaseId
                ORDER BY v.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getVerificationByRating($phaseId, $rating)
    {
        try {
            $data = iespConnection::connect()->query(
                "SELECT v.*, t.image1, t.image2, t.image3, t.fgTranscript, t.kiTranscript, imp.name AS nameip,
                        af.end AS dueDate, af.village AS village, ter.terr AS territ, ter.province AS province, act.name AS activ, p.designation AS proj, o.designation AS org, pf.compteId AS pfId,
                        s.name AS sup, s.compteId AS supId, s.phone AS phonesup, px.name AS prx, px.compteId AS proxId, px.phone AS phonepx, ph.name AS phasename, ph.id AS phaseid, ph.type AS phasetype
                FROM tpmverification v
                LEFT JOIN tpm t ON v.tpmId=t.id
                LEFT JOIN affectation af ON t.affectationId=af.id
                LEFT JOIN ip imp ON af.ipId=imp.id
                LEFT JOIN territoire ter ON af.territoireId=ter.id
                LEFT JOIN phase ph ON af.phaseId = ph.id
                LEFT JOIN activity act ON af.activityId = act.id
                LEFT JOIN product pd ON act.productId = pd.id
                LEFT JOIN result res ON pd.resultId = res.id
                LEFT JOIN project p ON res.projectId=p.id
                LEFT JOIN organisation o ON p.organisationId=o.id
                LEFT JOIN pointfocal pf ON p.pointfocalId=pf.id
                LEFT JOIN supervisor s ON af.supervisorId=s.id
                LEFT JOIN proxy px ON af.proxyId=px.id
                WHERE v.status='Submitted to partner' AND v.mention='Final' AND af.phaseId=$phaseId AND v.rating='$rating'
                ORDER BY v.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }


    function getVerificationDash()
    {
        try {
            $data = iespConnection::connect()->query(
                "SELECT v.*, t.image1, t.image2, t.image3, t.fgTranscript, t.kiTranscript, imp.name AS nameip,
                        af.end AS dueDate, af.village AS village, af.territoireId AS territoireid, ter.terr AS territ, ter.province AS province, act.name AS activ, p.designation AS proj, o.designation AS org, pf.compteId AS pfId,
                        s.name AS sup, s.compteId AS supId, s.phone AS phonesup, px.name AS prx, px.compteId AS proxId, px.phone AS phonepx, ph.name AS phasename, ph.id AS phaseid
                FROM tpmverification v
                LEFT JOIN tpm t ON v.tpmId=t.id
                LEFT JOIN affectation af ON t.affectationId=af.id
                LEFT JOIN ip imp ON af.ipId=imp.id
                LEFT JOIN territoire ter ON af.territoireId=ter.id
                LEFT JOIN phase ph ON af.phaseId = ph.id
                LEFT JOIN activity act ON af.activityId = act.id
                LEFT JOIN product pd ON act.productId = pd.id
                LEFT JOIN result res ON pd.resultId = res.id
                LEFT JOIN project p ON res.projectId=p.id
                LEFT JOIN organisation o ON p.organisationId=o.id
                LEFT JOIN pointfocal pf ON p.pointfocalId=pf.id
                LEFT JOIN supervisor s ON af.supervisorId=s.id
                LEFT JOIN proxy px ON af.proxyId=px.id
                WHERE v.status='Submitted to partner' AND v.mention='Final'
                ORDER BY id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getVerificationDashPhase($phaseId)
    {
        try {
            $data = iespConnection::connect()->query(
                "SELECT v.*, t.image1, t.image2, t.image3, t.fgTranscript, t.kiTranscript, imp.name AS nameip,
                        af.end AS dueDate, af.village AS village, af.territoireId AS territoireid, ter.terr AS territ, ter.province AS province, act.name AS activ, p.designation AS proj, o.designation AS org, pf.compteId AS pfId,
                        s.name AS sup, s.compteId AS supId, s.phone AS phonesup, px.name AS prx, px.compteId AS proxId, px.phone AS phonepx, ph.name AS phasename, ph.id AS phaseid, ph.type AS phasetype
                FROM tpmverification v
                LEFT JOIN tpm t ON v.tpmId=t.id
                LEFT JOIN affectation af ON t.affectationId=af.id
                LEFT JOIN ip imp ON af.ipId=imp.id
                LEFT JOIN territoire ter ON af.territoireId=ter.id
                LEFT JOIN phase ph ON af.phaseId = ph.id
                LEFT JOIN activity act ON af.activityId = act.id
                LEFT JOIN product pd ON act.productId = pd.id
                LEFT JOIN result res ON pd.resultId = res.id
                LEFT JOIN project p ON res.projectId=p.id
                LEFT JOIN organisation o ON p.organisationId=o.id
                LEFT JOIN pointfocal pf ON p.pointfocalId=pf.id
                LEFT JOIN supervisor s ON af.supervisorId=s.id
                LEFT JOIN proxy px ON af.proxyId=px.id
                WHERE v.status='Submitted to partner' AND v.mention='Final' AND af.phaseId=$phaseId
                ORDER BY id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getRatingTerritory($phaseId)
    {
        try {
            $data = iespConnection::connect()->query(
                "SELECT COUNT(DISTINCT v.id) AS nred, v.rating, ter.terr, ter.province
                FROM tpmverification v
                LEFT JOIN tpm t ON v.tpmId=t.id
                LEFT JOIN affectation af ON t.affectationId=af.id
                LEFT JOIN ip imp ON af.ipId=imp.id
                LEFT JOIN territoire ter ON af.territoireId=ter.id
                LEFT JOIN phase ph ON af.phaseId = ph.id
                LEFT JOIN activity act ON af.activityId = act.id
                LEFT JOIN product pd ON act.productId = pd.id
                LEFT JOIN result res ON pd.resultId = res.id
                LEFT JOIN project p ON res.projectId=p.id
                LEFT JOIN organisation o ON p.organisationId=o.id
                LEFT JOIN pointfocal pf ON p.pointfocalId=pf.id
                LEFT JOIN supervisor s ON af.supervisorId=s.id
                LEFT JOIN proxy px ON af.proxyId=px.id
                WHERE v.status='Submitted to partner' AND v.mention='Final' AND af.phaseId=$phaseId
                GROUP BY v.rating");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getRatingIP($phaseId)
    {
        try {
            $data = iespConnection::connect()->query(
                "SELECT COUNT(DISTINCT v.id) AS nred, v.rating, imp.name AS implementor
                FROM tpmverification v
                LEFT JOIN tpm t ON v.tpmId=t.id
                LEFT JOIN affectation af ON t.affectationId=af.id
                LEFT JOIN ip imp ON af.ipId=imp.id
                LEFT JOIN territoire ter ON af.territoireId=ter.id
                LEFT JOIN phase ph ON af.phaseId = ph.id
                LEFT JOIN activity act ON af.activityId = act.id
                LEFT JOIN product pd ON act.productId = pd.id
                LEFT JOIN result res ON pd.resultId = res.id
                LEFT JOIN project p ON res.projectId=p.id
                LEFT JOIN organisation o ON p.organisationId=o.id
                LEFT JOIN pointfocal pf ON p.pointfocalId=pf.id
                LEFT JOIN supervisor s ON af.supervisorId=s.id
                LEFT JOIN proxy px ON af.proxyId=px.id
                WHERE v.status='Submitted to partner' AND v.mention='Final' AND af.phaseId=$phaseId
                GROUP BY v.rating");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getRedTerritory($phaseId)
    {
        try {
            $data = iespConnection::connect()->query(
                "SELECT COUNT(v.id) AS nred, ter.terr
                FROM tpmverification v
                LEFT JOIN tpm t ON v.tpmId=t.id
                LEFT JOIN affectation af ON t.affectationId=af.id
                LEFT JOIN ip imp ON af.ipId=imp.id
                LEFT JOIN territoire ter ON af.territoireId=ter.id
                LEFT JOIN phase ph ON af.phaseId = ph.id
                LEFT JOIN activity act ON af.activityId = act.id
                LEFT JOIN product pd ON act.productId = pd.id
                LEFT JOIN result res ON pd.resultId = res.id
                LEFT JOIN project p ON res.projectId=p.id
                LEFT JOIN organisation o ON p.organisationId=o.id
                LEFT JOIN pointfocal pf ON p.pointfocalId=pf.id
                LEFT JOIN supervisor s ON af.supervisorId=s.id
                LEFT JOIN proxy px ON af.proxyId=px.id
                WHERE v.status='Submitted to partner' AND v.mention='Final' AND v.rating='red' AND af.phaseId=$phaseId
                GROUP BY ter.terr");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getOrangeTerritory($phaseId)
    {
        try {
            $data = iespConnection::connect()->query(
                "SELECT COUNT(v.id) AS norange, ter.terr
                FROM tpmverification v
                LEFT JOIN tpm t ON v.tpmId=t.id
                LEFT JOIN affectation af ON t.affectationId=af.id
                LEFT JOIN ip imp ON af.ipId=imp.id
                LEFT JOIN territoire ter ON af.territoireId=ter.id
                LEFT JOIN phase ph ON af.phaseId = ph.id
                LEFT JOIN activity act ON af.activityId = act.id
                LEFT JOIN product pd ON act.productId = pd.id
                LEFT JOIN result res ON pd.resultId = res.id
                LEFT JOIN project p ON res.projectId=p.id
                LEFT JOIN organisation o ON p.organisationId=o.id
                LEFT JOIN pointfocal pf ON p.pointfocalId=pf.id
                LEFT JOIN supervisor s ON af.supervisorId=s.id
                LEFT JOIN proxy px ON af.proxyId=px.id
                WHERE v.status='Submitted to partner' AND v.mention='Final' AND v.rating='orange' AND af.phaseId=$phaseId
                GROUP BY ter.terr");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getGreenTerritory($phaseId)
    {
        try {
            $data = iespConnection::connect()->query(
                "SELECT COUNT(v.id) AS ngreen, ter.terr
                FROM tpmverification v
                LEFT JOIN tpm t ON v.tpmId=t.id
                LEFT JOIN affectation af ON t.affectationId=af.id
                LEFT JOIN ip imp ON af.ipId=imp.id
                LEFT JOIN territoire ter ON af.territoireId=ter.id
                LEFT JOIN phase ph ON af.phaseId = ph.id
                LEFT JOIN activity act ON af.activityId = act.id
                LEFT JOIN product pd ON act.productId = pd.id
                LEFT JOIN result res ON pd.resultId = res.id
                LEFT JOIN project p ON res.projectId=p.id
                LEFT JOIN organisation o ON p.organisationId=o.id
                LEFT JOIN pointfocal pf ON p.pointfocalId=pf.id
                LEFT JOIN supervisor s ON af.supervisorId=s.id
                LEFT JOIN proxy px ON af.proxyId=px.id
                WHERE v.status='Submitted to partner' AND v.mention='Final' AND v.rating='green' AND af.phaseId=$phaseId
                GROUP BY ter.terr");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    
}