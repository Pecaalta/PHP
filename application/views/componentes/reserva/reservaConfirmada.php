<style>
    body {
        background: url("https://images4.alphacoders.com/646/646937.jpg");
    }

    .contenedor {
        background: white;
        border-radius: 3px;
        margin-top: 15px;
    }

    .servicios {
        padding: 10px;
    }
</style>

<div class="container contenedor">
    <br><br><br>
    <h3>Tu reserva ha sido realizada con exito!</h3>
    <br><br><br>
    <p>Consulta tus reservas aquí: <a href="<?php echo base_url() ?>reserva/mis_reservas/<?php echo $idUsuario ?>">Mis reservas</a></p>
    <br><br><br>
</div>