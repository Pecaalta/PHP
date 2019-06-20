<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ReserBar</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.0/css/mdb.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
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

        .container .logo {
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
    </style>
</head>

<body>
    <div class="container">
        <div class="alert alert-success" id="message" style="display: none;"> </div>
        <form onSubmit="return Validar()" action="<?php echo base_url(); ?>registro/editar_pass" method="post" enctype='multipart/form-data' class="box m-t-50px row z-depth-1">
            <div class="col-12 form-group">
                <img class="logo" src="<?php echo base_url(); ?>/public/img/logo.png" alt="" srcset="">
                <h3>Modificar contraseña</h3>
            </div>
            <div class="col-12 form-group">
                <input class="form-control" type="password" id="oldpassword" name="oldpassword" placeholder="Contraseña actual">
            </div>
            <div class="col-12 form-group">
                <input class="form-control" type="password" id="password" name="password" placeholder="Nueva contraseña">
            </div>
            <div class="col-12 form-group">
                <input class="form-control" type="password" id="repassword" name="repassword" placeholder="Repetir contraseña">
            </div>
           <!-- <div class="col-12">
                <p class="error"><?php echo $msg; ?></p>
            </div> -->
            <div class="col-12">
                <input class="margin-auto btn btn-primary m-b-15px" type="submit" value="Guardar cambios" id="btn">
            </div>
        </form>

        <script>
            $(function(){
                $( "#btn" ).click(function(event)
                {
                    event.preventDefault();
                    var passVieja= $("#oldpassword").val();
                    var passNueva= $("#password").val();
                    var passNuevaConfirm= $("#repassword").val();

                    $.ajax(
                        {
                            type:"post",
                            url: "<?php echo base_url(); ?>registro/verificar_pass",
                            data:{
                              oldpassword: passVieja,
                              password: passNueva,
                              repassword: passNuevaConfirm
                            },
                            success:function(response)
                            {
                                console.log(response);
                                $("#message").html(response);
                                $('#cartmessage').show();
                            }
                            error: function()
                            {
                                alert("Algo ha salido mal");
                            }
                        }
                    );
                });
            });
        </script>

</body>

</html>
<script>

    function Validar() {
        if ($("#oldpassword").val().trim() == "") {
            toastr.error("Error, falta la contraseña actual");
            return false;
        }
        if ($("#password").val().trim() == "") {
            toastr.error("Error, falta la nueva contraseña");
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
        return true;
    }
</script>
