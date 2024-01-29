<h1>Olvide Password</h1>
<p class="descripcion-pagina">Restablece tu password escribiendo tu email a continuación</p>
<?php 
    include_once __DIR__ . "/../templates/alertas.php";
?>
<form action="/olvide" method="post" class="formulario">
    <div class="campo">
        <label for="Email">E-mail</label>
        <input type="email" id="Email" name="Email" placeholder="Your E-mail">
    </div>
    <input type="submit" class="boton-azul" value="Enviar Instrucciones">
</form>

<div class="acciones">
    <a href="/crear-cuenta">¿Aún no tienes cuenta? Crear una</a>
    <a href="/">¿Ya tienes cuenta? Inicia Sesión</a>
</div>