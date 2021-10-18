<?php
$style = 'auth.css';
require_once approot . '/Views/Includes/head.php';
require_once approot . '/Config/google_credentials.php'
?>

<body>
    <!-- sgn = Sign In -->
    <div class="auth-container">
        <div class="sgn-container">
            <h2 class="title-form">Registrate</h2>
            <form action="" method="POST">
                <p class="description-form">¡Únete y disfruta de una amplia libreria digital disponible para tí en todo momento!</p>
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control <?= empty($data["nameError"]) ? "" : "form-error" ?>" name="name" id="name" value="<?= $data["name"] ?>">
                        <label for="name" class="floating-label <?= empty($data["nameError"]) ? "" : "form-error" ?>">Nombre</label>
                        <span id="name" class="error-message"><?= $data['nameError'] ?></span>
                    </div>
                    <div class="input-group">
                        <input type="text" class="form-control <?= empty($data["nameError"]) ? "" : "form-error" ?>" name="lastname" id="lastname" value="<?= $data["lastname"] ?>">
                        <label for="lastname" class="floating-label <?= empty($data["nameError"]) ? "" : "form-error" ?>">Apellido</label>
                        <span id="lastname" class="error-message"><?= $data['lastnameError'] ?></span>
                    </div>
                </div>
                <div class="form-group">

                    <div class="input-group">
                        <input type="text" class="form-control <?= empty($data["nameError"]) ? "" : "form-error" ?>" name="username" id="username" value="<?= $data["username"] ?>">
                        <label for="username" class="floating-label <?= empty($data["nameError"]) ? "" : "form-error" ?>">Nombre de usuario</label>
                        <span id="username" class="error-message"><?= $data['usernameError'] ?></span>
                    </div>
                    <div class="input-group">
                        <input type="text" class="form-control <?= empty($data["nameError"]) ? "" : "form-error" ?>" name="email" id="email" value="<?= $data["email"] ?>">
                        <label for="email" class="floating-label <?= empty($data["nameError"]) ? "" : "form-error" ?>">Correo electrónico</label>
                        <span id="email" class="error-message"><?= $data['emailError'] ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <input type="password" class="form-control <?= empty($data["nameError"]) ? "" : "form-error" ?>" name="password" id="password">
                        <label for="password" class="floating-label <?= empty($data["nameError"]) ? "" : "form-error" ?>">Contraseña</label>
                        <span id="password" class="error-message"><?= $data['passwordError'] ?></span>
                    </div>
                    <div class="input-group">
                        <input type="password" class="form-control <?= empty($data["nameError"]) ? "" : "form-error" ?>" name="confirmPassword" id="confirmPassword">
                        <label for="confirmPassword" class="floating-label <?= empty($data["nameError"]) ? "" : "form-error" ?>">Confirmar contraseña</label>
                        <span id="confirmPassword" class="error-message"><?= $data['confirmPasswordError'] ?></span>
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
    <!-- <div class="off-lgn-container">
    </div> -->
    </div>

    <script src="<?= urlroot ?>/public/js/floatingLabels.js?v=<?php echo time(); ?>"></script>
    <script src="<?= urlroot ?>/public/js/validations.js?v=<?php echo time(); ?>"></script>
</body>

</html>