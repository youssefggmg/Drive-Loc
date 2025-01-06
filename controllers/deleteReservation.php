<?php
include "../instance/instace.php";
include "../Class/reservation.php";
$reservation = new Reservation($pdo);
$id= $_GET['id'];
$result= $reservation->deleteReservation($id);
if ($result['status']==1) {
    header("location: ../client/myReservations.php");
}
?>