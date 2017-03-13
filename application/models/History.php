<?php

class History extends MY_Model {

	// constructor
	function __construct()
	{
		parent::__construct('history', 'seq');
	}

}
