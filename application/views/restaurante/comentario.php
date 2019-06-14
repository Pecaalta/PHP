
<style>
    body {
        background: url("https://www.aquateknica.com/wp-content/uploads/2018/02/color-alimentos-1024x576.jpg");
        background-size: cover;
    }


    .card {
        cursor: pointer;
        border-radius: 5px;
        margin: 15px 0;
        height: auto;
    }

    .card-img-veiw img {
        min-width: 100%;
        min-height: 100%;
        border-radius: 5px;
    }

    .card-img-veiw {
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

    .card-footer {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        background: none;
        margin: 0 20px;
    }

    .precio {
        color: #007aff;
        font-weight: 900;
    }

    .fluid-container {
        display: flex;
        flex-wrap: wrap;
    }

    .fluid-container>div {
        margin: 10px;
    }

    #star label { 
        color: #eee; 
        cursor: pointer; 
        transition: all .2s;
    }

    #star * { 
        -webkit-user-select: none; /* Safari 3.1+ */
        -moz-user-select: none; /* Firefox 2+ */
        -ms-user-select: none; /* IE 10+ */
        user-select: none; /* Standard syntax */
    }
    
    #star input { display: none; }

    /* Seleccionados */
    #star[date-satar="1"] label:nth-child(1),
    
    #star[date-satar="2"] label:nth-child(1),
    #star[date-satar="2"] label:nth-child(2),
    
    #star[date-satar="3"] label:nth-child(1),
    #star[date-satar="3"] label:nth-child(2),
    #star[date-satar="3"] label:nth-child(3),
    
    #star[date-satar="4"] label:nth-child(1),
    #star[date-satar="4"] label:nth-child(2),
    #star[date-satar="4"] label:nth-child(3),
    #star[date-satar="4"] label:nth-child(4),
    
    #star[date-satar="5"] label:nth-child(1),
    #star[date-satar="5"] label:nth-child(2),
    #star[date-satar="5"] label:nth-child(3),
    #star[date-satar="5"] label:nth-child(4),
    #star[date-satar="5"] label:nth-child(5) { color: #D8D135; }


    #editdescripcion {
        width: 100%;
        border-color: #ddd;
        padding: 14px 16px;
        resize: vertical;
        height: 120px;
    }
    #label {
        margin-right: 20px;
        color: #333;
    }

</style>
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="EditModal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form class="modal-content" action="<?php echo base_url(); ?>servicio/enviar_comentario" method="post" enctype='multipart/form-data' id="frm_nuevoServicio">
            <div class="modal-header">
                <h4 class="modal-title w-100" id="EditModal">Comentar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <label id="label">Valoracion</label>
                        <span id="star" date-satar="0">
                            <label for="star1"><i class="fas fa-star"></i></label>
                            <label for="star2"><i class="fas fa-star"></i></label>
                            <label for="star3"><i class="fas fa-star"></i></label>
                            <label for="star4"><i class="fas fa-star"></i></label>
                            <label for="star5"><i class="fas fa-star"></i></label>

                            <input type="radio" id="star1" name="valoracion" value="1" onclick="javascript:document.getElementById('star').setAttribute('date-satar',1)">
                            <input type="radio" id="star2" name="valoracion" value="2" onclick="javascript:document.getElementById('star').setAttribute('date-satar',2)">
                            <input type="radio" id="star3" name="valoracion" value="3" onclick="javascript:document.getElementById('star').setAttribute('date-satar',3)">
                            <input type="radio" id="star4" name="valoracion" value="4" onclick="javascript:document.getElementById('star').setAttribute('date-satar',4)">
                            <input type="radio" id="star5" name="valoracion" value="5" onclick="javascript:document.getElementById('star').setAttribute('date-satar',5)">
                        </span>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-12">
                        <input type="hidden" id="idServicio" name="idServicio" value="">
                        <textarea id="editdescripcion" class="textDescripcion form-control" type="text" name="descripcion" placeholder="Comentario"></textarea>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-12 mt-3 text-right">
                        <button type="reset" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary btn-sm mr-0">Enviar Comentario</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function dataComentar(id, nombre, descripcion, precio, imagen) {
        $("#editdescripcion").val(descripcion);
        $("#editprecio").val(precio);
    }
    function dataPrepare(id) {
        $("#star").attr("date-satar",0);
        $("#editdescripcion").val("");
        $("#idServicio").val(id);
    }
</script>
      
<div class="container">
    <div class="row">
        <?php foreach ($servicio as $item) : ?>
            <div class="col-sm-6 col-md-4 ">
                <div class="card">
                    <div class="card-img-veiw">
                        <img class="img-fluid" onerror="javascript:imgError(this)" class="card-img-top" src="<?php echo base_url() . $item->imagen ?>"/>
                    </div>
                    <div class="card-body text-center">
                        <h4 class="text-center font-weight-bold card-title mb--5"><?php echo $item->nombre; ?></h4>
                        <h5><?php echo $item->nickname; ?></h5>
                    </div>
                    <div class="card-footer">
                        <a data-toggle="modal" onclick="dataPrepare(<?php echo $item->id; ?>)" data-target="#EditModal" class="container btn btn-primary">Comentar</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>