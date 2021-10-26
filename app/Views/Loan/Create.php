<?php
$style = 'loan.css';
require_once approot . '/Views/Includes/head.php' ?>

<body>
    <header>
        <?php require_once approot . '/Views/Includes/navbar.php' ?>        
    </header>
    <main class="container">
        <div class="content__loan">
            <div class="content__title">
                <h3>Solicitar nuevo prestamo</h3>
            </div>
            <div class="content__body">
                <form action="" method="POST">
                    <input type="text" name="libro">
                    <input type="date" name="fecha">
                </form>
            </div>
        </div>
    </main>
    <?php require_once approot . '/Views/Includes/footer.php'; ?>

</body>

