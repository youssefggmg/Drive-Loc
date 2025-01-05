<?php
include "../Class/rate.php";
include "../instance/instace.php";
$rate= new rate($pdo);
$Result = $rate->createRating();
if ($Result['status']==1) {
    header("location: ../client/car-single.php?message".$Result["message"]);
}
?>