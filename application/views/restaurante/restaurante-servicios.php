<style>
    .modal .modal-content {
        padding: 0px;
    }
    body{
        background: url("https://images8.alphacoders.com/809/809022.jpg");
    }
    .contenedor{
        background: white;
        border-radius: 3px;
        margin-top: 15px;
        padding: 15px;
    }
    h1 {
        margin-bottom: -9px;
    }
    .servicios{
        padding: 10px;
    }
    .modificarLista{
        background-color: rgb(215, 222, 225);
        border-radius: 3px;
        margin-top: 2px;
    }
    .modificarMuestra{
        background-color: rgb(215, 222, 225);
        border-radius: 3px;
    }
    #prueba {
        position: absolute;
        font-size: 0.75rem;
        left: 1rem;
        bottom: -1rem;
    }
    .textDescripcion {
        height: 135px!important;
        resize: none
    }
    #drop_file_zone {
        background-color: #fff;
        border: 1px solid #ced4da;
        width: 100%; 
        height: 135px!important;
        padding: 8px;
        font-size: 18px;
        border-radius: 5px;
        overflow: hidden;
        position: relative;
    }
    .drag_upload_file {
        width:50%;
        margin:0 auto;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
    }
    .drag_upload_file i {
        text-align: center;
        font-size: 5rem;
    }
    
    .drag_upload_file #editselectfile, 
    .drag_upload_file #selectfile {
        opacity: 0;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 100;
        cursor: pointer;
    }
    #editoutput,
    #output {
        max-width: 100%;
        max-height: 100%;
        position: absolute;
    }
    .descripcion {
        color: #666;
    }
    .costo {
        font-size: 1.5rem;
        color: rgb(33, 150, 243);;
        font-weight: 900;
        width: 100%;
        text-align: center;
        display: inline-block;
        padding-bottom: -15px;
    }
    .card h4 {
        margin-bottom: 0!important;
    }
    .card .view{
        height: 150px;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;

    }
    .card .view img{
        width: 100%;
        height: auto;
    }
    .card-action {
        display: flex;
        justify-content: center;
    }
    .card .card-content {
        padding: 15px;
    }
    .card .card-content .card-title {
        text-align: left;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
        
    .card .card-reveal .card-title {
        text-align: left;
        color: #222!important;
    }    
    .card .card-reveal p {
        text-align: left;
        color: #666!important;
    }

    .card .card-image {
        height: 100px;
    }
    .card .card-content {
        padding-bottom: 10px;
    }
</style>
    <script>
        var loadFile = function(event,idVisor) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById(idVisor);
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        };
    </script>

<div class="container contenedor text-center z-depth-1">
    <p><?php validation_errors();?></p>
    <h1><?php echo $user["nickname"]?></h1>
    <h3>Gestión de servicios</h3>
    <br>
    <div class="center-block d-flex align-items-center justify-content-center">
        <ul class="nav nav-pills" role="tablist">
            <li class="nav-item">
            <a class="nav-link btn btn-primary" data-toggle="pill" href="#home">Añadir</a>
            </li>
            <li class="nav-item">
            <a class="nav-link btn btn-primary active" data-toggle="pill" href="#menu1">Tus servicios</a>
            </li>
        </ul>
    </div>

    <div class="tab-content">
        <div id="home" class="container tab-pane text-center servicios"><br>
            <form class="row" action="<?php echo base_url(); ?>restaurante/nuevoServicio" method="post" enctype='multipart/form-data' id="frm_nuevoServicio">
                <div class="col-xs-12 col-sm-8 form-group">
                    <input id="nombreNuevoServicio" class="form-control" type="text" name="nombre" placeholder="Nombre">
                    <div class="invalid-feedback"></div>
                    <label id="prueba" class="control-label" for="nombreNuevoServicio"></label>
                </div>
                <div class="col-xs-12 col-sm-4 form-group">
                    <input class="form-control" type="number" name="precio" placeholder="Precio">
                    <div class="invalid-feedback"></div>
                </div>
                <div class="col-xs-12 col-sm-8 form-group">
                    <textarea class="textDescripcion form-control" type="text" name="descripcion" placeholder="Descripcion"></textarea>
                    <div class="invalid-feedback"></div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div id="drop_file_zone" ondrop="upload_file(event)" ondragover="return false">
                        <div class="drag_upload_file">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <input type="file" id="selectfile" name="img" accept="image/*" onchange="loadFile(event,'output')">
                            <img id="output" src="" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <input type="submit" class="btn btn-primary" value="Añadir servicio">
                </div>
            </form>
        </div>

        <div id="menu1" class="container active tab-pane text-right servicios"><br>
            <div class="row">
                <?php for ($i=0; $i < sizeof($servicio->result()); $i++) { $item = $servicio->result()[$i];?>
                    <?php if($item->is_active):?>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="card">
                                <div class="card-image waves-effect waves-block waves-light">
                                    <img 
                                        data-toggle="modal" data-target="#imgModal" 
                                        onclick="imgaengrande.src = '<?php echo base_url() .  $item->imagen; ?>'"
                                        onerror="javascript:imgError(this)" class="card-img-top" src="<?php echo base_url() . $item->imagen; ?>" 
                                        alt="Card image cap"    
                                        class="activator" >
                                </div>
                                <div class="card-content">
                                    <span class="card-title activator grey-text text-darken-4"><?php echo isset($item->nombre) && $item->nombre != '' ? $item->nombre : 'Sin titulo'; ?><i class="material-icons right">more_vert</i></span>
                                    <span class="costo"><?php echo isset($item->precio) && $item->precio != '' ? '$'.$item->precio : 'sin precio'; ?></span>
                                </div>
                                <div class="card-reveal">
                                    <span class="card-title grey-text text-darken-4"><?php echo isset($item->nombre) && $item->nombre != '' ? $item->nombre : 'Sin titulo'; ?><i class="material-icons right">close</i></span>
                                    <p><?php echo isset($item->text_corto) && $item->text_corto != '' ? $item->text_corto : 'Sin descripcion'; ?></p>
                                </div>
                                <div class="card-action">
                                    <a data-toggle="modal" onclick="dataEdit(<?php echo $i ?>)" data-target="#EditModal" class="btn btn-sm btn-primary">Editar</a>
                                    <a data-toggle="modal" onclick="dataBorrar(<?php echo "'" . $item->id . "','" . $item->nombre . "'" ?>)" data-target="#BorrarModal" class="btn btn-sm btn-primary">Borrar</a>
                                </div>
                            </div>
                        </div>
                    <?php endif;?>
                <?php };?>
            </div>
        </div>
    </div>
