<?php 
include "../instance/instace.php";
include "../Class/reservation.php";
$reservation = new Reservation($pdo);
$result= $reservation->editReservation();
if ($result['status']==1) {
    header("location: ../client/editReservation.php");
}
?>