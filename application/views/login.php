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
    <link rel="stylesheet" type="text/css" href="/public/css/style.css">
    <link href="<?php echo base_url('public/css/materialize.min.css'); ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
        html, body {
            width: 100%;
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            background: url("<?php echo base_url(); ?>/public/img/bg.jpg")
        }
        .login {
            border-radius: 7px;
            max-width: 100%;
            max-height: 100%;
            width: 400px;
            padding: 0 20px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        .link {
            font-weight: 900;
            padding-bottom: 1rem;
            display: inline-block;
            color: #999;
        }
        footer{
            border-top: solid 1px rgba(0,0,0,.08);
            padding: .5rem 1rem 0 1rem;
            text-align: center
        }
        .logo {
            width: 200px;
            max-width: 100%;
            margin: 50px;
        }
        .m-b-15px {
            margin-bottom: 15px;
        }
        
    </style>
</head>
<body>
    <form action="<?php echo base_url(); ?>login/login" method="post" class="login z-depth-1">
        <img class="logo" src="<?php echo base_url(); ?>/public/img/logo.png" alt="" srcset="">
        <input class="form-control m-b-15px" name="nickname" type="text" placeholder="nickname">
        <input class="form-control m-b-15px" name="password" type="password" placeholder="Password">
        <p><?php echo $msg; ?></p>
        <input class="btn btn-primary mt-5 m-b-15px" type="submit" value="Iniciar sesion">
        <footer>
            <a class="link" href="<?php echo base_url(); ?>registro/restaurante">Registro Restaurante</a>
            -
            <a class="link" href="<?php echo base_url(); ?>registro/cliente">Registro Usuario    </a>
        </footer>
    </form>
</body>
</html>