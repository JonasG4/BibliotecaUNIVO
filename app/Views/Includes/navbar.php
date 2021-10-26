<?php
$greetings = [
    "Hola",
    "Hello",
    "Bonjour",
    "Hallo",
    "Ciao",
    "Olá",
    "Buna ziua",
    "Namaste",
    "Konnichi wa",
    "Habari",
    "Aloha",
    "Ni Hao"
]
?>
<nav class="nav"  id="nav__display">
    <ul class="nav__list">
        <li class="nav__list-item"><a class="item__link item__logo" href="<?= urlroot . '/' ?>">OHARA</a></li>
        <li class="nav__list-item"><a class="item__link" href="<?= urlroot . '/'; ?>">Inicio</a></li>
        <li class="nav__list-item"><a class="item__link" href="<?= urlroot . '/genre/' ?>">Categorias</a></li>
        <li class="nav__list-item"><a class="item__link" href="">Prestamo</a></li>
        <li class="nav__list-item"><a class="item__link" href="">Buscar</a></li>    
        <?php
        if (isLoggedIn()) : ?>
                <li class="nav__list-item nav__item-car">
                     <a class="nav-link car" href="<?=urlroot ."/Productos/mostrarCarro";?>"><i class="fas fa-shopping-cart"></i><span class="number-cart"><?php 
                        echo (empty($_SESSION['CARRITO'])) ? 0 : count($_SESSION['CARRITO']);?></span></a>
                </li>
            <li class="nav__list-item item__session">
                <button class="item__display" id="btn-menu">
                    <div class='item__container'>
                        <img class="item__user-img" src="<?= imagenurl . $_SESSION['avatar']; ?>" alt="<?= $_SESSION['name'] . ' ' . $_SESSION['lastname'] ?>">
                        <p class="item__username"><?= $_SESSION['username'] ?></p>
                    </div>
                </button>
                <ul class="item__menu" id='display-menu'>
                    <div class="menu__tip"></div>
                    <li class="menu__greeting">
                        <p class="greeting_head"><?= $greetings[rand(0, 11)] ?>,</p>
                        <p class="greeting__name"><?= $_SESSION['name'] . ' ' . $_SESSION['lastname'] ?></p>
                        <div class="greeting__divisor"></div>
                    </li>
                    <li class="menu__option" onclick="window.location.href='<?= urlroot . '/user/profile' ?>'">
                        <i class="fas fa-user"></i> <p>Mi Perfil</p>
                    </li>
                    <li class="menu__option" onclick="window.location.href='<?= urlroot . '/book/' ?>'">
                            <i class="fas fa-book"></i> <p>Mis libros</p>
                    </li>
                    <li class="menu__option" onclick="window.location.href='<?= urlroot . '/loan/' ?>'">
                        <i class="fas fa-tasks"></i>
                        <p>Préstamos</p>
                    </li>
                    <li class="menu__option" onclick="window.location.href='<?= urlroot . '/' ?>'">
                        <i class="fas fa-cog"></i>
                       <p>Configuración</p>
                    </li>
                    <li class="menu__option option__logout" onclick="window.location.href='<?= urlroot . '/auth/logout' ?>'"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</li>
                </ul>
            </li>
        <?php else : ?>
            <li class="nav__list-item">
                <a class="item__link" href="<?= urlroot ?>/auth/login">Iniciar sesion </a>
            </li>
            <li class="nav__list-item">
                <a class="item__link" href="<?= urlroot ?>/auth/register">Registrate </a>
            </li>

        <?php endif; ?>
        <li class="nav__list-item item__car"><a class="item__link" href="<?= urlroot . '/user/profile/'; ?>">Mi Carrito</a></li>
        <li class="nav__list-item item__account"><a class="item__link" href="<?= urlroot . '/user/profile/'; ?>">Mi Cuenta</a></li>
    </ul>
    <li class="nav__list-item icon__burger" onclick="document.getElementById('nav__display').classList.toggle('active');"></i></li>
</nav>

