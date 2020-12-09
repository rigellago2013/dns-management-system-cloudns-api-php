<?php
class Maintenance
{
    private $conn;
    private $table = 'maintenance';

    /**
     *  Initialize connection upon instantiation of the class
     *  Date: October 16, 2020
     */
    public function __construct($db)
    {
        $this->conn = $db;
    }
    
    /**
     *  Initialize connection upon instantiation of the class
     *  Date: October 18, 2020
     */
    public function syncAll()
    {
        //
        date_default_timezone_set('Etc/GMT+9');
        $date = date('m/d/Y h:i:s a', time());
        $success = true;
        $btn_name = 'btn-sync-all';
        //Insert to logs and btn logs
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO sync_button_logs (button_name, status) VALUES(:button_name, :status)";
        $query = $this->conn->prepare($sql);
        $query->bindParam(':button_name',$btn_name , PDO::PARAM_STR);
        $query->bindParam(':status', $success, PDO::PARAM_STR);
        $query->execute();

        $latest_btn_sync_all = $this->conn->query("SELECT * FROM sync_button_logs ORDER BY id DESC LIMIT 1");
        $data = $latest_btn_sync_all->fetch(PDO::FETCH_OBJ);

        if($data) {
            return $data;
        } else {
            return false;
        }
    }
    public function syncDomain()
    {
        # code...
    }

    public function syncDnsRecords()
    {
        # code...
    }   

    public function getLatestSyncAllRecord()
    { 
        $latest_btn_sync_all = $this->conn->query("SELECT * FROM sync_button_logs ORDER BY id DESC LIMIT 1");
        $data = $latest_btn_sync_all->fetch(PDO::FETCH_OBJ);
        if($data) {
            return $data;
        } else {
            return false;
        }
    }

    public function countAccounts()
    {
        $accounts = $this->conn->query("SELECT * FROM accounts");
        $accounts->execute();
        $data = $accounts->fetchAll();
        return $accounts->rowCount();
        
    }

    public function countDomains()
    {
        $domains = $this->conn->query("SELECT * FROM domains");
        $domains->execute();
        $data = $domains->fetchAll();
        return $domains->rowCount();
        
    }

    public function countDnsRecords()
    {
        $dns_records = $this->conn->query("SELECT * FROM dns_records");
        $dns_records->execute();
        $data = $dns_records->fetchAll();
        return $dns_records->rowCount();
        
    }


}
