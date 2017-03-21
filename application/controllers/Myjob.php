<?php

class Myjob extends Application {

	// determine the job of the team by name (parm1) or by token
	public function index()
	{
		$stats = null;
		if (!empty($this->token))
		{
			$prc_session = $this->trading->get($this->token);
			$plant = $prc_session->factory;
		} else
		{
			$plant = $this->uri->segment(1);
		}
		$stats = $this->stats->get($plant);
		echo $stats->making;
	}

}
