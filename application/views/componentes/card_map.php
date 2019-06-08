<a href="<?php echo base_url() . $item['href'] ?>">
    <img onerror="javascript:imgError(this)" class="card-img-top" src="<?php echo base_url() . $item['imagen'] ?>"/>
    <h4 class="text-center font-weight-bold card-title mb--5"><a><?php echo ($item["nombre"] != '')? $item["nombre"] : 'Sin titulo' ?></a></h4>
</a>