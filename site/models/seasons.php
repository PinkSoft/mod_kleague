<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_kleague
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Seasons Model
 *
 * @since  0.0.1
 * @version 0.0.1
 */
class KleaguesModelSeasons extends JModelItem
{
	/**
	 * @var array messages
	 */
	protected $seasons;
	
	/**
	 * Method to get a table object, load it if necessary.
	 *
	 * @param   string  $type    The table name. Optional.
	 * @param   string  $prefix  The class prefix. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return  JTable  A JTable object
	 *
	 * @since   1.6
	 */
	 public function getTable($type = 'Seasons', $prefix = 'KleagueTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
	/**
	 * Get the leagues
	 *
	 * @param   integer  $id  League Id
	 *
	 * @return  string        Fetched String from Table for relevant Id
	 */
	public function getLeague($id = 1)
	{
		if (!is_array($this->seasons))
		{
			$this->seasons = array();
		}
		
		if (!isset($this->seasons[$id]))
		{
			// Request the selected id
			$jinput = JFactory::getApplication()->input;
			$id     = $jinput->get('idSeason', 1, 'INT');
			
			// Get a TableLeagues instance
			$table = $this->getTable();
			
			// Load the league
			$table->load($id);
			
			// Assign the name
			$this->seasons[$id] = $table->name;
		}

		return $this->seasons[$id];
	}
}