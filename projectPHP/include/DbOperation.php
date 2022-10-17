<?php

class DbOperation
{
    private $conn;

    function __construct()
    {
        require_once dirname(__FILE__) . '/Constants.php';
        require_once dirname(__FILE__) . '/DbConnect.php';
        // opening db connection
        $db = new DbConnect();
        $this->conn = $db->connect();
    }

    /*
     * This method is added
     * We are taking username and password
     * and then verifying it from the database
     * */

    public function userLogin($username, $pass)
    {
        $password = md5($pass);
        $stmt = $this->conn->prepare("SELECT users_ID FROM users WHERE users_name = ? AND users_password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }

    /*
     * After the successful login we will call this method
     * this method will return the user data in an array
     * */

    public function getUserByUsername($username)
    {
        $stmt = $this->conn->prepare("SELECT users_ID, users_name, users_email, users_phone, users_chineseName FROM users WHERE users_name = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($id, $name, $email, $phone, $chineseName);
        $stmt->fetch();
        $user = array();
        $user['users_ID'] = $id;
        $user['users_name'] = $name;
        $user['users_email'] = $email;
        $user['users_phone'] = $phone;
        $user['users_chineseName'] = $chineseName;
        
        return $user;
    }

    public function createUser($username, $pass, $email, $name, $phone)
    {
        if (!$this->isUserExist($username, $email, $phone)) {
            $password = md5($pass);
            $stmt = $this->conn->prepare("INSERT INTO users (users_name, users_password, users_email, users_chineseName, users_phone) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $username, $password, $email, $name, $phone);
            if ($stmt->execute()) {
                return USER_CREATED;
            } else {
                return USER_NOT_CREATED;
            }
        } else {
            return USER_ALREADY_EXIST;
        }
    }


    private function isUserExist($username, $email, $phone)
    {
        $stmt = $this->conn->prepare("SELECT users_ID FROM users WHERE users_name = ? OR users_email = ? OR users_phone = ?");
        $stmt->bind_param("sss", $username, $email, $phone);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }


}

?>