<?php 

require_once approot . '/Views/Includes/navbar.php';
require_once approot . '/Views/Includes/head.php';

?>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="<?= urlroot ?>/public/css/mostrarCarro.css?v=<?php echo time(); ?>">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
  <script defer src="<?= urlroot ?>/public/js/alertDelete.js?v=<?php echo time(); ?>"></script>
</head>
<h3 class="title-car">Mi Carrito</h3>
  <?php if(!empty($_SESSION['CARRITO'])) { ?>
   
  <div class="container lista-productos">

    <table class="table table-light table-bordered">
    
      <tbody>
        <tr class="title-table">
          <th width="40%">Descripción</th>
          <th width="15%" class="text-center">Cantidad</th>
          <th width="20%" class="text-center">Precio</th>
          <th width="25%" class="text-center">Total</th>
        </tr>
        <?php $total = 0 ?>
        <?php foreach($_SESSION['CARRITO'] as $indice =>$producto) { ?>
        <tr>
          <td width="40%"><?php echo $producto['nombre'] ?></td>
          <td width="15%" class="text-center"><?php echo $producto['cantidad'] ?></td>
          <td width="20%" class="text-center"><?php echo $producto['precio'] ?></td>
          <td width="20%" class="text-center"><?php echo number_format($producto['precio'] * $producto['cantidad'],2); ?></td>
          <td width="5%">
          <form action="" method="POST">
            <input type="hidden" name="id" value="<?php echo openssl_encrypt($producto['id'],COD,KEY); ?>">
            <button class="btn btn-eliminar" id="delete" name="btn-action" value="Eliminar" type="submit">Eliminar</button></td>
          </form>
        </tr>
        <?php $total = $total + ($producto['precio'] * $producto['cantidad']); ?>
        <?php }?>
        <tr>
          <td colspan="3" align="center"><h3>Total</h3></td>
          <td colspan="3" align="riht"><h3>$ <?php echo number_format($total,2); ?></h3></td>
        </tr>
      </tbody>
    </table>
          <form action="Pagar" method="post" class="email-container">
            <div class="">
              <div class="form-group">
                <label class="label-correo" for="my-input">Correo</label>
                <input id="name" name="name" class=" email-input" type="text" placeholder="Ingrese correo" required/>
              </div>  
              <small id="emailHelp" class="form-text text-muted">
                Los productos serán enviados a este correo.
              </small>
            </div> 
        <button class="btn btn-pagar" type="submit" value="proceder" name="btn-action">Proceder a pagar</button>
          </form>

    <?php }else{ ?>
      <div class="container">
      <div class="alert alert-success">
        No hay productos en el carrito.
      </div>
      </div>
      
    <?php } ?>
  </div>