<?php

class Verify extends Application {

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
