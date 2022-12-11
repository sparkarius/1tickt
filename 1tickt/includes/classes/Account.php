<?php 
class Account { 

    private $connectionString;
    private $errArray = array();

    public function __construct($connectionString) {
        $this->connectionString = $connectionString;
    }

    public function login($user, $pass) {
        $pass = hash("sha512", $pass);

        $query = $this->connectionString->prepare("SELECT * FROM users WHERE username=:user AND password=:pass");
        $query->bindParam(":user", $user);
        $query->bindParam(":pass", $pass);
        
        $query->execute();

        if($query->rowCount() == 1) {
            return true;
        }
        else {
            array_push($this->errArray, Constants::$loginFailed);
            return false;
        }
    }

    public function register($first, $last, $username, $email, $email2, $password, $password2) {
        $this->validateFirstName($first);
        $this->validateLastName($last);
        $this->validateUsername($username);
        $this->validateEmails($email, $email2);
        $this->validatePasswords($password, $password2);

        if(empty($this->errArray)) {
            return $this->insertUserDetails($first, $last, $username, $email, $password);
        }
        else { 
            return false; 
        }
    }

    public function insertUserDetails($first, $last, $username, $email, $password) {
        $password = hash("sha512", $password);
        $pfp = "assets/images/profilePictures/default.png";

        $query = $this->connectionString->prepare("INSERT INTO users (firstName, lastName, username, email, password, profilePic)
                                                    VALUES (:firstName, :lastName, :username, :email, :pass, :pfp)");
        $query->bindParam(":firstName", $first);
        $query->bindParam(":lastName", $last);
        $query->bindParam(":username", $username);
        $query->bindParam(":email", $email);
        $query->bindParam(":pass", $password);
        $query->bindParam(":pfp", $pfp);

        return $query->execute();
    }

    private function validateFirstName($first) {
        if(strlen($first) > 25 || strlen($first) < 2) {
            array_push($this->errArray, Constants::$firstNameCharacters);
        }
    }

    private function validateLastName($last) {
        if(strlen($last) > 25 || strlen($last) <= 2) {
            array_push($this->errArray, Constants::$lastNameCharacters);
        }
    }

    private function validateUsername($username) {
        if(strlen($username) > 25 || strlen($username) < 5) {
            array_push($this->errArray, Constants::$usernameCharacters);
            return;
        }

        $query = $this->connectionString->prepare("SELECT username FROM users WHERE username=:username");
        $query->bindParam(":username", $username);
        $query->execute();

        if($query->rowCount() != 0) {
            array_push($this->errArray, Constants::$usernameTaken);
        }
    }

    private function validateEmails($email, $email2) {
        if($email != $email2) {
            array_push($this->errArray, Constants::$emailsDoNotMatch);
            return;
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errArray, Constants::$emailInvalid);
            return;
        }

        $query = $this->connectionString->prepare("SELECT username FROM users WHERE email=:email");
        $query->bindParam(":email", $email);
        $query->execute();

        if($query->rowCount() != 0) {
            array_push($this->errArray, Constants::$emailTaken);
        }
    }

    private function validatePasswords($password, $password2) {
        if($password != $password2) {
            array_push($this->errArray, Constants::$passwordsDoNotMatch);
            return;
        }

        if(preg_match("/[^A-Za-z0-9]/", $password)) {
            array_push($this->errArray, Constants::$passwordNotAlphanumeric);
            return;
        }

        if(strlen($password) > 30 || strlen($password) < 8) {
            array_push($this->errArray, Constants::$passwordLimit);
            return;
        }
    }

    public function getError($error) {
        if(in_array($error, $this->errArray)) {
            return "<span class='errorMessage'>$error</span>";
        }
    }
}

?>