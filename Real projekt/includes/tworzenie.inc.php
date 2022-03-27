<?php
    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $pwd = $_POST['pwd'];
        $pwdRep = $_POST['pwdRep'];

        require_once 'dbh.inc.php';
        require_once 'functions.inc.php';

        if(emptyInputSignup($name,$pwd,$pwdRep) !== false){
            header('location: ../konta.php?error=emptyinput');
            exit();
        }
        if(pwdMatch($pwd,$pwdRep) !== false){
            header('location: ../konta.php?error=pwddontmatch');
            exit();
        }
        if(nameTaken($conn,$name) !== false){
            header('location: ../konta.php?error=nametaken');
        }
        createUser($conn,$name,$pwd);
    }
    else{
        header('Location: ../konta.php');
    }