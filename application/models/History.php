<?php

class History extends MY_Model {

	// constructor
	function __construct()
	{
		parent::__construct('history', 'seq');
	}

	// record a transaction
	function record($factory, $action, $quantity=0, $amount=0)
	{
		$record = $this->create();
		$record->plant = $factory;
		$record->action = $action;
		$record->quantity = $quantity;
		$record->amount = $amount;
		$record->stamp = date('Y-m-d H:i:s.');
		$this->add($record);
	}

}
