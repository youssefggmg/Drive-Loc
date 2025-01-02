<?php
class Reservation
{
    private $id;
    private $startdate;
    private $enddate;
    private $place;
    private $userID;
    private $vehicul;
    private $dbcon;
    public function __construct($dbcon)
    {
        $this->dbcon = $dbcon;
    }
    public function addReservation()
    {
        $query = "INSERT INTO reservation (startdate, endDate, placeID, vehiculID, userID) 
                  VALUES (:startdate, :endDate, :placeID, :vehiculID, :userID)";
        try {
            // Get user inputs
            $this->startdate = $_POST["startdate"];
            $this->enddate = $_POST["endDate"];
            $this->place = $_POST["placeID"];
            $this->vehicul = $_POST["vehiculID"];
            $this->userID = $_POST["userID"];

            // Prepare and execute the query
            $stmt = $this->dbcon->prepare($query);
            $executed = $stmt->execute([
                "startdate" => $this->startdate,
                "endDate" => $this->enddate,
                "placeID" => $this->place,
                "vehiculID" => $this->vehicul,
                "userID" => $this->userID
            ]);
            // Return JSON response
            if ($executed) {
                return json_encode(["status" => 1, "message" => "Reservation added successfully"]);
            } else {
                return json_encode(["status" => 0, "error" => "Failed to add reservation"]);
            }
        } catch (PDOException $e) {
            return json_encode(["status" => 0, "error" => $e->getMessage()]);
        }
    }
    public function editReservation()
    {
        $query = "UPDATE reservation 
                  SET startdate = :startdate, endDate = :endDate, placeID = :placeID, vehiculID = :vehiculID, userID = :userID 
                  WHERE id = :id";

        try {
            // Get user inputs
            $this->id = $_POST["id"];
            $this->startdate = $_POST["startdate"];
            $this->enddate = $_POST["endDate"];
            $this->place = $_POST["placeID"];
            $this->vehicul = $_POST["vehiculID"];
            $this->userID = $_POST["userID"];

            // Prepare and execute the query
            $stmt = $this->dbcon->prepare($query);
            $executed = $stmt->execute([
                "id" => $this->id,
                "startdate" => $this->startdate,
                "endDate" => $this->enddate,
                "placeID" => $this->place,
                "vehiculID" => $this->vehicul,
                "userID" => $this->userID
            ]);
            // Return JSON response
            if ($executed) {
                return json_encode(["status" => 1, "message" => "Reservation updated successfully"]);
            } else {
                return json_encode(["status" => 0, "error" => "Failed to update reservation"]);
            }
        } catch (PDOException $e) {
            return json_encode(["status" => 0, "error" => $e->getMessage()]);
        }
    }

}
?>