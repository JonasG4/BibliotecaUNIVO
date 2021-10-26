<?php
if (!isLoggedIn()) {
    header('location: ' . urlroot . '/auth/login');
}
require_once approot . '/Views/Includes/head.php';
?>

<body>
    <header>
        <?php require_once approot . '/Views/Includes/navbar.php'; ?>
    </header>
    <main role="main">
        <section class="Section">
            <div class="Container-Secondary">
                <div class="Section__Head">
                    <h1>Autores y sus libros</h1>
                    <a class="Section__Link" href="<?= urlroot . '/AuthorBook/Create'; ?>">
                        <i class="fas fa-plus-circle"></i>
                        Añadir relación</a>
                </div>
                <?php
                if (empty($data['AuthorsBooks']) || isset($Error)) :
                ?>
                    <div class="Section__Notify-Alert">
                        <p><?php echo $data['Error']; ?></p>
                    </div>
                    <?php
                else :
                    foreach ($data['AuthorsBooks'] as $AuthorBook) :
                    ?>
                        <div class="Section__Card-Primary">
                            <div class="Card-Primary__Main-Image">
                                <img src="https://cdn-icons-png.flaticon.com/512/45/45825.png" alt="Imagen por defecto" class="Main__Image-Img">
                            </div>
                            <div class="Card-Primary__Main-Content">
                                <div class="Card-Primary__Card-Head">
                                    <div class="Card-Primary__Buttons-Container">
                                        <a href="<?= urlroot . '/AuthorBook/Update/' . $AuthorBook->Id_AuthorBook ?>">
                                            <i class="fas fa-pencil-alt Button-Update"></i>
                                        </a>
                                        <a href="<?= urlroot . '/AuthorBook/Delete/' . $AuthorBook->Id_AuthorBook ?>">
                                            <i class="fas fa-trash Button-Delete"></i>
                                        </a>
                                    </div>
                                    <div class="Card-Primary__Head-Text">
                                        <h2><?= $AuthorBook->First_Name . ' ' . $AuthorBook->Last_Name ?></h2>
                                    </div>
                                </div>
                                <div class="Card-Primary__Card-Body">
                                    <div class="Card-Primary__Body-Focus">
                                        <h3 class="Title"><?= $AuthorBook->Book_Title ?></h3>
                                        <p><?= $AuthorBook->Book_Synopsis ?></p>
                                    </div>
                                    <div class="Card-Primary__Body-Footer">
                                        Número de páginas: 
                                        <span class="Card-Primary__Pill">
                                            <?= $AuthorBook->Number_Pages ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="Card-Primary__Card-Footer">
                                    <p>Fecha de creación: <span class="Main__Span-Text"><?= $AuthorBook->Publication_Date ?></span></p>
                                </div>
                            </div>
                        </div>
                <?php
                    endforeach;
                endif;
                ?>
            </div>
        </section>
    </main>
    <?php require_once approot . '/Views/Includes/footer.php';?>
</body>