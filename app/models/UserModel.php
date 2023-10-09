<?
class UserModel {
    private $db;

    public function __construct() {
        $this->db = Db::getInstance();
    }

    public function verifyUser($username, $hash) : bool {
        $sql = "SELECT * FROM user WHERE username = ?";

        $stmt = $this->db->prepare($sql);
        $this->db->bindParams($stmt, "s", $username);

        $this->db->execute($stmt);

        $user = $this->db->getSingleRecord($stmt);

        $stmt->close();

        if ($user) {
            return password_verify($hash, $user['password']);
        }

        return false;
    }

    public function getUserRole($username) {
        $sql = "SELECT role FROM user WHERE username = ?";

        $stmt = $this->db->prepare($sql);
        $this->db->bindParams($stmt, "s", $username);

        $this->db->execute($stmt);

        $user = $this->db->getSingleRecord($stmt);

        $stmt->close();

        if ($user) {
            return $user['role'];
        }

        return false;
    }

    public function addUser(string $username, string $email, string $role, string $password, string $imagePath): int {
        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO user (username, role, email, password, image_path) VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            $this->db->logError();
            return false;
        }
        $this->db->bindParams($stmt, "sssss", $username, $role, $email, $hashed, $imagePath);

        $result = $this->db->execute($stmt);
        $id = $this->db->insertId();

        $stmt->close();

        return $id;
    }

    public function deleteUser($username) : bool{
        $sql = "DELETE FROM user WHERE username = ?";

        $stmt = $this->db->prepare($sql);
        $this->db->bindParams($stmt, "s", $username);

        $result = $this->db->execute($stmt);

        $stmt->close();

        return $result;
    }

    public function updateEmail($username, $newEmail) : bool {
        $sql = "UPDATE user SET email = ? WHERE username = ?";

        $stmt = $this->db->prepare($sql);
        $this->db->bindParams($stmt, "ss", $newEmail, $username);

        $result = $this->db->execute($stmt);

        $stmt->close();

        return $result;
    }

    public function updateRole($username, $newRole) : bool {
        $sql = "UPDATE user SET role = ? WHERE username = ?";

        $stmt = $this->db->prepare($sql);
        $this->db->bindParams($stmt, "ss", $newRole, $username);

        $result = $this->db->execute($stmt);

        $stmt->close();

        return $result;
    }

    public function updatePassword($username, $newPass) : bool{
        $hashed = password_hash($newPass, PASSWORD_DEFAULT);

        $sql = "UPDATE user SET password = ? WHERE username = ?";

        $stmt = $this->db->prepare($sql);
        $this->db->bindParams($stmt, "ss", $hashed, $username);

        $result = $this->db->execute($stmt);

        $stmt->close();

        return $result;
    }

    public function getUserByUsername($username) {
        $sql = "SELECT * FROM user WHERE username = ?";

        $stmt = $this->db->prepare($sql);
        $this->db->bindParams($stmt, "s", $username);

        $this->db->execute($stmt);

        $user = $this->db->getSingleRecord($stmt);

        $stmt->close();

        return $user;
    }

    public function userExists($username) {
        $sql = "SELECT * FROM user WHERE username = ?";

        $stmt = $this->db->prepare($sql);
        $this->db->bindParams($stmt, "s", $username);

        $this->db->execute($stmt);

        $user = $this->db->getSingleRecord($stmt);

        $stmt->close();

        return $user;
    }

    public function getMyBook($username){
        $sql ="SELECT b.book_id 
                FROM book b JOIN have h ON b.book_id = h.book_id
                JOIN user u ON h.username = u.username
                WHERE u.username = ?";
        $stmt = $this->db->prepare($sql);
        $this->db->bindParams($stmt, "s", $username);
        $this->db->execute($stmt);
        $books = $this->db->getAllRecords($stmt);
        $stmt->close();
        return $books;
    }

    public function getTotalPages($perPage) {
        $sql = "SELECT COUNT(*) FROM user";

        $stmt = $this->db->prepare($sql);
        $this->db->execute($stmt);

        $result = $this->db->getSingleRecord($stmt);

        $stmt->close();

        return ceil($result['COUNT(*)'] / $perPage);
    }

    public function getUsers($page, $perPage) {
        $sql = "SELECT * FROM user LIMIT ? OFFSET ?";

        $stmt = $this->db->prepare($sql);
        $offset = ($page - 1) * $perPage;
        
        $this->db->bindParams($stmt, "ii", $perPage, $offset);

        $this->db->execute($stmt);

        $users = $this->db->getAllRecords($stmt);

        $stmt->close();

        return $users;
    }

    public function getAllUsers() {
        $sql = "SELECT * FROM user";

        $stmt = $this->db->prepare($sql);
        $this->db->execute($stmt);

        $users = $this->db->getAllRecords($stmt);

        $stmt->close();

        return $users;
    }

    public function closeConnection() {
        $this->db->closeConnection();
    }
}
?>