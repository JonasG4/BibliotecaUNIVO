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
                                    Sinopsis:
                                </h4>
                                <p>
                                    <?= $data['Book']->Book_Synopsis ?>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="content__recomendation">
                <h4 class="content__recomendation-title">
                    También te pueden interesar...
                </h4>
                <div class="content__recomendation-body">
                    <?php foreach ($data['recomendations'] as $book) :
                        if ($book->Id_Book != $data['Book']->Id_Book) :
                    ?>

                            <div class="recomendation__book">
                                <div class="recomendation__book-cover">
                                    <img src="<?= imagenurl . $book->Book_Cover ?>" alt="" class="recomendation__book-img">
                                </div>
                                <!-- <div class="recomendation__book-title">
                                    <h4><?= $book->Book_Title ?></h4>
                                </div> -->
                            </div>
                    <?php
                        endif;
                    endforeach; ?>
                </div>
            </div>
            <div class="content">
                Comentarios
            </div>
        </section>
    </main>

    <?php require_once approot . '/Views/Includes/footer.php'; ?>
</body>
</html>