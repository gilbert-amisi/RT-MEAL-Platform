<?php



class Groupement
{

    function getGroupementAll()
    {
        try {
            $data = iespConnection::connect()->query("SELECT * FROM groupement ORDER BY groupm ASC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getGroupementByName($name)
    {
        try {
            $data = iespConnection::connect()->query("SELECT * FROM groupement WHERE groupm='{$name}' ORDER BY groupm ASC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getGroupementById($groupementId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT * FROM groupement WHERE id='{$groupementId}' ORDER BY groupm ASC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }
        
}