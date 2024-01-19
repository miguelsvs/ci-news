<div class="text-light">
    <?php if (! empty($news) && is_array($news)): ?>
        <div class="container mt-3">
            <div class="row">
                <?php foreach ($news as $news_item): ?>
                    <div class="col-md-4 news-div" data-url="/ci-news/news/<?= esc($news_item['slug']) ?>">
                        <div class="news-thumbnail d-flex flex-column h-100 m-1" >
                            <div class="container news-img-thumbnail-container align-items-center">
                                    <a href="/ci-news/news/<?= esc($news_item['slug']) ?>">
                                    <img src="/ci-news/public/uploads/<?= esc($news_item['img']) ?>" alt="logo" class="img-fluid img-thumbnail news-thumbnail-img">
                                    </a>
                            </div>               
                            <div class="text-center"><h4><?=$news_item['title']?></h4></div>
                            <div class="news-thumbnail-body text-center">
                                <?php 
                                    $resume = $news_item['body'];
                                    if (strlen($resume) >150){
                                        $resume = substr($resume,0,147)."...";} 
                                    echo $resume
                                ?>    
                            </div>
                            <div class="mt-auto text-center" >   
                                <a class="btn btn-secondary button-thumbnail" href="/ci-news/news/<?= esc($news_item['slug']) ?>" role="button">Seguir leyendo</a>
                            </div>
                        </div>
                    </div>

                <?php endforeach ?>
            </div>
        </div>
    <?php else: ?>
        <h3>No News</h3>
        <p>Unable to find any news for you.</p>
    <?php endif ?>
</div>

<!-- <script>
document.addEventListener('DOMContentLoaded', function() {
    var newsItems = document.querySelectorAll('.news-div');
    
    newsItems.forEach(function(item) {
        item.addEventListener('click', function() {
            var url = this.dataset.url;
            window.location.href = url;
        });
    });
});
</script> -->

