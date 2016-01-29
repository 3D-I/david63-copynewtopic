<?php
/**
*
* @package Copy New Topic Extension
* @copyright (c) 2016 david63
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace david63\copynewtopic\migrations;

class version_1_1_0 extends \phpbb\db\migration\migration
{
	public function update_data()
	{
		return array(
			array('config.add', array('copy_topic_from_forum', '0')),
			array('config.add', array('copy_topic_to_forum', '0')),

			// Add the ACP module
			array('module.add', array('acp', 'ACP_CAT_DOT_MODS', 'COPY_NEW_TOPIC')),

			array('module.add', array(
				'acp', 'COPY_NEW_TOPIC', array(
					'module_basename'	=> '\david63\copynewtopic\acp\copynewtopic_module',
					'modes'				=> array('main'),
				),
			)),
		);
	}
}
