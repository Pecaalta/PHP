<?php if(count($respuesta) > 0): ?>
    <?php if($respuesta['dia']): ?>
        <p class="alert alert-success"><i class="fas fa-sun"></i><?php echo " Mesas disponibles" ?></p>
    <?php endif; ?>
    <?php if(!$respuesta['dia']): ?>
        <p class="alert alert-danger"><i class="fas fa-sun"></i><?php echo " No hay mesas disponibles" ?></p>
    <?php endif; ?>
    <?php if($respuesta['noche']): ?>
        <p class="alert alert-success"><i class="fas fa-moon"></i><?php echo " Mesas disponibles" ?></p>
    <?php endif; ?>
    <?php if(!$respuesta['noche']): ?>
        <p class="alert alert-danger"><i class="fas fa-moon"></i><?php echo " No hay mesas disponibles" ?></p>
    <?php endif; ?>
<?php endif; ?>