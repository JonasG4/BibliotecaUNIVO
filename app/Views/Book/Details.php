<?php
$style = "book.css";
require_once approot . '/Views/Includes/head.php';
?>

<body>
    <header>
        <?php require_once approot . '/Views/Includes/navbar.php'; ?>
    </header>
    <main>
        <section class="container">
            <div class="content__details">
                <div class="content__title">
                  Detalles
                </div>
                <div class="content__body">
                    <div class="Book">
                        <div class="Book__Cover">
                            <img class="Book__Cover-img" src="<?= imagenurl . $data['Book']->Book_Cover ?>" alt="">
                            <div class="Book_Action">
                                <button class="btn__buy">
                                    <i class="fas fa-cart-plus"></i>
                                    Agregar al carrito</button>
                                <button class="btn__loan">Solicitar prestamo</button>
                            </div>
                        </div>
                        <div class="Book__Info">
                            <h1 class="Book__Title">
                                <?= $data['Book']->Book_Title ?>
                            </h1>
                            <div class="Book__Subtitles">
                                <div class="Book__Author">
                                    <h4>
                                        Autor(es):
                                    </h4>
                                    <span>
                                        <?= $data['Author']->First_Name . ' ' . $data['Author']->Last_Name ?>
                                    </span>
                                </div>
                                <div class="Book__Genre">
                                    <h4>
                                        Categoria:
                                    </h4>
                                    <span>
                                        <?= $data['Genre']->Genre_Name ?>
                                    </span>
                                </div>
                                <div class="Book__Edition">
                                    <h4>
                                        Edicion:
                                    </h4>
                                    <span>
                                        <?= $data['Book']->Book_Edition ?>
                                    </span>
                                </div>
                                <div class="Book__Publisher">
                                    <h4>
                                        Editorial:
                                    </h4>
                                    <span>
                                        <?= $data['Publisher']->Publisher_Name ?>
                                    </span>
                                </div>
                                <div class="Publication__Date">
                                    <h4>
                                        Fecha de publicacion:
                                    </h4>
                                    <span>
                                        <?= $data['Book']->Publication_Date ?>
                                    </span>
                                </div>
                            </div>
                            <div class="Book__Synopsis">
                                <h4>
                                    Sinopsis
                                </h4>
                                <p>
                                    <?= $data['Book']->Book_Synopsis ?>
                                </p>
                            </div>
                        


                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                Comentarios
            </div>
        </section>
    </main>

    <?php require_once approot . '/Views/Includes/footer.php'; ?>
</body>