<?php
    if(!isset($_SESSION['user_id'])){
        header('location: ' . urlroot . "/auth/login");
    }
    require_once approot . '/Views/Includes/head.php';
?>
<body>
    <main role="main">
        <section class="Section">
            <div class="Main__Head">
                <h1>Géneros</h1>
                <a class="Main__Link bg-Primary" href="<?= urlroot . '/Genre/Create' ; ?>">
                    <i class="fas fa-plus-circle"></i>
                    Añadir género</a>
            </div>
            <?php 
                if(empty ($data['Genres']) || isset($Error)):
            ?>
                    <div class="Main__Notify-Alert">
                        <p><?php echo $data['Error']; ?></p>
                    </div>
            <?php
                else:
                    foreach($data['Genres'] as $Genre):
            ?>
                        <div class="Main__Card">
                            <div class="Main__Card-Head">
                                <div class="Main__Head-Text">
                                    <h2><?=$Genre->Genre_Name?></h2>
                                </div>
                                    
                                <div class="Main__Buttons-Container">

                                    <a href="<?= urlroot . '/Genre/Update/'.$Genre->Id_Genre?>">
                                        <i class="fas fa-pencil-alt Button-Update"></i>
                                    </a>
                                    <a href="<?= urlroot . '/Genre/Delete/'.$Genre->Id_Genre?>">
                                        <i class="fas fa-trash Button-Delete"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="Main__Card-Body">
                                <div class="Main__Body-Focus">
                                    <p><?=$Genre->Genre_Description?></p>
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