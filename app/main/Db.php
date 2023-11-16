<?
// Database connection for query
class Db {
    private $conn;
    private $host;
    private $pass;
    private $db;

    private static $instance = null;

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Db();
        }
        return self::$instance;
    }

    private function __construct()
    {
        $this->host = $_ENV['DB_HOST'];
        $this->db = $_ENV['MYSQL_DATABASE'];
        $this->pass = $_ENV['MYSQL_ROOT_PASSWORD'];

        $this->conn = new mysqli($this->host, 'root', $this->pass);
        if ($this->conn->connect_error) {
            die("db connection failed " . $this->conn->connect_error);
        }
        $this->conn->select_db($this->db);
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

    public function error_info() {
        return $this->conn->error;
    }

    public function bindParams(mysqli_stmt $stmt, string $types, ...$vars) {
        $bindParams = [$types];
        foreach ($vars as &$var) {
            $bindParams[] = &$var;
        }
        
        return call_user_func_array([$stmt, 'bind_param'], $bindParams);
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

    public function logError() {
        error_log("SQL Error: " . mysqli_error($this->conn));
    }
}
?>