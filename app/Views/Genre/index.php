<?php
if (!isset($_SESSION['user_id'])) {
    header('location: ' . urlroot . "/auth/login");
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
                <h1>Géneros</h1>
                <a class="Section__Link" href="<?= urlroot . '/Genre/Create'; ?>">
                    <i class="fas fa-plus-circle"></i>
                    Añadir género</a>
            </div>
            <?php
            if (empty($data['Genres']) || isset($Error)) :
            ?>
                <div class="Section__Notify-Alert">
                    <p><?php echo $data['Error']; ?></p>
                </div>
                <?php
            else :
                foreach ($data['Genres'] as $Genre) :
                ?>
                    <div class="Section__Card-Secondary">
                        <div class="Card-Secondary__Main-Image">
                            <img src="https://i.pinimg.com/originals/0c/cc/bc/0cccbc9a0db085ae3d534829aa8a5aa3.png" alt="Imagen por defecto" class="Main__Image-Img">
                        </div>
                        <div class="Card-Secondary__Main-Content">
                            <div class="Card-Secondary__Card-Head">
                                <div class="Card-Secondary__Head-Text">
                                    <h2><?= $Genre->Genre_Name ?></h2>
                                </div>
                                <div class="Card-Secondary__Buttons-Container">
                                    <a href="<?= urlroot . '/Genre/Update/' . $Genre->Id_Genre ?>">
                                        <i class="fas fa-pencil-alt Button-Update"></i>
                                    </a>
                                    <a href="<?= urlroot . '/Genre/Delete/' . $Genre->Id_Genre ?>">
                                        <i class="fas fa-trash Button-Delete"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="Card-Secondary__Card-Body">
                                <div class="Card-Secondary__Body-Focus">
                                    <p><?= $Genre->Genre_Description ?></p>
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