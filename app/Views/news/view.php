
<div class="img-new-container w-100">
    <img src="/ci-news/public/uploads/<?= esc($news['img']) ?>" alt="<?= esc($news['img']) ?>" class="img-fluid img-new">
</div>


<div class="container text-light mt-3">
    <h1 class="text-center"><?= esc($news['title']) ?></h1>
    <div class="mt-3 news-body"><?=$news['body'] ?></div>
</div>


