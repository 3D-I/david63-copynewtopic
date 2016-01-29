<?php
/**
*
* @package Copy New Topic Extension
* @copyright (c) 2016 david63
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace david63\copynewtopic\acp;

class copynewtopic_info
{
	function module()
	{
		return array(
			'filename'	=> '\david63\copynewtopic\acp\copynewtopic_module',
			'title'		=> 'COPY_NEW_TOPIC',
			'modes'		=> array(
				'main'	=> array('title' => 'COPY_NEW_TOPIC_MANAGE', 'auth' => 'ext_david63/copynewtopic && acl_a_board', 'cat' => array('COPY_NEW_TOPIC')),
			),
		);
	}
}
