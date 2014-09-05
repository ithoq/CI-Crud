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

function btn_edit ($uri)
{
    return anchor($uri, '<span class="glyphicon glyphicon-edit"></span>');
}

function btn_delete ($uri)
{
    return anchor($uri, '<span class="glyphicon glyphicon-remove"></span>', array(
        'onclick' => "return confirm('You are about to delete a record. This cannot be undone. Are you sure?');"
    ));
}


/**
 * Reformat array values to "form selected" values
 */
function toSelectedValsFormat($data)
{
    // Convert to form selected format
    $array = array();
    foreach($data as $key => $value) {
        $array[] = $key;
    }

    return $array;
}

/**
 * @param $data
 * @return array
 * Convert result array to id => title format
 */
function toIdTitleFormat($data)
{
    // Format as id => title
    $array = array();

    foreach($data as $item) {
        $array[$item['id']] = $item['title'];
    }

    return $array;
}
