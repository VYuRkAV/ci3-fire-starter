<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends Editor_Controller {

    /**
     * @var string
     */
    private $_redirect_url;


    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // load the language files
        $this->lang->load('pages');

        // load the users model
        $this->load->model('pages_model');

        // set constants
        define('REFERRER', "referrer");
        define('THIS_URL', base_url('admin/pages'));
        define('DEFAULT_LIMIT', $this->settings->per_page_limit);
        define('DEFAULT_OFFSET', 0);
        define('DEFAULT_SORT', "last_update");
        define('DEFAULT_DIR', "DESC");

        // use the url in session (if available) to return to the previous filter/sorted/paginated list
        if ($this->session->userdata(REFERRER))
        {
            $this->_redirect_url = $this->session->userdata(REFERRER);
        }
        else
        {
            $this->_redirect_url = THIS_URL;
        }
    }


    /**************************************************************************************
     * PUBLIC FUNCTIONS
     **************************************************************************************/


    /**
     * User list page
     */
    function index()
    {
        // get parameters
        $limit  = $this->input->get('limit')  ? $this->input->get('limit', TRUE)  : DEFAULT_LIMIT;
        $offset = $this->input->get('offset') ? $this->input->get('offset', TRUE) : DEFAULT_OFFSET;
        $sort   = $this->input->get('sort')   ? $this->input->get('sort', TRUE)   : DEFAULT_SORT;
        $dir    = $this->input->get('dir')    ? $this->input->get('dir', TRUE)    : DEFAULT_DIR;

        // get filters
        $filters = array();

        if ($this->input->get('page'))
        {
            $filters['page'] = $this->input->get('page', TRUE);
        }

        if ($this->input->get('username'))
        {
            $filters['username'] = $this->input->get('username', TRUE);
        }

        if ($this->input->get('last_update'))
        {
            $filters['last_update'] = $this->input->get('last_update', TRUE);
        }

        // build filter string
        $filter = "";
        foreach ($filters as $key => $value)
        {
            $filter .= "&{$key}={$value}";
        }

        // save the current url to session for returning
        $this->session->set_userdata(REFERRER, THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");

        // are filters being submitted?
        if ($this->input->post())
        {
            if ($this->input->post('clear'))
            {
                // reset button clicked
                redirect(THIS_URL);
            }
            else
            {
                // apply the filter(s)
                $filter = "";

                if ($this->input->post('page'))
                {
                    $filter .= "&page=" . $this->input->post('page', TRUE);
                }

                if ($this->input->post('username'))
                {
                    $filter .= "&username=" . $this->input->post('username', TRUE);
                }

                if ($this->input->post('last_update'))
                {
                    $filter .= "&last_update=" . $this->input->post('last_update', TRUE);
                }

                // redirect using new filter(s)
                redirect(THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
            }
        }

        // get list
        $pages = $this->pages_model->get_all($limit, $offset, $filters, $sort, $dir);

        // build pagination
        $this->pagination->initialize(array(
            'base_url'   => THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
            'total_rows' => $pages['total'],
            'per_page'   => $limit
        ));

        // setup page header data
		$this
			->add_js_theme( "pages_i18n.js", TRUE )
			->set_title( lang('pages title page_list') );

        $data = $this->includes;

        // set content data
        $content_data = array(
            'this_url'   => THIS_URL,
            'pages'      => $pages['results'],
            'total'      => $pages['total'],
            'filters'    => $filters,
            'filter'     => $filter,
            'pagination' => $this->pagination->create_links(),
            'limit'      => $limit,
            'offset'     => $offset,
            'sort'       => $sort,
            'dir'        => $dir
        );

        // load views
        $data['content'] = $this->load->view('admin/pages/list', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }


    /**
     * Edit page
     *
     * @param  int $id
     */
    function edit($page = NULL)
    {
        // make sure we have a string
        if ( ! is_string($page))
        {
            redirect($this->_redirect_url);
        }

        // get the data
        $contents = $this->pages_model->get_page($page);

        // if empty results, return to list
        if ( ! $contents)
        {
            redirect($this->_redirect_url);
        }

        // validators
        $this->form_validation->set_error_delimiters($this->config->item('error_delimeter_left'), $this->config->item('error_delimeter_right'));
		foreach ($contents as $content)
        {
            if ($content['validation'])
            {
				foreach ($this->settings->idioms as $language_key => $language_name)
				{
					$this->form_validation->set_rules($content['id'] . "[" . $language_key . "]", lang('pages ' . $content['page'] . ' label ' . $content['name']), $content['validation']);
				}
            }
			if ($content['input_type'] == 'textarea')
			{
				$this->set_textarea();
			}
		}

        if ($this->form_validation->run() == TRUE)
        {
            // save the content
            $saved = $this->pages_model->save_page($this->input->post(), $this->user['id']);
			
            if ($saved)
            {
                $this->session->set_flashdata('message', lang('pages msg updated'));
            }
            else
            {
                $this->session->set_flashdata('error', lang('pages error update_failed'));
            }

            // return to list and display message
            redirect($this->_redirect_url);
        }

        // setup page header data
        $this->set_title( sprintf(lang('pages title'), $page) );

        $data = $this->includes;

        // set content data
        $content_data = array(
            'cancel_url'        => $this->_redirect_url,
            'contents'          => $contents
        );

        // load views
        $data['content'] = $this->load->view('admin/pages/form', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }


    /**
     * Export list to CSV
     */
    function export()
    {
        // get parameters
        $sort = $this->input->get('sort') ? $this->input->get('sort', TRUE) : DEFAULT_SORT;
        $dir  = $this->input->get('dir')  ? $this->input->get('dir', TRUE)  : DEFAULT_DIR;

        // get filters
        $filters = array();

        if ($this->input->get('page'))
        {
            $filters['page'] = $this->input->get('page', TRUE);
        }

        if ($this->input->get('username'))
        {
            $filters['username'] = $this->input->get('username', TRUE);
        }

        if ($this->input->get('last_update'))
        {
            $filters['last_update'] = $this->input->get('last_update', TRUE);
        }

        // get all users
        $pages = $this->pages_model->get_all(0, 0, $filters, $sort, $dir);

        if ($pages['total'] > 0)
        {
            // export the file
            array_to_csv($pages['results'], "pages");
        }
        else
        {
            // nothing to export
            $this->session->set_flashdata('error', lang('core error no_results'));
            redirect($this->_redirect_url);
        }

        exit;
    }

}