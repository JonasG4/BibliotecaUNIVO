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
                <h1>Nuevo autor</h1>
                <a class="Main__Link bg-Secondary" href="<?= urlroot . '/Book/' ; ?>">
                    <i class="fas fa-arrow-left"></i>
                    Regresar
                </a>
            </div>
            <form action="" method="POST" autocomplete="off" class="Main__Form">
                <div class="Main__Form-Group">
                    <label for="ISBN">ISBN: </label>
                    <input type="text" name="ISBN" id="ISBN" placeholder="Escribe aquí el ISBN del libro">
                    <span>
                        <?= isset($data['ISBN_Error']) ? $data['ISBN_Error'] : ''; ?>
                    </span>
                </div>
                <div class="Main__Form-Group">
                    <label for="Book_Title">Título del libro: </label>
                    <input type="text" name="Book_Title" id="Book_Title" placeholder="Escribe aquí el título del libro">
                    <span>
                        <?= isset($data['Title_Error']) ? $data['Title_Error'] : ''; ?>
                    </span>
                </div>
                <div class="Main__Form-Group">
                    <label for="Book_Synopsis">Sipnosis: </label>
                    <textarea name="Book_Synopsis" id="Book_Synopsis"></textarea>
                    <span>
                        <?= isset($data['Synopsis_Error']) ? $data['Synopsis_Error'] : ''; ?>
                    </span>
                </div>
                <div class="Main__Form-Group">
                    <label for="Book_Edition">Edición del libro: </label>
                    <input type="number" name="Book_Edition" id="Book_Edition" placeholder="Escribe la edición del libro">
                    <span>
                        <?= isset($data['Edition_Error']) ? $data['Edition_Error'] : ''; ?>
                    </span>
                </div>
                <div class="Main__Form-Group">
                    <label for="Number_Pages">Cantidad de páginas: </label>
                    <input type="number" name="Number_Pages" id="Number_Pages" placeholder="Escribe aquí la cantidad de páginas">
                    <span>
                        <?= isset($data['NumberPages_Error']) ? $data['NumberPages_Error'] : ''; ?>
                    </span>
                </div>
                <div class="Main__Form-Group">
                    <label for="Publication_Date">Fecha de publicación: </label>
                    <input type="date" name="Publication_Date" id="Publication_Date">
                    <span>
                        <?= isset($data['Date_Error']) ? $data['Date_Error'] : ''; ?>
                    </span>
                </div>
                <div class="Main__Form-Group">
                    <label for="Id_Genre">Géneros: </label>
                    <select name="Id_Genre" id="Id_Genre">
                        <?php
                            foreach($data['Genres'] as $Genre)
                                echo "<option value='{$Genre->Id_Genre}'>{$Genre->Genre_Name}</option>";
                        ?>
                    </select> 
                    <span>
                        <?= isset($data['Genre_Error']) ? $data['Genre_Error'] : ''; ?>
                    </span>
                </div>
                <div class="Main__Form-Group">
                    <label for="Id_Publisher">Editoriales: </label>
                    <select name="Id_Publisher" id="Id_Publisher">
                        <option selected>--Selecciona una editorial--</option>
                        <?php
                            foreach($data['Publishers'] as $Publisher){
                                echo "<option value='{$Publisher->Id_Publisher}'>{$Publisher->Publisher_Name}</option>";
                            }
                        ?>
                    </select>
                    <span>
                        <?= isset($data['Publisher_Error']) ? $data['Publisher_Error'] : ''; ?>
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