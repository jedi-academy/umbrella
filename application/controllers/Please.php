<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Webhook endpoint to trigger deployment
 */
class Please extends CI_Controller {

	public function index()
	{
		// what do we have to work with?
		$payload = json_decode($this->input->post('payload'));

		// extract what we need
		$repository = $payload['repository']['full_name'] ?? NULL;

		// do we know them?
		$plant = $this->plants->find($repository);
		if ($plant == NULL)
			die('Unknown repository');

		// is this an event of interest?
		// respond appropriately
		echo 'Ok';
	}

}
