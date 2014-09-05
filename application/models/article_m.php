<?php


class Article_m extends MY_Model {

    public $table_name = 'articles';
    protected $order_by = 'pubdate DESC, id DESC';
    protected $timestamps = TRUE;
    public $rules = array(
        'title'    => array(
            'field' => 'title',
            'label' => 'Title',
            'rules' => 'trim|required|max_length[100]|xss_clean'
        ),
        // TODO: make unique slug validation
        'slug'    => array(
            'field' => 'slug',
            'label' => 'Slug',
            'rules' => 'trim|max_length[100]|callback__unique_slug|xss_clean'
        ),
        'pubdate'    => array(
            'field' => 'pubdate',
            'label' => 'Publication date',
            'rules' => 'trim|required|exact_length[10]|xss_clean'
        ),
        'summary' => array(
            'field' => 'summary',
            'label' => 'Summary',
            'rules' => 'max_length[300]'
        ),
        'body'    => array(
            'field' => 'body',
            'label' => 'Body',
            'rules' => 'trim|required'
        ),
    );


    public $post_keys = array(
        'title',
        'slug',
        'pubdate',
        'summary',
        'body'
    );

    public function __construct()
    {
        parent::__construct();
        $this->form_validation->set_rules('categories[]', 'Categories', 'integer');
    }

    public function makeEmptyObj()
    {
        $article = new stdClass();
        $article->title = '';
        $article->slug = '';
        $article->body = '';
        $article->pubdate = date('Y-m-d');
        return $article;
    }

    public function validation()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules($this->rules);

        return $this->form_validation->run();
    }

    public function wherePublished()
    {
        $this->db->where('pubdate <=', date('Y-m-d'));
    }


    public function store($data)
    {
        // Set timestamps
        if ($this->timestamps == TRUE) {
            $now = date('Y-m-d H:i:s');
            $data['created'] = $now;
            $data['modified'] = $now;
        }

        // If no summary, set summary
        if (!$data['summary']) {
            $this->config->load('crud_config');
            $summary_len = $this->config->item('summary_len');

            $data['summary'] = substr($data['body'], 0, $summary_len) . '...</p>';
        }

        // Set slug
        $this->load->helper('url');
        if($data['slug']) {
            $data['slug'] = url_title($data['slug']);
        } else {
            $data['slug'] = url_title($data['title']);
        }

        // Store values to articles DB
        $this->db->set($data);
        $this->db->insert($this->table_name);
        $id = $this->db->insert_id();

        return $id;
    }


    /**
     * @param null $id
     * @return mixed
     * Get articles with tags and categories in sub array
     */
    public function getWithTagsAndCategories($id = NULL, $slug = NULL)
    {
        // Get articles
        !$id || $this->db->where('id', $id);
        !$slug || $this->db->where('slug', $slug);
        $articles = $this->db->get($this->table_name)->result_array();

        // Redirect 404 if no results
        if(!$articles) show_404('No articles found.');

        // Get categories and tags

        $i = 0;
        foreach($articles as $article) {
            // Get tags by article id
            $articles[$i]['tags'] = $this->getTagsById($article['id']);

            // Get categories by article id
            $articles[$i]['categories'] = $this->getCategoriesById($article['id']);

            $i++;
        }

        if($id || $slug) return $articles[0];

        return $articles;
    }

    public function getTagsById($id)
    {
        $query = $this->db->query("SELECT tags.title, tags.id FROM tags INNER JOIN taggable ON tags.id = taggable.tag_id WHERE taggable.taggable_id IN ($id) AND taggable.tag_type = 'articles'");

        $results = $query->result_array();

        return toIdTitleFormat($results);
    }

    public function getCategoriesById($id)
    {
        $query = $this->db->query("SELECT categories.title, categories.id FROM categories INNER JOIN categories_articles ON categories.id = categories_articles.category_id WHERE categories_articles.article_id IN ($id)");

        $results = $query->result_array();

        return toIdTitleFormat($results);
    }

}