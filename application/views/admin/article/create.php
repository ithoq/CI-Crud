<h3>Add a new article</h3>
<?php echo validation_errors(); ?>
<?php echo form_open('admin/article/store'); ?>

<table class="table">
    <tr>
        <td>Publication date</td>
        <td><?php echo form_input('pubdate', set_value('pubdate'), 'class="datepicker"'); ?></td>
    </tr>
    <tr>
        <td>Title</td>
        <td><?php echo form_input('title', set_value('title')); ?></td>
    </tr>    <tr>
        <td>Slug</td>
        <td><?php echo form_input('slug', set_value('slug')); ?></td>
    </tr>
    <tr>
        <td>Categories</td>
        <?php dump($this->input->post(), 'POST values') ?>
        <td><?php echo form_multiselect('categories[]', $categories, $this->input->post('categories') ) ?></td>
    </tr>
    <tr>
        <td>Tags</td>
        <td><?php echo form_input('tags', set_value('tags'), 'placeholder="comma separated values"'); ?></td>
    </tr>
    <tr>
        <td>Body</td>
        <td><?php echo form_textarea('body', set_value('body'), 'class="tinymce"'); ?></td>
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

