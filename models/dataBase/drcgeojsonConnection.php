<?php
class DrcgeojsonConnection
{
    static function connect()
    {
        $bd = new PDO('mysql:host=localhost;dbname=drcgeojson', 'root', '');
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $bd->exec("set names utf8");
        return $bd;
    }

}

