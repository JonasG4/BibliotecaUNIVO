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
                <h1>Nuevo autor</h1>
                <a class="Main__Link bg-Secondary" href="<?= urlroot . '/Author/'; ?>">
                    <i class="fas fa-arrow-left"></i>
                    Regresar
                </a>
            </div>
            <form action="" method="POST" autocomplete="off" class="Main__Form">
                <div class="Main__Form-Group">
                    <label for="First_Name">Nombres del autor: </label>
                    <input type="text" name="First_Name" id="First_Name" placeholder="Escribe aquí los nombres del autor">
                    <span>
                        <?= isset($data['FirstName_Error']) ? $data['FirstName_Error'] : ''; ?>
                    </span>
                </div>
                <div class="Main__Form-Group">
                    <label for="Last_Name">Apellidos del autor: </label>
                    <input type="text" name="Last_Name" id="Last_Name" placeholder="Escribe aquí los apellidos del autor">
                    <span>
                        <?= isset($data['LastName_Error']) ? $data['LastName_Error'] : ''; ?>
                    </span>
                </div>
                <div class="Main__Form-Group">
                    <label for="Origin_Country">País de origen: </label>
                    <input type="phone" name="Origin_Country" id="Origin_Country" placeholder="Escribe aquí el número telefónico">
                    <span>
                        <?= isset($data['Country_Error']) ? $data['Country_Error'] : ''; ?>
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