<?php
class Catigory {
    private $dbcon;

    public function __construct($dbcon)
    {
        $this->dbcon = $dbcon;
    }

    public function addCategory()
    {
        $query = "INSERT INTO catigory (catigoryName) VALUES (:catigoryName)";

        try {
            $catigoryName = $_POST["catigoryName"];

            $stmt = $this->dbcon->prepare($query);
            $executed = $stmt->execute([
                "catigoryName" => $catigoryName
            ]);

            if ($executed) {
                return json_encode(["status" => 1, "message" => "Category added successfully"]);
            } else {
                return json_encode(["status" => 0, "error" => "Failed to add category"]);
            }
        } catch (PDOException $e) {
            return json_encode(["status" => 0, "error" => $e->getMessage()]);
        }
    }

    
}
?>
