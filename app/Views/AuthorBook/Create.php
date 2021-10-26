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
                 <h1>Añadir relación</h1>
                 <a class="Main__Link" href="<?= urlroot . '/AuthorBook/'; ?>">
                     <i class="fas fa-arrow-left"></i>
                     Regresar
                 </a>
             </div>
             <form action="" method="POST" autocomplete="off" class="Main__Form">
                <div class="Main__Form-Row">
                    <div class="Main__Form-Group">
                        <label for="First_Name">Autores: </label>
                        <select name="Id_Author" id="Id_Author">
                            <option selected>----Selecciona un autor----</option>
                            <?php
                                foreach ($data['Authors'] as $Author) :
                                ?>
                                <option value="<?= $Author->Id_Author ?>"><?= $Author->First_Name . ' ' . $Author->Last_Name ?></option>
                            <?php
                                endforeach;
                                ?>
                        </select>
                        <span>
                            <?= isset($data['Author_Error']) ? $data['Author_Error'] : ''; ?>
                        </span>
                    </div>
                    <div class="Main__Form-Group">
                        <label for="Last_Name">Libros: </label>
                        <select name="Id_Book" id="Id_Book">
                            <option selected>----Selecciona un libro----</option>
                            <?php
                                print_r($data['Books']);
                                foreach ($data['Books'] as $Book) :
                                ?>
                                <option value="<?= $Book->Id_Book ?>"><?= $Book->Book_Title ?></option>
                            <?php
                                endforeach;
                                ?>
                        </select>
                        <span>
                            <?= isset($data['Book_Error']) ? $data['Book_Error'] : ''; ?>
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