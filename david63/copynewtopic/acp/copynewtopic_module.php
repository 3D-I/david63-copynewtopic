<?php
/**
*
* @package Copy New Topic Extension
* @copyright (c) 2016 david63
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace david63\copynewtopic\acp;

class copynewtopic_module
{
	public $u_action;

	function main($id, $mode)
	{
		global $phpbb_container, $user;

		$this->tpl_name		= 'copynewtopic_manage';
		$this->page_title	= $user->lang('COPY_NEW_TOPIC');

		// Get an instance of the admin controller
		$admin_controller = $phpbb_container->get('david63.copynewtopic.admin.controller');

		$admin_controller->display_options();
	}
}
