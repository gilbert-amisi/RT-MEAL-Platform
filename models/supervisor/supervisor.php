<?php

class Supervisor
{
    function addSupervisor($name,$phone,$email,$compteId)
    {
        try {
            $query = iespConnection::connect()->prepare("INSERT INTO supervisor(name,phone,email,compteId) VALUES(?,?,?,?)");
            $query->execute([$name,$phone,$email,$compteId]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    function getSupervisorAll()
    {
        try {
            $data = iespConnection::connect()->query("SELECT * FROM supervisor ORDER BY id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getSupervisorById($supervisorId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT s.*, c.email 
                                                        FROM supervisor s
                                                        LEFT JOIN compte c ON s.compteId=c.id
                                                        WHERE s.id=$supervisorId
                                                        ORDER BY id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getSupervisorByAffectation($affectationId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT af.*, s.name, c.email 
                                                        FROM affectation af
                                                        LEFT JOIN supervisor s ON af.supervisorId=s.id
                                                        LEFT JOIN compte c ON s.compteId=c.id
                                                        WHERE af.id=$affectationId
                                                        ORDER BY id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

}