<?php

namespace Controllers;

use Model\Admin;
use MVC\Router;

class AdminControllers
{
    public static function index(Router $router)
    {

        is_Admin();

        $fecha = $_GET['fecha'] ?? date('Y-m-d');
        $fechas = explode('-',$fecha);

        if (!checkdate($fechas[1], $fechas[2], $fechas[0])) {
            header("Location: /404");
        }

        //Consultar la base de datos

        $consulta = "SELECT citas.Id, citas.Hora, CONCAT( usuarios.Nombre, ' ', usuarios.Apellido) as cliente, ";
        $consulta .= " usuarios.Email, usuarios.Telefono, servicios.Nombre as servicio, servicios.Precio  ";
        $consulta .= " FROM citas  ";
        $consulta .= " LEFT OUTER JOIN usuarios ";
        $consulta .= " ON citas.UsuarioId=usuarios.Id  ";
        $consulta .= " LEFT OUTER JOIN citasservicios ";
        $consulta .= " ON citasservicios.CitasId=citas.Id ";
        $consulta .= " LEFT OUTER JOIN servicios ";
        $consulta .= " ON servicios.Id=citasservicios.ServiciosId ";
        $consulta .= " WHERE Fecha =  '$fecha' ";


        $citas = Admin::SQL($consulta);

        

        $router->render("admin/index", [
            "Nombre" => $_SESSION['Nombre'],
            "citas" => $citas,
            'fecha' => $fecha
        ]);
    }
}
