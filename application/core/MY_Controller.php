<?php

/**
 * core/MY_Controller.php
 *
 * Default application controller
 *
 * @author		JLP
 * @copyright           2010-2016, James L. Parry
 * ------------------------------------------------------------------------
 */
class Application extends CI_Controller {

	/**
	 * Constructor.
	 * Establish view parameters & load common helpers
	 */
	function __construct()
	{
		parent::__construct();

		//  Set basic view parameters
		$this->data = array();
		$this->data['pagetitle'] = 'Umbrella Corp - Life Is Our Business';
		$this->data['title'] = 'Panda Research Center';
		$this->data['ci_version'] = (ENVIRONMENT === 'development') ? 'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '';

		// login scoop?
		$this->data['userRole'] = ROLE_GUEST;
		
		$this->data['userID'] = $this->session->userdata('userID') ?? 'Guest';
		$this->data['userName'] = $this->session->userdata('userName') ?? '';
		$this->data['userRole'] = $this->session->userdata('userRole') ?? 'guest';
	}

	/**
	 * Render this page
	 */
	function render($template = 'template')
	{
		// Massage the menubar
		$choices = $this->config->item('menu_choices');
		foreach ($choices['menudata'] as &$menuitem)
		{
			$menuitem['active'] = (ltrim($menuitem['link'], '/ ') == uri_string()) ? 'active' : '';
		}
		$this->data['menubar'] = $this->parser->parse('theme/menubar', $choices, true);

		// integrate any needed CSS framework & components
		$this->data['caboose_styles'] = $this->caboose->styles();
		$this->data['caboose_scripts'] = $this->caboose->scripts();
		$this->data['caboose_trailings'] = $this->caboose->trailings();

		$this->data['content'] = $this->parser->parse($this->data['pagebody'], $this->data, true);
		$this->parser->parse('theme/template', $this->data);
	}

	/**
	 * RBAC - role-based access control.
	 * Restrict the access of a page to only those users
	 * who have the role specified.
	 * 
	 * @param string $roleNeeded 
	 */
	function restrict($roleNeeded = null)
	{
		$userRole = $this->session->userdata('userRole');
		if ($roleNeeded != null)
		{
			if ($userRole != $roleNeeded)
			{
				redirect("/");
				exit;
			}
		}
	}

	/**
	 * Are we logged in? 
	 */
	function loggedin()
	{
		return $this->session->userdata('userID');
	}

	/**
	 * Is the logged in user in a specific role? 
	 */
	function in_role($role)
	{
		if ($this->loggedin())
		{
			return ($role == $this->session->userdata('userRole'));
		}
	}

	/**
	 * Forced logout
	 */
	function logout() {
		$this->session->sess_destroy();
		redirect('/');
	}
}
