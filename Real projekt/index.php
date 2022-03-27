<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Witaj!</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
     <form class="box" action="includes/login.inc.php" method="post">
        <h1>Login</h1>
        <input type="text" name="name" placeholder="Nazwa">
        <input type="password" name="pwd" placeholder="Hasło">
        <input type="submit" name="submit" value="Zaloguj się">
        <?php
        if(isset($_GET["error"])){
            if($_GET["error"] = "emptyinput"){
                echo '<div class="style.css"><p> Wypełnij wszystkie pola!</p></div>';
            }
            else if($_GET["error"] = "pwddontmatch"){
                echo '<div class="style.css"><p> Hasła nie są takie same!</p></div>';
            }
            else if($_GET["error"] = "nametaken"){
                echo '<div class="style.css"><p> Użytkownik o takiej nazwie już istnieje! </p></div>';
            }
        }
    ?>
     </form>
</body>
</html>