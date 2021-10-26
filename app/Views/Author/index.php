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
            <div class="Section__Head">
                <h1>Autores</h1>
                <a class="Section__Link" href="<?= urlroot . '/Author/Create'; ?>">
                    <i class="fas fa-plus-circle"></i>
                    Añadir autor
                </a>
            </div>
            <?php
            if (empty($data['Authors']) || isset($Error)) :
            ?>
                <div class="Section__Notify-Alert">
                    <p><?php echo $data['Error']; ?></p>
                </div>
                <?php
            else :
                foreach ($data['Authors'] as $Author) :
                ?>
                    <div class="Section__Card-Secondary">
                        <div class="Card-Secondary__Main-Image">
                            <img src="https://cdn-icons-png.flaticon.com/512/401/401559.png" alt="Imagen por defecto" class="Main__Image-Img">
                        </div>
                        <div class="Card-Secondary__Main-Content">
                            <div class="Card-Secondary__Card-Head">
                                <div class="Card-Secondary__Head-Text">
                                    <h2><?= $Author->First_Name . ' ' . $Author->Last_Name ?></h2>
                                </div>
                                <div class="Card-Secondary__Buttons-Container">
                                    <a href="<?= urlroot . '/Author/Update/' . $Author->Id_Author ?>">
                                        <i class="fas fa-pencil-alt Button-Update"></i>
                                    </a>
                                    <a href="<?= urlroot . '/Author/Delete/' . $Author->Id_Author ?>">
                                        <i class="fas fa-trash Button-Delete"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="Card-Secondary__Card-Body">
                                <div class="Card-Secondary__Body-Focus">
                                    <p><?= $Author->Origin_Country ?></p>
                                </div>
                            </div>
                            <div class="Card-Secondary__Card-Footer">
                            </div>
                        </div>
                    </div>
            <?php
                endforeach;
            endif;
            ?>
        </section>
    </main>
</body>