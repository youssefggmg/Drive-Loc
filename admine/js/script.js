const dynamicButton = document.getElementById("addField");
const form = document.getElementById("adding");
let fieldNum = 0;

const allCategories = [
    { catigorYid: 1, catigoryName: "Economy" },
    { catigorYid: 2, catigoryName: "SUV" },
    { catigorYid: 3, catigoryName: "Luxury" },
    { catigorYid: 4, catigoryName: "Convertible" },
    { catigorYid: 5, catigoryName: "Compact" },
    { catigorYid: 6, catigoryName: "Midsize" },
    { catigorYid: 7, catigoryName: "Full-size" },
    { catigorYid: 8, catigoryName: "Pickup Truck" },
    { catigorYid: 9, catigoryName: "Van" },
    { catigorYid: 10, catigoryName: "Sports Car" },
    { catigorYid: 11, catigoryName: "Electric" },
    { catigorYid: 12, catigoryName: "Hybrid" },
    { catigorYid: 13, catigoryName: "Minivan" },
    { catigorYid: 14, catigoryName: "Off-Road" },
    { catigorYid: 15, catigoryName: "Luxury SUV" },
    { catigorYid: 16, catigoryName: "Coupe" },
    { catigorYid: 17, catigoryName: "Wagon" },
    { catigorYid: 18, catigoryName: "Crossover" },
    { catigorYid: 19, catigoryName: "Diesel" },
    { catigorYid: 20, catigoryName: "Exotic" },
    { catigorYid: 21, catigoryName: "Classic" }
];

function addField() {
    fieldNum++;

    const maxlengthInput = document.getElementById("maxlength");
    maxlengthInput.value = fieldNum;
    console.log(maxlengthInput.value);
    

    const newField = `
    <hr>
    <br>
    <div class="field${fieldNum}">
        <!-- Car Model Field -->
        <div>
            <label for="carModel-${fieldNum}" class="block text-sm font-medium text-gray-700 mb-1">Car Model</label>
            <input type="text" id="carModel-${fieldNum}" name="Vname[]"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 placeholder-gray-400"
                placeholder="Enter the car model" required />
        </div>

        <!-- Type Field -->
        <div>
            <label for="type-${fieldNum}" class="block text-sm font-medium text-gray-700 mb-1">Type</label>
            <input type="text" id="type-${fieldNum}" name="cartype[]"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 placeholder-gray-400"
                placeholder="Enter the car type" required />
        </div>

        <!-- Price Field -->
        <div>
            <label for="price-${fieldNum}" class="block text-sm font-medium text-gray-700 mb-1">Price</label>
            <input type="text" id="price-${fieldNum}" name="carPrise[]"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 placeholder-gray-400"
                placeholder="Enter the price" required />
        </div>

        <!-- Color Field -->
        <div>
            <label for="color-${fieldNum}" class="block text-sm font-medium text-gray-700 mb-1">Color</label>
            <input type="text" id="color-${fieldNum}" name="carColor[]"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 placeholder-gray-400"
                placeholder="Enter the color" required />
        </div>

        <!-- Image URL Field -->
        <div>
            <label for="imageUrl-${fieldNum}" class="block text-sm font-medium text-gray-700 mb-1">Image URL</label>
            <input type="url" id="imageUrl-${fieldNum}" name="carImage[]"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 placeholder-gray-400"
                placeholder="Enter the image URL" required />
        </div>

        <!-- Category Field -->
        <div>
            <label for="category-${fieldNum}" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
            <select id="category-${fieldNum}" name="catigoryID[]"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300">
                ${generateCategoryOptions()}
            </select>
        </div>
    </div>`;

    form.insertAdjacentHTML("beforeend", newField);
}

function generateCategoryOptions() {
    let options = '';
    allCategories.forEach(category => {
        options += `<option value="${category.catigorYid}">${category.catigoryName}</option>`;
    });
    return options;
}

dynamicButton.addEventListener("click", addField);
