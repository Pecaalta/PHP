<style>
    body{
        background: url("https://images8.alphacoders.com/809/809022.jpg");
    }
    .contenedor{
        background: white;
        border-radius: 3px;
        margin-top: 15px;
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
</style>

<div class="container contenedor text-center">
    <p><?php validation_errors();?></p>
    <h1>Gestión de servicios - <small class="text-muted"><?php echo $user["nickname"]?></small></h1>
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
            <form action="<?php echo base_url(); ?>restaurante/nuevoServicio" method="post" enctype='multipart/form-data' id="frm_nuevoServicio">
                <div class="col-4 form-group">
                    <input id="nombreNuevoServicio" class="form-control" type="text" name="nombre" placeholder="Nombre">
                    <p id="prueba"></p>
                    <div class="invalid-feedback">
                        
                    </div>
                </div>
                <div class="col-4 form-group">
                    <input class="form-control" type="text" name="descripcion" placeholder="Descripcion">
                    <div class="invalid-feedback">
                        
                    </div>
                </div>
                <div class="col-4 form-group">
                    <input class="form-control" type="number" name="precio" placeholder="Precio">
                    <div class="invalid-feedback">
                        
                    </div>
                </div>
                <div class="col-12">
                    <div id="drop_file_zone" ondrop="upload_file(event)" ondragover="return false">
                        <div id="drag_upload_file">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <input type="file" id="selectfile" name="img" accept="image/*" onchange="loadFile(event)">
                        <img id="output" src="" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <input type="submit" value="Añadir servicio">
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