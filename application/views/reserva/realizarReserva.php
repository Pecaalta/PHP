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

    #regiration_form fieldset:not(:first-of-type) {
        display: none;
    }

    .my-custom-scrollbar {
        position: relative;
        height: 400px;
        overflow: auto;
    }

    .table-wrapper-scroll-y {
        display: block;
    }
</style>

<div class="container contenedor text-center">
    <h3>Reserva</h3>
    <div class="progress">
        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <form action="<?php echo base_url(); ?>servicio/nuevaReserva" method="post" enctype='multipart/form-data' id="regiration_form">

        <datalist id="listaServicios">
            <?php foreach ($servicio->result() as $item) : ?>
                <option value="<?php echo $item->nombre ?>">
                <?php endforeach; ?>
        </datalist>

        <!--primer pagina!-->
        <fieldset class="servicios">
            <div id="cuadroComida">
                <h4>Escoge lo que vas a comer en <strong><?php echo $userRestaurante->nickname ?></strong></h4>

                <div class="container">
                    <div class="row">
                        <div class="col-sm-3">Comida</div>
                        <div class="col-sm-2">Cantidad</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 col-md-3">
                            <div class="table-wrapper-scroll-y my-custom-scrollbar text-left" id="prueba3">
                                <table class="table">
                                    <tbody>
                                        <?php foreach ($servicio->result() as $item) : ?>
                                            <tr>
                                                <td><a href="#"><?php echo $item->nombre ?></a></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="prueba2" class="col-sm-2 col-md-2">
                        </div>
                        <div id="carritoComidas" class="col-sm-3 col-md-6">

                        </div>
                    </div>
                </div>
            </div>
            <br>
            <hr>
            <input type="button" name="next" id="primerSiguiente" class="next btn btn-info" value="Siguiente" />
        </fieldset>

        <!--segunda pagina!-->
        <fieldset class="servicios">
            <div id="cuadroHorario" class="container">
                <div class="row">
                    <div class="col-md-5">Selecciona la fecha y la hora de tu reserva: </div>
                </div>
                <div class="row">
                    <div class="col-md-5"><input type="datetime-local" id="fecha" name="fecha">
                        <p id="fechaAviso"></p>
                    </div>
                    <div class="col-md-3"><a href="#" id="comprobarDisponibilidad">Comprobar disponibilidad</a>
                        <div id="prueba">

                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <input type="button" name="previous" class="previous btn btn-default" value="Anterior" />
            <input type="button" name="next" class="next btn btn-info" value="Siguiente" />
        </fieldset>

        <!--tercer pagina!-->
        <fieldset class="servicios">
            <div id="cuadroHorario" class="container text-left">
                <div class="row">
                    <div class="col-md-5">Información de pago: </div>
                </div>
                <div class="row">
                    <div class="col-md-8">Cantidad de personas<input type="number" id="cantidadPersonas"></div>
                    <div class="col-md-8">Nombre del titular de la tarjeta<input type="text" id="titularTarjeta"></div>
                    <div class="col-md-8">Numero de tarjeta<input type="text" id="tarjeta"></div>
                    <div class="col-md-8">CVC<input type="text" id="cvc"></div>
                </div>
                <div id="erroresPago"></div>
            </div>
            <hr>
            <input type="button" name="previous" class="previous btn btn-default" value="Anterior" />
            <input type="button" name="next" class="next btn btn-info" value="Siguiente" onclick="datosPago()" />
        </fieldset>
        <!--cuarta pagina!-->
        <fieldset class="servicios">
            <div id="cuadroHorario" class="container">
                <table class="table">
                    <th>Restaurante</th>
                    <td></td>
                </table>
            </div>
            <div class="col-12">
                <br>
                <p>Aca mostrare los datos antes de que confirme, lo dejo para despues</p>
                <a href="#" onclick="finalizarReserva()">Confirmar reserva</a>
                <div id="respuestaFinal"></div>
            </div>
            <hr>
            <input type="button" name="previous" class="previous btn btn-default" value="Anterior" />
        </fieldset>
    </form>
</div>



