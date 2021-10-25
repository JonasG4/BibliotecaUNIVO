<?php 
    if(!isset($_SESSION['user_id'])){
        header('location: ' . urlroot . '/auth/login');
    }
    require_once approot . '/Views/Includes/head.php';
?>

<body>
    <mainrole="main">
        <section class="Section">
            <div class="Main__Head">
                <h1>Libros</h1>
                <a class="Main__Link bg-Primary" href="<?= urlroot . '/Book/Create' ; ?>">
                    <i class="fas fa-plus-circle"></i>
                    Añadir libro
                </a>
            </div>
            <?php 
                if(empty ($data['Books']) || isset($Error)):
            ?>
                    <div class="Main__Notify-Alert">
                        <p><?php echo $data['Error']; ?></p>
                    </div>
            <?php
                else:
                    foreach($data['Books'] as $Book):
            ?>
                        <div class="Main__Card">
                            <div class="Main__Card-Head">
                                <div class="Main__Head-Text">
                                    <h2><?=$Book->Book_Title; ?></h2>
                                    <h2><span class="Small-Text">ISBN:</span><?=$Book->ISBN; ?></h2>
                                </div>
                                <div class="Main__Buttons-Container">
                                    <a href="<?= urlroot . '/Book/Update/'.$Book->Id_Book ?>">
                                        <i class="fas fa-pencil-alt Button-Update"></i>
                                    </a>
                                    <a href="<?= urlroot . '/Book/Delete/'.$Book->Id_Book ?>">
                                        <i class="fas fa-trash Button-Delete"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="Main__Card-Body">
                                <div class="Main__Body-Focus">
                                    <p><?=$Book->Book_Synopsis?></p>
                                </div>
                                <div class="Main__Body-Footer">
                                    <span class="Main__Pill">
                                        <?=$Book->Genre_Name?>
                                    </span>
                                    <span class="Main__Pill"> 
                                        <?=$Book->Publisher_Name?>
                                    </span>
                                </div>
                            </div>
                            <div class="Main__Card-Footer">
                                <p>Fecha de creación: <span class="Main__Span-Text"><?=$Book->Publication_Date?></span></p>
                            </div>
                        </div>
            <?php
                endforeach;
                endif;
            ?>
        </section>
    </main>
</body>