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
                    <td class="<?=$news_item['id']?>"><?= $news_item['title'] ?></td>
                    <td class="ckeditor-field <?=$news_item['id']?>" data-title="<?= esc($news_item['title']) ?>"><?= $news_item['body'] ?></td>
                    <td>
                        <form action="listaDelete" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="title" value="<?= esc($news_item['title']) ?>">
                            <button type="submit" >Delete </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <br>
    <button id="saveButton">Save Changes</button>
    <button id="saveDB">Save on DB</button>
<?php else: ?>
    <h3>No News</h3>
    <p>Unable to find any news for you.</p>
    
<?php endif ?>







