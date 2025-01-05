<?php
class rate
{
    private $dbcon;
    private $userID;
    private $carID;
    private $rating;

    public function __construct($dbcon)
    {
        $this->dbcon = $dbcon;
    }

    public function createRating()
    {
        $this->userID = intval($_POST['user_id'] ?? "");
        $this->carID = intval($_POST['car_id'] ?? "");
        $this->rating = intval($_POST['rating'] ?? "");

        // Check if the rating already exists
        $selectQ = "SELECT * FROM reservation WHERE userID = :userID AND vehiculID = :carID";
        $stmt = $this->dbcon->prepare($selectQ);
        $stmt->bindParam(':userID', $this->userID);
        $stmt->bindParam(':carID', $this->carID);
        $stmt->execute();
        $result = $stmt->fetch();

        if ($result) {
            return ["status" => 0, "message" => "you did not rent this car before "];
        } else {
            // Insert new rating
            $insertQ = "INSERT INTO rate (user_id, car_id, rating) VALUES (:userID, :carID, :rating)";
            $stmt = $this->dbcon->prepare($insertQ);
            $stmt->bindParam(':userID', $this->userID);
            $stmt->bindParam(':carID', $this->carID);
            $stmt->bindParam(':rating', $this->rating);
            $stmt->execute();
            return ["status" => 1, "message" => "your rate was added succefully"];
        }
    }
    public function getMyReview($userID, $carID)
    {
        // Fetch single review based on userID and carID
        $query = "SELECT * FROM rate WHERE userID = :userID AND vehiculeID = :carID";
        $stmt = $this->dbcon->prepare($query);
        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':carID', $carID);
        $stmt->execute();
        $result = $stmt->fetch();

        if ($result) {
            return ["status" => 1, "rating" => $result['rate']];
        } else {
            return ["status" => 0, "message" => "No review found."];
        }
    }
}
?>