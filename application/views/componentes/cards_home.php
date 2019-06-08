<style>
    .card-img-veiw img{
        min-width: 100%;
        min-height: 100%
    }
    .card-img-veiw{
        height: 200px;
        overflow: hidden;
    }
    .msgNoElement {
        text-align: center;
        width: 100%;
        padding: 50px 0;
        color: #999;
    }

    .badge {
        height: 2rem;
        padding: .5rem 1rem;
        font-size: 1rem;
        margin: 1rem 0.5rem;
    }
    .badge .close {
        font-size: 1rem;
        margin: 0 0rem 0 0.75rem;
        cursor: pointer;
    }

</style>
<script>
	function bag(e) {
        let key = "#" + e;
		$(e).val("");		
        let data = getdata();
		elementosAjax(data);
		mapaAjax(data);
	}
</script>
<?php if ($tienda != null && sizeof($tienda) != 0):?>
    <div class="row">
        <div class="col-12 mb-3">
            <?php foreach ($filter as $item):?>
                <div class="badge badge-pill badge-default">
                        <?php echo $item['key'] . " = " . $item['value'] ?><i onclick="bag(<?php echo $item['key'] ?>)" class="close fas fa-times"></i>
                </div>
            <?php endforeach;?>
        </div>
    </div>
    <div class="row">
        <?php foreach ($tienda as $item):?>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 mb-5">
                <a href="<?php echo base_url() . $item['href'] ?>">
                    <div class="card">
                        <div class="card-img-veiw">
                            <img onerror="javascript:imgError(this)" class="card-img-top" src="<?php echo base_url() . $item['imagen'] ?>"/>
                        </div>
                        <div class="card-body text-center">
                            <h4 class="text-center font-weight-bold card-title mb--5"><a><?php echo ($item["nombre"] != '')? $item["nombre"] : 'Sin titulo' ?></a></h4>
                            <p class="text-center card-text mb-0"><?php echo $item["nombre_restaurante"] ?></p>
                            <span><?php echo "$".$item["precio"] ?></span>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach;?>
    </div>
    <div class="row">
        <div class="col-12">
            <nav aria-label="Page navigation example">
                <ul class="pagination pagination-circle pg-blue justify-content-center">
                    <?php if (isset($page)) echo $page; ?>
                </ul>
            </nav>
        </div>
    </div>
<?php endif;?>
<?php if (sizeof($tienda) == 0):?>
    <div class="row">
        <div class="msgNoElement">
            <h1 >No hay servicios</h1>
            <h2>Pruebe quitar filtros o verifiquela ortografia</h2>
        </div>
    </div>
<?php endif;?>