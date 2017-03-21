<?php

/**
 * Buy a box of parts.
 * 
 * Returns a JSON object with the request status, the name of the factory
 * to which the parts are registered (if not "Bogus"), and then an
 * array with the parts in this box.
 */
class Box extends Application {

	function __construct()
	{
		parent::__construct();
		$this->load->library('engine');
	}

	public function index()
	{
		// basic fact-checking
		if (empty($this->trader))
			return "Oops: I don't recognize you!";
//		echo var_dump($this->trader);die();
		
//		$factory = $this->factories->factory;
//		if (empty($factory))
//			return "Oops: " . $factory . " not one of the good guys!";

		$cost = $this->properties->get('priceperpack');

		// make sure they can afford it
		$stat = $this->stats->get($this->trader);
		if ($stat->balance < $cost)
			return "Oops: you can't afford that!";

		// go get em
		$result = $this->engine->fillabox($this->trader);

		// charge them for it
		$stat->balance -= $cost;
		$this->stats->update($stat);

		$this->activity->record($this->trader,'bought a box of parts');
		echo json_encode($result);
	}

}
