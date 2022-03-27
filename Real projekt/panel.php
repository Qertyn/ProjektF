<?php
    session_start();
    if(!isset($_SESSION['userId'])){
        header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Firma XYZ ABC sp. z.o.o</title>
    <link rel="stylesheet" href="style.css">
</head>
<body bgcolor="#000000">
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
            </div>
        </div>
        <div id="glowna"><div class="text"><b>Tutaj są dostępne pliki:</b><br><br>
        <?php  
            if ($handle = opendir('uploads/.')) {
            while (false !== ($file = readdir($handle)))
            {
                if (($file != ".") && ($file != "..")){
                    echo '<a download="'.$file.'" href="uploads/"'.$file.'>'.$file.'</a><br>';
                }
            }
            closedir($handle);
            }
            if(($_SESSION['userId']) !== 1){
                echo '<form action="includes/upload.inc.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="file">
                <button type="submit" name="submit">Dodaj plik</button></form><br><br>';
            }else{
                echo '<a href="konta.php">Utwórz/usuń użytkownika</a><br>';
                echo '<form action="includes/upload.inc.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="file">
                <button type="submit" name="submit">Dodaj plik</button></form><br><br>
                
                <form action="includes/delete.inc.php" method="POST">
                <input type="text" name="filenamedel" placeholder="Oddzielaj nazwy plikow przecinkami (nazwa,nazwa)" style="width: 300px;">
                <button type="submit" name="submit2">Usun plik/i</button><br>
                </form><br>';
            }
            ?>
            </div>
        </div>
        <div id="stopka">
            <div id=tworca>Twórca strony: Adam Wieczorek | adam.wieczorek04@gmail.com</div>
        </div>
    </div>
</body>
</html>