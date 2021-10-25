<?php
$style = "user.css";
require_once approot . '/Views/Includes/head.php' ?>

<body>
    <header>
        <?php require_once approot . '/Views/Includes/navbar.php' ?>
    </header>

    <main class="container">
        <section class="content">
            <div class="user__data">
                <img class="user__avatar" src="<?= imagenurl . $data['avatar'] ?>" alt="">
                <div class="user__info">
                    <p class="user__username"><?= $data['username'] ?></p>
                    <p class="user__fullname"><?= $data['name'] . ' ' .  $data['lastname']; ?></p>
                    <p class="user__email"><?= $data['email'] ?></p>

                </div>
            </div>
        </section>

        <div class="content content__options">
            <!-- <h1>Configuraciones</h1> -->
            <div class="btn__group" id="btn__group">
                <button class="btn__option" onclick="window.location.href='<?= urlroot . '/loan'; ?>'">
                    <i class="fas fa-history"></i>
                    Historial de prestamos
                </button>
                <button class="btn__option" onclick="window.location.href='<?= urlroot . '/loan'; ?>'">
                    <i class="fas fa-book-open"></i>
                    Mis Libros
                </button>
                <button class="btn__option" onclick="window.location.href='<?= urlroot . '/user/edit'; ?>'">
                    <i class="fas fa-user-edit"></i>
                    Editar perfil
                </button>
                <button class="btn__option" onclick="window.location.href='<?= urlroot . '/user/changepassword'; ?>'">
                    <i class="fas fa-unlock-alt"></i>
                    Cambiar contraseña
                </button>
            </div>
        </div>

        <div class="content" id="content__selected">
            <h1>Mis libros</h1>

        </div>
    </main>
    <?php require_once approot . '/Views/Includes/footer.php'; ?>
    <script src="<?= urlroot ?>/public/js/switchView.js?v=<?php echo time(); ?>"></script>
</body>