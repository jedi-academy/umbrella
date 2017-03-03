<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application {

	// constructor
	function __construct()
	{
		parent::__construct();
		$this->plants = $this->factories->all();
		$this->stats = $this->stats->all();
	}

	// main dashboard
	public function index()
	{
		$this->data['pagebody'] = 'homepage';

		// plants gauge
		$total_plants = count($this->plants);
		$active_plants = 0;
		foreach ($this->plants as $record)
			if ($record->org != null)
				$active_plants++;
		$this->data['plants'] = $this->metric('Active Plants', $active_plants, 'primary', 'industry', '/plants', $total_plants . ' plants licensed');

		// boxes gauge
		$this->data['boxes'] = $this->metric('Boxes of parts bought', 77, 'success', 'cubes', '/boxes');
		// parts gauge
		$this->data['parts'] = $this->metric('Parts made', 6, 'green', 'cogs', '/plants');
		// returns gauge
		$this->data['returns'] = $this->metric('Parts returned', 23, 'info', 'recycle', '/plants');
		// transfers gauge
		$this->data['transfers'] = $this->metric('Parts transferred', 4, 'warning', 'handshake-o', '/boxes');
		// builds gauge
		$this->data['builds'] = $this->metric('Bots built', 6, 'danger', 'child', '/bots');
		// greed gauge
		$this->data['bucks'] = $this->metric('Greed meter', 1234, 'primary', 'dollar', '/plants');

		// bots breakdown chart
		$this->caboose->needed('morris', 'morris-donut-chart');
		$parms = ['donuts' => [
				['label' => "Household", 'value' => 6],
				['label' => "Butler", 'value' => 12],
				['label' => "Companion", 'value' => 4],
				['label' => "Motley", 'value' => 30],
		]];
		$this->data['donuts'] = $this->parser->parse('donuts', $parms, true);

		// tasks history panel
		$this->data['tasks'] = $this->parser->parse('tasks', $parms, true);
		// transactions history panel
		$this->data['transactions'] = $this->parser->parse('transactions', $parms, true);

		$this->render();
	}

	function metric($text, $value, $panel, $icon, $link, $subtitle = 'View Details')
	{
		$parms = ['text' => $text, 'value' => $value, 'panel' => $panel,
			'icon' => $icon, 'link' => $link, 'subtitle' => $subtitle];
		return $this->parser->parse('theme/_metric', $parms, true);
	}

}
