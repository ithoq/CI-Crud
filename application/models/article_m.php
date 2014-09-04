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
        'slug'    => array(
            'field' => 'slug',
            'label' => 'Slug',
            'rules' => 'trim|required|max_length[100]|callback__unique_slug|xss_clean'
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
        'categories' => array(

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
        'categories',
        'body',
        'tags'
    );

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

    // store and update
    public function store($data)
    {
        // TODO: Make categories work # make categories controller-view # make articles display ...
        // Set timestamps
        if ($this->timestamps == TRUE ) {
            $now = date('Y-m-d H:i:s');
            isset($data['id']) || $data['created'] = $now;
            $data['modified'] = $now;
        }

        // If no summary, set summary
        if (!$data['summary']) {
            $this->config->load('crud_config');
            $summary_len = $this->config->item('summary_len');

            $data['summary'] = substr($data['body'], 0, $summary_len) . '...</p>';
        }


        // Store values to articles DB

        $this->db->set($data);
        $this->db->insert($this->table_name);
        $id = $this->db->insert_id();

        return $id;
    }

    public function update($data, $id)
    {
        $filter = $this->primary_filter;
        $id = $filter($id);
        $this->db->set($data);
        $this->db->where($this->primary_key, $id);
        $this->db->update($this->table_name);
    }



}