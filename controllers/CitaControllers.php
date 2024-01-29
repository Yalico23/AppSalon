<?php 
namespace Controllers;

use MVC\Router;

class CitaControllers{
    public static function index (Router $router){
        //session_start();//Para tener los datos del Nombre - Nota la sesion ya esta abierta
        is_Auth();

        $router->render("cita/index", [
            "Nombre"=>$_SESSION['Nombre'],
            'Id' => $_SESSION['Id']
        ]);
    }
}
?>