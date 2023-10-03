<?
// Database connection for query
class Db {
    private $conn;
    private $host = 'wbd-db';
    private $user = 'user';
    private $pass = 'secret';
    private $db = 'wbd-db';

    public function __construct()
    {

        $this->conn = new mysqli($this->host, $this->user, $this->pass);
        if ($this->conn->connect_error) {
            die("db connection failed " . $this->conn->connect_error);
        }
    }

    public function query($sql) {
        $result = $this->conn->query($sql);
        if (!$result) {
            die("query error: " . $this->conn->error);
        }
        return $result;
    }

    public function getAllRecords($sql) {
        $result = $this->query($sql);
        $records = [];
        while ($row = $result->fetch_assoc()) {
            $records[] = $row;
        }
        return $records;
    }

    public function getSingleRecord($sql) {
        $result = $this->query($sql);
        return $result->fetch_assoc();
    }

    public function insertRecord($sql) {
        $result = $this->query($sql);
        return $this->conn->insert_id;
    }

    public function updateRecord($sql) {
        $this->query($sql);
    }

    public function deleteRecord($sql) {
        $this->query($sql);
    }

    public function closeConnection() {
        $this->conn->close();
    }
}
?>