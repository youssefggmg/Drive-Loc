<?php
class AUTH
{
    private $dbcon;
    private $name;
    private $email;
    private $password;
    private $hashedPassword;

    public function __construct($dbcon)
    {
        $this->dbcon = $dbcon;
    }

    public function signup()
    {
        // Validate and sanitize POST data
        $this->name = $_POST['name'];
        $this->email = $_POST['email'] ;
        $this->password = $_POST['password'];
        $this->hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

        // Check if email already exists
        $fideQ = "SELECT * from user WHERE user_email = :email";
        $stmt = $this->dbcon->prepare($fideQ);
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();
        $exist = $stmt->fetch();

        if ($exist) {
            return ["status" => 0, "error" => "Email already exists"];
        }

        // Insert new user into the database
        $query = "INSERT INTO user (user_name, user_email, password, role) values (:username, :email, :password, :role)";
        $stmt = $this->dbcon->prepare($query);
        $executed = $stmt->execute([
            'username' => $this->name,
            'email' => $this->email,
            'password' => $this->hashedPassword,
            'role' => 2
        ]);

        if ($executed) {
            $lastIndex = $this->dbcon->lastInsertId();
            return ["status" => 1, "index" => $lastIndex, "role" => 2];
        } else {
            return ["status" => 0, "error" => "Something went wrong, please try again"];
        }
    }

    public function login()
    {
        $this->email = $_POST['email'];
        $this->password = $_POST['password'];

        // Check if the user exists
        $query = "SELECT * FROM user WHERE user_email = :email";
        $stmt = $this->dbcon->prepare($query);
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();
        $exist = $stmt->fetch();
        var_dump($exist);

        if ($exist) {
            $isIdentical = password_verify($this->password, $exist["password"]);
            
            if ($isIdentical) {
                return [
                    "status" => 1,
                    "ID" => $exist["userID"],
                    "role" => $exist["role"],
                ];
            } else {
                return ["status" => 0, "error" => "Invalid credentials, please try again"];
            }
        } else {
            return ["status" => 0, "error" => "User not found"];
        }
    }
}
?>