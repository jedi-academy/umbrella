<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Whoami extends Application {

	// constructor
	function __construct()
	{
		parent::__construct();
	}

	// Identification service
	public function index()
	{
		$result = empty($this->trader) ? "Bogus" : $this->trader;
		echo $result;
	}

}
