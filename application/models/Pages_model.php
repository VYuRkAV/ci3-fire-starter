<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pages_model extends CI_Model {

    /**
     * @vars
     */
    private $_db;


    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // define primary table
        $this->_db = 'pages';
    }


    /**
     * Get list pages
     *
     * @param  int $limit
     * @param  int $offset
     * @param  array $filters
     * @param  string $sort
     * @param  string $dir
     * @return array|boolean
     */
    function get_all($limit = 0, $offset = 0, $filters = array(), $sort = 'last_update', $dir = 'DESC')
    {
        $sql = "
            SELECT SQL_CALC_FOUND_ROWS
				{$this->_db}.id,
				page,
				last_update,
				username
            FROM {$this->_db}
			LEFT JOIN users ON updated_by = users.id
        ";

        if ( ! empty($filters))
        {
            foreach ($filters as $key=>$value)
            {
                $value = $this->db->escape('%' . $value . '%');
                $sql .= " WHERE {$key} LIKE {$value}";
            }
        }

        $sql .= " 
		    GROUP BY  `page` 
		    ORDER BY {$sort} {$dir}";

        if ($limit)
        {
            $sql .= " LIMIT {$offset}, {$limit}";
        }

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0)
        {
            $results['results'] = $query->result_array();
        }
        else
        {
            $results['results'] = NULL;
        }

        $sql = "SELECT FOUND_ROWS() AS total";
        $query = $this->db->query($sql);
        $results['total'] = $query->row()->total;

        return $results;
    }
	
	/**
     * Get page
     *
     * @param  value $page
     * @return array|boolean
     */
    function get_page($page = NULL)
	{
		if (isset($page))
		{
			$sql = "
			    SELECT
					id,
					name,
					input_type,
					page,
					show_editor,
					input_size,
					validation,		
			";
			
			foreach ($this->settings->idioms as $language_key => $language_name)
			{
				$sql .= "
				    (SELECT 
					    content.value 
					FROM content 
					WHERE content.page_id = {$this->_db}.id 
					AND content.language = " . $this->db->escape($language_key) . ")
					AS {$language_key}, 
				";
			}
			
			$sql .="
			        sort_order
				FROM {$this->_db}
			";
			
			$sql .= "
			    WHERE page = " . $this->db->escape($page) . "
			";
			
			$query = $this->db->query($sql);
			
			if ($query->num_rows() > 0)
			{
				return $query->result_array();
			}		
		}
		
		return NULL;
	}

    /**
     * Save changes the page content
     *
     * @param  array $data
     * @param  int $user_id
     * @return boolean
     */
    function save_page($page_data = array(), $user_id = NULL)
    {
        if ($page_data && $user_id)
        {
			
            foreach ($page_data as $page_id => $language_key)
            {
				$this->db->trans_begin();
				
				$sql = "
					UPDATE {$this->_db}
					SET last_update = '" . date('Y-m-d H:i:s') . "',
						updated_by = " . $this->db->escape($user_id) . "
					WHERE id = " . $this->db->escape($page_id) . "
				";
				
				$this->db->query($sql);
				
				if ( is_array($language_key))
				{
					
					foreach ($language_key as $key => $value)
					{
						$sql = "
							SELECT SQL_CALC_FOUND_ROWS *
							FROM content
							WHERE page_id = " . $this->db->escape($page_id) . "
							AND language = " . $this->db->escape($key) . "
							LIMIT 1
						";
						
						$query = $this->db->query($sql);
						
						if ($query->num_rows())
						{
							$sql = "
								UPDATE content
								SET value = " . $this->db->escape($value) . "
								WHERE page_id = " . $this->db->escape($page_id) . "
								AND language = " . $this->db->escape($key) . "
							";
							
							$this->db->query($sql);
						}
						else
						{
							$sql = "
								INSERT INTO content (
									page_id,
									language,
									value
								) VALUES (
									" . $this->db->escape($page_id) . ",
									" . $this->db->escape($key) . ",
									" . $this->db->escape($value) . "
								)
							";
							
							$this->db->query($sql);
						}
					}
				}
			}
			
			// if the language was deleted
			$str_lng = FALSE;
			
			foreach ($this->settings->idioms as $language_key => $language_name)
			{
				$str_lng ? $str_lng .= ', ' . $this->db->escape($language_key) : $str_lng .= $this->db->escape($language_key);
			}
			
			$sql = "
			    DELETE FROM content
                WHERE language NOT IN ( {$str_lng} )
			";
			
			$this->db->query($sql);
			
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				
				return FALSE;
			}
			else
			{
				$this->db->trans_commit();
				
				return TRUE;
			}
        }
    }
	
	/**
     * Get content
     *
     * @param  value $page
	 * @param  value $language
     * @return array
     */
    function get_content ($page = NULL, $language = 'english')
	{
		if (isset($page))
		{
			$sql = "
			    SELECT
					name,
					(SELECT 
					    content.value 
					FROM content 
					WHERE content.page_id = {$this->_db}.id 
					AND content.language = " . $this->db->escape($language) . ")
					AS value
				FROM {$this->_db}
				WHERE page = " . $this->db->escape($page) . "
			";
			
			$query = $this->db->query($sql);
			
			if ($query->num_rows() > 0)
			{
				return $query->result_array();
			}		
		}
		
		return array();
	}

}
