<?
class SessionManager {
    private static $instance = null;

    private function __construct() {

    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new SessionManager();
        }
        return self::$instance;
    }

    public function login($username, $role) {
        if (isset($_SESSION)) return false;

        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;
    }

    public function logout() {
        if (!isset($_SESSION)) return;

        unset($_SESSION['username']);
        unset($_SESSION['role']);

        header('Location: /user/login');
    }
}
?>