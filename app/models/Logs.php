<?php
class Logs
{
    private $conn;
    private $table = 'logs';

    /**
     *  Initialize connection upon instantiation of the class
     *  Date: October 17, 2020
     */
    public function __construct($db)
    {
        $this->conn = $db;
    }
    

    /**
     *  Logs counter
     *  Date: October 20, 2020
     */
    public function countLogs()
    {
        $logs = $this->conn->query("SELECT * FROM logs");
        $logs->execute();
        $logs->fetchAll();
        return $logs->rowCount();
        
    }

    /**
     *  Show account
     *  @Params $id 
     *  Date: October 20, 2020
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
     *  Clear all log data
     *  Date: October 28, 2020
     */
    public function clearAll()
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
     *  Show all logs for current day
     *  Date: October 28, 2020
     */
    public function clearToday()
    {
        $query = "DELETE FROM $this->table WHERE recorded_on = CURDATE()";
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     *  Remove logs by date
     *  @Params $from $to
     *  Date: October 28, 2020
     */
    public function clearByDate($from, $to)
    {
        $query = "DELETE FROM $this->table WHERE recorded_on BETWEEN $from AND $to";
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
