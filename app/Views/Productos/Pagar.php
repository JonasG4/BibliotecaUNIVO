<?php 
$style = "mostrarCarro.css";
require_once approot . '/Views/Includes/navbar.php';
require_once approot . '/Views/Includes/head.php';
?>
<head>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
</head>
<!--form card-->
<div class="container-links">
  <div>
    <h1 class="message-send">¡Listo!</h1>
    <hr>
    <?php $total= 0; ?>
    <?php foreach($_SESSION['CARRITO'] as $indice =>$producto) { 
     
      $total = $total + ($producto['precio'] * $producto['cantidad']);  
    ?>
    <?php }?>
    <p class="message-confirm">Tu pago de<h4> $<?php echo number_format($total,2); ?> ha sido exitoso.</h4></p>
    <p class="message-confirm">Los link de los productos serán enviados al correo que proporcionaste.</p>
  
    <button class="btn-links btn-links__hover fire" type="button">Enviar Links</button>
    <?php 
    unset( $_SESSION["CARRITO"] );  
    ?>
  </div>
</div>
<script>
let redirect = false;
let url = document.querySelector(".fire")
url.addEventListener('click', function(){
  let timerInterval
  Swal.fire({
  title: 'Enviando!',
  html: 'Enviando links.',
  timer: 2000,
  timerProgressBar: true,
  didOpen: () => {
    Swal.showLoading()
    const b = Swal.getHtmlContainer().querySelector('b')
    timerInterval = setInterval(() => {
      b.textContent = Swal.getTimerLeft()
    }, 1000)
  },
  willClose: () => {
    clearInterval(timerInterval)
  }
}).then((result) => {
  /* Read more about handling dismissals below */
  if (result.dismiss === Swal.DismissReason.timer) {
    console.log('I was closed by the timer')
  }
})
url.classList.remove('btn-links__hover');
url.disabled = true;

});

</script>
