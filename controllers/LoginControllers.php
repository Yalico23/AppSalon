<?php

namespace Controllers;

use Clases\Email;
use Model\Usuario;
use MVC\Router;
use PHPMailer\PHPMailer\PHPMailer;

class LoginControllers
{
    public static function login(Router $router)
    {
        redireccionar();

        $auth = new Usuario();
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarLogin();
            if (empty($alertas)) {
                //Comprobar si existe usuario
                $usuario = Usuario::where('Email', $auth->Email);
                if ($usuario) {
                    //Verificar password
                    if ($usuario->checkPassword($auth->Password)) { //como es de manera dinamica no lo reconoce
                        session_start();
                        $_SESSION['Id'] = $usuario->Id;
                        $_SESSION['Nombre'] = $usuario->Nombre . " " . $usuario->Apellido;
                        $_SESSION['Email'] = $usuario->Email;
                        $_SESSION['login'] = true;

                        //Redireccionamiento
                        if ($usuario->Admin === '1') {
                            $_SESSION['Admin'] = $usuario->Admin ?? null;
                            header("Location: /admin");
                        } else {
                            header("Location: /cita");
                        }
                    }
                } else {
                    Usuario::setAlerta('error', 'User not found');
                }
            }
        }
        $alertas = Usuario::getAlertas();
        $router->render("auth/login", [
            "auth" => $auth,
            "alertas" => $alertas
        ]);
    }
    public static function logout()
    {
        $_SESSION = [];
        header("Location: /");
    }
    public static function olvide(Router $router)
    {
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();
            if (empty($alertas)) {
                $usuario = Usuario::where('Email', $auth->Email);
                if ($usuario && $usuario->Confirmado === '1') {
                    //Generar Token
                    $usuario->CrearToken();
                    $usuario->guardar();//usamos el update
                    // Enviar Email
                    $email = new Email($usuario->Email,$usuario->Nombre,$usuario->Token);
                    $email->enviarInstrucciones();
                    //Alerta de Exito
                    Usuario::setAlerta('exito','Check Email');
                }else{
                    Usuario::setAlerta('error','User not found or not confirmed');
                }
            }
        }
        $alertas = Usuario::getAlertas();
        $router->render("auth/olvide-password", [
            "alertas" => $alertas
        ]);
    }
    public static function recuperar(Router $router)
    {
        $alertas = [];
        $error = false;
        $token = s($_GET['token']);
        $usuario = Usuario::where('Token', $token);
        if (empty($usuario) || $usuario->Token === '') {
            Usuario::setAlerta('error', 'Token no valido o expiro el tiempo');
            $error = true;
        } 
        //no uso el else porque no habria formulario y por ende no existiria el metodo post, entonces si se realiza el post es porque el token es valido
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $password = new Usuario($_POST);
            $alertas=$password->validarPassword();
            if (empty($alertas)) {
                $usuario->Token = null;
                $usuario->Password=null;
                $usuario->Password=$password->Password;
                $usuario->hashPassword();
                $resultado=$usuario->guardar();//update
                if ($resultado) {
                    header("Location: /");
                }
            }
        }

        $alertas = Usuario::getAlertas();
        $router->render("auth/recuperar", [
            "alertas"=>$alertas,
            "error"=>$error
        ]);
    }
    public static function crear(Router $router)
    {

        $usuario = new Usuario();
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario($_POST);
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarCuenta();

            //Revisar si alertas esta vacio
            if (empty($alertas)) {
                //echo "Pasaste la validacion";
                $resultado = $usuario->existeUsuario(); //devuelve el numero de alertas
                if ($resultado->num_rows) {
                    $alertas = Usuario::getAlertas(); //obtnego las alertas que estan en memoria despues de la validacion
                } else {
                    //Hashear el password
                    $usuario->hashPassword(); //60 caracteres
                    //Generar token unico
                    $usuario->CrearToken(); //13 caracteres
                    //Enviar Email
                    $email  = new Email($usuario->Email, $usuario->Nombre, $usuario->Token);
                    $email->EnviarConfirmacion();

                    //Crear usuario
                    $resultado = $usuario->guardar();
                    if ($resultado) {
                        header('Location: /mensaje');
                    }
                }
            }
        }

        $router->render("auth/crear-cuenta", [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }
    public static function mensaje(Router $router)
    {
        Usuario::setAlerta('exito', 'Token valido durante 5 min');
        $alertas = Usuario::getAlertas();
        $router->render("auth/mensaje", [
            'alertas' => $alertas
        ]);
    }
    //el enlace del email 
    public static function confirmar(Router $router)
    {
        $alertas = [];
        $token = s($_GET['token']);
        $usuario = Usuario::where('Token', $token);
        if (empty($usuario) || $usuario->Token === '') {
            Usuario::setAlerta('error', 'Token no valido o expiro el tiempo');
        } else {
            $usuario->Confirmado = "1";
            $usuario->Token = null;
            date_default_timezone_set('America/Lima');
            $usuario->Creado = date('Y/m/d H:i:s');
            $usuario->guardar(); //aui actualiza el registro por el metodo guardar del activerecord
            Usuario::setAlerta('exito', 'Token valido');
        }
        //Obtener alertas
        $alertas = Usuario::getAlertas();
        $router->render("auth/confirmar-cuenta", [
            'alertas' => $alertas
        ]);
    }
}
