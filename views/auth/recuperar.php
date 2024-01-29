<h1 class="nombre-pagina">Recuperar Password</h1>
<p class="descripcion-pagina">Coloca tu nuevo password a continuación</p>

<?php 
//debuguear($alertas);
    include_once __DIR__ . "/../templates/alertas.php";
?>
<?php if(!$error): ?>
<form class="formulario" method="post"> <!-- quitamos el action para que se mande el token de la url -->
    <div class="campo">
        <label for="Password">Password</label>
        <input type="password" autofocus id="Password" placeholder="Your New Password" name="Password" autocomplete="off">
    </div>
    <input type="submit" value="Save Password" class="boton-azul">
</form>
<div class="acciones">
    <a href="/">¿Ya tienes cuenta? Iniciar Sesión</a>
    <a href="/crear-cuenta">¿Aún no tienes cuenta? Crear una</a>
</div>
<?php endif;?>