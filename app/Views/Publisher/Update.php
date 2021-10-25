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
            <div class="Main__Head">
                <h1>Actualizar Editorial</h1>
                <a class="Main__Link bg-Secondary" href="<?= urlroot . '/Publisher/'; ?>">
                    <i class="fas fa-arrow-left"></i>
                    Regresar
                </a>
            </div>
            <form action="" method="POST" autocomplete="off" class="Main__Form">
                <div class="Main__Form-Group">
                    <label for="Publisher_Name">Nombre de la editorial: </label>
                    <input type="text" value="<?= $data['Publisher']->Publisher_Name ?>" name="Publisher_Name" id="Publisher_Name" placeholder="Escribe aquí el nombre de la editorial">
                    <span>
                        <?= isset($data['Name_Error']) ? $data['Name_Error'] : ''; ?>
                    </span>
                </div>
                <div class="Main__Form-Group">
                    <label for="Origin_Country">País de origen: </label>
                    <input type="text" value="<?= $data['Publisher']->Origin_Country ?>" name="Origin_Country" id="Origin_Country" placeholder="Escribe aquí el país de origen">
                    <span>
                        <?= isset($data['Country_Error']) ? $data['Country_Error'] : ''; ?>
                    </span>
                </div>
                <div class="Main__Form-Group">
                    <label for="Phone_Number">Número telefónico: </label>
                    <input type="phone" value="<?= $data['Publisher']->Phone_Number ?>" name="Phone_Number" id="Phone_Number" placeholder="Escribe aquí el número telefónico">
                    <span>
                        <?= isset($data['Phone_Error']) ? $data['Phone_Error'] : ''; ?>
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