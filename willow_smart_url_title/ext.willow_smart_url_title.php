<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Willow_smart_url_title_ext {

    var $settings        = array();
    public $version         = '1.1.1';

    function __construct($settings='')
    {
        $this->settings = $settings;
    }


    public function activate_extension()
    {
        // Setup custom settings in this array.
        $this->settings = array();

        $data = array(
            'class'     => __CLASS__,
            'method'    => 'add_smart_url_script',
            'hook'      => 'cp_js_end',
            'settings'  => serialize($this->settings),
            'version'   => $this->version,
            'enabled'   => 'y'
        );
        ee()->db->insert('extensions', $data);

    }

    function add_smart_url_script()
    {
        $js = ee()->extensions->last_call ?: '';
        $query = ee()->db->select("action_id")
            ->from('actions')
            ->where('class', 'Willow_smart_url_title')
            ->get();
        if ($query->num_rows() > 0)
        {
            $row = $query->row();
            $js .= str_replace('act = 0', 'act = ' . $row->action_id, file_get_contents(PATH_THIRD . 'willow_smart_url_title/javascript/willow.js'));
        }
        return $js;
    }

    function disable_extension()
    {
        ee()->db->where('class', __CLASS__);
        ee()->db->delete('extensions');
    }

    function update_extension($current = '')
    {
        if ($current == '' OR $current == $this->version)
        {
            return FALSE;
        }
    }

    // END
}
// END CLASS