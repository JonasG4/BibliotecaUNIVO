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
                <h1>Autores y sus libros</h1>
                <a class="Main__Link bg-Primary" href="<?= urlroot . '/AuthorBook/Create' ; ?>">
                    <i class="fas fa-plus-circle"></i>
                    Añadir relación</a>
            </div>
            <?php 
                if(empty ($data['AuthorsBooks']) || isset($Error)):
            ?>
                    <div class="Main__Notify-Alert">
                        <p><?php echo $data['Error']; ?></p>
                    </div>
            <?php
                else:
                    foreach($data['AuthorsBooks'] as $AuthorBook):
            ?>
                        <div class="Main__Card">
                            <div class="Main__Card-Head">
                                <div class="Main__Head-Text">
                                    <h2>
                                        <?= $AuthorBook->First_Name . ' ' . $AuthorBook->Last_Name ?>
                                    </h2>
                                </div>
                                <div class="Main__Buttons-Container">
                                    <a href="<?= urlroot . '/AuthorBook/Update/' . $AuthorBook->Id_AuthorBook?>">
                                        <i class="fas fa-pencil-alt Button-Update"></i>
                                    </a>
                                    <a href="<?= urlroot . '/AuthorBook/Delete/'.$AuthorBook->Id_AuthorBook?>">
                                        <i class="fas fa-trash Button-Delete"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="Main__Card-Body">
                                <div class="Main__Body-Focus">
                                    <p>
                                        <?= $AuthorBook->Book_Synopsis ?>
                                    </p>
                                </div>
                                <div class="Main__Body-Footer">
                                    <p>
                                        Número de páginas: 
                                        <span class="Main__Pill"><?= $AuthorBook->Number_Pages ?></span>
                                    </p>
                                </div>
                            </div>
                            <div class="Main__Card-Footer">
                                <p>Fecha de creación: <span class="Main__Span-Text"><?= $AuthorBook->Publication_Date ?></span></p>                                    
                            </div>
                        </div>
            <?php
                endforeach;
                endif;
            ?>
        </section>
    </main>
</body>