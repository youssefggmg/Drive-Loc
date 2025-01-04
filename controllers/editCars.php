<?php 
include "../Class/vehicul.php";
include "../instance/instace.php";
$vehicul=  new vehicul($pdo);
$result = $vehicul->updateVehicul();
if ($result['status']==1) {
    header("location: ../admine/car.php");
}
else {
    echo $result['message'];
    echo $result['error'];
}
?>