<?php
$fileNames = $_POST['filenamedel'];
    $removeSpaces = str_replace(" ","", $fileNames);
    $allFileNames = explode(",", $removeSpaces);
    $countAllNames = count($allFileNames);

    for($i=0;$i<$countAllNames;$i++){
        if(file_exists("../uploads/".$allFileNames[$i]) == false){
            header('Location: ../panel.php?deleteerror');
        }
    }
    for($i=0;$i<$countAllNames;$i++){
        $path = "../uploads/".$allFileNames[$i];
        if(!unlink($path)){
            echo "Nie działa sadge";
        }
        else{
            header('Location: ../panel.php?ochuydziala');
        }
    }