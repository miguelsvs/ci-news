<div class="text-light">
    <?php if (! empty($news) && is_array($news)): ?>
        <div class="container mt-3">
            <div class="row">
                <?php foreach ($news as $news_item): ?>
                    <div class="col-md-4 news2-div" data-url="/ci-news/news/<?= esc($news_item['slug']) ?>">
                        <div class="news2-thumbnail d-flex flex-column h-100 m-1" >
                            <div class="news2-thumbnail-image-container">
                                <a href="/ci-news/news/<?= esc($news_item['slug']) ?>">
                                    <?php if($news_item['img_thumb256_256']){
                                        $imageurl= $news_item['img_thumb256_256'];
                                    }
                                    else
                                    {
                                        $imageurl = $news_item['img'];
                                    }?>
                                    <img src="/ci-news/public/uploads/<?=$imageurl ?>" alt="logo" class="img-fluid news2-thumbnail-img">
                                </a>
                            </div>           
                            <div class="news2-thumbnail-title">
                              <h4><?=$news_item['title']?></h4>
                                <?php 
                                    $resume = $news_item['body'];
                                    if (strlen($resume) >30){
                                        $resume = substr($resume,0,27)."...";} 
                                    echo $resume
                                ?>    
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
