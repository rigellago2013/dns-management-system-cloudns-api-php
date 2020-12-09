<?php
class DnsRecords
{
    private $conn;
    private $table = 'dns_records';

    /**
     *  Initialize connection upon instantiation of the class
     *  Date: October 19, 2020
     */
    public function __construct($db)
    {
        $this->conn = $db;
    }

    /**
     *  Create Dns Record
     *  Date: October 19, 2020
     */
    public function create($data)
    {
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO $this->table (id, domain_name, type, host, record, fail_over, ttl, status) VALUES(:id, :domain_name, :type, :host, :record, :fail_over, :ttl, :status)";
        $query = $this->conn->prepare($sql);
        $query->bindParam(':id', $data['id'], PDO::PARAM_STR);
        $query->bindParam(':domain_name', $data['domain_name'], PDO::PARAM_STR);
        $query->bindParam(':host', $data['host'], PDO::PARAM_STR);
        $query->bindParam(':record', $data['record'], PDO::PARAM_STR);
        $query->bindParam(':fail_over', $data['failover'], PDO::PARAM_STR);
        $query->bindParam(':ttl', $data['ttl'], PDO::PARAM_STR);
        $query->bindParam(':type', $data['type'], PDO::PARAM_STR);
        $query->bindParam(':status', $data['status'], PDO::PARAM_STR);
        if ($query->execute()) {
            $json_data = json_encode($data);
            $log_data = [
                    'table_name' => 'DNS_RECORD',
                    'request_method' => "INSERT",
                    'data' => $json_data,
            ];
            $q = "INSERT INTO logs(`table_name`, `request_method`, `data`) VALUES(:table_name, :request_method, :data)";
            $stmt= $this->conn->prepare($q);
            if($stmt->execute($log_data)) {
                return true;
            }
                return false;
        } else {
            return false;
        }
    }

    /**
    *  Update account
    *  @Params $password, $username, $id, $username, $password
    *  Date: October 19, 2020
    */
    public function update($data)
    {
        $data = [
            'id' => $data['dns-record-id'],
            'domain_name' => $data['domain_name'],
            'type' => $data['type'],
            'host' => $data['host'],
            'record' => $data['record'],
            'fail_over' => $data['fail_over'],
            'ttl' => $data['ttl'],
        ];    
        $query = "UPDATE $this->table SET 
                        domain_name = :domain_name, 
                        type = :type,
                        host = :host,
                        record = :record,
                        fail_over = :fail_over,
                        ttl = :ttl
                WHERE id = :id";
        $res = $this->conn->prepare($query)->execute($data);
        if(!empty($res)) {
        $json_data = json_encode($data);
        $log_data = [
                'table_name' => 'DNS_RECORD',
                'request_method' => "INSERT",
                'data' => $json_data,
        ];
        $q = "INSERT INTO logs(`table_name`, `request_method`, `data`) VALUES(:table_name, :request_method, :data)";
        $stmt= $this->conn->prepare($q);
        if($stmt->execute($log_data)) {
            return true;
        }
            return false;
        } else {
            return false;
        }
    }

    /**
    *  Delete record
    *  @Params $id
    *  Date: October 20, 2020
    */
    public function delete($id)
    {
        $query = "DELETE FROM $this->table WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id",$id,PDO::PARAM_INT);
        if($stmt->execute()) {
        $log_data = [
                'table_name' => 'DNS_RECORD',
                'request_method' => "DELETE",
                'data' => json_encode(['id' => $id]),
        ];
        $q = "INSERT INTO logs(`table_name`, `request_method`, `data`) VALUES(:table_name, :request_method, :data)";
        $stmt= $this->conn->prepare($q);
        if($stmt->execute($log_data)) {
            return true;
        }
            return false;
        } else {
            return false;
        }
    }

     /**
     *  @Params data from Cloudns API
     *  Check for existing records if not existing insert to db
     *  Date: October 22, 2020
     * 
     */
    public function checkDuplicateDeleteorCreate($data)
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
                    // $query->bindParam(':account_id', $account_id, PDO::PARAM_STR);
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
     *  Truncate dnsrecords table
     *  Date: October 27, 2020
     * 
     */
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

    /**
     *  Get distinct domains
     *  Date: October 30, 2020
     * 
     */
    public function distinctDomains()
    {
        $domains = $this->conn->query("SELECT DISTINCT domain_name FROM $this->table");
        $domains->execute();
        return $domains->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     *  Get distinct types
     *  Date: October 30, 2020
     * 
     */
    public function distinctTypes()
    {
        $domains = $this->conn->query("SELECT DISTINCT type FROM $this->table");
        $domains->execute();
        return $domains->fetchAll(PDO::FETCH_OBJ);
    }
}
