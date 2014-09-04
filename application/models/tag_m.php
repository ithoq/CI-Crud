<?php

class Tag_m extends MY_Model {


    protected $table_name = 'tags';

    public function store($entity_id, $tag_type, $input_tags)
    {
        // Input tags to array
        $input_tags = $this->tagsToLowerToArray($input_tags);

        // Check for existing tags
        $existing_tags = $this->getExistingTags($input_tags);

        // Compare existing tags vs input tags
        $new_tags = array_diff($input_tags, $existing_tags);

        $tag_ids = array();
        if(count($new_tags))
        {
            // Store new tags to DB
            $last_insert_id = $this->storeTags($new_tags);

            // Tag ids of newly inserted tags
            $tag_ids = $this->getTagIDs($last_insert_id, count($new_tags));
        }

        // Merge IDs of newly inserted tags and of existing in db ones
        $existing_tags = array_keys($existing_tags);
        $taggable_ids = array_merge($existing_tags, $tag_ids);


        #### 2 STORING TO TAGGABLE ####
        // Get existing tags for tag type
        // get existing tags for entity id
        $entity_tags = $this->getEntityTags($entity_id, $tag_type);
        $existing_tags = $this->get2ndChildVal($entity_tags);


        // Define tag-entity relations to be removed
        $tag_ids_for_delete = array_diff($existing_tags, $taggable_ids);
        // Define tag-entity relations to be added
        $tag_ids_to_add = array_diff($taggable_ids, $existing_tags);



        // Delete taggable relations
        !count($tag_ids_for_delete) || $this->deleteTaggables($tag_ids_for_delete, $tag_type);

        // Store taggable relations
        !count($tag_ids_to_add) || $this->storeTaggables($entity_id, $tag_ids_to_add, $tag_type);


        // TODO: Check code again and make sure it doesn't break.
        // TODO: Check code when values are empty.
        // TODO: Implement Eloquent https://github.com/illuminate/database
    }

    function storeTaggables($entity_id, $tag_ids, $tag_type)
    {
        $sql = "INSERT INTO taggable (taggable_id, tag_id, tag_type) VALUES ";
        $i = 0;
        foreach($tag_ids as $tag_id) {
            if($i != 0) $sql .= ',';
            $sql .= "(" . $entity_id . ',' . $tag_id . ",'" . $tag_type . "')";
            $i++;
        };
        $sql .= ";";

        return $this->db->query($sql);
    }

    function deleteTaggables($tag_ids, $tag_type)
    {
        $sql = "DELETE FROM taggable WHERE (tag_id, tag_type) IN (";
        $i = 0;
        foreach($tag_ids as $tag_id)
        {
            if($i != 0) $sql .= ',';
            $sql .= '(' . $tag_id . ",'" . $tag_type . "')";
            $i++;
        }
        //$sql .= '((1,2),(3,4),(5,6))';
        $sql .= ');';
        return $this->db->query($sql);
    }

    public function get2ndChildVal($entity_tags)
    {
        $existing_tags = array();
        foreach($entity_tags as $key => $value) {
            foreach($value as $k => $val)
            {
                $existing_tags[] = intval($val);
            }
        }
        return $existing_tags;
    }

    public function getEntityTags($id, $tag_type)
    {
        $this->select('tag_id');
        $this->db->where(array(
            'taggable_id' => $id,
            'tag_type' => $tag_type
        ));
        return $this->db->get('taggable')->result_array();
    }

    public function getTagIDs($last_insert_id, $new_tags_count)
    {
        $tag_ids = array($last_insert_id);
        $i = 1;
        while($new_tags_count - 1)
        {
            $tag_ids[] = $last_insert_id + $i;
            $new_tags_count--;
            $i++;
        }

        return $tag_ids;
    }

    public function storeTags($new_tags)
    {
        $sql = "INSERT INTO $this->table_name (title) VALUES ";
        $i = 0;
        foreach($new_tags as $tag) {
            if($i != 0) $sql .= ',';
            $sql .= "('" . $tag . "')";
            $i++;
        };
        $sql .= ";";
        $query = $this->db->query($sql);

        return $this->db->insert_id();
    }

    public function getExistingTags(array $input_tags)
    {
        $i = 0;
        $sql = '';
        foreach($input_tags as $tag) {
            if(!$i == 0) $sql .= 'UNION ';
            $sql .= "SELECT id, title FROM tags WHERE title='$tag' ";
            $i++;
        }
        $existing_tags = $this->db->query($sql)->result_array();

        $existing_tags_array = array();
        foreach($existing_tags as $key => $value)
        {
            $existing_tags_array[$value['id']] = $value['title'];
        }

        return $existing_tags_array;
    }

    /**
     * @param $tags
     * @return array
     * Convert comma separated tags list to array
     * and convert to lowercase
     */
    public function tagsToLowerToArray($tags)
    {
        $func = function($tag){
            $tag = trim($tag);
            return strtolower($tag);
        };

        $tag_array = explode(',', $tags);
        $tags = array_map($func, $tag_array);
        return $tags;
    }




}
