<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Production extends Application {

	// constructor
	public function __construct()
	{
		parent::__construct();
		$this->theplants = $this->factories->all();
		$this->thestats = $this->stats->all();
	}

	// dummy entry point?
	function index()
	{
		$this->data['pagebody'] = 'coming_soon';
		$this->render();
	}

	// present parts summary stats
	public function parts()
	{
		$this->data['pagebody'] = 'production';

		// extract production #'s
		$bought = 0;
		$returned = 0;
		$made = 0;
		$consumed = 0;
		foreach ($this->thestats as $record)
		{
			$bought += 10 * $record->boxes_bought;
			$returned += $record->parts_returned;
			$made += $record->parts_made;
			$consumed += 3 * $record->bots_built;
		}
		$balance = $bought + $made - $returned - $consumed;

		// parts gauge
		$this->data['bought'] = $bought;
		$this->data['returned'] = $returned;
		$this->data['made'] = $made;
		$this->data['consumed'] = $consumed;
		$this->data['balance'] = $balance;

		$this->render();
	}

	// present bots production summary 
	public function bots()
	{
		$this->data['pagebody'] = 'breakdown';

		echo 'BREAKDOWN ... ';
		// extract & summarize #'s
		$summary = array();
		$total = ['total_quantity' => 0, 'total_amount' => 0];
		foreach ($this->series as $record)
		{
			echo $record->code . ': '.$record->description.'    ';
//			$group = ['series' => $record->description ?? 'None', 'quantity' => 0, 'amount' => 0];
//			foreach ($this->boblog->all() as $one)
//			{
//				echo $record->series . ' / '.$one->series.'     ';
//				if ($one->series == $record->code)
//				{
//					$group['quantity'] ++;
//					$group['amount'] += $one->price;
//				}
//			}
//			$total['total_quantity'] += $group['quantity'];
//			$total['total_amount'] += $group['amount'];
//			if ($group['quantity'] > 0)
//				$group['amount'] /= $group['quantity'];
//			$summary[] = $group;
		}
//		$this->data['breaking'] = $summary;
//		
//		// calc totals
//		if ($total['total_quantity'] > 0)
//			$total['total_amount'] /= $total['total_quantity'];
//		$this->data = array_merge($this->data,$total);

		die();
		$this->render();
	}

	// present income statement summary data
	public function greed()
	{
		$this->data['pagebody'] = 'income_stmt';

		// extract production #'s
		$bought = 0;
		$returned = 0;
		$made = 0;
		$consumed = 0;
		foreach ($this->thestats as $record)
		{
			$bought += 10 * $record->boxes_bought;
			$returned += $record->parts_returned;
			$made += $record->parts_made;
			$consumed += 3 * $record->bots_built;
		}
		$balance = $bought + $made - $returned - $consumed;

		// parts gauge
		$this->data['bought'] = $bought;
		$this->data['returned'] = $returned;
		$this->data['made'] = $made;
		$this->data['consumed'] = $consumed;
		$this->data['balance'] = $balance;

		$this->render();
	}

}
