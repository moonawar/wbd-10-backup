<?
class SessionManager {
    private static $instance = null;

    private function __construct() {}

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new SessionManager();
        }
        return self::$instance;
    }

    public function login($username, $role) {
        if (isset($_SESSION)) {
            session_destroy();
        }

        session_start();

        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;
    }

    public function logout() {
        session_destroy();
        header('Location: /user/login');
    }
}
?>