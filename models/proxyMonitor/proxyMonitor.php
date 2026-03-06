<?php

class ProxyMonitor
{
    function addProxyMonitor($name,$phone,$email,$location,$province,$compteId)
    {
        try {
            $query = iespConnection::connect()->prepare("INSERT INTO proxy(name,phone,email,location,province,compteId) VALUES(?,?,?,?,?,?)");
            $query->execute([$name,$phone,$email,$location,$province,$compteId]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    function getProxyMonitorAll()
    {
        try {
            $data = iespConnection::connect()->query("SELECT * FROM proxy ORDER BY id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    function getProxybyId($proxyId)
    {
        try {
            $data = iespConnection::connect()->query("SELECT p.*, c.email 
                                                        FROM proxy p
                                                        LEFT JOIN compte c ON p.compteId=c.id
                                                        WHERE p.id=$proxyId
                                                        ORDER BY id DESC");
            return $data->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    
}