<?php
include '../includes/dbh.inc.php';
$status = '';
$targetDir = "../uploads/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
    $allowTypes = array('txt','png','jpeg','gif','pdf','sql');
    if(in_array($fileType, $allowTypes)){
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            $insert = $conn->query("INSERT INTO images (file_name) VALUES ('".$fileName."')");
            if($insert == false){
                $status = "Siema udało ci sie dodać plik: ".$fileName;
            }else{
                $status = "Coś się zepsuło, spróbuj ponownie przesłać plik";
            } 
        }else{
            $status = "Yikes, coś się zepsuło przy przesyłaniu pliku";
        }
    }else{
        $status = 'Pardon ale tylko prześlesz pliki z rozszerzeniem: txt, JPEG, PNG, GIF, PDF oraz sql';
    }
}else{
    $status = 'Well shit, naucz się wybierać pliki jak chcesz je wysyłać *facepalm*.';
}
header('Location: ../panel.php?fileuploaded');