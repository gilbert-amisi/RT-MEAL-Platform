<?php



class Territoire
{
    function addFeedback($soumissionId,$donneeId,$pointfocalId)
    {
        try {
            $query = iespConnection::connect()->prepare("INSERT INTO feedback(dateHeureEnreg,soumissionId,donneeId,pointfocalId) VALUES(?,?,?,?)");
            $query->execute([date('Y-m-d H:i:s'),$soumissionId,$donneeId,$pointfocalId]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function getTerritoireAll()
    {
        try {
            $data = iespConnection::connect()->query("SELECT * FROM territoire ORDER BY terr ASC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getTerritoireByName($name)
    {
        try {
            $data = iespConnection::connect()->query("SELECT * FROM territoire WHERE terr='{$name}' ORDER BY terr ASC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getTerritoireById($territoireId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT * FROM territoire WHERE id='{$territoireId}' ORDER BY terr ASC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }
        
}