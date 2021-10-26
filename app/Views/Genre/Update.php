<?php
if (!isLoggedIn()) {
    header('location: ' . urlroot . '/auth/login');
}
require_once approot . '/Views/Includes/head.php';
?>

<body>
    <header>
        <?php require_once approot . '/Views/Includes/navbar.php'; ?>
    </header>
    <main role="main">
        <section class="Section">
            <div class="Section__Head">
                <h1>Actualizar género</h1>
                <a class="Main__Link" href="<?= urlroot . '/Genre/'; ?>">
                    <i class="fas fa-arrow-left"></i>
                    Regresar
                </a>
            </div>
            <form action="" method="POST" autocomplete="off" class="Main__Form">
                <div class="Main__Form-Row">
                    <div class="Main__Form-Group">
                        <label for="Genre_Name">Nombre del género: </label>
                        <input type="text" value="<?= $data['Genre']->Genre_Name; ?>" name="Genre_Name" id="Genre_Name" placeholder="Ingrese el nombre del género">
                        <span>
                            <?= isset($data['Name_Error']) ? $data['Name_Error'] : ''; ?>
                        </span>
                    </div>
                    <div class="Main__Form-Group">
                        <label for="Genre_Description">Descripción: </label>
                        <input type="text" value="<?= $data['Genre']->Genre_Description; ?>" name="Genre_Description" id="Genre_Description" placeholder="Añade una descripción del género">
                        <span>
                            <?= isset($data['Description_Error']) ? $data['Description_Error'] : ''; ?>
                        </span>
                    </div>
                </div>
                <button type="submit" class="Main__Button Main__Button-Save">
                    <i class="fas fa-save"></i>
                    Guardar
                </button>
            </form>
        </section>
    </main>
</body>