<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Transfers extends Application
{

	public function index()
	{
		$this->data['pagebody'] = 'coming_soon';
		$this->render(); 
	}

}
