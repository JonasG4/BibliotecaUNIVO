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

<nav class="nav">
    <ul class="nav__list">
        <li class="nav__list-item"><a class="item__link item__logo" href="<?= urlroot . '/' ?>">OHARA</a></li>
        <li class="nav__list-item"><a class="item__link" href="<?= urlroot . '/'; ?>">Inicio</a></li>
        <li class="nav__list-item"><a class="item__link" href="">Categorias</a></li>
        <li class="nav__list-item"><a class="item__link" href="">Catalogo</a></li>
        <li class="nav__list-item"><a class="item__link" href="">Buscar</a></li>
        <li class="nav__list-item">
        <a class="nav-link car" href="<?=urlroot ."/Productos/mostrarCarro";?>"><i style="font-size: 25px; position:relative;" class="fas fa-shopping-cart "></i><span class="number-cart"><?php 
            echo (empty($_SESSION['CARRITO'])) ? 0 : count($_SESSION['CARRITO']);
          ?></span></a>
        </li>

        <?php
        if (isLoggedIn()) : ?>
            <li class="nav__list-item">
                <button class="item__display" id="btn-menu" onclick="document.getElementById('display-menu').classList.toggle('active')">
                    <div class='item__container'>
                        <img class="item__user-img" src="<?= imagenurl . $_SESSION['avatar']; ?>" alt="<?= $_SESSION['name'] . ' ' . $_SESSION['lastname'] ?>">
                        <p class="item__username"><?= $_SESSION['username'] ?></p>
                    </div>
                </button>
                <ul class="item__menu close" id='display-menu'>
                    <div class="menu__tip"></div>
                    <li class="menu__greeting">
                        <p class="greeting_head"><?= $greetings[rand(0, 11)] ?>,</p>
                        <p class="greeting__name"><?= $_SESSION['name'] . ' ' . $_SESSION['lastname'] ?></p>
                        <div class="greeting__divisor"></div>
                    </li>
                    <li class="menu__option" onclick="window.location.href='<?= urlroot . '/user/profile' ?>'">
                        <i class="fas fa-user"></i> <p>Mi Perfil</p>
                    </li>
                    <li class="menu__option" onclick="window.location.href='<?= urlroot . '/auth/logout' ?>'">
                            <i class="fas fa-book"></i> <p>Mis libros</p>
                    </li>
                    <li class="menu__option" onclick="window.location.href='<?= urlroot . '/loan/' ?>'">
                        <i class="fas fa-tasks"></i>
                        <p>Préstamos</p>
                    </li>
                    <li class="menu__option" onclick="window.location.href='<?= urlroot . '/auth/logout' ?>'">
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

    </ul>
</nav>