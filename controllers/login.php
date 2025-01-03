<?php
include "../Class/signup.php";
include "../instance/instace.php";
$signup = new AUTH($pdo);
$result = $signup->login();
if ($result["status"] == 0) {
    header("location: ../index.php?message=" . $result["error"]);
}
if ($result["status"] ==1) {
    echo $result["status"];
    setcookie("userID", $result['ID'], time() + 3600, "/");
    setcookie("ROLE", $result['role'], time() + 3600, "/");
    if ($result['role'] == 2) {
        header("location: ../client/home.php");
    } elseif ($result['role'] == 1) {
        header("location: ../admine/home.php");
    }
}
?>