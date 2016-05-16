<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Public_Controller {

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // load the language file
        $this->lang->load('welcome');
		
		// load the model file
        $this->load->model('pages_model');
    }


    /**
	 * Default
     */
	function index()
	{
		// get content
		$content_page = $this->pages_model->get_content('welcome', $this->session->language);
		
		foreach ($content_page as $content)
		{
			// set content data
			$content_data[$content['name']] = $content['value'];			
		}
		
        // setup page title data
        $this->set_title(lang('welcome title'));
		
		// setup page header data
        empty($content_data['head_message']) ? '' : $this->set_page_header($content_data['head_message']);

        $data = $this->includes;

        // load views
        $data['content'] = $this->load->view('welcome', $content_data, TRUE);
		$this->load->view($this->template, $data);
	}

}
