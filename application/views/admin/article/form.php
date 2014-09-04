<h3><?php echo empty($article->id) ? 'Add a new article' : 'Edit article ' . $article->title; ?></h3>
<?php echo validation_errors(); ?>
<?php echo form_open('admin/article/store'); ?>
<?php dump($article, '$article / Validation unsuccessful / in view'); ?>

<table class="table">
    <tr>
        <td>Publication date</td>
        <td><?php echo form_input('pubdate', set_value('pubdate', $article->pubdate), 'class="datepicker"'); ?></td>
    </tr>
    <tr>
        <td>Title</td>
        <td><?php echo form_input('title', set_value('title', $article->title)); ?></td>
    </tr>    <tr>
        <td>Slug</td>
        <td><?php echo form_input('slug', set_value('slug', $article->slug)); ?></td>
    </tr>
    <tr>
        <td>Categories</td>
        <?php  $cat_post = $this->input->post('categories') ? $this->input->post('categories'): ''; ?>
        <?php dump($cat_post, '$cat_post'); ?>
        <?php  $tags_post = $this->input->post('tags') ? $this->input->post('tags'): ''; ?>
        <?php dump($tags_post, '$tags_post'); ?>
        <td><?php echo form_multiselect('categories[]', $categories, $cat_post ) ?></td>
    </tr>
    <tr>
        <td>Tags</td>
        <td><?php echo form_input('tags', set_value('tags', $article->tags), 'placeholder="comma separated values"'); ?></td>
    </tr>
    <tr>
        <td>Body</td>
        <td><?php echo form_textarea('body', set_value('body', $article->body), 'class="tinymce"'); ?></td>
    </tr>
    <tr>
        <td></td>
        <td><?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?></td>
    </tr>
</table>

<?php echo form_close();?>

<script>
    $(function() {
        $('.datepicker').datepicker({ format : 'yyyy-mm-dd' });
    });
</script>