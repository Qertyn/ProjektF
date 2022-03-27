<?php
    function emptyInputSignup($name,$pwd,$pwdRep){
        $result;
        if(empty($name) || empty($pwd) || empty($pwdRep)){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }
    function pwdMatch($pwd, $pwdRep){
        $result;
        if($pwd !== $pwdRep){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }
    function nameTaken($conn,$name){
        $sql = "SELECT * FROM users WHERE usersName = ?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header('location: ../konta.php?error=stmtfailed');
            exit();
        }
        mysqli_stmt_bind_param($stmt, "s", $name);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($resultData)){
            return $row;
        }
        else{
            $result = false;
            return $result;
        }
        mysqli_stmt_close($stmt);
    }
    function createUser($conn,$name,$pwd){
        $sql = "INSERT INTO users (usersName,usersPwd) VALUES (?,?);";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header('location: ../konta.php?error=stmtfailed1');
            exit();
        }
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ss", $name, $hashedPwd);
        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
        header('location: ../index.php');
            exit();
    }
    function emptyInputLogin($name,$pwd){
        $result;
        if(empty($name) || empty($pwd)){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }
    function loginUser($conn, $name, $pwd){
        $nameExists = nameTaken($conn,$name);

        if ($nameExists === false){
            header('location: ../index.php?error=wronglogin');
            exit();
        }
        $pwdHashed = $nameExists['usersPwd'];
        $checkPwd = password_verify($pwd,$pwdHashed);
        if($checkPwd === false){
            header('location: ../index.php?error=wronglogin');
            exit();
        }
        else if($checkPwd === true){
            session_start();
            $_SESSION["userId"] = $nameExists["usersId"];
            header('location: ../panel.php');
        }
    }