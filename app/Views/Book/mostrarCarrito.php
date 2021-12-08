<?php
$style = "mostrarCarro.css";
require_once approot . '/Views/Includes/head.php'; ?>
<body>
  <header>
    <?php require_once approot . '/Views/Includes/navbar.php'; ?>
  </header>

    <h2 class="title-car">Mi Carrito</h2>
    <?php if(!empty($_SESSION['CART'])) { ?>
   
   <div class=" list-products">
 
     <table class="table-products">
     
       <tbody>
         <tr class="title-table thead">
           <th width="30%">Título</th>
           <th width="15%" class="text-center">Cantidad</th>
           <th width="20%" class="text-center">Fecha</th>
           <th width="20%"  class="text-center">Portada</th>
           <th width="25%"  class="text-center">Accion</th>
         </tr>
         <?php $total = 0 ?>
         <?php foreach($_SESSION['CART'] as $indice =>$producto) { ?>
         <tr>
           <td width="30%"><?php echo $producto['title'] ?></td>
           <td width="15%" class="text-center"> <?php echo $producto['author'] ?> </td>
           <td width="20%" class="text-center"><?php echo $producto['fecha'] ?> </td>
           <td width="20%" class="text-center">
           <img class="cover-img" src="<?= imagenurl . $producto['image']?>" alt="">
           </td>
           <td width="15%" class="">
           <form action="" method="POST">
            <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
            <button class="icon-delete" name="btn-action" type="submit">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="45" height="45" style="fill: rgba(255, 10, 10, 1);transform: ;msFilter:;"><path d="M5 20a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8h2V6h-4V4a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v2H3v2h2zM9 4h6v2H9zM8 8h9v12H7V8z"></path><path d="M9 10h2v8H9zm4 0h2v8h-2z"></path></svg>
            </button>
          </form>
           </td>
         </tr>

         <?php }?>
       </tbody>
     </table>
     <?php }else{ ?>
       <div class="message-car">
         No hay productos en el carrito.
       </div>
     <?php } ?>
     </div>
     <?php require_once approot . '/Views/Includes/footer.php';?>
</body>
