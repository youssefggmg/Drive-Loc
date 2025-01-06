<?php 
include "../instance/instace.php";
include "../Class/reservation.php";
$reservation = new Reservation($pdo);
$Result=$reservation->updateReservationStatus();
?>