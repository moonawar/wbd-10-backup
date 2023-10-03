<?
enum Role {
    case Customer;
    case Admin;
}

class UserModel {
    private $db;

    public function __construct()
    {
        require_once __DIR__ . '/../main/Db.php';
        $this->db = new Db();
    }

    public function addUser(string $username, string $email, Role $role, string $password, string $imagePath) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $role_str = $role == Role::Customer ? 'customer' : 'admin';

        if ($imagePath == null) {
            $imagePath = PROFILE_IMAGE_BASE;
        }

        $sql = "INSERT INTO user (username, role, email, password) 
            VALUES ('$username', '$role_str', '$email', '$hashed')";

        $this->db->insertRecord($sql);
    }

    public function deleteUser($username) {
        $sql = "DELETE FROM user WHERE username = $username";
        $this->db->deleteRecord($sql);
    }

    public function updateEmail($username, $newEmail) {
        $sql = "UPDATE user SET email = '$newEmail' WHERE username = $username";
        $this->db->updateRecord($sql);
    }

    public function updatePassword($username, $newPass) {
        $hashed = password_hash($newPass, PASSWORD_DEFAULT);
        $sql = "UPDATE user SET password = '$hashed' WHERE username = $username";
        $this->db->updateRecord($sql);
    }

    public function getUserByUsername($username) {
        $sql = "SELECT * FROM user WHERE username = $username";
        return $this->db->getSingleRecord($sql);
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