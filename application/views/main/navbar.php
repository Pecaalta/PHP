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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/public/css/style.css">

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.0/js/mdb.min.js"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <style>
        .logo {
            height: 15px;
        }
        .w-36{
            width: 36px;
        }
        .h-36{
            height: 36px;
        }
    </style>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark primary-color">
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
        <?php if (!isset($id) && !isset($rut)):?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url() ?>login">Entrar</a>
            </li>
        <?php endif;?>
        <?php if (isset($id) || isset($rut)):?>
            <li class="nav-item avatar dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-55" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img src="<?php echo base_url() . '/uploads/' . $img; ?>" class="w-36 h-36 rounded-circle z-depth-0"
                    alt="avatar image">
                </a>
                <div class="dropdown-menu dropdown-menu-lg-right dropdown-secondary"
                aria-labelledby="navbarDropdownMenuLink-55">
                    <?php if (isset($id)):?>
                        <a class="dropdown-item" href="<?php echo base_url().'usuario/perfil/'.$id; ?>">Mi Perfil</a>
                    <?php endif;?>
                    <?php if (isset($rut)):?>
                        <a class="dropdown-item" href="<?php echo base_url().'usuario/restaurante/'.$id; ?>">Mi local</a>
                    <?php endif;?>
                    <a class="dropdown-item" href="<?php echo base_url().'login/logout'; ?>">Salir</a>
                </div>
            </li>
        <?php endif;?>
    </ul>
  </div>
</nav>
