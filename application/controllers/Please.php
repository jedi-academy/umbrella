<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Webhook endpoint to trigger deployment
 */
class Please extends CI_Controller {

	public function index()
	{
		// not usable locally
		if (ENVIRONMENT == 'development')
			die('Not practical locally');

		// is this a real request? Check X-GitHub-Delivery header
		$tag = $this->input->get_request_header('X-GitHub-Delivery');
		if ($tag == NULL)
			die("Not a webhook request");

		// what do we have to work with?
		$incoming = $this->input->raw_input_stream;
		$payload = json_decode($incoming);

		// extract what we need
		$repository = $payload->repository->full_name ?? NULL;
		$event = $this->input->get_request_header('X-GitHub-Event');
		$repo = $payload->repository->name ?? NULL;
		if ($event == 'ping')
		{
			$org = $payload->repository->owner->login ?? NULL;
			$branch = '??';
		} elseif ($event == 'push')
		{
			$org = $payload->repository->owner->name ?? NULL;
			$branch = substr($payload->ref, 11);
		}
		echo $event . ' on ' . $repository . '>' . $branch . PHP_EOL;

		// do we know them?
		$plant = $this->plants->findRepo($org, $repo);
		if ($plant == NULL)
			die('Unknown repository');

		// is this only a ping (testing)
		if ($event == 'ping')
		{
			echo 'Ok';
			return;
		}

		// Is this the branch we are interested in?
		if ($branch != $plant->branch)
		{
			echo 'Not interested';
			return;
		}

		// ok. we have some serious work to do
		$app = $plant->id;
		$base = $plant->base ?? 'comp4711';
		$target = '~/' . $base . '/' . $app;
		$parms = ['base' => $base, 'app' => $app, 'org' => $org, 'repo' => $repo, 'branch' => $branch];
		if (!is_dir($target))
		{
			echo $target . PHP_EOL;
			// create & initialize a git repo
			$script = $this->parser->parse('scripts/create1', $parms, true);
			$result = shell_exec($script);
			echo $result;
		}
		$script = $this->parser->parse('scripts/update1', $parms, true);
		$result = shell_exec($script);
		echo $result;
	}

}
