class UsuarioRepo {
    private $orm;
    
    public function __construct($orm) {
        $this->orm = $orm;
    }
    
    public function findByEmail($email) {
        return $this->orm->findOne('Usuario', ['email' => $email]);
    }
}