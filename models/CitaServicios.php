<?php 
namespace Model;

class CitaServicios extends ActiveRecord{

    protected static $tabla = 'citasservicios';
    protected static $columnasDB = ['Id','CitasId','ServiciosId'];

    public $Id;
    public $CitasId;
    public $ServiciosId;


    public function __construct($args = [])
    {
        $this->Id = $args['Id'] ?? null;
        $this->CitasId = $args['CitasId'] ?? '';
        $this->ServiciosId = $args['ServiciosId'] ?? '';

    }
}
?>