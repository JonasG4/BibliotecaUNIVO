<?php
$style = 'auth.css';
require_once approot . '/Views/Includes/head.php';
require_once approot . '/Config/google_credentials.php';

//Recoger errores
$nameErr = empty($data["nameError"]) ? " " : "form__error";
$lastnameErr = empty($data["lastnameError"]) ? " " : "form__error";
$usernameErr = empty($data["usernameError"]) ? " " : "form__error";
$emailErr = empty($data["emailError"]) ? " " : "form__error";
$passwordErr = empty($data["passwordError"]) ? " " : "form__error";
$confirmPasswordErr = empty($data["confirmPasswordError"]) ? " " : "form__error";
?>

<body>
    <header>
        <?php require_once approot . '/Views/Includes/navbar.php'; ?>
    </header>
    <!-- sgn = Sign In -->
    <div class="auth-container">
        <div class="sgn-container">
            <h2 class="title-form">Registrate</h2>
            <form action="" method="POST" id="form__floating">
                <p class="description-form">¡Únete y disfruta de una amplia libreria digital disponible para tí en todo momento!</p>
                <div class="form-group">
                    <div class="input-group <?= $nameErr ?>" id="name__group">
                        <input type="text" class="form-control" name="name" id="name" value="<?= $data["name"] ?>">
                        <label for="name" class="floating-label">Nombre</label>
                        <i class="far fa-check-circle" id="checkIcon"></i>
                        <span id="name__msg" class="error-message"><?= $data['nameError'] ?></span>
                    </div>
                    <div class="input-group <?= $lastnameErr ?>" id="lastname__group">
                        <input type="text" class="form-control" name="lastname" id="lastname" value="<?= $data["lastname"] ?>">
                        <label for="lastname" class="floating-label">Apellido</label>
                        <i class="far fa-check-circle" id="checkIcon"></i>
                        <span id="lastname__msg" class="error-message"><?= $data['lastnameError'] ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group  <?= $usernameErr ?>" id="username__group">
                        <input type="text" class="form-control" name="username" id="username" value="<?= $data["username"] ?>">
                        <label for="username" class="floating-label">Nombre de usuario</label>
                        <i class="far fa-check-circle" id="checkIcon"></i>
                        <span id="username__msg" class="error-message"><?= $data['usernameError'] ?></span>
                    </div>
                    <div class="input-group  <?= $emailErr ?>" id="email__group">
                        <input type="text" class="form-control" name="email" id="email" value="<?= $data["email"] ?>">
                        <label for="email" class="floating-label">Correo electrónico</label>
                        <i class="far fa-check-circle" id="checkIcon"></i>
                        <span id="email__msg" class="error-message"><?= $data['emailError'] ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group <?= $passwordErr ?>" id="password__group">
                        <input type="password" class="form-control" name="password" id="password">
                        <label for="password" class="floating-label">Contraseña</label>
                        <i class="far fa-check-circle" id="checkIcon"></i>
                        <span id="password__msg" class="error-message"><?= $data['passwordError'] ?></span>
                    </div>
                    <div class="input-group <?= $confirmPasswordErr ?>" id="confirmPassword__group">
                        <input type="password" class="form-control" name="confirmPassword" id="confirmPassword">
                        <label for="confirmPassword" class="floating-label">Confirmar contraseña</label>
                        <i class="far fa-check-circle" id="checkIcon"></i>
                        <span id="confirmPassword__msg" class="error-message"><?= $data['confirmPasswordError'] ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn">Registrarme</button>
                </div>
                <div class="split-line">
                    <div class="r-line"></div>
                    <p>O</p>
                    <div class="l-line"></div>
                </div>
                <a href="<?= $urlRegister ?>" class="btn-google">
                    <img src="https://i.ibb.co/GdRyFks/5847f9cbcef1014c0b5e48c8.png" class="logo-google" alt="logo de goole">
                    Registrarme con Google</a>
                <p class="switchAuth">
                    ¿Ya tienes cuenta? <a href="<?= urlroot ?>/auth/login"> Inicia sesion</a>
                </p>
        </div>

        </form>
    </div>
    <script src="<?= urlroot ?>/public/js/floatingLabels.js?v=<?php echo time(); ?>"></script>
    <script src="<?= urlroot ?>/public/js/validations.js?v=<?php echo time(); ?>"></script>
</body>

</html>