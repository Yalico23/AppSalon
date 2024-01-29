<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function esUltimo (string $actual, string $proximo): bool{

    if ($actual !== $proximo) {
        return true;
    }else{
        return false;
    }
}

function is_Auth() : void{
    if (!isset($_SESSION['login'])) {
        header('Location: /');
    }
}
function is_Admin() : void{
    if (!isset($_SESSION['Admin'])) {
        header('Location: /');
    }
}

function redireccionar(): void{

    if (isset($_SESSION['login']) && isset($_SESSION['Admin'])) {
        header("Location: /admin");
    }elseif(isset($_SESSION['login'])){
        header("Location: /cita");
    }
}