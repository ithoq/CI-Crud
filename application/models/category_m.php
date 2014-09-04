<?php

class Category_m extends MY_Model {

    protected $table_name = 'categories';
    protected $order_by = 'title ASC, id ASC';
    protected $timestamps = TRUE;
    public $rules = array(
        'title'    => array(
            'field' => 'title',
            'label' => 'Title',
            'rules' => 'trim|required|max_length[100]|xss_clean'
        )
    );

    public $category_list = array();

    public function getEmptyObj()
    {
        $category = new stdClass();
        $category->title = '';
        $category->slug = '';
        return $category;
    }

    public function getCategoriesList()
    {
        // TODO: return categories from cache. Update cache if category added or deleted.
        if($this->category_list) return $this->category_list;

        $this->db->select(array('id','title'));

        $categories = $this->get('result_array');

        $this->category_list = get_category_array($categories);

        return $this->category_list;
    }

}