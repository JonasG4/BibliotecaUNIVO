<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
  <title>Document</title>
</head>
<body>
<?php 
require_once approot . '/Views/Includes/navbar.php';
require_once approot . '/Views/Includes/head.php';
?>
<div class="alert alert-success">
  <p> <?php echo ($data['mensaje']) ?></p>
  <a class="badge badge-success" href="<?=urlroot ."/Productos/mostrarCarro";?>">Ver Carrito</a>
</div>
<div class="container mt-5">
  <div class="row">
  <?php foreach($data['result'] as $producto) {?>
    <div class="col-3">
      <div class="card">
        <div class="card-body">
          <span><?php echo $producto->Book_Title ?></span>
          <h5 class="card-title">$10.00</h5>
          <p class="card-text"><?php echo $producto->Book_Synopsis?></p>
          <form action="" method="POST">
            <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto->Id_Book,COD,KEY) ?>">
            <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($producto->Book_Title,COD,KEY);?>">
            <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt('10.00',COD,KEY);?>">
            <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1,COD,KEY);?>">
            <button class="btn btn-primary" name="btn-action" value="Agregar" type="submit">
                    Agregar al carrito
            </button> 
          </form>
        </div>
      </div>
    </div>
  <?php } ?>   
    </div>
  </div>  
</body>
</html>