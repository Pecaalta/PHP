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
                    <input class="form-control" type="text" name="nombre" placeholder="Nombre">
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
                    <input type="submit" value="Registrarse">
                </div>
            </form>
        </div>

        <div id="menu1" class="container tab-pane active text-right servicios"><br>
            <div class="flex-column">
                <ul class="nav nav-tabs flex-column col-4 modificarLista" role="tablist">
                    <?php foreach($servicio->result() as $item):?>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#modificar<?php echo $item->id ?>"><?php echo $item->nombre ?></a>
                        </li>
                    <?php endforeach;?>
                </ul>
            </div>
            <div class="tab-content flex-column">
                <?php foreach($servicio->result() as $item):?>
                    <div id="modificar<?php echo $item->id ?>" class=" tab-pane col-8 modificarMuestra"><br>
                        <p><?php echo $item->id ?></p>
                    </div>
                <?php endforeach;?>
            </div>
        </div>    

        <div id="menu2" class="container tab-pane active text-center servicios"><br>
        </div>
    </div>
</div>