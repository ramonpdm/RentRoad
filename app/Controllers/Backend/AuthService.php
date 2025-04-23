class AuthService {
    private $usuarioRepository;
    
    public function __construct($usuarioRepository) {
        $this->usuarioRepository = $usuarioRepository;
    }
    
    public function authenticate($email, $password) {
        $usuario = $this->usuarioRepository->findByEmail($email);
        
        if (!$usuario) {
            throw new Exception('Credenciales inválidas');
        }
        
        if (!password_verify($password, $usuario->getPassword())) {
            throw new Exception('Credenciales inválidas');
        }
        
        return $usuario;
    }
}