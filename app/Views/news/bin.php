
<div class="container text-light mt-4">
<h2><?= esc($title) ?></h2>
<?php if (! empty($news) && is_array($news)): ?>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Text</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($news as $news_item): ?>
                <tr>
                    <td><?= esc($news_item['title']) ?></td>
                    <td><?= esc($news_item['body']) ?></td>
                    <td>
                        <form action="binDelete" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="title" value="<?= esc($news_item['title']) ?>">
                            <button type="submit" >Delete </button>
                        </form>
                    <td>
                    <form action="binRestore" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="title" value="<?= esc($news_item['title']) ?>">
                            <button type="submit" >Restore </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
<?php else: ?>
    <h3>No News</h3>
    <p>La papelera está vacía.</p>
<?php endif ?>
</div>