

<div class="container w-40 mt-4 text-light">
    <h2><?= esc($title) ?></h2>
    <?= session()->getFlashdata('error') ?>
    <?= validation_list_errors() ?>
    <div class="w-40">
    <?= form_open_multipart('news/create') ?>
        <?= csrf_field() ?>

        <label for="title">Title</label>
        <br>
        <input type="input" name="title" required="" value="<?= set_value('title') ?>">
        <br>

        <label for="body">Text</label>
        <br>
        <div class="text-dark">
        <textarea name="body" id="editor" class="hidden" cols="0" rows="0"><?= set_value('body') ?></textarea>
        <div>
        <br>
        <input type="file" name="userfile">
        <br>
        <br>
        <input type="submit" name="submit" value="Upload">
    <?= form_close()?>
    <div>

</div>

    
