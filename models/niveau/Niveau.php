<?php



class Niveau
{
    function addNiveau($levelNiveau,$designation,$forValidation)
    {
        try {
            $query = iespConnection::connect()->prepare("INSERT INTO niveau(levelNiveau,designation,forValidation) VALUES(?,?,?)");
            $query->execute([$levelNiveau,$designation,$forValidation]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    function getNiveauAll()
    {
        try {
            $data = iespConnection::connect()->query("SELECT * FROM niveau ORDER BY id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getNiveauForValidation()
    {
        try {
            $data = iespConnection::connect()->query("SELECT * FROM niveau WHERE forValidation='yes' ORDER BY id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getNiveauActiveAll()
    {
        try {
            $data = iespConnection::connect()->query("SELECT * FROM niveau WHERE active=1 ORDER BY id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getNiveauByLevelNiveau($levelNiveau)
    {
        try {
            $data = iespConnection::connect()->query("SELECT * FROM niveau WHERE levelNiveau='{$levelNiveau}' ORDER BY id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getNiveauById($niveauId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT * FROM niveau WHERE id='{$niveauId}' ORDER BY id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    
}