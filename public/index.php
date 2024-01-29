<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\ApiControllers;
use Controllers\CitaControllers;
use Controllers\AdminControllers;
use Controllers\LoginControllers;
use Controllers\ServiciosControllers;

$router = new Router();
//AREA PUBLICA
//Iniciar Sesion
$router->get("/", [LoginControllers::class, "login"]);
$router->post("/", [LoginControllers::class, "login"]);
$router->get("/logout", [LoginControllers::class, "logout"]);
//Recuperar password
$router->get("/olvide", [LoginControllers::class, "olvide"]);
$router->post("/olvide", [LoginControllers::class, "olvide"]);
$router->get("/recuperar", [LoginControllers::class, "recuperar"]);
$router->post("/recuperar", [LoginControllers::class, "recuperar"]);
//Crear Cuentas
$router->get("/crear-cuenta", [LoginControllers::class, "crear"]);
$router->post("/crear-cuenta", [LoginControllers::class, "crear"]);
//Confirmar Cuenta
$router->get("/confirmar-cuenta", [LoginControllers::class, "confirmar"]);
$router->get("/mensaje", [LoginControllers::class, "mensaje"]);

//AREA PRIVADA
$router->get("/cita", [CitaControllers::class, "index"]);
$router->get("/admin", [AdminControllers::class, "index"]);
//API de citas
$router->get("/api/servicios",[ApiControllers::class, "index"]);
$router->post("/api/citas",[ApiControllers::class, "guardar"]);
$router->post("/api/eliminar",[ApiControllers::class, "eliminar"]);//delete pero http no soporta ese 

//Crud de servicios
$router->get("/servicios",[ServiciosControllers::class, "index"]);

$router->get("/servicios/crear",[ServiciosControllers::class, "crear"]);
$router->post("/servicios/crear",[ServiciosControllers::class, "crear"]);

$router->get("/servicios/actualizar",[ServiciosControllers::class, "actualizar"]);
$router->post("/servicios/actualizar",[ServiciosControllers::class, "actualizar"]);

$router->post("/servicios/eliminar",[ServiciosControllers::class, "eliminar"]);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();