<?php

class Factories extends MY_Model {

	// constructor
	function __construct()
	{
		parent::__construct('factories','id');
	}

	// look for a specific repo
	public function findRepo($org = null, $repo = null)
	{
		if (empty($org) || empty($repo))
			return NULL;
		$all = $this->all();
		foreach ($all as $record)
		{
			if (($record->org == $org) && ($record->repo == $repo))
				return $record;
		}
		return NULL;
	}

}
