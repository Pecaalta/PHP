<?php foreach($servicio->result() as $item):?>
    <?php if($item->nombre == $nombreServicio):?>
        <p>Nombre: <?php echo $item->nombre ?></p>
        <p>Precio: <?php echo $item->precio ?></p>
        <p>Mas info: Link a la pag de servicio</p>
        <input type="text" name="idComida" id="idComida" value="<?php echo $item->id ?>" readonly style="display: none">
        <p>Cantidad: <input type="number" id="cantidad" style="width: 30%"></p>
        <a id="enviaComida" href="#">Añadir</a>
    <?php endif;?>
<?php endforeach;?>
<div id="errorCantidad">

</div>
