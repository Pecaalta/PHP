
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
        .logo-form {
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
            margin: 15px ;
            border: 1px solid #ced4da;
        }
        .table td {
            vertical-align: middle;
        }
        .view-list {
            width: 200px;
            height: 200px;
            border-radius: 3px;
        }
        .delete {
            padding: 5px;
            width: 30px;
            height: 30px;
        }
    </style>
        <script>
          var loadFile = function(event) {
            var reader = new FileReader();
            reader.onload = function(){
              var output = document.getElementById('output');
              output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
          };
        </script>
<div class="container">
    
    <form action="" method="post" class="box m-t-50px row z-depth-1" enctype='multipart/form-data'>
        <div class="col-12 form-group">
            <h1>Gestion de imagenes</h1>
        </div>
        <table class="table" >
            <?php foreach($img as $item):?>
                <tr>
                    <td width="100px"><img class="view-list z-depth-1" src="<?php echo base_url() . $item['img']; ?>" ></td>
                    <td width="50px" class="text-center" ><a class="delete btn btn-primary" href="<?php echo base_url() ."Restaurante/imagenesdelete/" . $item['id']; ?>">x</a></td>
                </tr>
            <?php endforeach;?>
        </table>
        <div class="col-12">
            <div id="drop_file_zone" ondrop="upload_file(event)" ondragover="return false">
                <div id="drag_upload_file">
                  <i class="fas fa-cloud-upload-alt"></i>
                  <input type="file" name="img" id="selectfile" accept="image/*" onchange="loadFile(event)">
                  <img id="output" src="" alt="">
                </div>
            </div>
        </div>
        <div class="col-12">
            <input class="margin-auto btn btn-primary m-b-15px" type="submit" value="Agregar">
        </div>
    </form>

        <div class="col-12">
            <p class="error"><?php echo $msg; ?></p>
        </div>
</body>
</html>