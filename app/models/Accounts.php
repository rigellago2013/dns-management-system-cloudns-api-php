<?php
class Accounts
{
    private $conn;
    private $table = 'accounts';

    /**
     *  Initialize connection upon instantiation of the class
     *  Date: October 8, 2020
     */
    public function __construct($db)
    {
        $this->conn = $db;
    }

    /**
     *  Create accounts
     *  @Params $authid, $authpassword, $username, $password
     *  Date: October 8, 2020
     */
    public function create($authid, $authpassword, $username, $password)
    {
        // $password = password_hash($authpassword, PASSWORD_DEFAULT); 
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO $this->table (auth_id, auth_password, username, password) VALUES(:authid, :authpassword, :username, :password)";
        $query = $this->conn->prepare($sql);
        $query->bindParam(':authid', $authid, PDO::PARAM_STR);
        $query->bindParam(':authpassword', $authpassword, PDO::PARAM_STR);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        if($query->execute()){
        $log_data = [
                'table_name' => 'ACCOUNTS',
                'request_method' => "INSERT",
                'data' => json_encode(['authid' => $authid, 'authpassword' => $authpassword, 'username' => $username, 'password' => $password]),
        ];
        $q = "INSERT INTO logs(`table_name`, `request_method`, `data`) VALUES(:table_name, :request_method, :data)";
        $stmt= $this->conn->prepare($q);
        if($stmt->execute($log_data)) {
            return true;
        } return false;
        } else {
            return false;
        }
    }

    /**
     *  Show account
     *  @Params $id 
     *  Date: October 9, 2020
     */
    public function show($id)
    {
        $query = "SELECT * FROM $this->table WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
    *  Update account
    *  @Params $password, $username, $id, $username, $password
    *  Date: October 9, 2020
    */
    public function update($authpassword, $id, $username, $password)
    {
        $password = password_hash($authpassword, PASSWORD_DEFAULT); 
        $data = [
            'username' => $username,
            ':authpassword' => $password,
            ':id' => $id
        ];    
        $query = "UPDATE $this->table SET auth_password = :authpassword, username = :username WHERE id = :id";
        $res = $this->conn->prepare($query)->execute($data);
        if(!empty($res)) {
            return true;
        } else {
            return false;
        }
    }

    /**
    *  Delete account
    *  @Params $id
    *  Date: October 9, 2020
    */
    public function delete($id)
    {
        $query = "DELETE FROM $this->table WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id",$id,PDO::PARAM_INT);
        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
    *  All accounts
    *  Date: October 13, 2020
    *
    */
    public function all()
    {
        $query = "SELECT * FROM $this->table ORDER BY id ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $accounts = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $accounts;
    }

    /****
     *  Authentication for account
     *  Date November 3, 2020
     */
    public function authenticate($username, $password)
    {
        $query = "SELECT * FROM $this->table WHERE username = :username AND password = :password ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

}
