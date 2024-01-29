<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Iniciar Sesion con tus datos</p>
<?php 
//debuguear($alertas);
    include_once __DIR__ . "/../templates/alertas.php";
?>
<form action="/" method="post">
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" autofocus id="email" placeholder="Your Email" name="Email" autocomplete="off"
        value="<?php echo $auth->Email ?>">
    </div>
    
    <div class="campo">
        <label for="password">Password</label>
        <input type="password" id="password" placeholder="Your Password" name="Password" autocomplete="off">
    </div>
    <input type="submit" value="Log in" class="boton-azul">
</form>

<div class="acciones">
    <a href="/crear-cuenta">¿Aún no tienes cuenta? Crear una</a>
    <a href="/olvide">¿Olvidaste tu contraseña?</a>
</div>