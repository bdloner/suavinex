<?php
/**
* Plugin Name: Forminator Pro - Change Upload Path
* Plugin URI: https://wpmudev.com/
* Description: mu-plugin for changing the Forminator upload dir to /uploads/ID.
* Version: 1.0.0
* Author: Konstantinos Xenos @ WPMUDEV
* Author URI: https://wpmudev.com/
* License: GPLv2 or later
* https://gist.github.com/wpmudev-sls/46d776223d9d54c732fd409b2e78c8a9
*/

class Change_Forminator_Upload_Dir {
	private $new_dir_id = 0;
	public function __construct() {
		// For non Ajax submit.
		add_action('forminator_form_before_handle_submit', [$this,'my_form_change_upload_dir',]);
		add_action('forminator_form_after_handle_submit', [$this,'my_form_restore_upload_dir',]);
		// For Ajax submit.
		add_action('forminator_form_before_save_entry', [$this,'my_form_change_upload_dir',]);
		add_action('forminator_form_after_save_entry', [$this,'my_form_restore_upload_dir',]);
	}

  /**
	* Hook into Forminator and apply the upload_dir filter.
	*
	* @param int $form_id The form ID.
	*/
	public function my_form_change_upload_dir($form_id) {
		$this->new_dir_id = $form_id;
		add_filter('upload_dir', [$this, 'my_form_ad_formid_to_upload_dir']);
	}
  
	/**
	* Hook into the upload_dir filter and change the path.
	*
	* @param array $param The upload dir parameters array.
	*/

	public function my_form_ad_formid_to_upload_dir($param) {
			$new_path = '/forminator/' . date('Y') . '/' . date('m');
			$param['path'] = $param['basedir'] . $new_path;
			$param['url'] = $param['baseurl'] . $new_path;
			return $param;
	}

	/**
	* Hook into Forminator and remove the upload_dir filter.
	*
	* @param int $form_id The form ID.
	*/
	public function my_form_restore_upload_dir($form_id) {
		$this->new_dir_id = 0;
		remove_filter('upload_dir', [$this, 'my_form_ad_formid_to_upload_dir']);
	}
}

new Change_Forminator_Upload_Dir();