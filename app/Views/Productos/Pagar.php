<?php 
require_once approot . '/Views/Includes/navbar.php';
require_once approot . '/Views/Includes/head.php';
?>
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="<?= urlroot ?>/public/css/Pagar.css?v=<?php echo time(); ?>">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
</head>

<div class="container">
<!--form card-->

<div class="jumbotron text-center">
  <h1 class="display-4">¡Listo!</h1>
  <hr class="my-4">
  <?php $total= 0; ?>
  <?php foreach($_SESSION['CARRITO'] as $indice =>$producto) { 
   
    $total = $total + ($producto['precio'] * $producto['cantidad']);  
  ?>
  <?php }?>
  <p class="lead">Tu pago de<h4> $<?php echo number_format($total,2); ?> ha sido exitoso.</h4></p>
  <p>Los link de los productos serán enviados al correo que proporcionaste.</p>

  <button class="btn btn-links fire mt-5" type="button">Enviar Links</button>
  
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
url.disabled = true;

});

</script>
