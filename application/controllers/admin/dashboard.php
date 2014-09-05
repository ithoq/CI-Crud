<?php

class Dashboard extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        // Fetch 5 recently modified articles
        $this->load->model('article_m');
        $this->db->order_by('modified', 'desc');
        $this->db->limit(5);
        $this->data['recent_articles'] = $this->article_m->getWithTagsAndCategories();

        $this->data['subview'] = 'admin/dashboard/index';
        $this->load->view('admin/main_layout', $this->data);
    }

}