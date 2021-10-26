<?php
$style = "loan.css";
require_once approot . '/Views/Includes/head.php' ?>

<body>
    <header>
        <?php require_once approot . '/Views/Includes/navbar.php' ?>
    </header>
    <main class="container">
        <div class="content__loan">
            <div class="content__title">
                <h3>
                <i class="fas fa-th-list"></i>  
                    Historial de préstamos
                </h3>
                <?php if (!empty($data['loans'])) : ?>
                <button class="new__loan">
                    <i class="fas fa-plus icon-plus"></i>
                    Solicitar nuevo prestamo
                </button>
                <?php endif ?>
            </div>
            <div class="content__body">
                <?php if (!empty($data['loans'])) : ?>
                    <table border="1" class="table">
                        <thead class="table__head">
                            <tr class="table__head-tr">
                                <th>Titulo</th>
                                <th>Usuario</th>
                                <th>Duracion</th>
                                <th>Fecha de prestamo</th>
                                <th>Fecha de devolucion</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="table__body">
                            <?php foreach ($data['loans'] as $loan) : ?>
                                <tr class="table__body-tr">
                                    <td><?= $loan->Book_Title; ?></td>
                                    <td><?= $loan->username; ?></td>
                                    <td><?= $loan->duration; ?></td>
                                    <td><?= $loan->check_out_date; ?></td>
                                    <td><?= $loan->return_date; ?></td>
                                    <td><?= $loan->status; ?></td>
                                    <td class="td__acciones">
                                        <a class="table__action-edit" href="<?= urlroot . '/loan/update/' . $loan->loan_id; ?>">
                                            <i class="far fa-edit"></i> Editar</a>
                                        <a class="table__action-delete" href="<?= urlroot . '/loan/delete/' . $loan->loan_id; ?>">
                                            <i class="far fa-trash-alt"></i> Cancelar</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <div class="loan__empty">
                        <h1 class="loan__empty-text">Aún no has realizado ningun prestamo.</h1>
                        <button class="loan__empty-btn" onclick="window.location.href='<?= urlroot . '/loan/request';?>'">Solicitar un préstamo</button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>
    <?php require_once approot . '/Views/Includes/footer.php'; ?>
</body>

</html>