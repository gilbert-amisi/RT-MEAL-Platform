<?php



class Keyinformant
{
    function addKeyinformant($identite,$contact,$genre,$adresse,$profession,$niveauId)
    {
        try {
            $query = iespConnection::connect()->prepare("INSERT INTO keyinformant(identite,contact,genre,adresse,profession,niveauId) VALUES(?,?,?,?,?,?)");
            $query->execute([$identite,$contact,$genre,$adresse,$profession,$niveauId]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    function getKeyinformantAll()
    {
        try {
            $data = iespConnection::connect()->query("SELECT * FROM keyinformant ORDER BY id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getKeyinformantActiveAll()
    {
        try {
            $data = iespConnection::connect()->query("SELECT * FROM keyinformant ORDER BY id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    
}