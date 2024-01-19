<h2><?= esc($title) ?></h2>

<?= session()->getFlashdata('error') ?>
<?= validation_list_errors() ?>

<form action="deleteOptions" method="post">
    <?= csrf_field() ?>

    <label for="title">Title</label>
    <input type="input" name="title" value="<?= set_value('title') ?>">
    <br>
    <br>

    <button type="submit" name="action" value="softDelete"> Soft Delete </button>
    <button type="submit" name="action" value="trueDelete"> True Delete </button>
</form>