<script>
    $("#comprobarDisponibilidad").click(function() {
        var fechaIndicada = $("#fecha").val();
        var id_restaurante = "<?php echo $userRestaurante->id ?>";
        var url = "reserva/fechaDisponible"
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() ?>" + url,
            dataType: 'html',
            data: {
                fechaIndicada: fechaIndicada,
                id_restaurante: id_restaurante
            },
            success: function(data) {
                $("#prueba").html(data);
            }
        });
    });


    $("#prueba3 a").click(function() {
        var nomSer = $(this).text();
        var id_restaurante = "<?php echo $userRestaurante->id ?>";
        console.log(nomSer);
        var url = "reserva/infoServicio"
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() ?>" + url,
            data: {
                nombreServicio: nomSer,
                id_restaurante: id_restaurante
            },
            dataType: "html",
            success: function(data) {
                $('#prueba2').html(data).css("background-color", "rgb(230, 233, 239)");
            }
        });
    });




    $(document).on('click', '#enviaComida', function() {
        var idSer = document.getElementById('idComida').value;
        var cantidad = document.getElementById('cantidad').value;
        if (cantidad > 0) {
            var id_restaurante = "<?php echo $userRestaurante->id ?>";
            var url = "reserva/agregarComida"
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() ?>" + url,
                data: {
                    idServicio: idSer,
                    cantidad: cantidad,
                    id_restaurante: id_restaurante
                },
                dataType: "html",
                success: function(data) {
                    $('#prueba2').html(data);
                }
            });
            actualizarElCondenadoCarrito(idSer, id_restaurante);
        } else {
            $('#errorCantidad').html("<p style='color: red'>La cantidad debe ser de al menos 1 unidad</p>");
        }
    });


    function actualizarElCondenadoCarrito(idSer, id_restaurante) {

        var url = "reserva/actualizarCarrito"
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() ?>" + url,
            data: {
                idServicio: idSer,
                id_restaurante: id_restaurante
            },
            dataType: "html",
            success: function(data) {
                $('#carritoComidas').html(data);
            }
        });
    }

    function eliminarServicio(idSer) {
        var url = "reserva/eliminarComida"
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() ?>" + url,
            data: {
                idServicio: idSer
            },
            dataType: "html",
            success: function(data) {
                var idfila = "eliminarFila" + idSer;
                var precio = $("#precio" + idSer).html();
                var precioTotal = $("#precioTotal").html();
                precioTotal = (precioTotal - precio);
                alert(precioTotal);
                $('#' + idfila).remove();
                $('#precioTotal').html(precioTotal);
            }
        });
    }

    function datosPago() {
        var cantPersonas = $("#cantidadPersonas").val();
        var tarjeta = $("#tarjeta").val();
        var titularTarjeta = $("#titularTarjeta").val();
        var cvc = $("#cvc").val();
        var url = "reserva/datosPago";
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() ?>" + url,
            data: {
                cantidadPersonas: cantPersonas,
                tarjeta: tarjeta,
                titularTarjeta: titularTarjeta,
                cvc: cvc
            },
            dataType: "html",
            success: function (data) {
                $('#erroresPago').text(data);
            }
        });
    }

    function finalizarReserva(){
        var url = "reserva/finalizarReserva";
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() ?>" + url,
            data:{notengonadapamandarteahoramismo: "pablitoclavounclavito"},
            dataType: "html",
            success: function (data) {
                $("#respuestaFinal").text(data);
            }
        });
    }

    $(document).ready(function() {
        var current = 1,
            current_step, next_step, steps;
        steps = $("fieldset").length;
        $(".next").click(function() {
            current_step = $(this).parent();
            next_step = $(this).parent().next();
            next_step.show();
            current_step.hide();
            setProgressBar(++current);
        });
        $(".previous").click(function() {
            current_step = $(this).parent();
            next_step = $(this).parent().prev();
            next_step.show();
            current_step.hide();
            setProgressBar(--current);
        });
        setProgressBar(current);
        // Change progress bar action
        function setProgressBar(curStep) {
            var percent = parseFloat(100 / steps) * curStep;
            percent = percent.toFixed();
            $(".progress-bar")
                .css("width", percent + "%")
                .html(percent + "%");
        }
    });
</script>