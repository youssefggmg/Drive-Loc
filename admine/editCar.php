<?php 
include "../Class/vehicul.php";
include "../instance/instace.php";
include "../Class/catigory.php";
$vehicul = new vehicul($pdo);
$catigory = new catigory($pdo);
$roleValidation= new roleValidation();
$roleValidation->isAdmine();
$vehiculInfo= $vehicul->singleVehicul();
$something= $vehiculInfo['result'][0];
$allcatigorys= $catigory->getAllCategories()['categories'];

// var_dump($allcatigorys);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Stylish Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 min-h-screen flex items-center justify-center">
    <div class="max-w-lg w-full bg-white shadow-2xl rounded-lg p-8">
        <h1 class="text-4xl font-extrabold text-center text-gray-800 tracking-wide">✨ editCar CARS</h1>
        <form action="your_backend_script.php" method="POST" id="dynamicForm" class="space-y-6 max-w-xl mx-auto">
        
                <?php echo "<input type='number'  name='VID'
                class='w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 placeholder-gray-400 hidden '
                placeholder='Enter the car model' required value='".$something["vehiclesID"]."' />"?>
            <!-- Car Model Field -->
            <div>
                <label for="carModel" class="block text-sm font-medium text-gray-700 mb-1">Car Model</label>
                <input type="text" id="carModel" name="carname"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 placeholder-gray-400"
                    placeholder="Enter the car model" required value="<?php echo $something["vehiclesName"]?>" />
            </div>

            <!-- Description Field -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">color</label>
                <input type="text" id="carModel" name="carColor"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 placeholder-gray-400"
                    placeholder="Enter the car model" required value="<?php echo $something["vehiclesColor"]?>" />
            </div>
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">color</label>
                <input type="text" id="price" name="carPrise"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 placeholder-gray-400"
                    placeholder="Enter the car model" required value="<?php echo $something["rent"]?>" />
            </div>

            <!-- Image URL Field -->
            <div>
                <label for="imageUrl" class="block text-sm font-medium text-gray-700 mb-1">Image URL</label>
                <input type="url" id="imageUrl" name="carImage"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 placeholder-gray-400"
                    placeholder="Enter the image URL" required value="<?php echo $something["vehiculImage"]?>" />
            </div>

            <!-- Category Field -->
            <div>
                <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                <select id="category" name="category"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300">
                    <?php
                    foreach ($allcatigorys as $catigory) {
                        echo '<option value="' . $catigory['catigoryName'] . '">' . $catigory['catigoryName'] . '</option>';
                    }
                    ?> 
                </select>
            </div>

            <div id="adding"></div>

            <!-- Buttons -->
            <div class="flex items-center justify-between" id="buttons">
                <button type="submit"
                    class="flex items-center justify-center bg-gradient-to-r from-blue-400 to-blue-500 hover:from-blue-500 hover:to-blue-600 text-white font-medium py-2 px-5 rounded-lg shadow-md transform transition hover:scale-105">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path d="M5 10a5 5 0 1010 0 5 5 0 00-10 0z" />
                    </svg>
                    Submit
                </button>
            </div>
        </form>
    </div>

    <script src="main.js"></script>
</body>

</html>