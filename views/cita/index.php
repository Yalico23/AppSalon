<h1 class="nombre-pagina">Crear nueva Cita</h1>
<p class="descripcion-pagina">Elije tu servicio a continuacion</p>

<?php include_once __DIR__ . '/../templates/barra.php' ?>

<div id="app">
    <nav class="tabs">
        <button type="button" data-paso="1">Servicios</button> <!--data-paso es una etiqueta personalizada-->
        <button type="button" data-paso="2">Informacion Citas</button>
        <button type="button" data-paso="3">Resumen</button>
    </nav>

    <div id="paso-1" class="seccion">
        <h2>Servicios</h2>
        <p class="text-center">Elije tus servicios a continuacion</p>
        <div id="servicios" class="listado-servicios"></div><!--Aqui inyectamos html desde la api en js-->
    </div>

    <div id="paso-2" class="seccion">
        <h2>Tus Datos y Cita</h2>
        <p class="text-center">Coloca tus datos y cita</p>
        <form class="formulario">
            <div class="campo">
                <label for="Nombre">Nombre</label>
                <input type="text" id="Nombre" placeholder="Your name" value="<?php echo $Nombre ?>" disabled>
            </div>

            <?php 
            date_default_timezone_set('America/Lima');
            ?>
            <div class="campo">
                <label for="Fecha">Fecha</label>
                <input type="date" id="Fecha" min="<?php echo date('Y-m-d', strtotime('+1 day')) ?>">
            </div>

            <div class="campo">
                <label for="Hora">Hora</label>
                <input type="time" id="Hora">
            </div>
            <input type="hidden" id="Id" value="<?php echo $Id ?>">
        </form>
    </div>

    <div id="paso-3" class="seccion contenido-resumen">
        <h2>Resumen</h2>
        <p class="text-center">Verifica que la informacion sea correcta</p>
    </div>

    <div class="paginacion">
        <button id="anterior" class="boton-azul">&laquo; Anterior</button>
        <button id="siguiente" class="boton-azul">Siguiente &raquo;</button>
    </div>
</div>
<?php 
$script = "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script src='build/js/app.js'></script>
"
?>
