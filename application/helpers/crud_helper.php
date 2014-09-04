<?php


if (!function_exists('dump_exit')) {
    function dump_exit($var, $label = 'Dump', $echo = TRUE) {
        dump ($var, $label, $echo);
        exit;
    }
}


if (!function_exists('dump')) {
    function dump ($var, $label = 'Dump', $echo = TRUE)
    {
        // Store dump in variable
        ob_start();
        var_dump($var);
        $output = ob_get_clean();

        // Add formatting
        $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
        $output = '<pre style="background: #FFFEEF; color: #000; border: 1px dotted #000; padding: 10px; margin: 10px 0; text-align: left;">' . $label . ' => ' . $output . '</pre>';

        // Output
        if ($echo == TRUE) {
            echo $output;
        }
        else {
            return $output;
        }
    }
}

if (!function_exists('e')) {
    function e($string)
    {
        return htmlentities($string);
    }
}


function _unique_slug($str)
{
    // Do NOT validate if slug already exists
    // UNLESS it's the slug for the current page

    $id = $this->uri->segment(4);
    $this->db->where('slug', $this->input->post('slug'));
    !$id || $this->db->where('id !=', $id);
    $page = $this->page_m->get();

    if (count($page)) {
        $this->form_validation->set_message('_unique_slug', '%s should be unique');
        return FALSE;
    }
    return TRUE;
}

//
function get_category_array($array)
{
    $keys = array();
    $values = array();
    $i = 0;
    foreach($array as $key => $value) {
        foreach($value as $key => $val)
        {
            $i++;
            if($i % 2 == 1) $keys[] = $val;
            if($i % 2 == 0) $values[] = $val;
        }
    }

    $result = array_combine($keys, $values);

    return $result;
}