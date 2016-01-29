<?php
/**
*
* @package Copy New Topic Extension
* @copyright (c) 2016 david63
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace david63\copynewtopic\event;

/**
* @ignore
*/
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class listener implements EventSubscriberInterface
{
	/** @var string phpBB table prefix */
	protected $phpbb_table_prefix;

	/** @var \phpbb\config\config */
	protected $config;

	/**
	* Constructor for listener
	*
	* @param string					$phpbb_table_prefix
	* @param \phpbb\config\config	$config				Config object
	*
	* @return \david63\copynewtopic\event\listener
	* @access public
	*/
	public function __construct($phpbb_table_prefix, \phpbb\config\config $config)
	{
		$this->table_prefix	= $phpbb_table_prefix;
		$this->config		= $config;
	}

	/**
	* Assign functions defined in this class to event listeners in the core
	*
	* @return array
	* @static
	* @access public
	*/
	static public function getSubscribedEvents()
	{
		return array(
			'core.posting_modify_submit_post_after' 	=> 'copy_topic',
			'core.posting_modify_submit_post_before'	=> 'lock_edit',
			'core.submit_post_modify_sql_data'			=> 'set_post_count',
		);
	}

	/**
	* Copy a new topic to another forum
	*
	* @param object $event The event object
	* @return null
	* @access public
	*/
	public function copy_topic($event)
	{
		$mode = $event['mode'];
		$data = $event['data'];

		if ($mode == 'post' && $data['forum_id'] == $this->config['copy_topic_from_forum'])
		{
			$data['forum_id']				= $this->config['copy_topic_to_forum'];
			// We need to make sure the topic does not need approval in the "to" forum
			$data['force_approved_state']	= ITEM_APPROVED;
			$poll							= $event['poll'];
			$post_author_name				= $event['post_author_name'];
			$post_data						= $event['post_data'];
			$update_message					= $event['update_message'];

			submit_post($mode, $post_data['post_subject'], $post_author_name, $post_data['topic_type'], $poll, $data, $update_message, ($update_message || $update_subject) ? true : false);
		}
	}

	/**
	* Lock editing of the topic
	*
	* @param object $event The event object
	* @return null
	* @access public
	*/
	public function lock_edit($event)
	{
		$mode = $event['mode'];
		$data = $event['data'];

		if ($mode == 'post' && $data['forum_id'] == $this->config['copy_topic_from_forum'])
		{
			// We need to make sure that the user cannot edit the topic
			// Admin and Mods will still be able to edit it
			$data['post_edit_locked'] = true;

			$event->offsetSet('data', $data);
		}
	}

	/**
	* Do not increase the user's post count when copying the topic
	*
	* @param object $event The event object
	* @return null
	* @access public
	*/
	public function set_post_count($event)
	{
		$post_mode	= $event['post_mode'];
		$data		= $event['data'];

		if ($post_mode == 'post' && $data['forum_id'] == $this->config['copy_topic_to_forum'])
		{
			// We do not want to increase the user's post count when copying the topic
			$sql_data = $event['sql_data'];

			$sql_data[$this->table_prefix . 'users']['stat'][0] = substr($sql_data[$this->table_prefix . 'users']['stat'][0], 0, -4);

			$event->offsetSet('sql_data', $sql_data);
		}
	}
}
