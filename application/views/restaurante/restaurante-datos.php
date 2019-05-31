<style>
    body{
        background: url("https://wallpapercave.com/wp/mGD11sD.jpg");
    }
    .contenedor{
        background: white;
        border-radius: 3px;
        margin-top: 15px;
    }
    .servicios{
        padding: 10px;
    }
</style>


<div class="container contenedor text-center">
    <form action="<?php echo base_url(); ?>restaurante/actualizarDatos" method="post" enctype='multipart/form-data' id="frm_actualizarDatos">
        <div class="col-4 form-group" style="display: inline-flex">
            <label  for="nick">Nombre del restaurante</label>
            <input disabled class="form-control" type="text" name="nick" id="nick" value="<?php echo $user['nickname'] ?>">
        </div>
    </form>
</div>