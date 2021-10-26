<?php
    if(!isset($_SESSION['user_id'])){
        header('location: ' . urlroot . '/auth/login');
    }
    require_once approot . '/Views/Includes/head.php';
?>
<body>
    <header>
        <?php require_once approot . '/Views/Includes/navbar.php';?>
    </header>
    <main role="main">
        <section class="Section">
            <div class="Section__Head">
                <h1>Editoriales</h1>
                <a class="Section__Link" href="<?= urlroot . '/Publisher/Create' ; ?>">
                    <i class="fas fa-plus-circle"></i>
                    Añadir editorial</a>
            </div>
            <?php 
                if(empty ($data['Publishers']) || isset($Error)):
            ?>
                    <div class="Section__Notify-Alert">
                        <p><?php echo $data['Error']; ?></p>
                    </div>
            <?php
                else:
                    foreach($data['Publishers'] as $Publisher):
            ?>
                        <div class="Section__Card-Secondary">
                            <div class="Card-Secondary__Main-Image">
                                <img src="https://i.pinimg.com/originals/d1/0d/a0/d10da071dc61f64c324afcbcfb77d754.png" alt="Imagen por defecto" class="Main__Image-Img">
                            </div>
                            <div class="Card-Secondary__Main-Content">
                                <div class="Card-Secondary__Card-Head">
                                    <div class="Card-Secondary__Head-Text">
                                        <h2><?=$Publisher->Publisher_Name?></h2>
                                    </div>
                                    <div class="Card-Secondary__Buttons-Container">
                                        <a href="<?= urlroot . '/Publisher/Update/'.$Publisher->Id_Publisher ?>">
                                            <i class="fas fa-pencil-alt Button-Update"></i>
                                        </a>
                                        <a href="<?= urlroot . '/Publisher/Delete/'.$Publisher->Id_Publisher ?>">
                                            <i class="fas fa-trash Button-Delete"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="Card-Secondary__Card-Body">
                                    <div class="Card-Secondary__Body-Focus">
                                        <p><?=$Publisher->Origin_Country?></p>
                                    </div>
                                </div>
                                <div class="Card-Secondary__Card-Footer">
                                    <p>Número telefónico: <span class="Span-Text"><?=$Publisher->Phone_Number?></span></p>
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