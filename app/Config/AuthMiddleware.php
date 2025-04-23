class AuthMiddleware {
    public static function handle($requiredRoles = []) {
        session_start();
        
        if (!isset($_SESSION['usuario'])) {
            header('Location: /login');
            exit();
        }
        
        if (!empty($requiredRoles) && !in_array($_SESSION['usuario']['rol'], $requiredRoles)) {
            header('Location: /errors/403');
            exit();
        }
    }
}