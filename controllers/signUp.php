<?php
include "../Class/signup.php";
include "../instance/instace.php";
$signup = new AUTH($pdo);
$result=$signup->signup();
if ($result["status"]=0) {
    header("location: ../sign.php?message=".$result["error"]);
}
if ($result["status"]=1) {
    setcookie("userID", $result['index'], time() + 3600,"/");
    setcookie("ROLE", $result['role'], time() + 3600,"/");
    header("location: ../client/home.php");
}
?>