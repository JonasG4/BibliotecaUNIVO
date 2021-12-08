<?php
$style = "book.css";
require_once approot . '/Views/Dashboard/Includes/head.php';
require_once approot . '/Views/Dashboard/Includes/navbar.php';
?>


<main class="main">
    <input hidden id="url" value="<?= urlroot . '/genre/' ?>">
    <section class="Section" id="CreateForm">
        <form id="Genre__Create" method="POST" autocomplete="off" class="Main__Form" enctype="multipart/form-data"> 
            <div class="Main__Form-Row">
                <div class="Main__Form-Group">
                    <label for="Genre_Name">Nombre del género: </label>
                    <input type="text" name="Genre_Name" id="Genre_Name" placeholder="Ingrese el nombre del género">
                    <span id="Name_Error">
                        <?= isset($data['Name_Error']) ? $data['Name_Error'] : ''; ?>
                    </span>
                </div>
            </div>
            <div class="Main__Form-Row">
                <div class="Main__Form-Group">
                    <label for="Genre_Description">Descripción: </label>
                    <input type="text" name="Genre_Description" id="Genre_Description" placeholder="Añade una descripción del género">
                    <span id="Description_Error">
                        <?= isset($data['Description_Error']) ? $data['Description_Error'] : ''; ?>
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
            <a onclick="showCreateForm()" class="main__header-link">Agregar género</a>
        </div>
        <div class="main__tools">
            <div class="tools__row">
                <form action="" class="tool__filters">
                    <select name="" id="" class="tool__filters-select">
                        <option value="" selected>Todas los géneros</option>
                        <?php foreach ($data['Genres'] as $genre) : ?>
                            <option value="<?= $genre->Id_Genre ?>"> <?= $genre->Genre_Name; ?></option>
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
                        <th class="table__head-cell">Género</th>
                        <th class="table__head-cell">Descripción</th>
                    </tr>
                </thead>
                <tbody id="formBody">
                    <?php foreach ($data['Genres'] as $genre) : ?>
                        <tr class="table__body-row">
                            <td class="table__body-cell"><?= $genre->Genre_Name ?></td>
                            <td class="table__body-cell"><?= $genre->Genre_Description ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <thead>
                    <tr class="table__head-row">
                        <th class="table__head-cell">Género</th>
                        <th class="table__head-cell">Descripción</th>
                    </tr>
                </thead>
            </table>
        </section>
        <p class="counter"> <?= count($data['Genres']) ?> Géneros literarios(s) </p>
    </section>

</main>

<script src="<?= urlroot . '/public/js/dashboard/navbar.js?v=' . time(); ?>"></script>
<script src="<?= urlroot . '/public/js/dashboard/genre.js?v=' . time(); ?>"></script>
</body>

</html>