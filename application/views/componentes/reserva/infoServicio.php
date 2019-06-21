<?php foreach($servicio->result() as $item):?>
    <?php if($item->nombre == $nombreServicio):?>
        <p>Nombre: <span id="nombreComida"><?php echo $item->nombre ?></span></p>
        <p>Precio: <span id="precioComida"><?php echo $item->precio ?></span></p>
        <p>Mas info: <a href="<?php echo base_url() ?>Servicio/info_servicio/<?php echo $item->id ?>">Ver <?php echo $item->nombre ?></a></p>
        <input type="text" name="idComida" id="idComida" value="<?php echo $item->id ?>" readonly style="display: none">
        <p>Cantidad: <input type="number" id="cantidad" style="width: 30%"></p>
        <a id="enviaComida" href="#">Añadir</a>
    <?php endif;?>
<?php endforeach;?>
<div id="errorCantidad">

</div>
