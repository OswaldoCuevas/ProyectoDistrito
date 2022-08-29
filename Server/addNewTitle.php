<?php
require ('conexion.php');
require('../Class/Title.php');

$Title = new Title();

if(isset($_POST['user_id'])         && isset($_POST['title_number']) && 
   isset($_POST['water_supply'])    && isset($_POST['initial_date']) && 
   isset($_POST['validity'])        && isset($_POST['extend'])       && 
   isset($_POST['cologne'])         && isset($_POST['plot'])         && 
   isset($_POST['longitude'])       && isset($_POST['latitude'])     &&
   isset($_POST['tenant'])
   )
{
    $user_id        = $_POST['user_id'];
    $title_number   = $_POST['title_number'];
    $water_supply   = $_POST['water_supply'];
    $initial_date   = $_POST['initial_date'];
    $validity       = $_POST['validity'];
    $extend         = $_POST['extend'];
    $cologne        = $_POST['cologne'];
    $plot           = $_POST['plot'];
    $longitude      = $_POST['longitude'];
    $latitude       = $_POST['latitude'];
    $tenant         = $_POST['tenant'];

    $encabezado = "(User_Id,Title_Number";

    $encabezado .= $water_supply        == "Sin registrar" ? "" : ",water_supply";
    $encabezado .= $initial_date        == "Sin registrar" ? "" : ",initial_date";
    $encabezado .= $validity            == "Sin registrar" ? "" :",validity";
    $encabezado .= $extend              == "Sin registrar" ? "" : ",extend";
    $encabezado .= $tenant              == "Sin registrar" ? "" : ",tenant";

    $encabezado .= ")";

    $values ="($user_id,'$title_number'";

    $values .= $water_supply    == "Sin registrar" ? ""     :   ",'"  .$water_supply. "'";
    $values .= $initial_date    == "Sin registrar" ? ""     :   ",'"  .$initial_date. "'";
    $values .= $validity        == "Sin registrar" ? ""     :   ",'"  .$validity.     "'";
    $values .= $extend          == "Sin registrar" ? ""     :   ",'"  .$extend.       "'";
    $values .= $tenant          == "Sin registrar" ? ""     :   ",'"  .$tenant.       "'";

    $values .=")";
    $addtitle= " $encabezado VALUES $values ";
    $Title -> addNewTitle($addtitle,$cologne,$plot,$longitude,$latitude);

    
}