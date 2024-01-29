<h1>Servicios</h1>
<?php include_once __DIR__ . '/../templates/barra.php' ?>

<ul class="servicios">
    <?php foreach ($servicios as $servicio) : ?>
        <li>
            <p>Nombre: <span><?php echo $servicio->Nombre ?></span></p>
            <p>Precio: <span>S/.<?php echo $servicio->Precio ?></span></p>
            <div class="acciones">
                <a class="boton-azul" href="/servicios/actualizar?Id=<?php echo $servicio->Id ?>">Actualizar</a>
                <form method="POST" action="/servicios/eliminar" id="formEliminarServicio-<?php echo $servicio->Id; ?>">
                    <input type="hidden" name="Id" value="<?php echo $servicio->Id; ?>">
                    <button type="submit" class="boton-eliminar" onclick="confirmDelete(event, 'formEliminarServicio-<?php echo $servicio->Id; ?>')">Eliminar</button>
                </form>
            </div>
        </li>
    <?php endforeach; ?>
</ul>

<?php
$script = "
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
<script src='build/js/eliminar.js'></script>
"
?>