<?php
include "../Class/vehicul.php";
include "../instance/instace.php";
$vehicul=  new vehicul($pdo);
$vehicul->filteredCars();
?>