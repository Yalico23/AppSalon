<?php 
namespace Model;

class Cita extends ActiveRecord{
    protected static $tabla = 'citas';
    protected static $columnasDB = ['Id','Fecha','Hora','UsuarioId'];
    
    public $Id;
    public $Fecha;
    public $Hora;
    public $UsuarioId;

    public function __construct($args = [])
    {
        $this->Id = $args['Id']?? null;
        $this->Fecha = $args['Fecha']?? '';
        $this->Hora = $args['Hora']?? '';
        $this->UsuarioId = $args['UsuarioId']?? '';
    }
}
?>