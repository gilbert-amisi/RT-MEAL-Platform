<?php
class iespConnection
{
    static function connect()
    {
        $bd = new PDO('mysql:host=localhost;dbname=iesp', 'root', '');
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $bd->exec("set names utf8");
        return $bd;
    }

}

function securise($data) {
    $data=trim($data);
    $data=stripslashes($data);
    $data=stripcslashes($data);
    $data=strip_tags($data);
    return $data;
}

function dateFrench($myDate)
{
    $items_date = explode('-', $myDate);
    return $items_date[2] . "/" . $items_date[1] . "/" . $items_date[0];
}

function dateFrenchWithTime($myDateTime)
{
    $items_global=explode(' ', $myDateTime);
    $items_date = explode('-', $items_global[0]);
    return $items_date[2] . "/" . $items_date[1] . "/" . $items_date[0]." ".$items_global[1];
}

function dateFrenchItem($myDate, $position)
{
    $items_date = explode('-', $myDate);
    return $items_date[$position];
}

function dateTimeFrenchItem($myDateTime, $position)
{
    $items_DateTime=explode(' ',$myDateTime);

    return $items_DateTime[$position];
}

