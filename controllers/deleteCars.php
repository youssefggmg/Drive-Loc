<?php
include "../Class/vehicul.php";
include "../instance/instace.php";
$vehicul = new vehicul($pdo);
$result= $vehicul->deleteVehicul();
if ($result['status']==1) {
    header("location: ../admine/car.php");
}
?>