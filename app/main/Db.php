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

    public function insertRecord($sql) : bool{
        $result = $this->query($sql);
        return $this->conn->affected_rows > 0;
    }

    public function updateRecord($sql) : bool{
        $this->query($sql);
        return $this->conn->affected_rows > 0;
    }

    public function deleteRecord($sql) : bool{
        $this->query($sql);
        return $this->conn->affected_rows > 0;
    }

    function escapeString($input) {
        $escaped = str_replace("'", "\'", $input);
        $escaped = str_replace("\\", "\\\\", $escaped);
    
        return $escaped;
    }

    public function closeConnection() {
        $this->conn->close();
    }
}
?>