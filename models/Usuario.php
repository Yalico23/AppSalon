<?php 
namespace Model;

class Usuario extends ActiveRecord{
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['Id','Nombre','Apellido','Email','Telefono','Admin','Confirmado','Token','Password','Creado'];

    public $Id;
    public $Nombre;
    public $Apellido;
    public $Email;
    public $Telefono;
    public $Admin;
    public $Confirmado;
    public $Token;
    public $Password;
    public $Creado;

    public function __construct($args = [])
    {
        $this->Id = $args['Id'] ?? null;
        $this->Nombre = $args['Nombre'] ?? '';
        $this->Apellido = $args['Apellido'] ?? '';
        $this->Email = $args['Email'] ?? '';
        $this->Password = $args['Password'] ?? '';
        $this->Telefono = $args['Telefono'] ?? '';
        $this->Admin = $args['Admin'] ?? '0';
        $this->Confirmado = $args['Confirmado'] ?? '0';
        $this->Token = $args['Token'] ?? '';
        date_default_timezone_set('America/Lima');
        $this->Creado = date('Y/m/d H:i:s');

    }

    public function validarCuenta(){
        !$this->Nombre ? self::$alertas['error'][] = 'Nombre is required' : '';
        !$this->Apellido ? self::$alertas['error'][] = 'Apellido is required' : '';
        !$this->Email ? self::$alertas['error'][] = 'Email is required' : '';
        !$this->Telefono ? self::$alertas['error'][] = 'Telefono is required' : '';
        if (!$this->Password) {
            self::$alertas['error'][] = "Password is required";
        } else {
            if (strlen($this->Password) < 6) {
                self::$alertas['error'][] = "Password is too short";
            }
        }    

        return self::$alertas;
    }
    public function validarLogin(){
        !$this->Email ? self::$alertas['error'][] = 'Email is required' : '';
        if (!$this->Password) {
            self::$alertas['error'][] = "Password is required";
        } else {
            if (strlen($this->Password) < 6) {
                self::$alertas['error'][] = "Password is too short";
            }
        }        
        return self::$alertas;
    }
    public function validarEmail(){
        !$this->Email ? self::$alertas['error'][] = 'Email is required' : '';
                
        return self::$alertas;
    }
    public function validarPassword(){
        if (!$this->Password) {
            self::$alertas['error'][] = "Password is required";
        } else {
            if (strlen($this->Password) < 6) {
                self::$alertas['error'][] = "Password is too short";
            }
        }        
        return self::$alertas;
    }
    //Revisa si el user existe
    public function existeUsuario(){
        $query = "SELECT * FROM " . self::$tabla . " WHERE Email = '". $this->Email ."' LIMIT 1";
        $resultado = self::$db->query($query);
        if ($resultado->num_rows) {
            self::$alertas['error'][]='El usuario ya esta registrado';
        }
        return $resultado;
    }
    public function hashPassword(){
        $this->Password = password_hash($this->Password, PASSWORD_BCRYPT);
    }
    public function CrearToken(){
        $this->Token = uniqid();
    }
    public function checkPassword($Password){
        $resultado = password_verify($Password,$this->Password);
        if (!$resultado || !$this->Confirmado) {
            self::$alertas['error'][]="Password incorrect or couldn't be verified";
        }else{
            return true;
        }
    }
}
?>