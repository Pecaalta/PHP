<style>
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
    }
    .textDescripcion {
        margin-top: 10px;
        height: 135px!important;
        resize: none
    }
    #drop_file_zone {
            background-color: #fff;
            border: 1px solid #ced4da;
            width: 100%; 
            height: 200px;
            padding: 8px;
            font-size: 18px;
            border-radius: 5px;
            overflow: hidden;
        }
        #drag_upload_file {
            width:50%;
            margin:0 auto;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
        #drag_upload_file i {
            text-align: center;
            font-size: 5rem;
        }
        #drag_upload_file #selectfile {
            opacity: 0;
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 100;
            cursor: pointer;
        }
        #output {
            max-width: 100%;
            max-height: 100%;
            position: absolute;
        }
</style>

<div class="container contenedor text-center z-depth-1">
    <p><?php validation_errors();?></p>
    <h1><?php echo $user["nickname"]?></h1>
    <h3>Gestión de servicios</h3>
    <br>
    <div class="center-block d-flex align-items-center justify-content-center">
        <ul class="nav nav-pills" role="tablist">
            <li class="nav-item">
            <a class="nav-link active" data-toggle="pill" href="#home">Añadir</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" data-toggle="pill" href="#menu1">Modificar</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" data-toggle="pill" href="#menu2">Eliminar</a>
            </li>
        </ul>
    </div>

    <div class="tab-content">
        <div id="home" class="container tab-pane active text-center servicios"><br>
            <form class="row" action="<?php echo base_url(); ?>restaurante/nuevoServicio" method="post" enctype='multipart/form-data' id="frm_nuevoServicio">
                <div class="col-sm-12 col-md-8">
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 form-group">
                            <input id="nombreNuevoServicio" class="form-control" type="text" name="nombre" placeholder="Nombre">
                            <div class="invalid-feedback">
                                
                            </div>
                            <label id="prueba" class="control-label" for="nombreNuevoServicio"></label>
                        </div>
                        <div class="col-xs-12 col-sm-4 form-group">
                            <input class="form-control" type="number" name="precio" placeholder="Precio">
                            <div class="invalid-feedback">
                                
                            </div>
                        </div>
                        <div class="col-12 form-group">
                            <textarea class="textDescripcion form-control" type="text" name="descripcion" placeholder="Descripcion"></textarea>
                            <div class="invalid-feedback">
                                
                            </div>
                        </div>

                    </div>
                </div>    
                <div class="col-sm-12 col-md-4">
                    <div id="drop_file_zone" ondrop="upload_file(event)" ondragover="return false">
                        <div id="drag_upload_file">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <input type="file" id="selectfile" name="img" accept="image/*" onchange="loadFile(event)">
                        <img id="output" src="" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <input type="submit" class="btn btn-primary" value="Añadir servicio">
                </div>
            </form>
        </div>

        <div id="menu1" class="container tab-pane text-right servicios"><br>
            <div class="flex-column">
                <ul class="nav nav-tabs flex-column col-4 modificarLista" role="tablist">
                    <?php foreach($servicio->result() as $item):?>
                        <?php if($item->is_active): ?>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#modificar<?php echo $item->id ?>"><?php echo $item->nombre ?></a>
                            </li>
                        <?php endif;?>    
                    <?php endforeach;?>
                </ul>
            </div>
            <div class="tab-content flex-column">
                <?php foreach($servicio->result() as $item):?>
                    <div id="modificar<?php echo $item->id ?>" class=" tab-pane col-8 modificarMuestra"><br>
                        <form action="<?php echo base_url(); ?>restaurante/modificarServicio" method="post" enctype='multipart/form-data' id="frm_modificarServicio<?php echo $item->id ?>">
                            <div class="col-4 form-group">
                                <input style="display: none" readonly class="form-control" type="text" name="id" value="<?php echo $item->id ?>">
                            </div>
                            <div class="col-4 form-group">
                                <input class="form-control" type="text" name="nombre" placeholder="Nombre" value="<?php echo $item->nombre ?>">
                            </div>
                            <div class="col-4 form-group">
                                <input class="form-control" type="text" name="descripcion" placeholder="Nombre" value="<?php echo $item->descripcion ?>">
                            </div>
                            <div class="col-4 form-group">
                                <input class="form-control" type="text" name="precio" placeholder="Nombre" value="<?php echo $item->precio ?>">
                            </div>
                            <div class="col-12">
                                <input type="submit" value="Modificar servicio">
                            </div>
                        </form>
                    </div>
                <?php endforeach;?>
            </div>
        </div>    

        <div id="menu2" class="container tab-pane text-right servicios"><br>
            <div class="flex-column">
                <ul class="nav nav-tabs flex-column col-4 modificarLista" role="tablist">
                    <?php foreach($servicio->result() as $item):?>
                        <?php if($item->is_active): ?>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#eliminar<?php echo $item->id ?>"><?php echo $item->nombre ?></a>
                            </li>
                        <?php endif;?>    
                    <?php endforeach;?>
                </ul>
            </div>
            <div class="tab-content flex-column">
                <?php foreach($servicio->result() as $item):?>
                    <div id="eliminar<?php echo $item->id ?>" class=" tab-pane col-8 modificarMuestra"><br>
                        <form action="<?php echo base_url(); ?>restaurante/eliminarServicio" method="post" enctype='multipart/form-data' id="frm_eliminarServicio<?php echo $item->id ?>">
                            <div class="col-4 form-group">
                                <input style="display: none" readonly class="form-control" type="text" name="id" value="<?php echo $item->id ?>">
                            </div>
                            <p>Quieres dar de baja el servicio <?php echo $item->nombre ?>?</p>
                            <div class="col-12">
                                <input type="submit" value="Eliminar servicio">
                            </div>
                        </form>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</div>
<!--
<script>
        $(document).ready(function(){

            $( "#autocompletado" ).keypress(function() {
                console.log( "Handler for .keypress() called." );
                $.ajax({
                    url: '<?php echo base_url(); ?>/welcome/sugerencias',
                    type: 'POST',
                    dataType: 'html',
                    data: {text: $(this).val() },
                    beforeSend: function(e) {
                        // animacion de carga
                    },
                    success: function(e){
                        $("#dropdown-autocompletado").html(e);
                    },
                    error: function(e){
                        console.log(e);
                    },
                    complete: function(e) {
                        console.log(e);
                    },
                });
            });
        });
        
    </script>
!-->
<script>
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
</script>