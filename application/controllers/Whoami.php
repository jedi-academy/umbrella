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
		$result = empty($this->trader) ? "I don't recognize you" : 'You must be '.$this->trader;
		echo $result;
	}

}
