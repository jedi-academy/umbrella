<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Plants extends Application {

	private $items_per_page = 10;

	public function index()
	{
		$this->page(1);
	}

	// Show a single page of todo items
	private function show_page($extract)
	{
		$this->data['pagetitle'] = 'Plant list';

		// build the task presentation output
		$result = ''; // start with an empty array		
		foreach ($extract as $record)
		{
			if (!empty($record->status))
				$task->status = $this->statuses->get($record->status)->name;
//			$record->deployed = date_format($record->deployed,DATE_W3C);
			$stat = $this->stats->get($record->id);
			$record->last_made = $stat->last_made ?? 'Unknown';
			$result .= $this->parser->parse('plantone', (array) $record, true);
		}
		$this->data['display_set'] = $result;

		// and then pass them on
		$this->data['pagebody'] = 'plantlist';
		$this->render();
	}

	// Extract & handle a page of items, defaulting to the beginning
	function page($num = 1)
	{
		$records = $this->factories->all(); // get all the plants
		$extract = array(); // start with an empty extract
		// use a foreach loop, because the record indices may not be sequential
		$index = 0; // where are we in the tasks list
		$count = 0; // how many items have we added to the extract
		$start = ($num - 1) * $this->items_per_page;
		foreach ($records as $record)
		{
			if ($index++ >= $start)
			{
				$extract[] = $record;
				$count++;
			}
			if ($count >= $this->items_per_page)
				break;
		}

		$this->data['pagination'] = $this->pagenav($num);
		$this->show_page($extract);
	}

	// Build the pagination navbar
	private function pagenav($num)
	{
		$lastpage = ceil($this->factories->size() / $this->items_per_page);
		$parms = array(
			'first' => 1,
			'previous' => (max($num - 1, 1)),
			'next' => min($num + 1, $lastpage),
			'last' => $lastpage,
			'base' => 'plants'
		);
		return $this->parser->parse('plantnav', $parms, true);
	}

	// take a closer look at one plant
	function inspect($which = null)
	{
		$record = null;
		if ($which != null)
			$record = $this->factories->get($which);
		if ($record == null)
		{
			$this->page(1);
			return;
		}
		
		$this->data = array_merge($this->data,(array) $record);
		$this->data['pagebody'] = 'plant_inspect';
		$this->render();
	}

	// present all the plants in a grid
	function grid() {
		$this->data['pagetitle'] = 'Plant Grid';

		// build the task presentation output
		$result = ''; // start with an empty array		
		foreach ($this->factories->all() as $record)
		{
			if (!empty($record->status))
				$task->status = $this->statuses->get($record->status)->name;
			$stat = $this->stats->get($record->id);
			$record->last_made = $stat->last_made ?? 'Unknown';
			
			$frag = empty($record->org) ? 'planticon' : 'plantavatar';
			$record->thumbnail = $this->parser->parse($frag,(array)$record,true);
			$result .= $this->parser->parse('plantcell', (array) $record, true);
		}
		$this->data['display_set'] = $result;

		// and then pass them on
		$this->data['pagebody'] = 'plantgrid';
		$this->render();
	}
}
