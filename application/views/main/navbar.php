<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ReserBar</title>
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.0/css/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/public/css/style.css">

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.0/js/mdb.min.js"></script>


    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"></script>

    <link 
        rel="stylesheet" 
        href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
        integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
        crossorigin=""
    />
    <script 
        src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
        integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
        crossorigin=""
    ></script>

    <style>
        nav .logo {
            height: 15px;
        }
        .avatar-img{
            overflow: hidden;
            display: inline-block;
            width: 36px;
            height: 36px;
        }
        nav .dropdown-menu {
            width: 100%;
            z-index: 10000;
            border: none;
            padding: 5px;
            box-shadow: 0 2px 5px 0 rgba(0,0,0,.16),0 2px 10px 0 rgba(0,0,0,.12)!important;
        }
        nav .dropdown-item {
            color: #555!important;
        }
        nav .dropdown-item:hover {
            border-radius: 5px;
            background-color: #4285f4!important;
            box-shadow: 0 2px 5px 0 rgba(0,0,0,.16), 0 2px 10px 0 rgba(0,0,0,.12);
            color: #fff!important;
        }

        nav .nav-item a{
            border-radius: 5px;
        }

        .md-form .form-control{
            border: none!important;
            background: rgba(250,250,250,.16)!important;
            padding: 0.5rem 1rem!important;
            border-radius: 6px!important;
            margin: 0!important;
            transition: all .5s;
        }
        .md-form .form-control:hover{
            background: rgba(250,250,250,.20)!important;
        }
        .md-form .form-control:active,
        .md-form .form-control:focus{
            background: rgba(250,250,250,.32)!important;
        }

        .navbar-dark {
            background: #333;
        }
    </style>
    <script>
        function imgError(img) {
            img.error="";
            img.src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Products/img%20(49).jpg";
        }
        $(document).ready(function(){

            $( "#autocompletado" ).keypress(function() {
                console.log( "Handler for .keypress() called." );
                $.ajax({
                    url: '<?php echo base_url(); ?>/welcome/sugerencias',
                    type: 'POST',
                    dataType: 'html',
                    data: {text: $(this).val() },
                    beforeSend: function(e) {
                        // animacion de carga
                    },
                    success: function(e){
                        $("#dropdown-autocompletado").html(e);
                    },
                    error: function(e){
                        console.log(e);
                    },
                    complete: function(e) {
                        console.log(e);
                    },
                });
            });
        });
        
    </script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark ">
  <a class="navbar-brand" href="#">
    <img class="logo" src="<?php echo base_url(); ?>/public/img/logo.png" alt="" srcset="">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555"
    aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent-555">
    <ul class="navbar-nav mr-auto">
        <?php foreach ($nav as $item):?>
            <li class="nav-item <?php echo $item['class']; ?>">
                <a class="nav-link" href="<?php echo base_url().$item['href']; ?>"><?php echo $item["texto"]; ?></a>
            </li>
        <?php endforeach;?>
    </ul>
    <ul class="navbar-nav ml-auto nav-flex-icons">
        <form class="form-inline">
            <div class="md-form my-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="autocompletado" aria-label="Search">
                <div id="dropdown-autocompletado" class="dropdown-menu">
                </div>
            </div>
        </form>
        <?php if (!isset($id) && !isset($rut)):?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url() ?>login">Entrar</a>
            </li>
        <?php endif;?>
        <?php if (isset($id) || isset($rut)):?>
            <li class="nav-item avatar dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-55" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img onerror="javascript:imgError(this)" src="<?php echo base_url() . $img; ?>" class="avatar-img rounded-circle z-depth-1"
                    alt="avatar image">
                </a>
                <div class="dropdown-menu dropdown-menu-lg-right dropdown-secondary" aria-labelledby="navbarDropdownMenuLink-55">
                    <?php if (isset($id) and !isset($rut)):?>
                        <a class="dropdown-item" href="<?php echo base_url().'usuario/perfil/'.$id; ?>">Mi Perfil</a>
                    <?php endif;?>
                    <?php if (isset($rut)):?>
                        <a class="dropdown-item" href="<?php echo base_url().'restaurante/principal/'.$id; ?>">Mi local</a>
                        <a class="dropdown-item" href="<?php echo base_url().'restaurante/editarDatos/'.$id; ?>">Editar mi local</a>
                        <a class="dropdown-item" href="<?php echo base_url().'restaurante/imagenes/'.$id; ?>">Gestionar imagenes</a>
                        <a class="dropdown-item" href="<?php echo base_url().'restaurante/servicios/'.$id; ?>">Gestionar servicios</a>
                    <?php endif;?>
                    <a class="dropdown-item" href="<?php echo base_url().'login/logout'; ?>">Salir</a>
                </div>
            </li>
        <?php endif;?>
    </ul>
  </div>
</nav>
