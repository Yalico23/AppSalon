<?php 
namespace Model;

class Servicio extends ActiveRecord{
    //Base de datos la configuracion
    protected static $tabla = 'servicios';
    protected static $columnasDB = ['Id','Nombre','Precio'];

    public $Id;
    public $Nombre;
    public $Precio;

    public function __construct($args = [])
    {
        $this->Id = $args['Id'] ?? null;
        $this->Nombre = $args['Nombre'] ?? '';
        $this->Precio = $args['Precio'] ?? '';
    }

    public function validarServicio(){
        !$this->Nombre ? self::$alertas['error'][] = 'Nombre is required' : '';
        !$this->Precio ? self::$alertas['error'][] = 'Precio is required' : '';
        
        if ($this->Precio > 9999) {
            self::$alertas['error'][] = 'Precio is too long';
        }

        return self::$alertas;
    }
}
?>

