<?php
require_once approot . '/Views/Includes/head.php';
?>

<body>
    <header>
        <?php require_once approot . '/Views/Includes/navbar.php'; ?>
    </header>
    <main>
        <section class="container">
            <div class="content">
                <?php if (!empty($data['Books'])) : ?>
                    <h1 class="title__secondary">
                        Recomendaciones para ti
                    </h1>
                    <div class="content__body-books">
                        <?php foreach ($data['Books'] as $book) : ?>
                            <div class="card__book">
                                <div class="card__body">
                                    <div class="card__book-actions" id="icon__action">
                                        <i class="book__icon icon__details" onclick="window.location.href='<?= urlroot . '/book/details/' . $book->Id_Book ?>'"></i>
                                        <i class="book__icon icon__fav"></i>
                                    </div>
                                    <div class="card__book-img">
                                        <img src="<?= imagenurl . $book->Book_Cover ?>" alt="" class="card__cover">
                                    </div>
                                </div>
                                <div class="card__book-title">
                                    <?= $book->Book_Title ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <div class="empty__books">
                        <i class="far fa-frown"></i>
                        <h1 class="empty__books-text">No hay registros disponibles</h1><br>
                        <button class="empty__books-btn">Ir a añadir libro</button>
                    </div>
                <?php endif; ?>
            </div>
        </section>

    </main>
    <?php require_once approot . '/Views/Includes/footer.php'; ?>

    <script>
        var favs = document.querySelectorAll('#icon__action .icon__fav');
        favs.forEach(fav => {
            fav.onclick = (e) => {
                e.target.classList.toggle('hasFav');
            }
        });
    </script>
</body>

</html>