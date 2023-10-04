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

    public function prepare($sql) {
        return $this->conn->prepare($sql);
    }

    public function bindParams(mysqli_stmt $stmt, string $types, ...$vars) {
        return $stmt->bind_param($types, $vars);
    }

    public function execute(mysqli_stmt $stmt) {
        return $stmt->execute();
    }

    public function insertId() {
        return $this->conn->insert_id;
    }

    public function getSingleRecord(mysqli_stmt $stmt) {
        return $stmt->get_result()->fetch_assoc();
    }

    public function getAllRecords(mysqli_stmt $stmt) {
        $result = $stmt->get_result();
        $records = [];
        while ($row = $result->fetch_assoc()) {
            $records[] = $row;
        }
        return $records;
    }

    public function closeConnection() {
        $this->conn->close();
    }
}
?>