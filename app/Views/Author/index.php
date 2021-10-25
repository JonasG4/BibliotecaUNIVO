<?php
    if(!isLoggedIn()){
        header('location: ' . urlroot . '/auth/login');
    }
    require_once approot . '/Views/Includes/head.php';
?>
<body>
    <main role="main">
        <section class="Section">
            <div class="Main__Head">
                <h1>Autores</h1>
                <a class="Main__Link bg-Primary" href="<?= urlroot . '/Author/Create' ; ?>">
                    <i class="fas fa-plus-circle"></i>
                    Añadir autor
                </a>
            </div>
            <?php 
                if(empty ($data['Authors']) || isset($Error)):
            ?>
                    <div class="Main__Notify-Alert">
                        <p><?php echo $data['Error']; ?></p>
                    </div>
            <?php
                else:
                    foreach($data['Authors'] as $Author):
            ?>
                        <div class="Main__Card">
                            <div class="Main__Card-Head">
                                    <div class="Main__Head-Text">
                                        <h2><?=$Author->First_Name . ' ' . $Author->Last_Name?></h2>
                                    </div>
                                    <div class="Main__Buttons-Container">
                                        <a href="<?= urlroot . '/Author/Update/'.$Author->Id_Author ?>">
                                            <i class="fas fa-pencil-alt Button-Update"></i>
                                        </a>
                                        <a href="<?= urlroot . '/Author/Delete/'.$Author->Id_Author ?>">
                                            <i class="fas fa-trash Button-Delete"></i>
                                        </a>
                                    </div>
                            </div>
                            <div class="Main__Card-Body">
                                <div class="Main__Body-Focus">
                                    <?=$Author->Origin_Country?>
                                </div>
                                <div class="Main__Body-Footer">
                                </div>
                            </div>
                            <div class="Main__Card-Footer">
                            </div>
                        </div>
            <?php
                endforeach;
                endif;
            ?>
        </section>
    </main>
</body>