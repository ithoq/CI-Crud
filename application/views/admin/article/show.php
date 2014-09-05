<section>
    <?php if($this->session->flashdata('message')): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $this->session->flashdata('message'); ?>
        </div>
    <?php endif; ?>

    <h2>Articles</h2>

    <div class="col-md-12">
        <h1><?php echo $article['title']; ?></h1>
        <div class="pull-left">
            <?php foreach($article['categories'] as $key => $value): ?>
                <span class="label black"><?php echo $value; ?></span>
            <?php endforeach; ?>
        </div><div class="clear"></div>
        <p><?php echo $article['body']; ?></p>
        <div>
            <span class="badge">Posted on <?php echo $article['pubdate']; ?></span>

            <div class="pull-right">
                <?php foreach($article['tags'] as $key => $value): ?>
                <span class="label label-default"><?php echo $value; ?></span>
                <?php endforeach; ?>

            </div>
        </div>
    </div>

</section>