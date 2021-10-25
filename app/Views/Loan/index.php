<?php
$style = "loan.css";
require_once approot . '/Views/Includes/head.php' ?>

<body>
    <header>
        <?php require_once approot . '/Views/Includes/navbar.php' ?>
    </header>
    <main class="container">
        <div class="content">
            <h1 class="content__title">
                Historial de préstamos
            </h1>
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
                    <?php
                    if (!empty($data['loans'])) :
                        foreach ($data['loans'] as $loan) : ?>
                            <tr class="table__body-tr">
                                <td><?= $loan->title; ?></td>
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
                        <?php endforeach;
                    else : ?>
                        <tr>
                            <td colspan="8">
                                No hay prestamos recientes
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
    <?php require_once approot . '/Views/Includes/footer.php'; ?>
</body>

</html>