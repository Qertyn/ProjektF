<?php
session_start();
include_once 'dbh.inc.php';
if(isset($_POST['btn_delete'])){
    $username = $_POST['username_delete'];
    if($username == "admin"){
        header('Location: ../konta.php?chujciwdupe');
    }else{
    $sql = mysqli_query($conn, "DELETE FROM users WHERE usersName='$username';");
    if($sql){
        header('Location: ../konta.php?kontousuniete');
        }
    }
}
