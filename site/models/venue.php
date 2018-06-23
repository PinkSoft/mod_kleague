<?php
/**
 * Venue Model for Kleague Component
 * 
 * @package    Joomla.Tutorials
 * @subpackage Components
 * @link http://dev.joomla.org/component/option,com_jd-wiki/Itemid,31/id,tutorials:components/
 * @license		GNU/GPL
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.model' );

class KleagueModelVenue extends JModelLegacy
{
	
	/**
	* @var array matches
	*/
	
	var $idVenue = null;
	
	function __construct()
	{
		parent::__construct();
		
		$pid = (int) JRequest::getVar('id');
		//echo '$mid = '.$mid.'<br>';
		$this->idVenue = $pid;
		//$this->idMatch = $mid;
	}
	
	/**
	 * Gets the greeting
	 * @return string The greeting to be displayed to the user
	 */
	
	
	
	function getVenue()
	{
		$db =& JFactory::getDBO();
		//echo '$idvenue = '.$this->idVenue. ' <BR>';
		
		$query = 'SELECT tp.*
  					FROM #__kleague_venues tp 
					WHERE idVenue = '. $this->idVenue;
	
		$db->setQuery($query);
		$venue = ($venue = $db->loadObject());
	
		return $venue;
	
	}
	
	
}
