<?php
class Domains
{
    private $conn;
    private $table = 'domains';

    /**
     *  Initialize connection upon instantiation the class
     *  Date: October 6, 2020
     * 
     */
    public function __construct($db)
    {
        $this->conn = $db;
    }

    /**
     *  Insert Domains from Cloudns API
     *  @Params $data[]
     *  Date: October 6, 2020
     * 
     */
    public function insert($data)
    {
        $arr = [];
        $x = 0;
        $array_data = json_decode($data, true);
        foreach ($array_data as $value) {
            $arr[$x++] = [
                'name' => $value['name'],
                'status' => $value['status'],
                'registered_on' => $value['registered_on'],
                'expires_on' => $value['expires_on'],
                'privacy_protection' => $value['privacy_protection'],
            ];
        }
        //refactor for optimization
        for ($i = 0; $i < count($arr); $i++) {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO $this->table (name,status,registered_on,expires_on,privacy_protection) VALUES(:name, :status, :registered_on, :expires_on, :privacy_protection)";
            $query = $this->conn->prepare($sql);
            $query->bindParam(':name', $arr[$i]['name'], PDO::PARAM_STR);
            $query->bindParam(':status', $arr[$i]['status'], PDO::PARAM_STR);
            $query->bindParam(':registered_on', $arr[$i]['registered_on'], PDO::PARAM_STR);
            $query->bindParam(':expires_on', $arr[$i]['expires_on'], PDO::PARAM_STR);
            $query->bindParam(':privacy_protection', $arr[$i]['privacy_protection'], PDO::PARAM_STR);
        }
        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     *  Get domains from resource
     *  Date: October 6, 2020
     * 
     */
    public function findAll()
    {
        $i = 0;
        $data = [];
        $query = "SELECT * FROM $this->table ORDER BY id ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $domains = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach ($domains as $value) {
            $data[$i++] = [
                'id' => $value->id,
                'status' => $value->status,
                'name' => $value->name,
                'registered_on' =>   $value->registered_on,
                'expires_on' => $value->expires_on,
                'privacy_protection' => $value->privacy_protection,
            ];
        }
        return $data;
    }


    /**
     *  @Params data from Cloudns API
     *  Check for existing records if not existing insert to db
     *  Date: October 7, 2020
     * 
     */
    public function checkDuplicateDeleteorCreate($data, $account_id)
    {
        try {
            $arr = [];
            $x = 0;
            $array_data = json_decode($data, true);
            foreach ($array_data as $value) {
                $arr[$x++] = [
                    'name' => $value['name'],
                    'status' => $value['status'],
                    'registered_on' => $value['registered_on'],
                    'expires_on' => $value['expires_on'],
                    'privacy_protection' => $value['privacy_protection'],
                ];
            }
            foreach ($arr as $key => $value) {
                $query = "SELECT id, name, registered_on FROM domains WHERE name = :name LIMIT 1";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':name', $value['name']);
                $stmt->execute();
                if ($stmt->rowCount() == 0) {
                    // refactor for optimization
                    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "INSERT INTO $this->table (name,status,registered_on,expires_on,privacy_protection, account_id) VALUES(:name, :status, :registered_on, :expires_on, :privacy_protection, :account_id)";
                    $query = $this->conn->prepare($sql);
                    $query->bindParam(':name', $value['name'], PDO::PARAM_STR);
                    $query->bindParam(':status', $value['status'], PDO::PARAM_STR);
                    $query->bindParam(':registered_on', $value['registered_on'], PDO::PARAM_STR);
                    $query->bindParam(':expires_on', $value['expires_on'], PDO::PARAM_STR);
                    $query->bindParam(':privacy_protection', $value['privacy_protection'], PDO::PARAM_STR);
                    $query->bindParam(':account_id', $account_id, PDO::PARAM_STR);
                    $query->execute();

                    
                } else if($stmt->rowCount() > 0) {
                    $data = $stmt->fetch(PDO::FETCH_OBJ);
                    $q = "DELETE FROM $this->table WHERE id = :id";
                    $delete_dom = $this->conn->prepare($q);
                    $delete_dom->bindParam(":id",$data->id,PDO::PARAM_INT);
                    $delete_dom->execute();
                }
            }
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    /**
     *  Fetch By Account Id
     *  @Params $account_id
     *  Date: October 13, 2020
     */
    public function getByAccountId($account_id)
    {
        $query = "SELECT * FROM $this->table WHERE account_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $account_id);
        $stmt->execute();
        try {
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function findAllWithAccounts()
    {
        $query = "SELECT
                        a.id AS a_id,
                        a.auth_id AS a_auth_id,
                        a.auth_password AS a_auth_password,
                        d.id AS d_id,
                        d.name AS d_name
                FROM accounts a 
                INNER JOIN domains d
                ON a.id = d.account_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }


    /**
     *  Delete account
     *  @Params $id
     *  Date: October 9, 2020
     */
    public function delete($data)
    {
        $query = "DELETE FROM $this->table WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $data['id'], PDO::PARAM_INT);
        if ($stmt->execute()) {
            $log_data = [
                'table_name' => 'DNS_RECORD',
                'request_method' => "DELETE",
                'data' => json_encode($data),
            ];
            $q = "INSERT INTO logs(`table_name`, `request_method`, `data`) VALUES(:table_name, :request_method, :data)";
            $query = $this->conn->prepare($q);
            if ($query->execute($log_data)) {
                return true;
            }
            return false;
        } else {
            return false;
        }
    }

    public function clear()
    {
        $query = "TRUNCATE TABLE $this->table";
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function countPerAccount($account_id)
    {
        $domains = $this->conn->query("SELECT * FROM domains WHERE account_id = $account_id");
        $domains->execute();
        $domains->fetchAll();
        return $domains->rowCount();
    }


}
