<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Willow_smart_url_title {
	
	
	public function __construct()
	{

	}

	function check_url_title() 
	{
		$url_title = ee()->input->post('url_title', true);
		$channel_id = ee()->input->post('channel_id', true);
		$entry_id = ee()->input->post('entry_id', true);

		// Check to see if this is an existing entry

		$entry = ee('Model')->get('ChannelEntry')
			->filter('channel_id', $channel_id)
			->filter('url_title', $url_title)			
			->filter('entry_id', '!=', $entry_id)
			->fields('entry_id')
			->first();

		ee()->config->config['send_headers'] = NULL;
		@header('Content-Type: application/json; charset=UTF-8');

		// If new entry, check URL title against database

		if ($entry)
		{
			$fields = [];
			$fields['found'] = true;
			$found = FALSE;
			$num = 2;
			while ($found == FALSE)
			{
				$new_url_title = $url_title;

				// If URL title is already at the max-length, replace last two characters with -#

				if (strlen($url_title) > 198)
				{
					if (substr($url_title, -2, 1) === '-' AND is_numeric(substr($url_title, -1)))
					{
						$new_url_title = substr_replace($url_title, $num, -1);
					}				
				}
				else 
				{
					$new_url_title .= '-' . $num;
				}
				$entry = ee('Model')->get('ChannelEntry')
					->filter('channel_id', $channel_id)
					->filter('url_title', $new_url_title)			
					->filter('entry_id', '!=', $entry_id)
					->fields('entry_id')
					->first();

				// Increase number if alternate URL already exists

				if ($entry)
				{
					$num++;
				}
				else 
				{
					$found = TRUE;
					$url_title = $new_url_title;
					$fields['not_changed'] = false;					
				}

				// To avoid long loop, addon stops at 10 alternate URL titles.

				if ($num > 9)
				{
					$found = TRUE;
					$fields['not_changed'] = true;
				}
			}
			$fields['url_title'] = $url_title;
			ee()->output->send_ajax_response(json_encode($fields));
		}

		// Existing entry so no check is performed

		else
		{
			$found = false;
			ee()->output->send_ajax_response(json_encode($found));
		}
	}
}