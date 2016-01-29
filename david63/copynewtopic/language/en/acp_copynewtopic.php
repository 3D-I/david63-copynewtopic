<?php
/**
*
* @package Cookie Policy Extension
* @copyright (c) 2014 david63
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

/// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
	'COPY_NEW_TOPIC_EXPLAIN'		=> 'Set the options for automatically copying a new topic from one forum to another.',
	'COPY_TOPIC_FROM_FORUM'			=> 'Copy from',
	'COPY_TOPIC_FROM_FORUM_EXPLAIN'	=> 'The forum from which you want the new topic to be copied from.',
	'COPY_NEW_TOPIC_OPTIONS'		=> 'Options',
	'COPY_TOPIC_TO_FORUM'			=> 'Copy to',
	'COPY_TOPIC_TO_FORUM_EXPLAIN'	=> 'The forum to which yoy want the new topic to be copied to.',

	'FORUMS_INVALID'				=> 'The from and to forums cannot be the same.'
));
