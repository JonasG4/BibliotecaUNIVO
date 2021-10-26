<?php
if (!isset($_SESSION['user_id'])) {
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
                    <h1>Libros</h1>
                    <a class="Section__Link" href="<?= urlroot . '/Book/Create'; ?>">
                        <i class="fas fa-plus-circle"></i>
                        Añadir libro
                    </a>
                </div>
                <?php
                if (empty($data['Books']) || isset($Error)) :
                ?>
                    <div class="Section__Notify-Alert">
                        <p><?php echo $data['Error']; ?></p>
                    </div>
                    <?php
                else :
                    foreach ($data['Books'] as $Book) :
                    ?>
                        <div class="Section__Card-Primary">
                            <div class="Card-Primary__Main-Image">
                                <img src="https://cdn-icons-png.flaticon.com/512/732/732397.png" alt="Imagen por defecto" class="Main__Image-Img">
                            </div>
                            <div class="Card-Primary__Main-Content">
                                <div class="Card-Primary__Card-Head">
                                    <div class="Card-Primary__Buttons-Container">
                                        <a href="<?= urlroot . '/Book/Update/' . $Book->Id_Book ?>">
                                            <i class="fas fa-pencil-alt Button-Update"></i>
                                        </a>
                                        <a href="<?= urlroot . '/Book/Delete/' . $Book->Id_Book ?>">
                                            <i class="fas fa-trash Button-Delete"></i>
                                        </a>
                                    </div>
                                    <div class="Card-Primary__Head-Text">
                                        <h2><?= $Book->Book_Title; ?></h2>
                                        <h2><span class="Text">ISBN:</span><?= $Book->ISBN; ?></h2>
                                    </div>
                                </div>
                                <div class="Card-Primary__Card-Body">
                                    <div class="Card-Primary__Body-Focus">
                                        <p><?= $Book->Book_Synopsis ?></p>
                                    </div>
                                    <div class="Card-Primary__Body-Footer">
                                        <span class="Card-Primary__Pill">
                                            <?= $Book->Genre_Name ?>
                                        </span>
                                        <span class="Card-Primary__Pill">
                                            <?= $Book->Publisher_Name ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="Card-Primary__Card-Footer">
                                    <p>Fecha de creación: <span class="Span-Text-Secondary"><?= $Book->Publication_Date ?></span></p>
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