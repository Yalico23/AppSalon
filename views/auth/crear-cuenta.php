<h1 class="nombre-pagina">Crear cuenta</h1>
<p class="descripcion-pagina">Llena el formulario para crear una cuenta</p>

<?php 
//debuguear($alertas);
    include_once __DIR__ . "/../templates/alertas.php";
?>

<form action="/crear-cuenta" method="post" class="formulario">
    <div class="campo">
        <label for="Nombre">Nombre</label>
        <input autocomplete="off" autofocus type="text" placeholder="Your name" id="Nombre" name="Nombre" 
        value="<?php echo s($usuario->Nombre) ?>">
    </div>
    <div class="campo">
        <label for="Apellido">Apellido</label>
        <input autocomplete="off" type="text" placeholder="Your last name" id="Apellido" name="Apellido"
        value="<?php echo s($usuario->Apellido) ?>">
    </div>
    <div class="campo">
        <label for="Telefono">Telefono</label>
        <input autocomplete="off" type="tel" placeholder="Your phone" id="Telefono" name="Telefono" pattern="[0-9+]+"
        value="<?php echo s($usuario->Telefono) ?>">
    </div>
    <div class="campo">
        <label for="Email">E-mail</label>
        <input autocomplete="off" type="email" placeholder="Your E-Email" id="Email" name="Email"
        value="<?php echo s($usuario->Email) ?>">
    </div>
    <div class="campo">
        <label for="Password">Password</label>
        <input autocomplete="off" type="password" placeholder="Your Password" id="Password" name="Password">
    </div>
    <input type="submit" value="Create" class="boton-azul">
</form>

<div class="acciones">
    <a href="/">¿Ya tienes cuenta? Iniciar Sesión</a>
    <a href="/olvide">¿Olvidaste tu contraseña?</a>
</div>

