<?php



class Compte
{
    function addCompte($identite, $typeCompte, $nomUtilisateur, $motDePasse, $email)
    {
        try {
            $query = iespConnection::connect()->prepare("INSERT INTO compte(dateEnreg,identite,typeCompte,nomUtilisateur,motDePasse,email) VALUES(?,?,?,?,?,?)");
            $query->execute([date('Y-m-d H:i'), $identite, $typeCompte, $nomUtilisateur, $motDePasse, $email]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function updateCompteAllItems($compteId, $identite, $typeCompte, $nomUtilisateur, $motDePasse, $email)
    {
        try {
            $query = iespConnection::connect()->prepare("UPDATE compte SET identite=?,typeCompte=?,nomUtilisateur=?,motDePasse=?,email=? WHERE id=?");
            $query->execute([$identite, $typeCompte, $nomUtilisateur, $motDePasse, $email, $compteId]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function updateCompteWithoutNomUtilisateur($compteId, $identite, $typeCompte, $motDePasse, $email)
    {
        try {
            $query = iespConnection::connect()->prepare("UPDATE compte SET identite=?,typeCompte=?,motDePasse=?,email=? WHERE id=?");
            $query->execute([$identite, $typeCompte, $motDePasse, $email, $compteId]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function updateCompteWithoutNomUtilisateurWithoutMotDePasse($compteId, $identite, $typeCompte,$email)
    {
        try {
            $query = iespConnection::connect()->prepare("UPDATE compte SET identite=?,typeCompte=?,email=? WHERE id=?");
            $query->execute([$identite, $typeCompte,$email, $compteId]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function updateCompteWithoutMotDePasse($compteId, $identite, $typeCompte, $nomUtilisateur,$email)
    {
        try {
            $query = iespConnection::connect()->prepare("UPDATE compte SET identite=?,typeCompte=?,nomUtilisateur=?,email=? WHERE id=?");
            $query->execute([$identite, $typeCompte, $nomUtilisateur,$email, $compteId]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function getCompteAll()
    {
        try {
            $data = iespConnection::connect()->query("SELECT * FROM compte ORDER BY id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getCompteActiveAll()
    {
        try {
            $data = iespConnection::connect()->query("SELECT * FROM compte ORDER BY id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getCompteSupervisor()
    {
        try {
            $data = iespConnection::connect()->query("SELECT * FROM compte WHERE typeCompte='TPM Supervisor' ORDER BY id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getCompteProxy()
    {
        try {
            $data = iespConnection::connect()->query("SELECT * FROM compte WHERE typeCompte='TPM Proxy monitor' ORDER BY id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }
    function getCompteCoordinator()
    {
        try {
            $data = iespConnection::connect()->query("SELECT * FROM compte WHERE typeCompte='TPM Coordinator' ORDER BY id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getComptePFActiveAll()
    {
        try {
            $data = iespConnection::connect()->query("SELECT * FROM compte WHERE typeCompte='Partner' ORDER BY id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getCompteByType($type)
    {
        try {
            $data = iespConnection::connect()->query("SELECT * FROM compte WHERE typeCompte='{$type}' ORDER BY id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getCompteById($compteId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT * FROM compte WHERE id='{$compteId}' ORDER BY id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getCompteByNomUtilisateur($nomUtilisateur)
    {
        try {
            $data = iespConnection::connect()->query("SELECT * FROM compte WHERE nomUtilisateur='{$nomUtilisateur}' ORDER BY id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getCompteByLogin($nomUtilisateur, $motDePasse)
    {
        try {
            $data = iespConnection::connect()->query("SELECT * FROM compte WHERE nomUtilisateur='{$nomUtilisateur}' AND motDePasse='{$motDePasse}'");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }
}
