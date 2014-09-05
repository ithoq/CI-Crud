<section>
    <?php if($this->session->flashdata('message')): ?>
    <div class="alert alert-success" role="alert">
        <?php echo $this->session->flashdata('message'); ?>
    </div>
    <?php endif; ?>

    <h2>Articles</h2>

    <?php echo anchor('admin/article/create', '<span class="glyphicon glyphicon-plus"></span> Add an article'); ?>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Title</th>
            <th>Pubdate</th>
            <th class="column-categories">Categories</th>
            <th class="column-tags">Tags</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php if(count($articles)): foreach($articles as $article): ?>
            <tr>
                <td><?php echo anchor('admin/article/edit/' . $article['id'], $article['title']); ?></td>
                <td><?php echo $article['pubdate']; ?></td>
                <td class="column-categories"><?php echo implode(', ', $article['tags']); ?></td>
                <td class="column-tags"><?php echo implode(', ', $article['categories']); ?></td>
                <td><?php echo btn_edit('admin/article/edit/' . $article['id']); ?></td>
                <td><?php echo btn_delete('admin/article/delete/' . $article['id']); ?></td>
            </tr>
        <?php endforeach; else: ?>
            <tr>
                <td colspan="8">We could ot find any articles.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
    <?php //$this->load->view('admin/components/_pagination'); ?>
</section>