<a class="dropdown-item" href="<?php echo base_url() . $href; ?>">
    <?php if (isset($restaurante) && isset($name) ):?>
        <b><?php echo $restaurante?></b> - <?php echo $name; ?>
    <?php endif;?>
    <?php if (isset($restaurante) && !isset($name) ):?>
        <b><?php echo $restaurante?></b>
    <?php endif;?>
    <?php if (!isset($restaurante) && isset($name) ):?>
        <b><?php echo $name?></b>
    <?php endif;?>
</a>