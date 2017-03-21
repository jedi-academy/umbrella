<?php

class Build extends Application {

	// constructor
	function __construct()
	{
		parent::__construct();
	}

	// Build more parts
	public function index()
	{
		$result = empty($this->trader) ? "Bogus" : $this->trader;
		echo $result;
	}

}
