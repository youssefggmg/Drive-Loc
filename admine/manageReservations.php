<?php
include "../Class/reservation.php";
include "../instance/instace.php";

$reservationObj = new Reservation($pdo);

$userID = $_COOKIE["userID"];

$response = $reservationObj->allReservation();

if ($response['status'] === 1) {
    $reservations = $response['data'];
} else {
    $reservations = [];
    $errorMessage = $response['message'] ?? 'An error occurred';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Reservations</title>
    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/ionicons.min.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="home.php">Car<span>Book</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a href="home.php" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="myReservations.php" class="nav-link">My Reservation</a></li>
                    <li class="nav-item"><a href="pricing.php" class="nav-link">Pricing</a></li>
                    <li class="nav-item"><a href="car.php" class="nav-link">Cars</a></li>
                    <li class="nav-item"><a href="blog.php" class="nav-link">Blog</a></li>
                    <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mx-auto mt-12 px-6 mt-[10em] mb-[10em]">
        <!-- Page Title -->
        <h2 class="text-4xl font-extrabold text-center text-gray-900 mb-8">Your Reservations</h2>

        <!-- Error or Success Message -->
        <?php if (isset($errorMessage)): ?>
            <div class="mb-6 p-4 bg-red-100 text-red-800 border border-red-400 rounded-lg shadow-md">
                <?= htmlspecialchars($errorMessage) ?>
            </div>
        <?php endif; ?>

        <!-- Reservations Table -->
        <?php if (!empty($reservations)): ?>
            <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
                <table class="min-w-full table-auto border-collapse text-sm">
                    <thead class="bg-gradient-to-r from-blue-600 to-teal-600 text-white">
                        <tr>
                            <th class="py-4 px-6 text-left">Vehicle</th>
                            <th class="py-4 px-6 text-left">Color</th>
                            <th class="py-4 px-6 text-left">Type</th>
                            <th class="py-4 px-6 text-left">Rent</th>
                            <th class="py-4 px-6 text-left">Vehicle Image</th>
                            <th class="py-4 px-6 text-left">Start Date</th>
                            <th class="py-4 px-6 text-left">End Date</th>
                            <th class="py-4 px-6 text-left">Reservation Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        <?php foreach ($reservations as $reservation): ?>
                            <tr class="border-t hover:bg-gray-50">
                                <td class="py-4 px-6 font-medium text-gray-800">
                                    <?= htmlspecialchars($reservation['vehiclesName']) ?>
                                </td>
                                <td class="py-4 px-6"><?= htmlspecialchars($reservation['vehiclesColor']) ?></td>
                                <td class="py-4 px-6"><?= htmlspecialchars($reservation['vehiclestype']) ?></td>
                                <td class="py-4 px-6 font-bold text-teal-600"><?= htmlspecialchars($reservation['rent']) ?> MAD
                                </td>
                                <td class="py-4 px-6">
                                    <img src="<?= htmlspecialchars($reservation['vehiculImage']) ?>" alt="Vehicle Image"
                                        class="w-20 h-20 object-cover rounded-full shadow-md">
                                </td>
                                <td class="py-4 px-6"><?= htmlspecialchars($reservation['startdate']) ?></td>
                                <td class="py-4 px-6"><?= htmlspecialchars($reservation['endDate']) ?></td>
                                <td class="py-4 px-6 capitalize">
                                    <select class="border rounded-lg p-2"
                                        onchange="updateStatus(this, <?= $reservation['reservationID'] ?>)">
                                        <option value="pending" <?= $reservation['reservation_status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                                        <option value="accepted" <?= $reservation['reservation_status'] === 'accepted' ? 'selected' : '' ?>>Accepted</option>
                                        <option value="rejected" <?= $reservation['reservation_status'] === 'rejected' ? 'selected' : '' ?>>Rejected</option>
                                    </select>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="mt-4 p-4 bg-yellow-100 text-yellow-800 border border-yellow-400 rounded-lg shadow-md">
                No reservations found.
            </div>
        <?php endif; ?>
    </div>
    <script>
        function updateStatus(select, reservationID) {
            const status = select.value;
            fetch(`../controllers/updateStatus.php?id=${reservationID}&status=${status}`, {
                method: 'GET'
            })
        }
    </script>
</body>

</html>