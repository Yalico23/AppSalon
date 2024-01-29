<h1>Panel Administrativo</h1>

<?php

include_once __DIR__ . '/../templates/barra.php' ?>


<h2>Buscar Citas</h2>

<div class="busqueda">
    <form method="post">
        <div class="campo">
            <label for="Fecha">Fecha</label>
            <input type="date" name="Fecha" id="Fecha" value="<?php echo $fecha ?>">
        </div>
    </form>
    <button class="btn-buscar boton-azul">Buscar</button>
</div>

<?php
if (count($citas) === 0) {
    echo "<h2>No hay Citas en esta Fecha</h2>";
}
?>

<div class="citas-admin">
    <ul class="citas">
        <?php $IdCita = 0 ?>
        <?php foreach ($citas as $key => $cita) : ?>

            <?php if ($IdCita !== $cita->Id) : ?>
                <?php $total = 0; //calcular el total 
                ?>
                <li>
                    <p>ID: <span><?php echo $cita->Id ?></span> </p>
                    <p>Hora: <span><?php echo $cita->Hora ?></span> </p>
                    <p>Cliente: <span><?php echo $cita->cliente ?></span> </p>
                    <p>E-mail: <span><?php echo $cita->Email ?></span> </p>
                    <p>Telefono: <span><?php echo $cita->Telefono ?></span> </p>

                    <h3>Servicios</h3>

                    <?php $IdCita = $cita->Id ?>
                <?php endif; ?>
                <p class="servicio"><?php echo $cita->servicio . " " . $cita->Precio ?></p>
                <?php
                $actual = $cita->Id;
                $proximo = $citas[$key + 1]->Id ?? 0;

                // echo "<hr>";
                // echo $actual;
                // echo "<hr>";
                // echo $proximo;
                $total += $cita->Precio;
                ?>
                <?php if (esUltimo($actual, $proximo)) : ?>
                    <p class='total'>Total a pagar: <span>S/. <?php echo $total ?></span></p>

                    <form action="/api/eliminar" method="POST" id="formEliminarCita-<?php echo $cita->Id; ?>"> 
                        <input type="hidden" name="Id" value="<?php echo $cita->Id; ?>">
                        <button type="submit" class="boton-eliminar" onclick="confirmDelete(event, 'formEliminarCita-<?php echo $cita->Id; ?>')">Eliminar</button>
                    </form>
                <?php endif; ?>

            <?php endforeach; ?>
    </ul>
</div>
<?php
$script = "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script src='build/js/buscador.js'></script>
    <script src='build/js/eliminar.js'></script>
"
?>