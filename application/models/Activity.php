<?php

class Activity extends MY_Model {

	// some limits
	private $activity_limit = 100; // how many to retain
	private $activity_page = 8; // how many to return for activity panel

	// constructor

	function __construct()
	{
		parent::__construct('activity', 'seq');
	}

	// record a new activity
	function record($factory, $action)
	{
		// prune the table if needed
		$size = $this->size();
		if ($size >= $this->activity_limit)
		{
			// drop the oldest
			$drop_count = $size - $this->activity_limit + 1;
			$oldest = $this->first($drop_count);
			foreach ($oldest as $record)
				$this->delete($record->seq);
		}

		// create & add new activity record
		$record = $this->create();
		$record->factory = $factory;
		$record->action = $action;
		$this->add($record);
	}

	// construct view parameters for activity panel
	function latest()
	{
		$records = $this->tail($this->activity_page);
		$result = [];
		foreach ($records as $record)
			array_unshift($result, ['factory' => $record->factory, 'action' => $record->action,
				'delta' => time_ago($record->timestamp)]);
		return $result;
	}

}
