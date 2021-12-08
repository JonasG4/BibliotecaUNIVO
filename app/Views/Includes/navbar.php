<?php

// Arreglo con saludos en diferentes idiomas
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
];

//Links de redireccion
$navLink = [
    "home" => '/',
    "catalogue" => '/book/catalogue',
    "loan" => '/loan/request',
    "favorites" => '/favorites',
    "car" => '/book/mostrarCarrito'
];

// A esta direccion se hara la busqueda de libros
$urlData = urlroot . '/book/search';
//Obtener url actual
$url = "";
if (isset($_GET['url'])) {
    $url = $_GET['url'];
    $url = filter_var($url, FILTER_SANITIZE_URL);
    $url = '/' . strtolower($url);
} else {
    $url = '/';
}

?>
<!-- NAVEGACION -->
<nav class="nav" id="nav__display">
    <!-- LISTA -->
    <ul class="nav__list">
        <!-- LOGO -->
        <li class="nav__list-item">
            <a class="item__link item__logo" href="<?= urlroot . '/' ?>">OHARA</a>
        </li>

        <!-- INPUT DE BUSQUEDA -->
        <li class="nav__list-item nav__input-search">
            <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="search" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="search__icon">
                <path d="M508.5 468.9L387.1 347.5c-2.3-2.3-5.3-3.5-8.5-3.5h-13.2c31.5-36.5 50.6-84 50.6-136C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c52 0 99.5-19.1 136-50.6v13.2c0 3.2 1.3 6.2 3.5 8.5l121.4 121.4c4.7 4.7 12.3 4.7 17 0l22.6-22.6c4.7-4.7 4.7-12.3 0-17zM208 368c-88.4 0-160-71.6-160-160S119.6 48 208 48s160 71.6 160 160-71.6 160-160 160z" class=""></path>
            </svg>
            <input type="search" dir="tlr" aria-expanded="true" role="combobox" aria-autocomplete="list" autocomplete="off" spellcheck="false" aria-invalid="false" name="searchInput" id="searchInput" onkeyup="filter('<?= $urlData ?>')" placeholder="Buscar por titulo, autor o editorial..." class="item__search" />

            <div class="searchFilter" id="searchFilter">
              
            </div>

            </div>
        </li>

        <!-- INICIO -->
        <li class="nav__list-item iconMenu  <?= $url == $navLink['home'] ? 'active' : '' ?>" onclick="setLocationMenu('<?= urlroot . $navLink['home'] ?>')">
            <svg viewBox="0 0 24 24" aria-hidden="true" class="item__icon">
                <g>
                    <!-- Si la pagina activa es Inicio, entonces el ICONO sera relleno, de lo contrario sera bordeado -->
                    <?php if ($url == $navLink['home']) : ?>
                        <path d="M22.58 7.35L12.475 1.897c-.297-.16-.654-.16-.95 0L1.425 7.35c-.486.264-.667.87-.405 1.356.18.335.525.525.88.525.16 0 .324-.038.475-.12l.734-.396 1.59 11.25c.216 1.214 1.31 2.062 2.66 2.062h9.282c1.35 0 2.444-.848 2.662-2.088l1.588-11.225.737.398c.485.263 1.092.082 1.354-.404.263-.486.08-1.093-.404-1.355zM12 15.435c-1.795 0-3.25-1.455-3.25-3.25s1.455-3.25 3.25-3.25 3.25 1.455 3.25 3.25-1.455 3.25-3.25 3.25z"></path>
                    <?php else : ?>
                        <path d="M22.46 7.57L12.357 2.115c-.223-.12-.49-.12-.713 0L1.543 7.57c-.364.197-.5.652-.303 1.017.135.25.394.393.66.393.12 0 .243-.03.356-.09l.815-.44L4.7 19.963c.214 1.215 1.308 2.062 2.658 2.062h9.282c1.352 0 2.445-.848 2.663-2.087l1.626-11.49.818.442c.364.193.82.06 1.017-.304.196-.363.06-.818-.304-1.016zm-4.638 12.133c-.107.606-.703.822-1.18.822H7.36c-.48 0-1.075-.216-1.178-.798L4.48 7.69 12 3.628l7.522 4.06-1.7 12.015z"></path>
                        <path d="M8.22 12.184c0 2.084 1.695 3.78 3.78 3.78s3.78-1.696 3.78-3.78-1.695-3.78-3.78-3.78-3.78 1.696-3.78 3.78zm6.06 0c0 1.258-1.022 2.28-2.28 2.28s-2.28-1.022-2.28-2.28 1.022-2.28 2.28-2.28 2.28 1.022 2.28 2.28z"></path>
                    <?php endif; ?>
                </g>
            </svg>
            <p class="tooltip__descripcion">Inicio</p>
        </li>

        <!-- CATALOGO -->
        <li class="nav__list-item iconMenu  <?= $url == $navLink['catalogue'] ? 'active' : '' ?>" onclick="setLocationMenu('<?= urlroot . $navLink['catalogue'] ?>')">

            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="books" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="item__icon">
                <?php if ($url == $navLink['catalogue']) : ?>
                    <path d="M575.11 443.25L461.51 19.06C458.2 6.7 445.61-3.18 430.15.96L414.7 5.1c-6.18 1.66-11.53 6.4-16.06 14.24-14.03 6.94-52.3 17.21-68 18.22-7.84-4.53-14.85-5.96-21.03-4.3l-15.46 4.14c-2.42.65-4.2 1.95-6.15 3.08V32c0-17.67-14.33-32-32-32h-64c-17.67 0-32 14.33-32 32v64h128l101.66 396.94c3.31 12.36 15.9 22.24 31.36 18.1l15.45-4.14c6.18-1.66 11.53-6.4 16.06-14.24 13.91-6.88 52.18-17.2 68-18.22 7.84 4.53 14.85 5.96 21.03 4.3l15.46-4.14c15.45-4.14 21.41-18.99 18.09-31.35zm-134.4-7.06L348.64 92.37l61.82-16.56 92.07 343.82-61.82 16.56zM0 384h128V128H0v256zM96 0H32C14.33 0 0 14.33 0 32v64h128V32c0-17.67-14.33-32-32-32zM0 480c0 17.67 14.33 32 32 32h64c17.67 0 32-14.33 32-32v-64H0v64zm160-96h128V128H160v256zm0 96c0 17.67 14.33 32 32 32h64c17.67 0 32-14.33 32-32v-64H160v64z" class=""></path>
                <?php else : ?>
                    <path d="M575.46 454.59L458.55 11.86c-2.28-8.5-11.1-13.59-19.6-11.31L423.5 4.68c-7.54 2.02-12.37 9.11-11.83 16.53-11.47 7.42-64.22 21.55-77.85 20.86-3.24-6.69-10.97-10.42-18.5-8.4L304 36.7V32c0-17.67-14.33-32-40-32H24C14.33 0 0 14.33 0 32v448c0 17.67 14.33 32 24 32h240c25.67 0 40-14.33 40-32V115.94l101.45 384.2c2.28 8.5 11.1 13.59 19.6 11.31l15.46-4.14c7.54-2.02 12.37-9.11 11.83-16.52 11.47-7.42 64.21-21.55 77.85-20.86 3.24 6.69 10.97 10.42 18.5 8.4l15.46-4.14c8.49-2.28 13.58-11.1 11.31-19.6zM128 464H48v-48h80v48zm0-96H48V144h80v224zm0-272H48V48h80v48zm128 368h-80v-48h80v48zm0-96h-80V144h80v224zm0-272h-80V48h80v48zm185.98 355.01L344.74 81.69c16.76-1.8 60.74-13.39 77.28-20.71l97.24 369.32c-16.76 1.81-60.74 13.4-77.28 20.71z" class=""></path>
                <?php endif; ?>
            </svg>
            <p class="tooltip__descripcion">Catálogo</p>
        </li>

        <!-- PRESTAMOS -->
        <li class="nav__list-item iconMenu  <?= $url == $navLink['loan'] ? 'active' : '' ?>" onclick="setLocationMenu('<?= urlroot . $navLink['loan'] ?>')">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="file-plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="item__icon">
                <?php if ($url == $navLink['loan']) : ?>
                    <path d="M377,105,279.1,7a24,24,0,0,0-17-7H256V128H384v-6.1A23.92,23.92,0,0,0,377,105ZM224,136V0H24A23.94,23.94,0,0,0,0,24V488a23.94,23.94,0,0,0,24,24H360a23.94,23.94,0,0,0,24-24V160H248A24.07,24.07,0,0,1,224,136Zm72,176v16a16,16,0,0,1-16,16H216v64a16,16,0,0,1-16,16H184a16,16,0,0,1-16-16V344H104a16,16,0,0,1-16-16V312a16,16,0,0,1,16-16h64V232a16,16,0,0,1,16-16h16a16,16,0,0,1,16,16v64h64A16,16,0,0,1,296,312Z" class=""></path>
                <?php else : ?>
                    <path d="M369.9,97.9,286,14A48,48,0,0,0,252.1-.1H48A48.16,48.16,0,0,0,0,48V464a48,48,0,0,0,48,48H336a48,48,0,0,0,48-48V131.9A48.23,48.23,0,0,0,369.9,97.9ZM256,51.9,332.1,128H256ZM336,464H48V48H208V152a23.94,23.94,0,0,0,24,24H336ZM215,223.75a16,16,0,0,0-16-16H183a16,16,0,0,0-16,16v56.5h-55.5a16,16,0,0,0-16,16v16a16,16,0,0,0,16,16H167v56a16,16,0,0,0,16,16h16a16,16,0,0,0,16-16v-56h56.5a16,16,0,0,0,16-16v-16a16,16,0,0,0-16-16H215Z" class=""></path>
                <?php endif; ?>
            </svg>
            <p class="tooltip__descripcion">Solicitar prestamo</p>
        </li>

        <!-- FAVORITES -->
        <li class="nav__list-item iconMenu  <?= $url == $navLink['favorites'] ? 'active' : '' ?>" onclick="setLocationMenu('<?= urlroot . $navLink['favorites'] ?>')">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bookmark" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="item__icon">
                <?php if ($url == $navLink['favorites']) : ?>
                    <path d="M0 512V48C0 21.49 21.49 0 48 0h288c26.51 0 48 21.49 48 48v464L192 400 0 512z" class=""></path>
                <?php else : ?>
                    <path d="M336 0H48C21.49 0 0 21.49 0 48v464l192-112 192 112V48c0-26.51-21.49-48-48-48zm0 428.43l-144-84-144 84V54a6 6 0 0 1 6-6h276c3.314 0 6 2.683 6 5.996V428.43z" class=""></path>
                <?php endif ?>
            </svg>
            <p class="tooltip__descripcion">Libros favoritos</p>
        </li>

        <!-- Si el usuario esta logeado, apareceran estos ICONOS, de lo contrario apareceran opciones de Registro e Inicio de Sesion -->
        <?php
        if (isLoggedIn()) : ?>

            <!-- MOSTRAR CARRITO -->
            <li class="nav__list-item nav__item-car iconMenu <?= $url == $navLink['car'] ? 'active' : '' ?>" onclick="setLocationMenu('<?= urlroot .  $navLink['car'] ?>')">
                <?php if (!empty($_SESSION['CART'])) : ?>
                    <span class="number-cart">
                        <?= count($_SESSION['CART']); ?>
                    </span>
                <?php endif; ?>
                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="shopping-cart" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="item__icon">
                    <?php if ($url == $navLink['car']) : ?>
                        <path d="M528.12 301.319l47.273-208C578.806 78.301 567.391 64 551.99 64H159.208l-9.166-44.81C147.758 8.021 137.93 0 126.529 0H24C10.745 0 0 10.745 0 24v16c0 13.255 10.745 24 24 24h69.883l70.248 343.435C147.325 417.1 136 435.222 136 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-15.674-6.447-29.835-16.824-40h209.647C430.447 426.165 424 440.326 424 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-22.172-12.888-41.332-31.579-50.405l5.517-24.276c3.413-15.018-8.002-29.319-23.403-29.319H218.117l-6.545-32h293.145c11.206 0 20.92-7.754 23.403-18.681z" class=""></path>
                    <?php else : ?>
                        <path d="M551.991 64H144.28l-8.726-44.608C133.35 8.128 123.478 0 112 0H12C5.373 0 0 5.373 0 12v24c0 6.627 5.373 12 12 12h80.24l69.594 355.701C150.796 415.201 144 430.802 144 448c0 35.346 28.654 64 64 64s64-28.654 64-64a63.681 63.681 0 0 0-8.583-32h145.167a63.681 63.681 0 0 0-8.583 32c0 35.346 28.654 64 64 64 35.346 0 64-28.654 64-64 0-18.136-7.556-34.496-19.676-46.142l1.035-4.757c3.254-14.96-8.142-29.101-23.452-29.101H203.76l-9.39-48h312.405c11.29 0 21.054-7.869 23.452-18.902l45.216-208C578.695 78.139 567.299 64 551.991 64zM208 472c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm256 0c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm23.438-200H184.98l-31.31-160h368.548l-34.78 160z" class=""></path>
                    <?php endif; ?>
                </svg>
                <p class="tooltip__descripcion">Carrito</p>
            </li>

            <!-- CUENTA DE USUARIO -->
            <li class="nav__list-item item__session">
                <button class="item__display" id="btn-menu">
                    <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="user" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="item__icon" id="svg_user">
                        <path d="M313.6 304c-28.7 0-42.5 16-89.6 16-47.1 0-60.8-16-89.6-16C60.2 304 0 364.2 0 438.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-25.6c0-74.2-60.2-134.4-134.4-134.4zM400 464H48v-25.6c0-47.6 38.8-86.4 86.4-86.4 14.6 0 38.3 16 89.6 16 51.7 0 74.9-16 89.6-16 47.6 0 86.4 38.8 86.4 86.4V464zM224 288c79.5 0 144-64.5 144-144S303.5 0 224 0 80 64.5 80 144s64.5 144 144 144zm0-240c52.9 0 96 43.1 96 96s-43.1 96-96 96-96-43.1-96-96 43.1-96 96-96z" class=""></path>
                    </svg>
                </button>
                <p class="tooltip__descripcion">Cuenta</p>

                <!-- MENU DESPLEGABLE -->
                <ul class="item__menu" id='display-menu'>
                    <div class="menu__tip"></div>
                    <li class="menu__greeting">
                        <p class="greeting_head"><?= $greetings[rand(0, 11)] ?>,</p>
                        <p class="greeting__name"><?= $_SESSION['name'] . ' ' . $_SESSION['lastname'] ?></p>
                        <div class="greeting__divisor"></div>
                    </li>
                    <li class="menu__option" onclick="window.location.href='<?= urlroot . '/user/profile' ?>'">
                        <i class="fas fa-user"></i>
                        <p>Perfil</p>

                    </li>
                    <li class="menu__option" onclick="window.location.href='<?= urlroot . '/book/' ?>'">
                        <i class="fas fa-book"></i>
                        <p>Libros</p>
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