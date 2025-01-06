<?php
include "../Class/place.php";
include "../Class/reservation.php";
include "../instance/instace.php";
$place = new Place($pdo);
$reservation = new Reservation($pdo);
$thisreservation = $reservation->getSingleReservation($_GET["id"])["data"];
$allplaces = $place->getallplaces()["places"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 min-h-screen flex items-center justify-center">
    <div class="max-w-lg w-full bg-white shadow-2xl rounded-lg p-8">
        <h1 class="text-4xl font-extrabold text-center text-gray-800 tracking-wide">✨ ADD RESERVATION</h1>
        <form action="../controllers/addReservation.php" method="POST" id="dynamicForm"
            class="space-y-6 max-w-xl mx-auto">

            <!-- Start Date Field -->
            <div>
                <label for="startdate" class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                <input type="date" id="startdate" name="startdate" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 placeholder-gray-400"
                    required value="<?php echo $thisreservation['startdate']?>" />
            </div>
            <input type="number" hidden value="<?php echo $_GET["id"] ?>" name="id">

            <!-- End Date Field -->
            <div>
                <label for="enddate" class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                <input type="date" id="enddate" name="endDate"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 placeholder-gray-400"
                    required value="<?php echo $thisreservation['endDate']?>" />
            </div>

            <!-- Place Field -->
            <div>
                <label for="placeID" class="block text-sm font-medium text-gray-700 mb-1">Place</label>
                <select id="placeID" name="placeID"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300">
                    <?php foreach ($allplaces as $place) { ?>
                        <option value="<?php echo $place['id']; ?>"><?php echo $place['placeName'];
                           ?></option>
                    <?php } ?>
                </select>
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-between">
                <button type="submit"
                    class="flex items-center justify-center bg-gradient-to-r from-blue-400 to-blue-500 hover:from-blue-500 hover:to-blue-600 text-white font-medium py-2 px-5 rounded-lg shadow-md transform transition hover:scale-105">
                    Submit
                </button>
            </div>
        </form>
    </div>
</body>

</html>