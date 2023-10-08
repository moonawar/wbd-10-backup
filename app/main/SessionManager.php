<?
class SessionManager {
    private static $instance = null;
    public const MAX_LIFETIME = 60 * 60 * 24; // 1 day

    private function __construct() {
        ini_set('session.gc_maxlifetime', self::MAX_LIFETIME);
    }

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
        if (!isset($_SESSION)) return;

        unset($_SESSION['username']);
        unset($_SESSION['role']);

        session_destroy();
        header('Location: /user/login');
    }
}
?>