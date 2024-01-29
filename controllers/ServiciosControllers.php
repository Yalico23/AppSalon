<?php

namespace Controllers;

use Model\Servicio;
use MVC\Router;

class ServiciosControllers
{

    public static function index(Router $router)
    {
        is_Admin();
        $servicios = Servicio::all();

        $router->render("services/index", [
            "Nombre" => $_SESSION['Nombre'],
            "servicios" => $servicios
        ]);
    }
    public static function crear(Router $router)
    {
        is_Admin();
        $servicio = new Servicio();
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicio = new Servicio($_POST);
            $alertas = $servicio->validarServicio();
            if (empty($alertas)) {
                $servicio->guardar();
                header("Location: /servicios");
            }
        }

        $router->render("services/crear", [
            "Nombre" => $_SESSION['Nombre'],
            "alertas" => $alertas,
            "servicio" => $servicio
        ]);
    }
    public static function actualizar(Router $router)
    {
        is_Admin();
        $Id = $_GET['Id'];

        if (!is_numeric($_GET['Id'])) return;
        $servicio = Servicio::find($Id);
        if ($servicio === null) {
            header("Location: /");
        }
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicio->sincronizar($_POST);
            $alertas = $servicio->validarServicio();
            if (empty($alertas)) {
                $servicio->guardar();
                header("Location: /servicios");
            }
        }
        $router->render("services/actualizar", [
            "Nombre" => $_SESSION['Nombre'],
            "alertas" => $alertas,
            "servicio" => $servicio
        ]);
    }
    public static function eliminar()
    {
        is_Admin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $Id = $_POST['Id'];
            $servicio = Servicio::find($Id);
            $servicio->eliminar();
            header("Location: /servicios");
        }
    }
}
