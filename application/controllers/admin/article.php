<?php

class Article extends Admin_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('article_m');
    }

    function index()
    {
        // Get articles
        $this->data['articles'] = $this->article_m->getWithTagsAndCategories();
        $this->data['subview'] = 'admin/article/index';

        return $this->load->view('admin/main_layout', $this->data);
    }

    function show()
    {
        // Funkcija koja vraća članak treba biti sposobna vratiti članak po ID-u i po slug-u (slug je URI-friendly verzija naslova članka, npr za naslov "Zvjezdani kod d.o.o." slug bi bio "zvjezdani-kod-d-o-o").
        // Također, funkcija treba primati opcionalni parametar koji je array s imenima elemenata posta koje funkcija treba vratiti (npr. array('title', 'excerpt')).
        $id = $this->uri->segment(4);
        $slug = $this->uri->segment(5);

        if(!is_numeric($id)) { $slug = $id; $id = FALSE; }

        if(!$id && !$slug) show_404();

        // Get articles
        $this->data['article'] = $this->article_m->getWithTagsAndCategories($id, $slug);
        $this->data['subview'] = 'admin/article/show';

        return $this->load->view('admin/main_layout', $this->data);
    }

    function create()
    {
        // TODO: add date picker : tests/jquery-minical OR http://www.jqueryrain.com/demo/jquery-date-time-picker/

        // Get article with categories and tags by id

        // Get categories
        $this->load->model('category_m');
        $this->data['categories'] = $this->category_m->getCategoriesList();

        dump($this->data['categories'], '$this->data[\'categories\']');

        // Load empty article object
        $this->data['article'] = $this->article_m->makeEmptyObj();

        // Load the view / display form
        $this->data['subview'] = 'admin/article/create';
        $this->load->view('admin/main_layout', $this->data);

    }

    /**
     * Store form post values to database
     */
    function store()
    {
        // Funkcija koja upisuje članke mora biti sposobna primiti sve elemente koje članak može sadržavati i upisati ih u bazu.

        // Add post values to data array
        $data = $this->article_m->arrayFromPost();

        // Validate form
        if($this->article_m->validation()) {

            // Validation success

            // Store values to db
            $id = $this->article_m->store($data);

            // Store categories
            if($this->input->post('categories')) {
                $this->load->model('category_m');
                $this->category_m->storeArticleCategory($id, $this->article_m->table_name, $this->input->post('categories'));
            }

            // Store Tags
            if($this->input->post('tags')) {
                $this->load->model('tag_m');
                $this->tag_m->store($id, $this->article_m->table_name, $this->input->post('tags'));
            }

            // Set success message and redirect
            $this->load->library('session');
            $this->session->set_flashdata('message', 'Article was successfully submitted.');

            redirect('admin/article');
        }

        // Validation unsuccessful

        // Set empty form data to avoid errors
        $this->data['article'] = $this->article_m->makeEmptyObj();

        // Get categories
        $this->load->model('category_m');
        $this->data['categories'] = $this->category_m->getCategoriesList();

        // Load the view
        $this->data['subview'] = 'admin/article/create';
        $this->load->view('admin/main_layout', $this->data);

    }

    function update($id = NULL)
    {
        // if $id, fetch by $id
        $id =  $this->uri->segment(4);

        // Set a new one


    }

    function edit($id = NULL)
    {
        // Funkcija za ažuriranje članka mora biti sposobna primiti sve elemente
        // koje članak može sadržavati te ažurirati postojeći članak u bazi.
        // Za dodavanje, uređivanje i brisanje kategorija treba napraviti posebni
        // set funkcija.
        $id =  $this->uri->segment(4);
        $this->data['article'] = $this->article_m->getWithTagsAndCategories($id);

        // Get categories
        $this->load->model('category_m');

        // All categories
        $this->data['categories'] = $this->category_m->getCategoriesList();

        // Selected categories
        $sel_categories = toSelectedValsFormat($this->article_m->getCategoriesById($id));
        $this->data['sel_categories'] = $sel_categories;

        // Load the view / display form
        $this->data['subview'] = 'admin/article/edit';
        $this->load->view('admin/main_layout', $this->data);
    }



}