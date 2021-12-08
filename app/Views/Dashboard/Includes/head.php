<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="<?= urlroot . '/public/favicon.ico'?>" type="image/x-icon">
    <link rel="stylesheet" href="<?= urlroot ?>/public/css/dashboard/main.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/dab50b8499.js" crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <script defer src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Si se declara el style se invocará -->
    <?php if(isset($style)):?>
        <link rel="stylesheet" href="<?= urlroot . "/public/css/dashboard/". $style . "?v=" . time()?>">
    <?php endif?>
    <title>
        <?= isset($data['title']) ? $data['title'] : sitename ?>
    </title>
</head>