</div>

<script>
    var listaServicios = <?php echo isset($servicio) && $servicio != null ?  json_encode($servicio->result()) : '[]'; ?>;
    $("#nombreNuevoServicio").keyup(function() {
        var nombreSer = $( "#nombreNuevoServicio" ).val();
        var url="restaurante/existeServicio"
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() ?>"+url,
            dataType: 'html',
            data: {nombre: nombreSer},
            success: function (data) {
                data = JSON.parse(data);
                $( "#prueba" ).text( data['body'] );
            }
        });
       
    })
    .keyup();    
    function dataEdit(i) {
        if (listaServicios[i]){
            $("#editid").val(listaServicios[i].id);
            $("#editnombre").val(listaServicios[i].nombre);
            $("#editdescripcion").val(listaServicios[i].descripcion);
            $("#editprecio").val(listaServicios[i].precio);
            document.getElementById('editoutput').src = "<?php echo base_url()?>" + listaServicios[i].imagen;
            
        }
    }
    function dataBorrar(id, nombre ) {
         $("#borrarid").val(id);
         $("#borrarnombre").text(nombre);
    }

    
</script>


<!-- Central Modal Small -->
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="EditModal" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <form class="modal-content" action="<?php echo base_url(); ?>restaurante/modificarServicio" method="post" enctype='multipart/form-data' id="frm_nuevoServicio">
            <div class="modal-header">
              <h4 class="modal-title w-100" id="EditModal">Editar</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="row" >
                    <div class="col-xs-12 col-sm-4 form-group">
                        <input id="editprecio" class="form-control" type="number" name="precio" placeholder="Precio">
                        <div class="invalid-feedback"></div>
                    </div>
                    <input id="editid" type="hidden" name="id" placeholder="Nombre">
                    <div class="col-xs-12 col-sm-8">
                        <input id="editnombre" class="form-control" type="text" name="nombre" placeholder="Nombre">
                        <div class="invalid-feedback"></div>
                        <label id="prueba" class="control-label" for="nombreNuevoServicio"></label>
                    </div>
                    <div class="col-sm-12 col-md-8 form-group">
                        <textarea id="editdescripcion" class="textDescripcion form-control" type="text" name="descripcion" placeholder="Descripcion"></textarea>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div id="drop_file_zone" ondrop="upload_file(event)" ondragover="return false">
                            <div class="drag_upload_file">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <input type="file" id="editselectfile" name="img" accept="image/*" onchange="loadFile(event,'editoutput')">
                            <img id="editoutput" src="" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="reset" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary btn-sm ml-3">Guardar</button>
            </div>
          </form>
        </div>
</div>

    <!-- Central Modal Small -->
<div class="modal fade" id="BorrarModal" tabindex="-1" role="dialog" aria-labelledby="BorrarModal" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <form class="modal-content" action="<?php echo base_url(); ?>restaurante/eliminarServicio" method="post" enctype='multipart/form-data' id="frm_nuevoServicio">
        <div class="modal-header">
            <h4 class="modal-title w-100" id="BorrarModal">Borrar</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="col-4 form-group">
                <input id="borrarid" type="hidden" name="id">
            </div>
            <p class="text-center">Quieres dar de baja el servicio <b id="borrarnombre"></b> ?</p>
        </div>
        <div class="modal-footer">
            <button type="reset" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary btn-sm ml-3">Eliminar</button>
        </div>
        </form>
    </div>
</div>
