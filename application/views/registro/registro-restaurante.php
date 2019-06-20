<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ReserBar</title>

        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" />
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="<?php echo base_url('public/css/bootstrap.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('public/css/mdb.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('public/css/style.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('public/css/materialize.min.css'); ?>">

        <style>
            .modal {
                height: auto;
                background: none;
            }
            .text-primary {
                color: #fff!important;
            }
            html, body {
                width: 100%;
                height: 100%;
                margin: 0;
                background: url("<?php echo base_url(); ?>/public/img/bg.jpg")
            }
            .box {
                border-radius: 7px;
                padding: 0 20px;
                background: #fff;
            }
            .logo {
                display: block;
                width: 200px;
                max-width: 100%;
                margin: 50px auto 0;
            }
            .m-b-15px {
                margin-bottom: 15px;
            }
            .m-t-50px {
                margin-top: 50px;
            }
            .margin-auto {
                margin: 10px auto 30px;
                display: block;
            }
            h3 {
                text-align: center;
                margin-bottom: 10px;
                margin-top: 0px;
                font-size: 20px;
                color: #666;
                text-transform: uppercase;
            }


            #drop_file_zone {
                background-color: #fef;
                border: #ccc 1px solid;
                width: 100%;
                height: 200px;
                padding: 8px;
                font-size: 18px;
                border-radius: 5px;
                overflow: hidden;
                margin: 5px 0 0 0;
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
                color: #aaa;
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
            .error {
                text-align: center;
                margin: 5px;
            }

            .table {
                width:100%;
                max-width: 500px;
                margin: 10px auto;
                border: 1px solid #ced4da;
            }
            .table td {
                vertical-align: middle;
            }
            .view-list {
                width: 80px;
                height: 80px;
                border-radius: 3px;
            }
            .delete {
                padding: 5px;
                width: 30px;
                height: 30px;
            }
            #mapid {
                border: 1px solid #ced4da;
                overflow: hidden;
                border-radius: 3px;
            }
            .msj {
                font-size: 0.75rem!important;
                position: absolute;
                bottom: -1.6rem;
                left: 1.3rem;
            }
            .step-content .row {
                height: 0;
                opacity: 0;
                overflow: hidden;
                transition: opacity .3s;
            }
            .active .step-content .row,
            .warning .step-content .row{
                height: auto;
                opacity: 1;
            }
            .display-block {
                display: inline-block!important;
                line-height: 23px;
            }
            .leaflet-control-attribution.leaflet-control {
                display: none;
            }
            .leaflet-bar a {
                width: 26px!important;
                height: 26px!important;
                line-height: 26px!important;
                display: block!important;
                text-align: center!important;
            }
            .input-field {
                margin-top: 0;
            }
            .timepicker {
                height: calc(1.5em + .75rem + 2px);
            }
        </style>
    </head>
    <body>
        <div class="container">
            <form onSubmit="return Validar()" action="<?php echo base_url(); ?>registro/post_cliente" method="post" enctype='multipart/form-data' class="box m-t-50px row z-depth-1">
                <div class="col-12">
                    <img class="logo" src="<?php echo base_url(); ?>/public/img/logo.png" alt="" srcset="">
                    <h3>Restaurante</h3>
                </div>

                <div class="col-sm-12 col-md-4">
                    <p id="prueba" class="msj"></p>
                    <input id="disponible" class="form-control" type="text" name="nickname" placeholder="Nickname">
                </div>
                <div class="col-sm-12 col-md-4">
                    <input class="form-control" type="text" id="nombre" name="nombre" placeholder="Nombre" require>
                </div>
                <div class="col-sm-12 col-md-4">
                    <input class="form-control" id="rut" name="rut" type="text" placeholder="RUT" require>
                </div>

                <div class="col-sm-12 col-md-6">
                    <input class="form-control" id="telefono" name="telefono" type="text" placeholder="Teléfono" require>
                </div>
                <div class="col-sm-12 col-md-6">
                    <p id="emailOK" class="msj"></p>
                    <input class="form-control" type="text" id="email" id="email" name="email" placeholder="Email" id="mail">
                </div>


                <div class="col-sm-12 col-md-6">
                    <input class="form-control" type="password" id="password" name="password" placeholder="Contraseña" require>
                </div>
                <div class="col-sm-12 col-md-6">
                    <input class="form-control" type="password" id="repassword" name="repassword" placeholder="Repetir Contraseña" require>
                </div>

                <div class="col-sm-12 col-md-4">
                    <input class="form-control" type="number" id="mesas" name="mesa" placeholder="Número de mesas" require>
                </div>
                <div class="col-sm-6 col-md-4">
                    <input class="timepicker"  type="time" id="apertura" name="apertura" placeholder="Clausura" require>
                </div>
                <div class="col-sm-6 col-md-4">
                    <input class="timepicker"  type="time" id="cierre" name="cierre" placeholder="Apertura" require>
                </div>

                <div class="col-12">
                    <input type="hidden" id="categoria" name="categoria">
                    <div class="chips col-12 chips-placeholder"></div>
                </div>

                <div class="col-sm-12 col-md-8">
                    <input class="form-control" id="direccion" name="direccion" type="text" placeholder="Dirección" require>
                </div>
                <div class="col-sm-12 col-md-4">
                    <select id="zona" name="zona" require>
                        <option value="" selected disabled>Zona</option>
                        <?php foreach ($zonas as $zona):?>
                            <option value="<?php echo $zona['id']; ?>"><?php echo $zona['nombre']; ?></option>
                        <?php endforeach;?>
                    </select>
                </div>

                <div class="col-12">
                    <div id="drop_file_zone" ondrop="upload_file(event)" ondragover="return false">
                        <div id="drag_upload_file">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <input type="file" id="selectfile" id="img" name="img" accept="image/*" onchange="loadFile(event)" require>
                            <img id="output" src="" alt="">
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-3">
                    <div id="mapid" style="width: 100%; height: 400px;"></div>
                    <input type="hidden" id="lat" name="lat" >
                    <input type="hidden" id="lng" name="lng" >
                </div>

                <div class="col-12">
                    <p id="error" class="error"><?php echo $msg; ?></p>
                </div>
                <div class="col-12 text-align mb-3 mt-3">
                    <a href="<?php echo base_url('login')?>" class="btn btn-primary ml-0"> Entrar </a>
                    <input class="btn btn-primary" type="submit" value="Registrarse">
                </div>
            </form>
        </div>
    </body>
