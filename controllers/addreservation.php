<?php 
include "../Class/reservation.php";
include "../instance/instace.php";
$reservation = new Reservation($pdo);
$reservations = $reservation->addReservation();
if ($reservations["status"] == 1 ) {
    header("location: ../client/car.php");
}
?>