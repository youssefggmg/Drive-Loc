<?php
class vehicul
{
    private $dbcon = null;
    private $Carname = "";
    private $CarColor = "";
    private $CarType = "";
    private $CarPrice = "";
    private $catigory = "";
    private $CarImage = "";
    private $CarID = "";

    public function __construct($dbcon)
    {
        $this->dbcon = $dbcon;
    }
    public function addVehicul()
    {
        try {
            $this->Carname = $_POST["carname"];
            $this->CarColor = $_POST["carColor"];
            $this->CarType = $_POST["cartype"];
            $this->CarPrice = $_POST["carPrise"];
            $this->catigory = $_POST["catigoryID"];
            $this->CarImage = $_POST["carImage"];
            $query = "INSERT INTO vehicles(vehiclesName,vehiclesColor,vehiclestype,vehiculImage,rent,catigorYid) values (:name,:color,:type,:image,:rent,:id )";
            $stmt = $this->dbcon->prepare($query);
            $executed = $stmt->execute([
                "name" => $this->Carname,
                "color" => $this->CarColor,
                "type" => $this->CarType,
                "image" => $this->CarPrice,
                "rent" => $this->catigory,
                "id" => $this->CarImage,
            ]);
            if ($executed) {
                return [
                    "status" => 1,
                    "message" => "success"
                ];
            }
        } catch (PDOException $e) {
            die("ther is an error <br>" . $e->getMessage());
        }
    }
    public function updateVehicul()
    {
        $this->CarID = $_POST["CID"] ?? null;
        $this->Carname = $_POST["carname"] ?? "";
        $this->CarColor = $_POST["carColor"] ?? "";
        $this->CarType = $_POST["cartype"] ?? "";
        $this->CarPrice = $_POST["carPrise"] ?? "";
        $this->catigory = $_POST["catigoryID"] ?? "";
        $this->CarImage = $_POST["carImage"] ?? "";

        // Check if CarID is provided
        if (empty($this->CarID)) {
            return ["status" => 0, "error" => "Car ID is required."];
        }

        // Prepare query dynamically
        $query = "UPDATE vehicles SET ";
        $params = [];

        if (!empty($this->Carname)) {
            $query .= "vehiclesName = :name, ";
            $params["name"] = $this->Carname;
        }
        if (!empty($this->CarColor)) {
            $query .= "vehicleColor = :color, ";
            $params["color"] = $this->CarColor;
        }
        if (!empty($this->CarType)) {
            $query .= "vehicleType = :type, ";
            $params["type"] = $this->CarType;
        }
        if (!empty($this->CarPrice)) {
            $query .= "vehiclePrice = :price, ";
            $params["price"] = $this->CarPrice;
        }
        if (!empty($this->catigory)) {
            $query .= "categoryID = :category, ";
            $params["category"] = $this->catigory;
        }
        if (!empty($this->CarImage)) {
            $query .= "vehicleImage = :image, ";
            $params["image"] = $this->CarImage;
        }

        // Remove the last comma and space
        $query = rtrim($query, ", ");
        $query .= " WHERE vehicleID = :id";
        $params["id"] = $this->CarID;

        try {
            $stmt = $this->dbcon->prepare($query);
            $executed = $stmt->execute($params);

            if ($executed) {
                return ["status" => 1, "message" => "Vehicle updated successfully."];
            } else {
                return ["status" => 0, "error" => "Failed to update vehicle."];
            }
        } catch (PDOException $e) {
            return ["status" => 0, "error" => $e->getMessage()];
        }
    }
}
