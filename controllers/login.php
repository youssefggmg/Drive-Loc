<?php
include "../Class/signup.php";
include "../instance/instace.php";
$signup = new AUTH($pdo);
$result=$signup->login();
if ($result["status"]=0) {
    header("location: ../index.php?message=".$result["error"]);
}
if ($result["status"]=1) {
    setcookie("userID", $result['ID'], time() + 3600,"/");
    setcookie("roleID", $result['role'], time() + 3600,"/");
    header("location: ../client/home.php");
}
?>