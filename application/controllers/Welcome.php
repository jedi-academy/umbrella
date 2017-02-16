<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application {

	public function index()
	{
		$this->data['pagebody'] = 'homepage';

		$this->data['plants'] = $this->metric('Plants active', 24, 'primary', 'industry', '/plants');
		$this->data['boxes'] = $this->metric('Boxes of parts bought', 77, 'success', 'cubes', '/boxes');
		$this->data['parts'] = $this->metric('Parts made', 6, 'green', 'cogs', '/plants');
		$this->data['returns'] = $this->metric('Parts returned', 23, 'info', 'recycle', '/plants');
		$this->data['transfers'] = $this->metric('Parts transferred', 4, 'warning', 'handshake-o', '/boxes');
		$this->data['builds'] = $this->metric('Bots built', 6, 'danger', 'child', '/bots');
		$this->data['bucks'] = $this->metric('Greed meter', 1234, 'primary', 'dollar', '/plants');
		
		$this->caboose->needed('morris','morris-donut-chart');
		$parms = ['donuts'=> [
			['label'=> "Household", 'value'=> 6],
			['label'=> "Butler", 'value'=> 12],
			['label'=> "Companion", 'value'=> 4],
			['label'=> "Motley", 'value'=> 30],
 		]];
		$this->data['donuts'] = $this->parser->parse('donuts',$parms,true);
		
		$this->data['tasks'] = $this->parser->parse('tasks',$parms,true);
		$this->data['transactions'] = $this->parser->parse('transactions',$parms,true);
		
		$this->render();
	}

	function metric($text, $value, $panel, $icon, $link)
	{
		$parms = ['text' => $text, 'value' => $value, 'panel' => $panel, 'icon' => $icon, 'link' => $link];
		return $this->parser->parse('theme/_metric', $parms, true);
	}

}
