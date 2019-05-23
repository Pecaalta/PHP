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
    <style>
        html, body {
            width: 100%;
            height: 100%;
            margin: 0;
            background: rgba(0, 0, 0, .7);
            z-index: 0;
        }
        body::after {
            content: "";
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: -1;
            position: absolute;
            background: url("<?php echo base_url(); ?>/public/img/bg.jpg");
            background-position: top;
        }
        .box {
            display: block;
            border-radius: 7px;
            padding: 20px;
            background: #fff;
            display: flex;
            justify-content: center;
            flex-direction: column;
        }
        .logo {
            display: block;
            width: 200px;
            max-width: 100%;
            margin: 0px auto 0;
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
        h1 {
            text-align: center;
            font-size: 30px;
            color: #fff;
            font-weight: 900;
            text-transform: uppercase;
        }
        h3 {
            text-align: center;
            font-size: 20px;
            color: #111;
            text-transform: uppercase;
        }
        p {
            text-align: center;
            font-size: 16px;
            color: #aaa;
            text-transform: uppercase;
        }
        i {
            font-size: 5rem;
            color: #222;
            text-align: center;
            margin-bottom: 20px;  
        }

    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="  m-t-50px ">
                <h1>Registrate para difrutar de nuestros servicios</h1>
                <p>Elije el tipo de usaurio que te quede mejor y acompañanos</p>
            </div>
        </div>
    </div>
    <div class="row">
        <a href="registro/restaurante" class="col-sm-12 col-md-6">
            <div  class="box  m-t-50px z-depth-1">
                <img class="logo" src="<?php echo base_url(); ?>/public/img/logo.png" alt="" srcset="">
                <h3>Restaurante</h3>
                <i class="fas fa-glass-cheers"></i>
            </div>
        </a>
        <a href="registro/cliente" class="col-sm-12 col-md-6">
            <div  class="box m-t-50px z-depth-1">
                <img class="logo" src="<?php echo base_url(); ?>/public/img/logo.png" alt="" srcset="">
                <h3>Cliente</h3>
                <i class="fas fa-user-edit"></i>
            </div>
        </a>
    </div>
</body>
</html>