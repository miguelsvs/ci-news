
<div class="container mt-3">
    <h2 class="text-light"><?= esc($title) ?></h2>


    <table class="table table-striped table-dark">
        <thead class="table-light">
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Text</th>
                    <th scope="col">Image</th>
                    <th scope="col">Delete</th>
                    <th scope="col">Update</th>
                </tr>
    </thead>
    <tbody>
        <?php foreach ($news as $news_item): ?>
            <tr>
                            <th class="<?=$news_item['id']?>" scope="row"><?= $news_item['title'] ?></td>
                            <td class="ckeditor-field <?=$news_item['id']?>" data-title="<?= esc($news_item['title']) ?>"><?= $news_item['body'] ?></td>
                            <td class="<?=$news_item['id']?>"> <img src="/ci-news/public/uploads/<?= esc($news_item['img']) ?>" alt="logo" class="img-fluid"></td>
                            <td>
                                <form action="listaDelete" method="post">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="title" value="<?= esc($news_item['title']) ?>">
                                    <button type="submit" >Delete </button>
                                </form>
                            </td>
                            <td>
                                <form action="listaUpdate" method="post" data-title="<?= esc($news_item['title']) ?>">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="title" value="<?= esc($news_item['title']) ?>">
                                    <input type="hidden" name="body" value="<?= esc($news_item['body']) ?>">
                                    <button type="submit" >Update </button>
                                </form>
                            </td>
                        </tr>
        <?php endforeach ?>
    </tbody>
    </table>

</div>









