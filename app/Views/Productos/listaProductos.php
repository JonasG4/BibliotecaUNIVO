<?php 
$style = "mostrarCarro.css";
require_once approot . '/Views/Includes/navbar.php';
require_once approot . '/Views/Includes/head.php';
?>
<body>
<div class="alert alert-success">
  <?php if($data['mensaje'] == "") {
    echo "";
  }else {?>
     <p class="cart-number"> <?php echo ($data['mensaje']) ?></p>
  <?php 
  }?> 
</div>
<div class="container-item">
  <div class="row-card">
  <?php foreach($data['result'] as $producto) {?>
    <div class="item-card">
      <div class="item-card__body">
        <div class="card-body">
          <h2 class="title-book"><?php echo $producto->Book_Title ?></h2>
          <span class="line-book"></span>
          <p class="card-text"><?php echo $producto->Book_Synopsis?></p>
          <form action="" method="POST">
            <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto->Id_Book,COD,KEY) ?>">
            <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($producto->Book_Title,COD,KEY);?>">
            <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt('10.00',COD,KEY);?>">
            <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1,COD,KEY);?>">
            <h3 class="card-price">$10.00</h3>
            <button class="btn btn-addcar" name="btn-action" value="Agregar" type="submit">
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