<div class="campo">
    <label for="Nombre">Nombre</label>
    <input 
    type="text" 
    name="Nombre" 
    id="Nombre"
    placeholder="Agregar Nombre"
    value="<?php echo $servicio->Nombre ?>"
    >
</div>

<div class="campo">
    <label for="Precio">Precio</label>
    <input 
    type="number" 
    step="any" 
    name="Precio" 
    id="Precio"
    placeholder="Agregar Precio"
    value="<?php echo $servicio->Precio ?>"
    >
</div>