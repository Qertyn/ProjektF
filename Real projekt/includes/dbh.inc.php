<?php
    $serverName = "localhost";
    $dBUsername = "root";
    $dBPassword = "";
    $dBName = "ProjektF";

$conn = mysqli_connect($serverName,$dBUsername,$dBPassword,$dBName);

if(!$conn){
    die("Connection lost: ".mysqli_connect_error());
}