</html>

<script type="text/javascript" src="<?php echo base_url('public/js/jquery-3.4.1.min.js') ?>"></script>
<script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js" integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og==" crossorigin=""></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('public/js/popper.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/js/bootstrap.min.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<script>
    var nick_disponible = false;
    var email_disponible = false;
    var categorias = null;

    var loadFile = function(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('output');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
        if (event.target.files[0].size > 200) document.getElementById('error').value = "Imagen demasiado pesada" ;
    };

    $(function() {
        $( document ).ready(function() {

            let cierre = $('#cierre').timepicker({
                twelveHour: false
            });

            let apertura = $('#apertura').timepicker({
                twelveHour: false
            });

            $('.datepicker').datepicker();

            $('select').formSelect();

            cargaMapa();

            $.get(<?php echo "'".base_url('usuario/listaCategorias')."'" ?>, function(data, status){
                $('.chips-placeholder').chips({
                    placeholder: 'Categorias',
                    autocompleteOptions: {
                        data: JSON.parse(data),
                        limit: 10,
                        minLength: 3
                    }
                });
            });

            $("#email").keyup(function() {
                check(
                    "usuario/email_disponible",
                    { email: $("#email").val()},
                    $("#emailOK") ,
                    (e) => { email_disponible = e; }
                );
            });

            $("#disponible").keyup(function() {
                check(
                    "usuario/nick_disponible",
                    { nombre: $("#disponible").val()},
                    $("#prueba"),
                    (e) => { nick_disponible = e; }
                );
            });

        });
    });

    function check(url,data, input, colback) {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() ?>" + url,
            dataType: 'html',
            data: data,
            success: function(data) {
                data = JSON.parse(data);
                input.text(data['body']);
                colback(data['boolean']);
            }
        });
    }

    function Validar(page) {
        var categorias = M.Chips.getInstance($('.chips-placeholder'));
        $("#categoria").val(JSON.stringify(categorias.chipsData));

        if (!email_disponible) {
            toastr.error("Error, el email no está disponible");
            return false;
        }
        if (!nick_disponible) {
            toastr.error("Error, el nick no está disponible");
            return false;
        }
        if ($("#disponible").val().trim() == "") {
            toastr.error("Error, falta el nick");
            return false;
        }
        if ($("#nombre").val().trim() == "") {
            toastr.error("Error, falta el nombre");
            return false;
        }
        if ($("#telefono").val().trim() == "") {
            toastr.error("Error, falta el telefono");
            return false;
        }
        if ($("#email").val().trim() == "") {
            toastr.error("Error, falta el mail");
            return false;
        }
        if (($("#email").val()).indexOf("@") == -1) {
            toastr.error("Error Formato de mail incorecto");
            return false;
        }
        if ($("#rut").val().trim() == "") {
            toastr.error("Error, falta el rut");
            return false;
        }
        if ($("#password").val().trim() == "") {
            toastr.error("Error, falta la contraseña");
            return false;
        }
        if ($("#repassword").val().trim() == "") {
            toastr.error("Error, falta la confirmación de la contraseña");
            return false;
        }
        if ($("#repassword").val().trim() != $("#password").val().trim() ) {
            toastr.error("Error, la contraseña y su confirmación no coinciden");
            return false;
        }
        if ($("#output").attr("src") == "") {
            toastr.error("Error, no hay imagen cargada");
            return false;
        }
        if ($("#mesas").val() == null) {
            toastr.error("Error, debe especificar el numero de mesas");
            return false;
        }
        if ($("#apertura").val() == '') {
            toastr.error("Error, no hay hora de apertura");
            return false;
        }
        if ($("#cierre").val() == '') {
            toastr.error("Error, no hay hora de cierre");
            return false;
        }
/*        if ((new Date("01/01/2000 " + $("#cierre").val())).getTime() <= (new Date("01/01/2000 " +$("#apertura").val())).getTime()) {
            toastr.error("Error, el horario de cierre no puede ser menor al de apretura");
            return false;
        }   */
        if ($("#direccion").val().trim() == "") {
            toastr.error("Error, falta la dirección");
            return false;
        }
        if ($("#zona").val() == null) {
            toastr.error("Error, no se ha seleccionado una zona");
            return false;
        }
        if ($("#lat").val().trim() == "" && $("#lng").val().trim() == "") {
            toastr.error("Error, faltan las coordenadas");
            return false;
        }
        if ($("#lat").val().trim() == "") {
            toastr.error("Error, falta latitud");
            return false;
        }
        if ($("#lng").val().trim() == "") {
            toastr.error("Error, falta longitud");
            return false;
        }
        return true;
    }

	function cargaMapa() {
        var mymap = L.map('mapid').locate({
            setView: true,
            maxZoom: 16
        }).setView([51.505, -0.09], 13);
        L.tileLayer(
            'https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw',
            {
                maxZoom: 18,
                id: 'mapbox.streets'
            }
        ).addTo(mymap);
        var restaurante = null;
        var popup = L.popup();
        mymap.on('click', function (e) {
            document.getElementById('lat').value = e.latlng.lat;
            document.getElementById('lng').value = e.latlng.lng;
            if(restaurante == null) {
                popup.setLatLng(e.latlng).setContent("Aqui estaría tu restaurante ").openOn(mymap);
                restaurante = L.marker(e.latlng).addTo(mymap);
            } else {
                restaurante.setLatLng(e.latlng);
            }
        });
    }

</script>
