<?php
if (isset($_SESSION['user_id'])) {
    header('location: ' . urlroot . '/');
}
//Se define el nombre del style creado en la carpeta css
$style = "auth.css";

//Se invoca la cabecera
require_once approot . '/Views/Includes/head.php';
require_once approot . '/Config/google_credentials.php';

?>

<body>
    <main class="auth-container">
        <!-- lgn = login -->
        <div class="lgn-container">
            <h3 class="title-form">Iniciar sesion</h3>
            <form action="<?= urlroot ?>/auth/login" method="POST">
                <?php if (!empty($data['logError']) || isset($_GET['logError'])) : ?>
                    <div class="invalidFeedback">
                        <i class="fas fa-times-circle"></i>
                        <?= isset($data['logError']) ? $data['logError'] : ""; ?>
                        <?= isset($_GET["logError"]) ? $_GET['logError'] : ""; ?>
                    </div>
                <?php endif ?>
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" name="usernameOrEmail" class="form-control" autocomplete="off">
                        <label for="usernameOrEmail" class="floating-label">Usuario o correo eléctronico</label>
                        <span class="error-message"><?= isset($data["usernameOrEmailError"]) ? $data["usernameOrEmailError"] : ""; ?></span>
                    </div>
                    <div class="input-group">
                        <input type="password" name="password" id="password" class="form-control" autocomplete="off">
                        <label for="password" class="floating-label">Contraseña</label>
                        <i class="far fa-eye-slash" id="pw-icon"></i>
                        <span class="error-message"><?=  isset($data["passwordError"]) ? $data["passwordError"] : "" ?></span>
                    </div>
                    <button type="submit" class="btn">Iniciar sesión</button>
                </div>
            </form>
            <div class="split-line">
                <div class="r-line"></div>
                <p>O</p>
                <div class="l-line"></div>
            </div>
            <a href="<?= $urlLogin?>" class="btn-google">
                <img src="https://i.ibb.co/GdRyFks/5847f9cbcef1014c0b5e48c8.png" class="logo-google" alt="logo de goole">
                Inicia sesión con Google</a>
                <p class="switchAuth">
                    ¿No tienes cuenta?<a href="<?= urlroot; ?>/auth/register"> Registrate</a>
                </p>
        </div>
        <!-- <div class="off-lgn-container">
        </div> -->
    </main>
</body>

<script src="<?= urlroot ?>/public/js/floatingLabels.js?v=<?php echo time(); ?>"></script>
<script src="<?= urlroot ?>/public/js/validations.js?v=<?php echo time(); ?>"></script>

</html>