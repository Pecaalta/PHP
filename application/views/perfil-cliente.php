<style>
    body {
        background: url("<?php echo base_url(); ?>/public/img/perfil.jpg");
    }

    img {
        max-width: 100%;
        margin-top: 15px;
    }

    #perfil {
        margin: auto;
    }

    i {
        font-size: 30px;
    }

    .list-group {
        flex-direction: row !important;
        flex-wrap: wrap;
    }

    .list-group-item {
        width: 50%;
    }

    label {
        font-weight: bold;
    }

    #editar,
    #editarpass {
        font-size: 1em;
    }

    #divedit {
        width: 38%;
        margin: auto;
        margin-top: 2px;
        background-color: #ebecf0;
        font-weight: 700;
        border-radius: 3px;
        font-size: 12px;
    }

    #diveditpass {
        width: 59%;
        margin: auto;
        margin-top: 2px;
        background-color: #ebecf0;
        font-weight: 700;
        border-radius: 3px;
        font-size: 12px;
    }

    a{
        color: black;
    }

    .my-5 {
        margin-top: 15px !important;
    }

    #botones {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
    }
</style>
<section class="text-center my-5 p-1">
    <div id="perfil" class="col-lg-6 col-md-8">
        <div class="card testimonial-card">
            <div class="avatar mx-auto white">
                <img width="210px" height="210px;" src="<?php echo base_url() . '/uploads/' . $img; ?>" class="rounded-circle z-depth-0" />
                <div id="botones">
                    <div id="divedit">
                        <a href=<?php echo base_url() . 'usuario/editar/' . $id; ?>>
                            <i id="editar" class="fas fa-pencil-alt"></i> Editar Perfil
                        </a>
                    </div>
                    <div id="diveditpass">
                        <a href=<?php echo base_url() . 'usuario/cambio_password/' . $id; ?>>
                            <i id="editarpass" class="fas fa-key"></i> Cambiar contraseña
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h5><i class="fas fa-user"></i></h5>
                <h4 class="font-weight-bold mb-4">
                    <li class="list-inline-item mr-0"><?php echo $user["nickname"] ?></li>
                </h4>
                <hr>
                <div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <i class="fas fa-id-badge"></i><br><label>Nombre</label><br> <?php echo $user["nombre"] ?>
                        </li>
                        <li style="border-top: 0px;" class="list-group-item">
                            <i class="far fa-id-badge"></i><br><label>Apellido</label><br><?php echo $user["apellido"] ?>
                        </li>
                        <li style="border-bottom: 0px;" class="list-group-item">
                            <i class="fas fa-at"></i><br><label>Email</label><br><?php echo $user["email"] ?>
                        </li>
                        <li class="list-group-item">
                            <i class="fas fa-calendar-alt"></i><br><label style="font-size: 15px;">Fecha de Nacimiento</label><br><?php echo $user["fecha_de_nacimiento"] ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
</body>

</html>