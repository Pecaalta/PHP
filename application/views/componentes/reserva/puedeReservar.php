<?php if($respuesta2['negativo'] == 'falso'):?>
    <p class="alert alert-success"><?php echo $respuesta2['positivo'] ?></p>
<?php endif;?>
<?php if($respuesta2['positivo'] == 'falso'):?>
    <p class="alert alert-danger"><?php echo $respuesta2['negativo'] ?></p>
<?php endif;?>