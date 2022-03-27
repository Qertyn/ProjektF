<?php
    session_start();
    if(($_SESSION['userId']) !== 1){
        header('Location: panel.php');
        exit();
    }
    include_once 'includes/dbh.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menedżer kont</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div id="container">
        <div id="leb">
            <div id="firma"><h1>Firma XYZ ABC sp. z.o.o</h1></div><div id="wyloguj"><form action="includes/login.inc.php" method="post"><input type="submit" name="submit" value="Wyloguj się"></form></div>
        </div>
        <div id="boczek">
            <div id="uzytkownik">Zalogowano z uprawnieniami:
                <?php
                    if($_SESSION['userId'] === 1){
                        echo "<b>administratora</b>";
                    }else{
                        echo "<b>uzytkownika</b>";
                    }
                ?>
                <br><br><br><br><br><a href="panel.php">Powrót do panelu</a>
            </div>
        </div>
        <div id="glowna"><div class="text"><b>Zrób konto</b>
     <form action="includes/tworzenie.inc.php" method="post">
        <input type="text" name="name" placeholder="login"><br><br>
        <input type="password" name="pwd" placeholder="hasło"><br><br>
        <input type="password" name="pwdRep" placeholder="powtórz hasło"><br>
        <button type="submit" name="submit">Stwórz konto</button><br>
        <?php
        if(isset($_GET["error"])){
            if($_GET["error"] = "emptyinput"){
                echo "<p> Wypełnij wszystkie pola!</p>";
            }
            else if($_GET["error"] = "pwddontmatch"){
                echo "<p> Hasła nie są takie same!</p>";
            }
            else if($_GET["error"] = "nametaken"){
                echo "<p> Użytkownik o takiej nazwie już istnieje! </p>";
            }
            else header('Location: konta.php');
        }
        ?>
     </form><br>
    <b>Konta zapisane w bazie:</b> <br>
    <?php
        $sql = "SELECT usersName FROM users;";
        $result = mysqli_query($conn,$sql);
        $resultCheck = mysqli_num_rows($result);

        if($resultCheck>0){
            while($row = mysqli_fetch_assoc($result)){
                echo "".$row['usersName']."<br>";
            }
        }
    ?>
    <form method="post" action="includes/deleteAcc.inc.php">
    <input type="text" name="username_delete" placeholder="Podaj nazwę konta do usunięcia"><br />
    <input type="submit" name="btn_delete" value="Usuń użytkownika" />
    </form>
    </div>
    </div>
        <div id="stopka">
            <div id=tworca>Twórca strony: Adam Wieczorek | adam.wieczorek04@gmail.com</div>
        </div>
    </div>
</body>
</html>