<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Base Editor Class - used for administration pages
 */
class Editor_Controller extends MY_Controller {

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // must be logged in
        if ( ! $this->user)
        {
            if (current_url() != base_url())
            {
                //store requested URL to session - will load once logged in
                $data = array('redirect' => current_url());
                $this->session->set_userdata($data);
            }

            redirect('login');
        }

        // make sure this user is setup as admin
        if ($this->user['role'] == 'admin' OR $this->user['role'] == 'editor')
        {
			// load the admin language file
			$this->lang->load('admin');
	
			// prepare theme name
			$this->settings->theme = strtolower($this->config->item('admin_theme'));
	
			// set up global header data
			$this
				->add_css_theme( "{$this->settings->theme}.css" )
				->add_js_theme( "{$this->settings->theme}_i18n.js", TRUE );
	
			// declare main template
			$this->template = "../../{$this->settings->root_folder}/themes/{$this->settings->theme}/template.php";
		}
		else
		{
            redirect(base_url());
        }

    }

}
