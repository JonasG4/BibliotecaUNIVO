<?php
$style = "book.css";
require_once approot . '/Views/Dashboard/Includes/head.php';
require_once approot . '/Views/Dashboard/Includes/navbar.php';
?>

<main class="main">
    <input hidden id="url" value="<?= urlroot . '/publisher/' ?>">
    <section class="Section" id="CreateForm">
        <form id="Publisher__Create" method="POST" autocomplete="off" class="Main__Form" enctype="multipart/form-data"> 
            <div class="Main__Form-Row">
                <div class="Main__Form-Group">
                    <label for="Publisher_Name">Nombre de la editorial: </label>
                    <input type="text" name="Publisher_Name" id="Publisher_Name" placeholder="Escribe aquí el nombre de la editorial">
                    <span id="Name_Error">
                        <?= isset($data['Name_Error']) ? $data['Name_Error'] : ''; ?>
                    </span>
                </div>
            </div>
            <div class="Main__Form-Row">
                <div class="Main__Form-Group">
                    <label for="Phone_Number">Número telefónico: </label>
                    <input type="phone" name="Phone_Number" id="Phone_Number" placeholder="Escribe el número telefónico">
                    <span id="Phone_Error">
                        <?= isset($data['Phone_Error']) ? $data['Phone_Error'] : ''; ?>
                    </span>
                </div>
            </div>
            <div class="Main__Form-Row">
                <div class="Main__Form-Group">
                    <label for="Origin_Country">País de origen: </label>
                    <input type="text" name="Origin_Country" id="Origin_Country" placeholder="Escribe el país de origen">
                    <span id="Country_Error">
                        <?= isset($data['Country_Error']) ? $data['Country_Error'] : ''; ?>
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
        <a onclick="showCreateForm()" class="main__header-link">Agregar editorial</a>
    </div>
    <div class="main__tools">
        <div class="tools__row">
            <form action="" class="tool__filters">
                <select name="" id="" class="tool__filters-select">
                    <option value="" selected>Todos los países</option>
                    <?php foreach ($data['Publishers'] as $publisher) : ?>
                        <option value="<?= $publisher->Origin_Country ?>"> <?= $publisher->Origin_Country; ?></option>
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
                    <th class="table__head-cell">Nombre de la editorial</th>
                    <th class="table__head-cell">Número telefónico</th>
                    <th class="table__head-cell">País de origen</th>
                    <th class="table__head-cell">Acciones</th>
                </tr>
            </thead>
            <tbody id="formBody">
                <?php foreach ($data['Publishers'] as $publisher) : ?>
                    <tr class="table__body-row">
                        <td class="table__body-cell"><?= $publisher->Publisher_Name ?></td>
                        <td class="table__body-cell"><?= $publisher->Phone_Number ?></td>
                        <td class="table__body-cell"><?= $publisher->Origin_Country?></td>
                        <td class="table__body-cell">
                            <a href="" class="btn__action">Editar</a>
                            <a href="" class="btn__action">Borrar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <thead>
                <tr class="table__head-row">
                    <th class="table__head-cell">Nombre de la editorial</th>
                    <th class="table__head-cell">Número telefónico</th>
                    <th class="table__head-cell">País de origen</th>
                    <th class="table__head-cell">Acciones</th>
                </tr>
            </thead>
        </table>
    </section>
    <p class="counter"> <?= count($data['Publishers']) ?> Editoriales(s) </p>
</section>

</main>

<script src="<?= urlroot . '/public/js/dashboard/navbar.js?v=' . time(); ?>"></script>
<script src="<?= urlroot . '/public/js/dashboard/publisher.js?v=' . time(); ?>"></script>
</body>

</html>