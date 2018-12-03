<?php
ob_start(); //Turns on output buffering

//sets default time zone
date_default_timezone_set("America/New_York");

//connection to mysql database

try{
    //all our routes will reference this database connection, last two arguments being username and pw
    $con = new PDO("mysql:dbname=platvideos;host = localhost", "root", "");
    //how to address errors
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    //if there is an error it will be of type PDOException and display a failed message with details
}catch(PDOException $e){
    echo "Connection failed!" . $e->getMessage();
}
?>