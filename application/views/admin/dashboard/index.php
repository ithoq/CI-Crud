<h2>Recently modified articles</h2>

<div class="col-md-12">
    <?php foreach($recent_articles as $article): ?>
    <h1><?php echo anchor('admin/article/show/' . $article['id'] . '/' . $article['slug'], $article['title']); ?></h1>
        <div class="pull-left">
            <?php foreach($article['categories'] as $key => $value): ?>
                <span class="label black"><?php echo $value; ?></span>
            <?php endforeach; ?>
        </div><div class="clear"></div>
        <h5>Modified - <?php echo date('Y-m-d H:i:s', strtotime(e($article['modified']))); ?></h5>
    <p><?php echo $article['summary']; ?></p>
    <div>
        <span class="badge">Posted on <?php echo $article['pubdate']; ?></span>

        <div class="pull-right">
            <?php foreach($article['tags'] as $key => $value): ?>
                <span class="label label-default"><?php echo $value; ?></span>
            <?php endforeach; ?>

        </div>
    </div>
    <hr>
    <?php endforeach; ?>
</div>