<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta id="viewport" name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ReserBar</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="<?php echo base_url('public/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('public/css/mdb.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('public/css/style.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('public/css/materialize.min.css'); ?>" rel="stylesheet">


    <style>
        html,
        body {
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
            margin-bottom: 50px;
            font-size: 20px;
            color: #666;
            text-transform: uppercase;
        }


        #drop_file_zone {
            background-color: #EEE;
            border: #999 1px dashed;
            width: 100%;
            height: 200px;
            padding: 8px;
            font-size: 18px;
            border-radius: 5px;
            overflow: hidden;
        }

        #drag_upload_file {
            width: 50%;
            margin: 0 auto;
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

        .msj {
            font-size: 0.75rem;
            position: absolute;
            top: -1rem;
            left: 1.3rem;
        }
    </style>
    <script>
        var loadFile = function(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('output');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        };
    </script>
<!--
    <script>
        $(document).ready(function() {

            $("#autocompletado").keypress(function() {
                console.log("Handler for .keypress() called.");
                $.ajax({
                    url: '<?php echo base_url(); ?>/welcome/sugerencias',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        text: $(this).val()
                    },
                    beforeSend: function(e) {
                        // animacion de carga
                    },
                    success: function(e) {
                        $("#dropdown-autocompletado").html(e);
                    },
                    error: function(e) {
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
    
</head>

<body>
    <div class="container">
        <form onSubmit="return Validar()" action="<?php echo base_url(); ?>registro/post_cliente" method="post" enctype='multipart/form-data' class="box m-t-50px row z-depth-1">
            <div class="col-12 form-group">
                <img class="logo" src="<?php echo base_url(); ?>/public/img/logo.png" alt="" srcset="">
                <h3>Cliente</h3>
            </div>
            <div class="col-4 form-group">
                <p id="prueba" class="msj"></p>
                <input id="disponible" class="form-control" type="text" name="nickname" placeholder="Nickname">
            </div>
            <div class="col-4 form-group">
                <input class="form-control" type="text" id="nombre" name="nombre" placeholder="Nombre">
            </div>
            <div class="col-4 form-group">
                <input class="form-control" type="text" id="apellido" name="apellido" placeholder="Apellido">
            </div>
            <div class="col-6 form-group">
                <input class="form-control" type="date" id="fecha_de_nacimiento" name="fecha_de_nacimiento" placeholder="Fecha de nacimiento">
            </div>
            <div class="col-6 form-group">
                <p id="emailOK" class="msj"></p>
                <input class="form-control" type="text" id="email" name="email" placeholder="Email" id="mail">
            </div>
            <div class="col-6 form-group">
                <input class="form-control" type="password" id="password" name="password" placeholder="Contraseña">
            </div>
            <div class="col-6 form-group">
                <input class="form-control" type="password" id="repassword" name="repassword" placeholder="Repetir Contraseña">
            </div>
            <div class="col-12">
                <div id="drop_file_zone" ondrop="upload_file(event)" ondragover="return false">
                    <div id="drag_upload_file">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <input type="file" id="selectfile" id="img" name="img" accept="image/*" onchange="loadFile(event)">
                        <img id="output" src="" alt="">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <p class="error"><?php echo $msg; ?></p>
            </div>
            <div class="col-12 text-align mb-3 mt-3">
                <a href="<?php echo base_url('login')?>" class="btn btn-primary ml-0"> Entrar </a>
                <input class="btn btn-primary" type="submit" value="Registrarse">
            </div>
        </form>
</body>
<script>
    var nick_disponible = false;
    var email_disponible = false;

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


    function Validar() {
        if ($("#disponible").val() == "") {
            toastr.error("Error no hay ningun nicknombre");
            return false;
        }
        if (!nick_disponible) {
            toastr.error("Error, el nick no esta disponible");
            return false;
        }
        if ($("#nombre").val().trim() == "") {
            toastr.error("Error falta el nombre");
            return false;
        }
        if ($("#apellido").val().trim() == "") {
            toastr.error("Error falta el apellido");
            return false;
        }
        if ($("#fecha_de_nacimiento").val().trim() == "") {
            toastr.error("Error la fecha de naciminto");
            return false;
        }
        let fecha_de_nacimiento = new Date($("#fecha_de_nacimiento").val());
        if (fecha_de_nacimiento.getTime() > (new Date()).getTime()) {
            toastr.error("Error  la fecha de naciminto");
            return false;
        }
        if ($("#email").val().trim() == "") {
            toastr.error("Error el email");
            return false;
        }
        if (($("#email").val()).indexOf("@") == -1) {
            toastr.error("Error Formato incorecto");
            return false;
        }
        if (!email_disponible) {
            toastr.error("Error, el email no esta disponible");
            return false;
        }
        if ($("#password").val().trim() == "") {
            toastr.error("Error no hay contraseña");
            return false;
        }
        if ($("#repassword").val().trim() == "") {
            toastr.error("Error no hay repeticion contraseña");
            return false;
        }
        if ($("#repassword").val().trim() != $("#password").val().trim() ) {
            toastr.error("Error no coincide la contraseña");
            return false;
        }
        if ($("#output").attr("src") == "") {
            toastr.error("Error, no hay imagen cargada");
            return false;
        }
        return true;
    }
</script>

</html>