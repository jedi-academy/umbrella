<?php

/**
 * Work service for factory apps.
 * 
 * This controller provides a number of services that a factory
 * app can request.
 * 
 * @package		Panda Research Center
 * @author		J.L. Parry
 * @link		https://umbrella.jlparry.com/help
 */
class Work extends CI_Controller {

	/**
	 *  Normal entry point ... should never get here
	 */
	public function index()
	{
		redirect('/');
	}

	/**
	 * Register a new trading session for a factory
	 * 
	 * @param	string	$team	Factory (team) name
	 * @param   string  $password Super-secret access token for the factory
	 * @return	The API key
	 */
	function registerme($team = NULL, $password = NULL)
	{
		echo 'Not implemented yet.';
	}

	/**
	 * Purchase a box of random parts for your factory to use
	 * 
	 * @param	string	$key	Factory's API key (passed as query parameter)
	 * @return	An array of parts certificates, JSON formatted
	 */
	function buybox()
	{
		echo 'Not implemented yet.';
	}

	/**
	 * Requests any newly built parts for this factory
	 * 
	 * @param	string	$key	Factory's API key (passed as query parameter)
	 * @return	An array of parts certificates, JSON formatted
	 */
	function mybuilds()
	{
		echo 'Not implemented yet.';
	}

	/**
	 * Ask the PRC to recycle up to three parts that you do not want
	 * 
	 * @param	string	$part1	Certificate code for a part to return
	 * @param	string	$part2	Certificate code for a part to return
	 * @param	string	$part3	Certificate code for a part to return
	 * @param	string	$key	Factory's API key (passed as query parameter)
	 * @return	"Ok AMOUNT" (where AMOUNT is the value credited to your account balance) or an error message
	 */
	function recycle($part1 = NULL, $part2 = NULL, $part3 = NULL)
	{
		echo 'Not implemented yet.';
	}

	/**
	 * Ask the PRC to buy an assembled bot from you
	 * 
	 * @param	string	$part1	Certificate code for the "top" part of your bot
	 * @param	string	$part2	Certificate code for the "torso" part of your bot
	 * @param	string	$part3	Certificate code for the "bottom" part of your bot
	 * @param	string	$key	Factory's API key (passed as query parameter)
	 * @return	"Ok AMOUNT" (where AMOUNT is the value credited to your account balance) or an error message
	 */
	function buymybot($part1 = NULL, $part2 = NULL, $part3 = NULL)
	{
		echo 'Not implemented yet.';
	}

	/**
	 * Restart your bot factory's participation in the current trading session
	 * 
	 * @param	string	$key	Factory's API key (passed as query parameter)
	 * @return	"Ok AMOUNT" (where AMOUNT is the starting balance assigned to you) or an error message
	 */
	function rebootme()
	{
		echo 'Not implemented yet.';
	}

	/**
	 * Destroy your plants' PRC trading session
	 * 
	 * @param	string	$key	Factory's API key (passed as query parameter)
	 * @return	 "Ok" or an error message
	 */
	function goodbye()
	{
		echo 'Not implemented yet.';
	}

}
