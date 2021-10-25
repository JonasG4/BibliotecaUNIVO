<?php
$TiempoMax = date('Y') . '-' . (int)(date('m') + 1) . '-' . date('d');
?>

<?php foreach ($data['loan'] as $value) : ?>
    <h1><?= $value->title?></h1>
    <h1><?= $value->username?></h1>
    <h1><?= $value->duration?></h1>
    <h1><?= $value->check_out_date?></h1>
    <h1><?= $value->return_date?></h1>
    <?php endforeach; ?>