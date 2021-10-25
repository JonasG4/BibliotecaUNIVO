<?php
if(!isset($_SESSION['user_id'])){
    header('location: ' . urlroot ."/auth/login");
}
require_once approot . '/Views/Includes/head.php'; 
?>
<body>
    <main>
        <h1>Hola, <?=$_SESSION['name'] ." ". $_SESSION['lastname']?></h1>
    </main>
    <?php require_once approot . '/Views/Includes/footer.php';?>
</body>
</html>