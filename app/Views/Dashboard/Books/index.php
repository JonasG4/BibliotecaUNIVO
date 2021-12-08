<?php
$style = "book.css";
require_once approot . '/Views/Dashboard/Includes/head.php';
require_once approot . '/Views/Dashboard/Includes/navbar.php';
?>
<main class="main">
    <input hidden id="url" value="<?= urlroot . '/book/' ?>">
    <section class="Section" id="CreateForm">
        <form id="Book__Create" method="POST" autocomplete="off" class="Main__Form" enctype="multipart/form-data"> 
            <div class="Main__Form-Row">
                <div class="Main__Form-Group">
                    <label for="ISBN">ISBN: </label>
                    <input type="text" name="ISBN" id="ISBN" placeholder="Ingrese un ISBN válido">
                    <span id="ISBN_Error"></span>
                </div>
            </div>
            <div class="Main__Form-Row">
                <div class="Main__Form-Group">
                    <label for="Book_Title">Título del libro: </label>
                    <input type="text" name="Book_Title" id="Book_Title" placeholder="Escribe el título del libro">
                    <span id="Title_Error"></span>
                </div>
                <div class="Main__Form-Group">
                    <label for="Id_Author">Autor del libro: </label>
                    <select name="Id_Author" id="Id_Author" class="Input__Select">
                        <option selected>----Selecciona un Autor----</option>
                        <?php
                        foreach ($data['Authors'] as $Author)
                            echo "<option value='{$Author->Id_Author}'>{$Author->First_Name} {$Author->Last_Name}</option>";
                        ?>
                    </select>
                    <span id="Author_Error"></span>
                </div>
            </div>

            <div class="Main__Form-Group">
                <label for="Book_Synopsis">Añade una pequeña sinopsis: </label>
                <textarea name="Book_Synopsis" id="Book_Synopsis"></textarea>
                <span id="Synopsis_Error"></span>
            </div>

            <div class="Main__Form-Row">
                <div class="Main__Form-Group">
                    <label for="Number_Pages">Cantidad de páginas: </label>
                    <input type="number" name="Number_Pages" id="Number_Pages" placeholder="Escribe la cantidad de páginas">
                    <span id="Npages_Error"></span>
                </div>
                <div class="Main__Form-Group">
                    <label for="Book_Edition">Edición del libro: </label>
                    <input type="number" name="Book_Edition" id="Book_Edition" placeholder="Añade la edición del libro">
                    <span id="Edition_Error"></span>
                </div>
                <div class="Main__Form-Group">
                    <label for="Publication_Date">Fecha de publicación: </label>
                    <input type="date" name="Publication_Date" id="Publication_Date">
                    <span id="Date_Error"></span>
                </div>
            </div>

            <div class="Main__Form-Row">
                <div class="Main__Form-Group">
                    <label for="Id_Genre">Géneros: </label>
                    <select name="Id_Genre" id="Id_Genre" class="Input__Select">
                        <option selected>----Selecciona un género----</option>
                        <?php
                        foreach ($data['Genre'] as $Genre)
                            echo "<option value='{$Genre->Id_Genre}'>{$Genre->Genre_Name}</option>";
                        ?>
                    </select>
                    <span id="Genre_Error"></span>

                </div>
                <div class="Main__Form-Group">
                    <label for="Id_Publisher">Editoriales: </label>
                    <select name="Id_Publisher" id="Id_Publisher" class="Input__Select">
                        <option selected>----Selecciona una editorial----</option>
                        <?php
                        foreach ($data['Publisher'] as $Publisher) {
                            echo "<option value='{$Publisher->Id_Publisher}'>{$Publisher->Publisher_Name}</option>";
                        }
                        ?>
                    </select>
                    <span id="Publisher_Error"></span>
                </div>
            </div>
            <div class="Main__Form-row">
                <div class="Main__Form-Group">
                    <label for="Book_Cover">Seleccione portada</label>
                    <input type="file" name="Book_Cover" id="Book_Cover" accept="images/*">
                </div>
                <span id="Cover_Error"></span>
            </div>
            <button type="submit" class="Main__Button Main__Button-Save">
                <i class="fas fa-save"></i>
                Guardar
            </button>
            <button onclick="closeCreateForm()" class="Main__Button Main__Button-Cancel">
                Cancelar
            </button>
        </form>
    </section>

    <section class="main__content">

    <div class="main__header">
        <h1 class="main__header-title">
            <?= $data['title'] ?>
        </h1>
        <a onclick="showCreateForm()" class="main__header-link">Agregar Nuevo</a>
    </div>
    <div class="main__tools">
        <div class="tools__row">
            <div class="tools__col-1">
                <p class="tool__tag">Todos<span class="tool__tag-count">(200)</span></p>
                <span class="v__line"></span>
                <p class="tool__tag">Fisicos<span class="tool__tag-count">(170)</span></p>
                <span class="v__line"></span>
                <p class="tool__tag">Digitales<span class="tool__tag-count">(30)</span></p>
            </div>
            <div class="tools__col-2">
                <form action="">
                    <input type="text" class="input__buscar" placeholder="Buscar un libro...">
                    <button type="submit" class="btn__buscar"> Buscar</button>
                </form>
            </div>
        </div>
        <div class="tools__row">
            <form action="" class="tool__filters">
                <select name="categoria" id="categoria" class="tool__filters-select">
                    <option value="" selected>Todos los Años</option>
                    <?php for ($min = 1900; $min <= date('Y'); $min++) : ?>
                        <option value="<?= $min ?>"><?= $min ?></option>
                    <?php endfor; ?>
                </select>
                <select name="" id="" class="tool__filters-select">
                    <option value="" selected>Todas las Categorias</option>
                    <?php foreach ($data['Genre'] as $categoria) : ?>
                        <option value="<?= $categoria->Id_Genre ?>"> <?= $categoria->Genre_Name; ?></option>
                    <?php endforeach; ?>
                </select>
                <select name="" id="" class="tool__filters-select">
                    <option value="" selected>Todas las Editoriales</option>
                    <?php foreach ($data['Publisher'] as $publisher) : ?>
                        <option value="<?= $publisher->Id_Publisher ?>"> <?= $publisher->Publisher_Name ?></option>
                    <?php endforeach; ?>
                </select>
                <button class="btn__filter">Filtrar</button>
            </form>
        </div>
    </div>
    <section class="mid__container">
        <table class="table__books">
            <thead>
                <tr class="table__head-row">
                    <th class="table__head-cell">Portada</th>
                    <th class="table__head-cell">Título</th>
                    <th class="table__head-cell">Descripción</th>
                    <th class="table__head-cell">Autor</th>
                    <th class="table__head-cell">Categoria</th>
                    <th class="table__head-cell">Editorial</th>
                    <th class="table__head-cell">Edición</th>
                    <th class="table__head-cell">Número de paginas</th>
                    <th class="table__head-cell">Fecha de publicación</th>
                    <th class="table__head-cell">Acciones</th>
                </tr>
            </thead>
            <tbody id="formBody">
                <?php foreach ($data['Books'] as $book) : ?>
                    <tr class="table__body-row">
                        <td class="table__body-cell"><img src="<?= imagenurl . $book->Book_Cover ?>" alt="" class="table__cover"></td>
                        <td class="table__body-cell"><?= $book->Book_Title ?></td>
                        <td class="table__body-cell"><?= $book->Book_Synopsis ?></td>
                        <td class="table__body-cell"><?= $book->First_Name . " " . $book->Last_Name ?></td>
                        <td class="table__body-cell"><?= $book->Genre_Name ?></td>
                        <td class="table__body-cell"><?= $book->Publisher_Name ?></td>
                        <td class="table__body-cell"><?= $book->Book_Edition ?></td>
                        <td class="table__body-cell"><?= $book->Number_Pages ?></td>
                        <td class="table__body-cell"><?= $book->Publication_Date ?></td>
                        <td class="table__body-cell">
                            <a href="" class="btn__action" onclick="edit(<?= $book->Id_Book?>)">Editar</a>
                            <a href="" class="btn__action" onclick="edit(<?= $book->Id_Book?>)" id="btn_delete">Borrar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <thead>
                <tr class="table__head-row">
                    <th class="table__head-cell">Portada</th>
                    <th class="table__head-cell">Título</th>
                    <th class="table__head-cell">Descripción</th>
                    <th class="table__head-cell">Autor</th>
                    <th class="table__head-cell">Categoria</th>
                    <th class="table__head-cell">Editorial</th>
                    <th class="table__head-cell">Edición</th>
                    <th class="table__head-cell">Número de paginas</th>
                    <th class="table__head-cell">Fecha de publicación</th>
                    <th class="table__head-cell">Acciones</th>
                </tr>
            </thead>
        </table>
    </section>
    <p class="counter"> <?= count($data['Books']) ?> Libro(s) </p>
    </section>

</main>

<script src="<?= urlroot . '/public/js/dashboard/navbar.js?v=' . time(); ?>"></script>
<script src="<?= urlroot . '/public/js/dashboard/book.js?v=' . time(); ?>"></script>
</body>

</html>