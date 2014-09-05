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

    public function storeArticleCategory($article_id, $table_name, $categories)
    {

        // Remove old categories and union with insert
        $sql = "DELETE FROM categories_articles WHERE article_id = $article_id";

        $this->db->query($sql);

        // Insert categories
        $sql = "INSERT INTO categories_articles (category_id, article_id) VALUES ";

        $i = 0;
        foreach($categories as $category_id) {
            $i == 0 || $sql .= ',';
            $sql .= '(' . $category_id . ',' . $article_id . ')';
            $i++;
        }

        $sql .= ';';

        $this->db->query($sql);
    }

    public function getCategoriesList($cat_ids = NULL)
    {
        // TODO: return categories from cache. Update cache if category added or deleted.
        if($this->category_list) return $this->category_list;

        $this->db->select(array('id','title'));

        !$cat_ids || $this->db->where_in('id', $cat_ids);

        $categories = $this->get('result_array');

        $this->category_list = toIdTitleFormat($categories);

        return $this->category_list;
    }

    public function getCategoriesById($id)
    {
        // TODO: make into one query with join statements
        // Get category_ids via categories_articles
        $this->db->select('category_id');
        $this->db->where('article_id', $id);
        $c_a = $this->db->get('categories_articles')->result_array();
        $cat_ids = get2ndChildVal($c_a);

        return $cat_ids;
    }

}