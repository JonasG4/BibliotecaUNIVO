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
            <div class="Main__Head">
                <h1>Editoriales</h1>
                <a class="Main__Link bg-Primary" href="<?= urlroot . '/Publisher/Create' ; ?>">
                    <i class="fas fa-plus-circle"></i>
                    Añadir editorial</a>
            </div>
            <?php 
                if(empty ($data['Publishers']) || isset($Error)):
            ?>
                    <div class="Main__Notify-Alert">
                        <p><?php echo $data['Error']; ?></p>
                    </div>
            <?php
                else:
                    foreach($data['Publishers'] as $Publisher):
            ?>
                        <div class="Main__Card">
                            <div class="Main__Card-Head">
                                <div class="Main__Head-Text">
                                    <h2><?=$Publisher->Publisher_Name?></h2>
                                </div>
                                <div class="Main__Buttons-Container">
                                    <a href="<?= urlroot . '/Publisher/Update/'.$Publisher->Id_Publisher ?>">
                                        <i class="fas fa-pencil-alt Button-Update"></i>
                                    </a>
                                    <a href="<?= urlroot . '/Publisher/Delete/'.$Publisher->Id_Publisher ?>">
                                        <i class="fas fa-trash Button-Delete"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="Main__Card-Body">
                                <div class="Main__Body-Focus">
                                    <?=$Publisher->Origin_Country?>
                                </div>
                                <div class="Main__Body-Footer">
                                </div>
                            </div>
                            <div class="Main__Card-Footer">
                                <p>Número telefónico: <span class="Main__Span-Text"><?=$Publisher->Phone_Number?></span></p>
                            </div>
                        </div>
            <?php
                endforeach;
                endif;
            ?>
        </section>
    </main>
</body>