<?php
include "../Class/vehicul.php";
include "../instance/instace.php";
$vehicul= new vehicul($pdo);
$result=$vehicul->addMultiple();
if($result==1){
    header("location: ../admine/car.php");
}

?>