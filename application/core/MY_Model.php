<?php

class MY_Model extends CI_Model {

    protected $table_name = '';
    protected $primary_key = 'id';
    protected $primary_filter = 'intval';
    protected $order_by = '';
    public $rules = array();
    public $post_keys = array();
    protected $timestamps = FALSE;

    public function __construct()
    {
        parent::__construct();
    }

    public function arrayFromPost()
    {
        $data = array();
        foreach($this->post_keys as $field)
        {
            $data[$field] = $this->input->post($field);
        }

        return $data;
    }

    public function get($method = 'result')
    {
        return $this->db->get($this->table_name)->$method();
    }

    public function getById($id)
    {

        $this->db->where($this->primary_key, $id);

        return $this->db->get($this->table_name)->row();

    }

//    public function getById($id)
//    {
//        // Filter input
//        $filter = $this->primary_filter;
//        $id = $filter($id);
//
//        // Get single data
//        $this->db->where($this->primary_key, $id);
//        $method = 'row';
//
//        return $this->db->get($this->table_name)->$method();
//    }

    function select($values)
    {
        $this->db->select($values);
    }


}