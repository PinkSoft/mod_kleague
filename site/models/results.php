<?php
/**
 * Kleague Model for Kleague Component
 * 
 * @package    Joomla.Tutorials
 * @subpackage Components
 * @link http://dev.joomla.org/component/option,com_jd-wiki/Itemid,31/id,tutorials:components/
 * @license		GNU/GPL
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.model' );

class KleagueModelResults extends JModel
{
	
	/**
	* @var array matches
	*/
	protected $matches;
	
	/**
	 * Gets the greeting
	 * @return string The greeting to be displayed to the user
	 */
	function getMatches()
	{
		$db =& JFactory::getDBO();

		$query = 'SELECT * FROM #__kleague_matches ORDER BY date DESC LIMIT 25';
		$db->setQuery($query);
		$matches = ($matches = $db->loadObjectList())?$matches:array();
				
		return $matches;
		
	}
}
