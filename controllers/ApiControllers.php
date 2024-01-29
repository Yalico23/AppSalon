<?php

namespace Controllers;

use Model\Cita;
use Model\CitaServicios;
use Model\Servicio;

class ApiControllers
{
    public static function index()
    {
        $servicios = Servicio::all();
        echo json_encode($servicios);
    }
    public static function guardar()
    {
        // $respuesta =[
        //     //"mensaje" => "todo ok"
        //     "datos" => $_POST
        // ];

        // $respuesta = [
        //     'cita' => $cita
        // ];

        // echo json_encode($respuesta);

        //Almacena la Cita y devuelve el ID
        $cita = new Cita($_POST);      
        $resultado = $cita->guardar();

        $Id = $resultado['Id'];
        
        //Almacena la cita y el servicio/s

        //Almacena los Servicios con el ID de la cita
        $IdServicios = explode(",", $_POST['servicios']);

        foreach($IdServicios as $IdServicio){
            $args = [
                'CitasId' => $Id,
                'ServiciosId' => $IdServicio
            ];

            $citaServicio = new CitaServicios($args);

            $citaServicio->guardar();
        };
        
        //Retornamos una respuesta

        echo json_encode(['resultado' => $resultado]);
        
    }

    public static function eliminar(){
        //echo "eliminando Cita...";
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $Id = $_POST['Id'];
            if (filter_var($Id,FILTER_VALIDATE_INT)) {
                $cita = Cita::find($Id);
            }
            if ($cita) {    
                $cita->eliminar();
            }
            header("Location:" . $_SERVER['HTTP_REFERER']);//para volver a la misma pagina donde nos encontramos
        }
    }
}
