<?php
    if(!isLoggedIn()){
        header('location: ' . urlroot . '/auth/login');
    }
    require_once approot . '/Views/Includes/head.php';
?>

<body>
    <main role="main">
        <section class="Section">
            <div class="Main__Head">
                <h1>Actualizar relación</h1>
                <a class="Main__Link bg-Secondary" href="<?= urlroot . '/AuthorBook/' ; ?>">
                    <i class="fas fa-arrow-left"></i>
                    Regresar
                </a>
            </div>
            <form action="" method="POST" autocomplete="off" class="Main__Form">
                <div class="Main__Form-Group">
                    <label for="First_Name">Autores: </label>
                    <select name="Id_Author" id="Id_Author">
                        <?php
                            foreach($data['Authors'] as $Author):
                                if($Author->Id_Author == $data['AuthorBook']->Id_Author):
                        ?>
                                    <option selected value='<?=$Author->Id_Author?>'><?=$Author->First_Name . $Author->Last_Name?></option>;
                        <?php
                                else:
                        ?>
                                    <option value='<?=$Author->Id_Author?>'><?=$Author->First_Name . $Author->Last_Name?></option>;
                        <?php
                            endif;
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
                        <?php
                            foreach($data['Books'] as $Book):
                                if($Book->Id_Book == $data['AuthorBook']->Id_Book):
                        ?>
                                    <option selected value='<?=$Book->Id_Book?>'><?=$Book->Book_Title?></option>;
                        <?php
                                else:
                        ?>
                                    <option value='<?=$Book->Id_Book?>'><?=$Book->Book_Title?></option>;
                        <?php
                            endif;
                            endforeach;
                        ?>
                    </select>
                    <span>
                        <?= isset($data['Book_Error']) ? $data['Book_Error'] : ''; ?>
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