<h3>Editing <?php echo $article['title']; ?></h3>
<?php echo validation_errors(); ?>
<?php echo form_open('admin/article/update/' . $article['id']); ?>

<table class="table">
    <tr>
        <td>Publication date</td>
        <td><?php echo form_input('pubdate', set_value('pubdate', $article['pubdate']), 'class="datepicker"'); ?></td>
    </tr>
    <tr>
        <td>Title</td>
        <td><?php echo form_input('title', set_value('title', $article['title'])); ?></td>
    </tr>    <tr>
        <td>Slug</td>
        <td><?php echo form_input('slug', set_value('slug', $article['slug'])); ?></td>
    </tr>
    <tr>
        <td>Categories</td>
        <?php isset($sel_categories) || $sel_categories = $this->input->post('categories') ? $this->input->post('categories'): ''; ?>
        <td><?php echo form_multiselect('categories[]', $categories, $sel_categories ) ?></td>
    </tr>
    <tr>
        <td>Tags</td>
        <?php isset($tags) || $tags = $this->input->post('tags') ? $this->input->post('tags'): ''; ?>
        <?php $tags = implode(', ', $article['tags']); ?>
        <td><?php echo form_input('tags', set_value('tags', $tags), 'placeholder="comma separated values"'); ?></td>
    </tr>
    <tr>
        <td>Body</td>
        <td><?php echo form_textarea('body', set_value('body', $article['body']), 'class="tinymce"'); ?></td>
    </tr>
    <tr>
        <td></td>
        <td><?php echo form_submit('submit', 'Update', 'class="btn btn-primary"'); ?></td>
    </tr>
</table>

<?php echo form_close();?>

<script>
    $(function() {
        $('.datepicker').datepicker({ format : 'yyyy-mm-dd' });
    });
</script>