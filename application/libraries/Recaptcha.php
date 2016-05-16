<?php (! defined('BASEPATH')) and exit('No direct script access allowed');

/**
 * CodeIgniter Recaptcha library
 *
 * @package CodeIgniter
 * @author  Bo-Yi Wu <appleboy.tw@gmail.com>
 * @link    https://github.com/appleboy/CodeIgniter-reCAPTCHA
 */
class Recaptcha
{
    /**
     * ci instance object
     *
     */
    private $_ci;

    /**
     * reCAPTCHA site up, verify and api url.
     *
     */
    const sign_up_url = 'https://www.google.com/recaptcha/admin';
    const site_verify_url = 'https://www.google.com/recaptcha/api/siteverify';
    const api_url = 'https://www.google.com/recaptcha/api.js';

    /**
     * constructor
     *
     * @param string $config
     */
    public function __construct()
    {
        $this->_ci = & get_instance();
        $this->_ci->load->config('recaptcha');

        if (!$this->_ci->config->item('recaptcha_site_key') or !$this->_ci->config->item('recaptcha_secret_key')) {
            die("To use reCAPTCHA you must get an API key from <a href='"
                .self::sign_up_url."'>".self::sign_up_url."</a>");
        }
    }

    /**
     * Submits an HTTP GET to a reCAPTCHA server.
     *
     * @param array $data array of parameters to be sent.
     *
     * @return array response
     */
    private function _submitHTTPGet($data)
    {
        $url = self::site_verify_url.'?'.http_build_query($data);
        $response = file_get_contents($url);

        return $response;
    }

    /**
     * Calls the reCAPTCHA siteverify API to verify whether the user passes
     * CAPTCHA test.
     *
     * @param string $response response string from recaptcha verification.
     * @param string $remoteIp IP address of end user.
     *
     * @return ReCaptchaResponse
     */
    public function verifyResponse($response, $remoteIp = null)
    {
        $remoteIp = (!empty($remoteIp)) ? $remoteIp : $this->_ci->input->ip_address();

        // Discard empty solution submissions
        if (empty($response)) {
            return array(
                'success' => false,
                'error-codes' => 'missing-input',
            );
        }

        $getResponse = $this->_submitHttpGet(
            array(
                'secret' => $this->_ci->config->item('recaptcha_secret_key'),
                'remoteip' => $remoteIp,
                'response' => $response,
            )
        );

        // get reCAPTCHA server response
        $responses = json_decode($getResponse, true);

        if (isset($responses['success']) and $responses['success'] == true) {
            $status = true;
        } else {
            $status = false;
            $error = (isset($responses['error-codes'])) ? $responses['error-codes']
                : 'invalid-input-response';
        }

        return array(
            'success' => $status,
            'error-codes' => (isset($error)) ? $error : null,
        );
    }

    /**
     * Render Script Tag
     *
     * onload: Optional.
     * render: [explicit|onload] Optional.
     * hl: Optional.
     * see: https://developers.google.com/recaptcha/docs/display
     *
     * @param array parameters.
     *
     * @return scripts
     */
    public function getScriptTag(array $parameters = array())
    {
		$default = array();
		$this->_ci->config->item('recaptcha_lang') ? $default['hl'] = $this->_ci->config->item('recaptcha_lang') : '';
		$this->_ci->config->item('recaptcha_onload') ? $default['onload'] = $this->_ci->config->item('recaptcha_onload') : '';
		$this->_ci->config->item('recaptcha_render') ? $default['render'] = $this->_ci->config->item('recaptcha_render') : '';

        $result = array_replace($default, $parameters);

        $scripts = '<script type="text/javascript" src="'.self::api_url.'?'.http_build_query($result).'" async defer></script>';

        return $scripts;
    }

    /**
     * render the reCAPTCHA widget
     *
     * data-theme: dark|light
     * data-type: audio|image
     *
     * @param array parameters.
     *
     * @return scripts
     */
    public function getWidget(array $parameters = array())
    {
        $default['data-sitekey'] = $this->_ci->config->item('recaptcha_site_key');
		$this->_ci->config->item('recaptcha_theme') ? $default['data-theme'] = $this->_ci->config->item('recaptcha_theme') : '';
		$this->_ci->config->item('recaptcha_type') ? $default['data-type'] = $this->_ci->config->item('recaptcha_type') : '';
		$this->_ci->config->item('recaptcha_size') ? $default['data-size'] = $this->_ci->config->item('recaptcha_size') : '';

        $result = array_replace($default, $parameters);

        $html = '';
        foreach ($result as $key => $value) {
            $html .= ' '.$key.'="'.$value.'"';
        }

        return '<div class="g-recaptcha" '.$html.'></div>';
    }
}
