<?php
    if(!isset($_SESSION['user_id'])){
        header('location: ' . urlroot . '/auth/login');
    }
    require_once approot . '/Views/Includes/head.php';
?>
<body>
    <main role="main">
        <section class="Section">
            <div class="Main__Head">
                <h1>Nueva Editorial</h1>
                <a class="Main__Link bg-Secondary" href="<?= urlroot . '/Publisher/' ; ?>">
                    <i class="fas fa-arrow-left"></i>
                    Regresar
                </a> 
            </div>
            <form action="" method="POST" autocomplete="off" class="Main__Form">
                <div class="Main__Form-Group">
                    <label for="Publisher_Name">Nombre de la editorial: </label>
                    <input type="text" name="Publisher_Name" id="Publisher_Name" placeholder="Escribe aquí el nombre de la editorial">
                    <span>
                        <?= isset($data['Name_Error']) ? $data['Name_Error'] : ''; ?>
                    </span>
                </div>
                <div class="Main__Form-Group">
                    <label for="Origin_Country">País de origen: </label>
                    <input type="text" name="Origin_Country" id="Origin_Country" placeholder="Escribe aquí el país de origen">
                    <span>
                        <?= isset($data['Country_Error']) ? $data['Country_Error'] : ''; ?>
                    </span>
                </div>
                <div class="Main__Form-Group">
                    <label for="Phone_Number">Número telefónico: </label>
                    <input type="phone" name="Phone_Number" id="Phone_Number" placeholder="Escribe aquí el número telefónico">
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