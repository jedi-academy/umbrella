<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Vault extends Application
{

	public function __construct() {
		parent::__construct();
//		$this->restrict([ROLE_PLANT,ROLE_ADMIN]);
	}
	
	public function index()
	{
		// if already logged in, proceed to setup
		
		
		$this->data['pagebody'] = 'vault';
		$this->render(); 
	}
	
	public function settings() {
		$this->data['pagebody'] = 'settings';
		$this->render(); 
	}
	
	public function update() {
		
	}

}
