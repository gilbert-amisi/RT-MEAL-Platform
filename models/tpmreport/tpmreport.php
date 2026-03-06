<?php

class Tpm
{
    function addTpm($affectationId, $comment, $image1, $image2, $image3, $fgFile, $kiFile)
    {
        try {
            $query = iespConnection::connect()->prepare("INSERT INTO tpm(affectationId,comment,image1,image2,image3,fgTranscript,kiTranscript) VALUES(?,?,?,?,?,?,?)");
            $query->execute([$affectationId, $comment, $image1, $image2, $image3, $fgFile, $kiFile]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function disableAffectation($affectationId)
    {
        try {
            $query = iespConnection::connect()->prepare("UPDATE affectation SET status='Disabled' WHERE id=?");
            $query->execute([$affectationId]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function editTpm($comment, $image1, $image2, $image3, $fgFile, $kiFile, $tpmId)
    {
        try {
            $query = iespConnection::connect()->prepare("UPDATE tpm SET comment=?,image1=?,image2=?,image3=?,fgTranscript=?,kiTranscript=?, note='Not checked yet', status='' WHERE id=?");
            $query->execute([$comment, $image1, $image2, $image3, $fgFile, $kiFile, $tpmId]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    function getTpmAll($phaseId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT t.*, af.end AS endAf, DATEDIFF(af.end, t.date) AS nbj,  af.village AS village, act.name AS activ, p.designation AS proj, o.designation AS org,
                                                             s.name AS sup, s.compteId AS supId, px.name AS prx, px.phone AS proxphone, px.compteId AS proxId,
                                                             ph.name AS phasename, ph.type AS phasetype, imp.name AS implementor, ter.terr, ter.province
                                                      FROM tpm t
                                                      LEFT JOIN affectation af ON t.affectationId=af.id
                                                      LEFT JOIN phase ph ON af.phaseId=ph.id
                                                      LEFT JOIN territoire ter ON af.territoireId=ter.id
                                                      LEFT JOIN ip imp ON af.ipId=imp.id
                                                      LEFT JOIN activity act ON af.activityId=act.id
                                                      LEFT JOIN product pd ON act.productId=pd.id
                                                      LEFT JOIN result res ON pd.resultId=res.id
                                                      LEFT JOIN project p ON res.projectId=p.id
                                                      LEFT JOIN organisation o ON p.organisationId=o.id
                                                      LEFT JOIN supervisor s ON af.supervisorId=s.id
                                                      LEFT JOIN proxy px ON af.proxyId=px.id
                                                      WHERE ph.id=$phaseId
                                                      ORDER BY t.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getFeedbackByTpm($tpmId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT fd.instruction, fd.date AS fddate, fd.tpmId, t.*, af.end AS endAf, DATEDIFF(af.end, t.date) AS nbj,  af.village AS village, act.name AS activ, p.designation AS proj, o.designation AS org,
                                                        s.name AS sup, s.compteId AS supId, px.name AS prx, px.phone AS proxphone, px.compteId AS proxId,
                                                        ph.name AS phasename, ph.type AS phasetype, imp.name AS implementor, ter.terr, ter.province
                                                        FROM tpmfeedback fd
                                                        LEFT JOIN tpm t ON fd.tpmId=t.id
                                                        LEFT JOIN affectation af ON t.affectationId=af.id
                                                        LEFT JOIN phase ph ON af.phaseId=ph.id
                                                        LEFT JOIN territoire ter ON af.territoireId=ter.id
                                                        LEFT JOIN ip imp ON af.ipId=imp.id
                                                        LEFT JOIN activity act ON af.activityId=act.id
                                                        LEFT JOIN product pd ON act.productId=pd.id
                                                        LEFT JOIN result res ON pd.resultId=res.id
                                                        LEFT JOIN project p ON res.projectId=p.id
                                                        LEFT JOIN organisation o ON p.organisationId=o.id
                                                        LEFT JOIN supervisor s ON af.supervisorId=s.id
                                                        LEFT JOIN proxy px ON af.proxyId=px.id
                                                        WHERE fd.tpmId=$tpmId
                                                        ORDER BY fd.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getTpmFeedbackAll($compteId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT fd.instruction, fd.date AS fddate, fd.tpmId, t.*, af.end AS endAf, DATEDIFF(af.end, t.date) AS nbj,  af.village AS village, act.name AS activ, p.designation AS proj, o.designation AS org,
                                                        s.name AS sup, s.compteId AS supId, px.name AS prx, px.phone AS proxphone, px.compteId AS proxId,
                                                        ph.name AS phasename, ph.type AS phasetype, imp.name AS implementor, ter.terr, ter.province
                                                        FROM tpmfeedback fd
                                                        LEFT JOIN tpm t ON fd.tpmId=t.id
                                                        LEFT JOIN affectation af ON t.affectationId=af.id
                                                        LEFT JOIN phase ph ON af.phaseId=ph.id
                                                        LEFT JOIN territoire ter ON af.territoireId=ter.id
                                                        LEFT JOIN ip imp ON af.ipId=imp.id
                                                        LEFT JOIN activity act ON af.activityId=act.id
                                                        LEFT JOIN product pd ON act.productId=pd.id
                                                        LEFT JOIN result res ON pd.resultId=res.id
                                                        LEFT JOIN project p ON res.projectId=p.id
                                                        LEFT JOIN organisation o ON p.organisationId=o.id
                                                        LEFT JOIN supervisor s ON af.supervisorId=s.id
                                                        LEFT JOIN proxy px ON af.proxyId=px.id
                                                        WHERE s.compteId=$compteId
                                                        ORDER BY fd.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getTpmFeedbackByProxy($compteId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT fd.instruction, fd.date AS fddate, t.*, af.end AS endAf, DATEDIFF(af.end, t.date) AS nbj,  af.village AS village, act.name AS activ, p.designation AS proj, o.designation AS org,
                                                        s.name AS sup, s.compteId AS supId, px.name AS prx, px.phone AS proxphone, px.compteId AS proxId,
                                                        ph.name AS phasename, ph.type AS phasetype, imp.name AS implementor, ter.terr, ter.province
                                                        FROM tpmfeedback fd
                                                        LEFT JOIN tpm t ON fd.tpmId=t.id
                                                        LEFT JOIN affectation af ON t.affectationId=af.id
                                                        LEFT JOIN phase ph ON af.phaseId=ph.id
                                                        LEFT JOIN territoire ter ON af.territoireId=ter.id
                                                        LEFT JOIN ip imp ON af.ipId=imp.id
                                                        LEFT JOIN activity act ON af.activityId=act.id
                                                        LEFT JOIN product pd ON act.productId=pd.id
                                                        LEFT JOIN result res ON pd.resultId=res.id
                                                        LEFT JOIN project p ON res.projectId=p.id
                                                        LEFT JOIN organisation o ON p.organisationId=o.id
                                                        LEFT JOIN supervisor s ON af.supervisorId=s.id
                                                        LEFT JOIN proxy px ON af.proxyId=px.id
                                                        WHERE px.compteId=$compteId
                                                        ORDER BY fd.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }
    function getValidatedByProxy($compteId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT COUNT(t.note) AS nbval, af.proxyId, px.name AS prx, px.phone AS proxphone, px.compteId AS proxId
                                                        FROM tpm t
                                                        LEFT JOIN affectation af ON t.affectationId=af.id
                                                        LEFT JOIN proxy px ON af.proxyId=px.id
                                                        WHERE t.note='validated' AND px.compteId=$compteId
                                                        GROUP BY px.compteId");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }
    function getUnvalidatedByProxy($compteId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT COUNT(t.note) AS nbunval, af.proxyId, px.name AS prx, px.phone AS proxphone, px.compteId AS proxId
                                                        FROM tpm t, affectation af, proxy px
                                                        WHERE t.affectationId=af.id AND af.proxyId=px.id AND t.note='Unvalidated' AND px.compteId=$compteId
                                                        GROUP BY px.compteId");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }
    function getUncheckedByProxy($compteId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT COUNT(t.note) AS nbunchecked, af.proxyId, px.name AS prx, px.phone AS proxphone, px.compteId AS proxId
                                                        FROM tpm t, affectation af, proxy px
                                                        WHERE t.affectationId=af.id AND af.proxyId=px.id AND t.note='Not checked yet' AND px.compteId=$compteId
                                                        GROUP BY px.compteId");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function addFinalReport($file, $comment, $phaseId)
    {
        try {
            $query = iespConnection::connect()->prepare("INSERT INTO finalreport(file,comment,phaseId) VALUES(?,?,?)");
            $query->execute([$file, $comment, $phaseId]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
    
    function getFinalReport($phaseId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT fr.*
                                                      FROM finalreport fr
                                                      LEFT JOIN phase ph ON fr.phaseId=ph.id
                                                      WHERE ph.id=$phaseId
                                                      ORDER BY fr.id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }
    
}