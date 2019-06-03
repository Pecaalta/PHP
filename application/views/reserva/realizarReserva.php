<style>
    body{
        background: url("https://images4.alphacoders.com/646/646937.jpg");
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
    <h3>Reserva</h3>
    <form action="<?php echo base_url(); ?>servicio/nuevaReserva" method="post" enctype='multipart/form-data' id="frm_nuevaReserva">

        <datalist id="listaServicios">
            <?php foreach($servicio->result() as $item):?>
                <option value="<?php echo $item->nombre?>">
            <?php endforeach;?>
        </datalist>

        <!--primer pagina!-->
        <div id="cuadroComida" >
            <h4>Escoge lo que vas a comer</h4>

            <div class="container">
                <div class="row datosServicios">
                    <div class="col-sm-5">Comida</div>
                    <div class="col-sm-4">Cantidad</div>
                    
                </div>
                <div class="row datosServicios">
                    <div class="col-sm-5 col-md-5"><input list="listaServicios" name="nombreServicio0"></div>
                    <div class="col-sm-4 col-md-5"><input class="form-control" type="number" name="cantidad0" placeholder="Cantidad"></div>
                </div>
            </div>
        </div>
        <div class="col-sm-4 text-center" style="margin: auto"><input type="button" class="btn btn-outline-primary btn-sm" id="addComida" value="Agrega otra comida" /></div>
        
        <!--segunda pagina!-->
        <div id="cuadroHorario" class="container">
            <div class="row">
                <div class="col-md-5">Selecciona la fecha y la hora de tu reserva: </div>
            </div>
            <div class="row">
                <div class="col-md-5"><input type="date" id="fecha" name="fecha"><p id="fechaAviso"></p></div>
                <div class="col-md-5"><input type="time" id="hora" name="hora"><p id="horaAviso"></p></div>
                <div class="col-md-5"><a href="#" id="comprobarDisponibilidad">Comprobar disponibilidad</a><p id="prueba"></p></div>
            </div>
        </div>

        <div class="col-12">
            
            <br>
            <input type="submit" value="Realizar reserva" disabled>
        </div>
    </form>
    
</div>


<script>

var contador = 1;

$( "#addComida" ).click(function() {
 
    var newElement = '<div class="row datosServicios"><div class="col-sm-5 col-md-5"><input list="listaServicios" name="nombreServicio'+contador+'"></div><div class="col-sm-4 col-md-5"><input class="form-control" type="number" name="cantidad' + contador + '" placeholder="Cantidad"></div>';
    $( "#cuadroComida" ).append( $(newElement) );
    contador = contador + 1;
 
});

$("#comprobarDisponibilidad").click(function() {
        var fechaIndicada = $( "#fecha" ).val();
        var horaIndicada = $( "#hora" ).val();
        var id_restaurante = "<?php echo $userRestaurante->id ?>";
        var url="reserva/fechaDisponible"
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() ?>"+url,
            dataType: 'html',
            data: {fechaIndicada: fechaIndicada,
                    horaIndicada: horaIndicada,
                    id_restaurante: id_restaurante},
            success: function (data) {
                data = JSON.parse(data);
                $( "#prueba" ).text( data['body'] );
            }
        });
       
    })
    .keyup();  

</script>