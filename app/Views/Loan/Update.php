<form action="" method="POST">
    <input type="hidden" name="loan_id" value="<?= $data['loans']->loan_id;?>">
    Estado: <input type="text" value="<?= $data['loans']->status; ?>" name='status'><br>
    <span style="color: red"><?= isset($data['statusErr']) ? $data['statusErr'] : '' ;?></span><br>
    <button type="submit">Actualizar</button>
</form>