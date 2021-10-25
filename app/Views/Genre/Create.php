<?php
if (!isset($_SESSION['user_id'])) {
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
            <div class="Main__Head">
                <h1>Nueva Editorial</h1>
                <a class="Main__Link bg-Secondary" href="<?= urlroot . '/Publisher/'; ?>">
                    <i class="fas fa-arrow-left"></i>
                    Regresar
                </a>
            </div>
            <form action="" method="POST" autocomplete="off" class="Main__Form">
                <div class="Main__Form-Group">
                    <label for="Genre_Name">Nombre de la editorial: </label>
                    <input type="text" name="Genre_Name" id="Genre_Name" placeholder="Escribe aquí el nombre del género">
                    <span>
                        <?= isset($data['Name_Error']) ? $data['Name_Error'] : ''; ?>
                    </span>
                </div>
                <div class="Main__Form-Group">
                    <label for="Genre_Description">País de origen: </label>
                    <input type="text" name="Genre_Description" id="Genre_Description" placeholder="Escribe aquí una pequeña descripción del género">
                    <span>
                        <?= isset($data['Description_Error']) ? $data['Description_Error'] : ''; ?>
                    </span>
                </div>
                <button type="submit" class="Main__Button Main__Button-Save">
                    <i class="fas fa-save"></i>
                    Guardar
                </button>
            </form>
        </section>
    </main>
</body>