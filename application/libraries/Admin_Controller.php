<?php

 class Admin_Controller extends MY_Controller {

     public function __construct()
     {
         parent::__construct();
         $this->data['meta_title'] =  config_item('meta_title');
         $this->load->helper('form');
         $this->load->library('form_validation');
         $this->load->library('session');
     }
 }