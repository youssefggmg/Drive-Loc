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
                return ["status" => 1, "message" => "Reservation added successfully"];
            } else {
                return ["status" => 0, "error" => "Failed to add reservation"];
            }
        } catch (PDOException $e) {
            return ["status" => 0, "error" => $e->getMessage()];
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
    public function getReservationDetails($userID)
    {
        $query = "SELECT 
                    v.vehiclesID, 
                    v.vehiclesName, 
                    v.vehiclesColor, 
                    v.vehiclestype, 
                    v.rent, 
                    v.vehiculImage, 
                    v.catigorYid, 
                    r.reservationID, 
                    r.startdate, 
                    r.endDate, 
                    r.status AS reservation_status, 
                    r.placeID, 
                    r.userID
                    FROM vehicles v, reservation r
                    WHERE v.vehiclesID = r.vehiculID
                    AND r.userID =  :userID";

        try {
            $stmt = $this->dbcon->prepare($query);
            $stmt->execute(["userID" => $userID]);

            // Fetch all results
            $reservations = $stmt->fetchAll();

            // Return results
            if ($reservations) {
                return ["status" => 1, "data" => $reservations];
            } else {
                return ["status" => 0, "message" => "No reservations found for this user."];
            }
        } catch (PDOException $e) {
            return ["status" => 0, "error" => $e->getMessage()];
        }
    }

}
?>