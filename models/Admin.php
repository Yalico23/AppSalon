<?php 
namespace Model;

class Admin extends ActiveRecord{
    protected static $tabla = 'citasservicios';
    protected static $columnasDB = ['Id','Hora','cliente','Email','Telefono','servicio','Precio'];

    public $Id;
    public $Hora;
    public $cliente;
    public $Email;
    public $Telefono;
    public $servicio;
    public $Precio;

    public function __construct($args = [])
    {
        $this->Id = $args['Id'] ?? null;
        $this->Hora = $args['Hora'] ?? '';
        $this->cliente = $args['cliente'] ?? '';
        $this->Email = $args['Email'] ?? '';
        $this->Telefono = $args['Telefono'] ?? '';
        $this->servicio = $args['servicio'] ?? '';
        $this->Precio = $args['Precio'] ?? '';
    }
}
?>