<?php
$style = 'loan.css';
$url = urlroot . '/books/filterBook';
require_once approot . '/Views/Includes/head.php' ?>

<body>
    <header>
        <?php require_once approot . '/Views/Includes/navbar.php' ?>        
    </header>
    <main class="container">
        <input type="hidden" id="uri" value="<?=$url?>">
        <div class="content__loan">
            <div class="content__title">
                <h3>Solicitar nuevo prestamo</h3>
            </div>
            <div class="content__body">
                <form action="" method="POST" class="form__loan"> 
                    <div class="form__group">
                        <div class="input__group">
                            <label for="">Buscar nombre del libro</label>
                            <input type="text" name="libro" placeholder="Escribar el titulo..." class="input__control" id="search">
                        </div>
                        <div class="input__group">
                            <label for="">Fecha de préstamos</label>
                            <input type="date" name="fecha" min="<?= date('Y-m-d')?>" class="input__control">
                        </div>
                        <button type="submit" class="btn__loan">Prestar</button>
                    </div>
                    <br><hr><br>
                    <div class="books__filters" id="filters">
                            
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?php require_once approot . '/Views/Includes/footer.php'; ?>
    <script src="<?= urlroot . '/public/js/filter.js?v=' . time()?>"></script>
</body>

