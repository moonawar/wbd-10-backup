<?
class UserModel {
    private $db;

    public function __construct(Db $db) {
        $this->db = $db;
    }

    public function addUser(string $username, string $email, UserRole $role, string $password, string $imagePath): bool {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $role_str = $role == UserRole::Customer ? 'customer' : 'admin';

        $sql = "INSERT INTO user (username, role, email, password) VALUES (?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);
        $this->db->bindParams($stmt, "ssss", $username, $role_str, $email, $hashed);

        $result = $this->db->execute($stmt);

        $stmt->close();

        return $result;
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

        $result = $this->db->execute($stmt);

        $user = $stmt->get_result()->fetch_assoc();

        $stmt->close();

        return $user;
    }

    public function getAllUsers() {
        $sql = "SELECT * FROM user";

        return $this->db->getAllRecords($sql);
    }

    public function closeConnection() {
        $this->db->closeConnection();
    }
}
?>