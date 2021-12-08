<?php
$style = "home.css";
require_once approot . '/Views/Dashboard/Includes/head.php';
require_once approot . '/Views/Dashboard/Includes/navbar.php';
?>
<main class="main">
    <h1 class="main__title"><?= $data['title']?></h1>
    <div class="top__container">
        <div class="user__count">
            <i class='bx bxs-user max-icon'></i>
            <div class="user__count-info">
                <span class="info-title">Usuarios totales</span>
                <span class="info-count">200</span>
            </div>
        </div>
       
        <div class="user__count">
            <i class='bx bxs-user max-icon'></i>
            <div class="user__count-info">
                <span class="info-title">Usuarios totales</span>
                <span class="info-count">200</span>
            </div>
        </div>
        <div class="user__count">
            <i class='bx bxs-user max-icon'></i>
            <div class="user__count-info">
                <span class="info-title">Usuarios totales</span>
                <span class="info-count">200</span>
            </div>
        </div>
        <div class="user__count">
            <i class='bx bxs-user max-icon'></i>
            <div class="user__count-info">
                <span class="info-title">Usuarios totales</span>
                <span class="info-count">200</span>
            </div>
        </div>
    </div>
    <section class="mid__container">

    </section>
</main>



<script src="<?= urlroot . '/public/js/dashboard/navbar.js?v=' . time(); ?>"></script>
</body>

</html>