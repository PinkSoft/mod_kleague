<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_kleague
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Kleague Model
 *
 * @since  0.0.1
 */
class KleagueModelKleague extends JModelItem
{
	/**
	 * @var string message
	 */
	protected $message;
	
	/**
	 * Get the message
         *
	 * @return  string  The message to be displayed to the user
	 */
public function getMsg()
	{
		if (!isset($this->message))
		{
			$jinput = JFactory::getApplication()->input;
			$id     = $jinput->get('id', 1, 'INT');
			switch ($id)
			{
				case 2:
					$this->message = 'WSS 2';
					break;
				case 1:
					$this->message = 'WSS 1';
					break;
				case 3:
					$this->message = 'WSS 3';
					break;
				case 4:
					$this->message = 'WSS 4';
					break;
				case 5:
					$this->message = 'WSS 5';
					break;
				case 6:
					$this->message = 'WSS A1';
					break;
				default:
					$this->message = 'Geen correcte team geselecteerd';
					break;
			}
		}
		return $this->message;
	}
}
