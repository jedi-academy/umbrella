<?php

/**
 * Bot factory game engine
 */
class Engine {

	protected $init = FALSE;

	function __construct()
	{
		$this->CI = &get_instance();
	}

	// constructor
	private function initialize()
	{
		$this->pool = array();

		// build a list of bots produced
		$this->CI->load->helper('directory');
		$bots = directory_map('./images/bots');

		// isolate model identifier
		$found = array();
		foreach ($bots as $botname)
		{
			$found[] = substr($botname, 0, 1);
		}

		// make appropriately scaled pool to pick bots from
		foreach ($this->CI->series->all() as $series)
		{
			$starts = $series->starts;
			$ends = $series->ends;
			$limit = $series->frequency;
			$pos = 0;
			$i = 0;
			while ($i < $limit)
			{
				$candidate = $found[$pos];
				if ($candidate >= $starts)
					if ($candidate <= $ends)
					{
						$this->pool[] = $candidate;
						$i++;
					}
				$pos++;
				if ($pos >= count($found))
					$pos = 0;
			}
		}

		$this->init = TRUE;
	}

	// Make a box of parts
	function fillabox($factory)
	{
		$result = array();
		if (!$this->init)
			$this->initialize();

		for ($i = 0; $i < 10; $i++)
		{
			$result[] = $this->buildapart($factory);
		}
		return $result;
	}

	// Make a new part
	private function buildapart($factory = 'Bogus')
	{
		$pieces = [1,2,3];
		$part = $this->CI->parts->create();
		//fixme check for duplicates
		$part->id = $this->randomToken();
		$part->plant = $factory;
		$part->model = $this->pool[array_rand($this->pool)];
		$part->piece = $pieces[array_rand($pieces)];
		$part->stamp = 
		$this->CI->parts->add($part);
		return $part;
	}

	// come up with a random token
	private function randomToken()
	{
		$token = random_int(1000000, 5000000);
		// compute its hex representation
		$hex = dechex($token);
		return $hex;
	}

}
