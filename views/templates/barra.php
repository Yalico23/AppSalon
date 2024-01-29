<div class="barra">
    <p>Hola : <?php echo $Nombre ?></p>
    <a class="boton-cerrar" href="/logout">Cerrar Sesion</a>
</div>
<?php if (isset($_SESSION['Admin'])) : ?>
    <div class="barra-servicios">
        <a class="boton-azul" href="/admin">Ver Citas</a>
        <a class="boton-azul" href="/servicios">Ver Servicios</a>
        <a class="boton-azul" href="/servicios/crear">Nuevo Servicios</a>
    </div>
<?php endif; ?>