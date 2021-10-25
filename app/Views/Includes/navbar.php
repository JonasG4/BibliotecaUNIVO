<?php 
?>
<header>
    <link rel="stylesheet" href="<?= urlroot ?>/public/css/Pagar.css?v=<?php echo time(); ?>">
</header>
<nav>
    <ul>
        <li><a href="">Inicio</a></li>
        <li><a href="">Categorias</a></li>
        <li><a href="">Catalogo</a></li>
        <li><a href="">Buscar</a></li>
        <li>
        <a class="nav-link car" href="<?=urlroot ."/Productos/mostrarCarro";?>"><i style="font-size: 25px; position:relative;" class="fas fa-shopping-cart "></i><span class="number-cart"><?php 
            echo (empty($_SESSION['CARRITO'])) ? 0 : count($_SESSION['CARRITO']);
          ?></span></a>
        </li>
        <?php
            if(isset($_SESSION['user_id'])):?>
            <li>
                <p style="font-size: 25px">Hola,</p>
                <p style="font-size: 14px"><?=$_SESSION["name"] . $_SESSION["lastname"]?></p>
                <a href="<?=urlroot?>/auth/logout">Cerrar Sesion</a> 
            </li>
            <li>
            </li>
            <?php else: ?>
                <li>
                   <a href="<?=urlroot?>/auth/login">Iniciar sesion </a>
               </li> 
               <li>
                   <a href="<?=urlroot?>/auth/register">Registrate </a>
               </li>
        <?php endif;?>
    </ul>
</nav>