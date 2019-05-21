<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.0/css/mdb.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <style>
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
    </style>
</head>
<body>
<div class="container">
    <form action="<?php echo base_url(); ?>registro/post_restaurante" method="post" class="box m-t-50px row z-depth-1">
        <div class="col-12 form-group">
            <img class="logo" src="<?php echo base_url(); ?>/public/img/logo.png" alt="" srcset="">
            <h3>Restaurante</h3>
        </div>
        <div class="col-4 form-group">
            <input class="form-control" name="nickname" type="text" placeholder="Nickname">
        </div>
        <div class="col-4 form-group">
            <input class="form-control" name="nombre" type="text" placeholder="Nombre">
        </div>
        <div class="col-4 form-group">
            <input class="form-control" name="rut" type="text" placeholder="RUT">
        </div>
        <div class="col-8 form-group">
            <input class="form-control" name="direccion" type="text" placeholder="Dirección">
        </div>
        <div class="col-4 form-group">
            <input class="form-control" name="zona" type="text" placeholder="Zona">
        </div>

        <div class="col-6 form-group">
            <input class="form-control" name="telefono" type="text" placeholder="Teléfono">
        </div>
        <div class="col-6 form-group">
            <input class="form-control" name="email" type="text" placeholder="Email">
        </div>
        <div class="col-12">
            <p class="error"><?php echo $msg; ?></p>
        </div>
        <div class="col-12">
            <input class="margin-auto btn btn-primary m-b-15px" type="submit" value="Registrarse">
        </div>
    </form>
</body>
</html>