<nav>
    <ul>
        <li><a href="">Inicio</a></li>
        <li><a href="">Categorias</a></li>
        <li><a href="">Catalogo</a></li>
        <li><a href="">Buscar</a></li>
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