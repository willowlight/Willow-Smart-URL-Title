<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Willow_smart_url_title_upd {

	public $version = '1.1.1';

	public function __construct()
	{
	}

	// ----------------------------------------------------------------

	/**
	 * Installation Method
	 *
	 * @return 	boolean 	TRUE
	 */
	function install()
	{
		$data = array(
		   'module_name' => 'Willow_smart_url_title',
		   'module_version' => $this->version,
		   'has_cp_backend' => 'n',
		   'has_publish_fields' => 'n'
		);
		ee()->db->insert('modules', $data);

		$data = array(
   			'class'     => 'Willow_smart_url_title' ,
   			'method'    => 'check_url_title',
   			'csrf_exempt' => 0
		);
		ee()->db->insert('actions', $data);


		return TRUE;
	}


	function uninstall()
	{
		ee()->db->delete('modules', array('module_name' => 'Willow_smart_url_title'));
		ee()->db->delete('actions', array('class' => 'Willow_smart_url_title'));

		return TRUE;
	}

	function update($current = '')
	{

		if ($current === $this->version)
		{
			return FALSE;
		}

		return TRUE;
	}

}
