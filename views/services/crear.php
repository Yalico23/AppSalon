<h1>Crear Servicios</h1>
<p class="descripcion-pagina">Llena todos los campos para añadir un nuevo servicio</p>
<?php include_once __DIR__ . '/../templates/barra.php' ?>
<?php include_once __DIR__ . '/../templates/alertas.php' ?>

<form class="formulario" action="/servicios/crear" method="post">
    <?php include_once 'formulario.php' ?>
<input type="submit" value="Guardar Servicio" class="boton-azul">
</form>