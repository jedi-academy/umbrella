<?php

class Goodbye extends Application
{

	public function index()
	{
		if (!empty($this->token)) {
			$prc_session = $this->trading->get($this->token);
			$this->trading->delete($this->token);
		}
		redirect('/');
	}

}
