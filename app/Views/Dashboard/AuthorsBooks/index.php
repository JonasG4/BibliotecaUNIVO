<?php
$style = "book.css";
require_once approot . '/Views/Dashboard/Includes/head.php';
require_once approot . '/Views/Dashboard/Includes/navbar.php';
?>

<main class="main">
    <input hidden id="url" value="<?= urlroot . '/authorbook/' ?>">
    <section class="Section" id="CreateForm">
        <form id="AuthorBook__Create" method="POST" autocomplete="off" class="Main__Form" enctype="multipart/form-data"> 
            <div class="Main__Form-Row">
                <div class="Main__Form-Group">
                    <label for="First_Name">Autores: </label>
                    <select name="Id_Author" id="Id_Author" class="Input__Select">
                        <option selected>----Selecciona un Autor----</option>
                        <?php
                        foreach ($data['Authors'] as $Author)
                            echo "<option value='{$Author->Id_Author}'>{$Author->First_Name} {$Author->Last_Name}</option>";
                        ?>
                    </select>
                    <span id="Author_Error">
                        <?= isset($data['Author_Error']) ? $data['Author_Error'] : ''; ?>
                    </span>
                </div>
            </div>
            <div class="Main__Form-Row">
                <div class="Main__Form-Group">
                    <label for="Last_Name">Libros: </label>
                    <select name="Id_Book" id="Id_Book" class="Input__Select">
                        <option selected>----Selecciona un Autor----</option>
                        <?php
                        foreach ($data['Books'] as $book)
                            echo "<option value='{$book->Id_Book}'>{$book->Book_Title}</option>";
                        ?>
                    </select>
                    <span id="Book_Error">
                        <?= isset($data['Book_Error']) ? $data['Book_Error'] : ''; ?>
                    </span>
                </div>
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
            <?= $data['Title'] ?>
        </h1>
        <a onclick="showCreateForm()" class="main__header-link">Agregar relación entre libros y autores</a>
    </div>
    <div class="main__tools">
        <div class="tools__row">
            <form action="" class="tool__filters">
                <select name="" id="" class="tool__filters-select">
                    <option value="" selected>Todos los autores</option>
                    <?php foreach ($data['Authors'] as $author) : ?>
                        <option value="<?= $author->Id_Author ?>"> <?= $author->First_Name . " " . $author->Last_Name; ?></option>
                    <?php endforeach; ?>
                </select>
                <button class="btn__filter">Filtrar</button>
            </form>
        </div>
    </div>
    <section class="mid__container">
        <table class="table__books" >
            <thead>
                <tr class="table__head-row">
                    <th class="table__head-cell">Autor</th>
                    <th class="table__head-cell">Libro</th>
                    <th class="table__head-cell">Sinópsis</th>
                    <th class="table__head-cell">Cantidad de páginas</th>
                </tr>
            </thead>
            <tbody id="formBody">
                <?php foreach ($data['AuthorsBooks'] as $authorbook) : ?>
                    <tr class="table__body-row">
                        <td class="table__body-cell"><?= $authorbook->First_Name ?></td>
                        <td class="table__body-cell"><?= $authorbook->Book_Title?></td>
                        <td class="table__body-cell"><?= $authorbook->Book_Synopsis ?></td>
                        <td class="table__body-cell"><?= $authorbook->Number_Pages ?></td>
                        <td class="table__body-cell">
                            <a href="" class="btn__action">Editar</a>
                            <a href="" class="btn__action">Borrar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <thead>
                <tr class="table__head-row">
                    <th class="table__head-cell">Autor</th>
                    <th class="table__head-cell">Libro</th>
                    <th class="table__head-cell">Sinópsis</th>
                    <th class="table__head-cell">Cantidad de páginas</th>
                </tr>
            </thead>
        </table>
    </section>
    <p class="counter"> <?= count($data['AuthorsBooks']) ?> Autores y libros(s) </p>
</section>

</main>

<script src="<?= urlroot . '/public/js/dashboard/navbar.js?v=' . time(); ?>"></script>
<script src="<?= urlroot . '/public/js/dashboard/authorbook.js?v=' . time(); ?>"></script>
</body>

</html>