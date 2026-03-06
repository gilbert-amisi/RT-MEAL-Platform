<?php



class Organization
{
    function addOrganization($designation,$color)
    {
        try {
            $query = iespConnection::connect()->prepare("INSERT INTO organisation(designation,color) VALUES(?,?)");
            $query->execute([$designation,$color]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    function getOrganizationAll()
    {
        try {
            $data = iespConnection::connect()->query("SELECT * FROM organisation ORDER BY id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getOrganizationAllActive()
    {
        try {
            $data = iespConnection::connect()->query("SELECT * FROM organisation WHERE active=1 ORDER BY id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getCompagnieById($compagnieId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT * FROM compagnie WHERE id='{$compagnieId}' ORDER BY id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    
}