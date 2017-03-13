<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends Application {

	// constructor
	function __construct()
	{
		parent::__construct();
		$this->plants = $this->factories->all();
		$this->stats = $this->stats->all();
	}

	// main dashboard
	public function index()
	{
		$this->data['pagebody'] = 'homepage';
		$this->data['content'] = time_ago('2017-03-13 00:05:00');
		$this->render();
	}

}
