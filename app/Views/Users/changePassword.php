<?php
$style = "user.css";
require_once approot . '/Views/Includes/head.php' ?>

<body>
    <header>
        <?php require_once approot . '/Views/Includes/navbar.php' ?>
    </header>
    <main class="container">
        <div class="content">
            <h1 class="content__title">Cambiar contraseña</h1>
            <form method="POST" class="form__container">
                <div class="form__group">
                    <div class="form__input">
                        <label for="" class="input__label">Antigua contraseña</label>
                        <input type="password" name="oldPassword" id="oldPassword" class="input__control">
                        <span class="error__message"><?= empty($data['oldPasswordErr']) ? '' : $data['oldPasswordErr'] ?></span>
                    </div>
                    <div class="form__input">
                        <label for="" class="input__label">Nueva contraseña</label>
                        <input type="password" name="newPassword" class="input__control">
                        <span class="error__message"><?= empty($data['newPasswordErr']) ? '' : $data['newPasswordErr']  ?></span>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__input">
                        <label for="" class="input__label">Confirmar contraseña</label>
                        <input type="password" name="confirmPassword" class="input__control">
                        <span class="error__message"><?= empty($data['confirmPasswordErr']) ? '' : $data['confirmPasswordErr']  ?></span>
                    </div>
                </div>
                <button type="submit" class="form__btn">Actualizar</button>
            </form>

        </div>
    </main>
    <?php require_once approot . '/Views/Includes/footer.php'; ?>
</body>

</html>