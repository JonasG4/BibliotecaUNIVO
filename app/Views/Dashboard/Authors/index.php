<?php
$style = "book.css";
require_once approot . '/Views/Dashboard/Includes/head.php';
require_once approot . '/Views/Dashboard/Includes/navbar.php';
?>

<main class="main">
    <input hidden id="url" value="<?= urlroot . '/author/' ?>">
    <section class="Section" id="CreateForm">
        <form id="Author__Create" method="POST" autocomplete="off" class="Main__Form" enctype="multipart/form-data"> 
            <div class="Main__Form-Row">
                <div class="Main__Form-Group">
                    <label for="First_Name">Nombre del autor: </label>
                    <input type="text" name="First_Name" id="First_Name" placeholder="Ingrese el nombre del autor">
                    <span id="FirstName_Error">
                    </span>
                </div>
                <div class="Main__Form-Group">
                    <label for="Last_Name">Apellido del autor: </label>
                    <input type="text" name="Last_Name" id="Last_Name" placeholder="Ingrese el apellido del autor">
                    <span id="LastName_Error">
                    </span>
                </div>
            </div>
            <div class="Main__Form-Row">
                <div class="Main__Form-Group">
                    <label for="Origin_Country">País de origen: </label>
                    <input type="text" name="Origin_Country" id="Origin_Country" placeholder="¿Cuál es su país de origen?">
                    <span id="Country_Error">
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
            <a onclick="showCreateForm()" class="main__header-link">Agregar autor</a>
        </div>
        <div class="main__tools">
            <div class="tools__row">
                <form action="" class="tool__filters">
                    <select name="" id="" class="tool__filters-select">
                        <option value="" selected>Todos los países</option>
                        <?php foreach ($data['Authors'] as $author) : ?>
                            <option value="<?= $author->Id_Author ?>"> <?= $author->Origin_Country; ?></option>
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
                        <th class="table__head-cell">Nombre</th>
                        <th class="table__head-cell">Apellido</th>
                        <th class="table__head-cell">País de origen</th>
                        <th class="table__head-cell">Acciones</th>
                    </tr>
                </thead>
                <tbody id="formBody">
                    <?php foreach ($data['Authors'] as $author) : ?>
                        <tr class="table__body-row">
                            <td class="table__body-cell"><?= $author->First_Name ?></td>
                            <td class="table__body-cell"><?= $author->Last_Name ?></td>
                            <td class="table__body-cell"><?= $author->Origin_Country?></td>
                            <td class="table__body-cell">
                                <a href="" class="btn__action">Editar</a>
                                <a href="" class="btn__action">Borrar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <thead>
                    <tr class="table__head-row">
                        <th class="table__head-cell">Nombre</th>
                        <th class="table__head-cell">Apellido</th>
                        <th class="table__head-cell">País de origen</th>
                        <th class="table__head-cell">Acciones</th>
                    </tr>
                </thead>
            </table>
        </section>
        <p class="counter"> <?= count($data['Authors']) ?> Autores(s) </p>
    </section>

</main>

<script src="<?= urlroot . '/public/js/dashboard/navbar.js?v=' . time(); ?>"></script>
<script src="<?= urlroot . '/public/js/dashboard/author.js?v=' . time(); ?>"></script>
</body>

</html>