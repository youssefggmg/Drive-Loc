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
    private $lignes_par_page = 4;
    
    public function __construct($dbcon)
    {
        $this->dbcon = $dbcon;
    }
    public function getLinesParPage()
    {
        return $this->lignes_par_page;
    }
    public function totleCars (){
        $sql = "SELECT COUNT(*) as total FROM `vehicles`";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['total'];
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
    public function addMultiple()
{
    $primeSQuery = "SELECT vehiclesName FROM vehicles WHERE vehiclesName = :Vname";
    try {
        for ($i = 0; $i < $_POST["maxlength"]; $i++) {
            $this->Carname = $_POST["Vname" . $i];
            $this->CarColor = $_POST["carColor" . $i];
            $this->CarType = $_POST["cartype" . $i];
            $this->CarPrice = $_POST["carPrise" . $i];
            $this->catigory = $_POST["catigoryID" . $i];
            $this->CarImage = $_POST["carImage" . $i];
            
            $stmt = $this->dbcon->prepare($primeSQuery);
            $stmt->execute([
                "Vname" => $this->Carname
            ]);
            $exist = $stmt->fetch();
            
            if ($exist) {
                echo json_encode(["status" => 0, "error" => "This car already exists."]);
                exit; 
            }
        }

        for ($i = 0; $i < $_POST["maxlength"]; $i++) {
            $this->Carname = $_POST["Vname" . $i];
            $this->CarColor = $_POST["carColor" . $i];
            $this->CarType = $_POST["cartype" . $i];
            $this->CarPrice = $_POST["carPrise" . $i];
            $this->catigory = $_POST["catigoryID" . $i];
            $this->CarImage = $_POST["carImage" . $i];
            
            $INSERTQuery = "INSERT INTO vehicles(vehiclesName,vehiclesColor,vehiclestype,vehiculImage,rent,catigorYid) 
                            VALUES (:name, :color, :type, :image, :rent, :id)";
            $stmt = $this->dbcon->prepare($INSERTQuery);
            $executed = $stmt->execute([
                "name"  => $this->Carname,
                "color" => $this->CarColor,
                "type"  => $this->CarType,
                "image" => $this->CarImage,
                "rent"  => $this->CarPrice,
                "id"    => $this->catigory
            ]);
            
            if (!$executed) {
                echo json_encode(["status" => 0, "error" => "Something went wrong while adding vehicles."]);
                exit;
            }
        }

        // Success response
        echo json_encode(["status" => 1, "message" => "All vehicles were added successfully."]);
        exit;

    } catch (PDOException $e) {
        // Error response
        echo json_encode(["status" => 0, "error" => "Database error: " . $e->getMessage()]);
        exit;
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
    public function deleteVehicul()
    {
        try {
            $this->CarID = $_POST["CID"];
            $query = "DELETE FROM vehicles where vehiclesID = :id";
            $stmt = $this->dbcon->prepare($query);
            $stmt->execute([
                "id" => $this->CarID
            ]);
        } catch (PDOException $e) {
            die("there is an error " . $e->getMessage());
        }
    }
    public function allVehiculs($page)
    {
        $query = "SELECT * FROM vehicles LIMIT :offset,:limit ";
        try {
            $offset= ($page-1) * $this->lignes_par_page;
            $stmt = $this->dbcon->prepare($query);
            $stmt->bindValue(":offset", (int)$offset, PDO::PARAM_INT);
            $stmt->bindValue(":limit", (int)$this->lignes_par_page, PDO::PARAM_INT);
            $stmt->execute();
            $allVehicules = $stmt->fetchAll();
            $result = ["status" => 1, "allVehicules" => $allVehicules];
            return $result;
        } catch (PDOException $e) {
            return ["status" => 0, "error" => "pdo error </br>". $e->getMessage()];
        }
    }
    public function singleVehicul()
    {
        try {
            $vId = $_POST["VID"];
            $query = "SELECT * FROM vehicles WHERE vehiclesID=:id";
            $stmt = $this->dbcon->prepare($query);
            $executed = $stmt->execute([
                "id" => $vId
            ]);
            if ($executed) {
                return ["status" => 1, "result" => $executed->fetchAll()];
            }
        } catch (PDOException $e) {
            die("error" . $e->getMessage());
        }
    }
}
