<?php
$style = "user.css";

$thisUrl = urlroot . "/user/uploadUserPhoto";
$redirectTo = urlroot . "/user/profile/";

require_once approot . '/Views/Includes/head.php';?>
<body>
    <header>
        <?php require_once approot . '/Views/Includes/navbar.php'; ?>
    </header>
    <main class="container">
        <div class="content__user">
            <h1 class="content__title">Actualizar foto de perfil</h1>
            <div class="content__body">
                <input type="hidden" value="<?= $thisUrl?>" id="thisurl">
                <input type="hidden" value="<?= $redirectTo?>" id="redirecto">
                <div class="progress__bar"> 
                    <div class="bar__blue" id="bar__state">
                        <span id="progress__percent"></span>
                    </div>
                </div>
                <?= empty($data['file'] ? "" : "<h1>".$data['file']. "</h1>"); ?>
                <div id="preview" class="container__preview">
                    <div id="preview__img" class="a">
                        <img src="<?= imagenurl . $_SESSION['avatar'] ?>" alt="photo-2021-10-11-19-58-46" class="preview__img">
                    </div>
                </div>

                <form action="" id="form__file" method="POST" enctype="multipart/form-data" class="form__upload-file">
                <div class="form__file" id="btn__file">
                    <i class="fas fa-cloud-upload-alt icon-upload" id="icon-upload"></i>
                    <label for="" class="form__file-label" id="input__label">Elegir Archivo</label>
                    <input type="file" name="userPhoto" id="userPhoto" class="form__file-input" accept="image/*">
                </div>
                <button class="btn__submit" id="sbmt__btn">Subir foto</button>
                </form>
            </div>
        </div>
    </main>
    <?php require_once approot . '/Views/Includes/footer.php'; ?>

   <script src="<?= urlroot . '/public/js/uploadPhoto.js?v='.time() ?>"></script>
</body>

</html>