<?php 
class Place {
    private $dbcon;

    public function __construct($dbcon)
    {
        $this->dbcon = $dbcon;
    }
    public function getAllPlaces()
    {

        $query = "SELECT * FROM place";
        $stmt = $this->dbcon->prepare($query);
        $stmt->execute();

        $places = $stmt->fetchAll();
        if ($places) {
            return ["status"=>1,"places"=>$places];
        }

    }
}

?>