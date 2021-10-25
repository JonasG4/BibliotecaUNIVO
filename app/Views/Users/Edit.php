<?php
$style = "user.css";
require_once approot . '/Views/Includes/head.php' ?>

<body>
    <header>
        <?php require_once approot . '/Views/Includes/navbar.php' ?>
    </header>
    <main class="container">
        <div class="content">
            <h1 class="content__title">Editar perfil</h1>
            <form method="POST" class="form__container">
                <div class="form__group">
                    <div class="form__input">
                        <label for="" class="input__label">Nombre</label>
                        <input type="text" value="<?= $data['name']; ?>" name="name" class="input__control" />
                        <span class="error__message"><?= empty($data['nameError']) ? "" : $data['nameError'] ?></span>
                    </div>
                    <div class="form__input">
                        <label for="" class="input__label">Apellido</label>
                        <input type="text" value="<?= $data['lastname']; ?>" name="lastname" class="input__control" />
                        <span class="error__message"><?= empty($data['lastnameError']) ? "" : $data['lastnameError'] ?></span>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__input">
                        <label for="" class="input__label">Nombre de usuario</label>
                        <input type="text" value="<?= $data['username']; ?>" name="username" class="input__control" />
                        <span class="error__message"><?= empty($data['usernameError']) ? "" : $data['usernameError'] ?></span>
                    </div>
                    <div class="form__input">
                        <label for="" class="input__label">Correo electrónico</label>
                        <input type="text" value="<?= $data['email']; ?>" name="email" class="input__control" />
                        <span class="error__message"><?= empty($data['emailError']) ? "" : $data['emailError'] ?></span>
                    </div>
                </div>
                <button type="submit" class="form__btn">Actualizar</button>
            </form>
        </div>
    </main>

    <?php require_once approot . '/Views/Includes/footer.php'; ?>
</body>

</html>