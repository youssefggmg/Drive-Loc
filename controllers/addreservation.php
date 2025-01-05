<?php 
include "../Class/reservation.php";
include "../instance/instace.php";
$reservation = new Reservation($pdo);
$reservation->addReservation();
?>