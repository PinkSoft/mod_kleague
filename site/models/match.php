<?php
/**
 * Match Model for Kleague Component
 * 
 * @package    Joomla.Tutorials
 * @subpackage Components
 * @link http://dev.joomla.org/component/option,com_jd-wiki/Itemid,31/id,tutorials:components/
 * @license		GNU/GPL
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.model' );

class KleagueModelMatch extends JModelLegacy
{
	
	/**
	* @var array matches
	*/
	protected $match;
	var $idMatch = null;
	
	function __construct()
	{
		parent::__construct();
		
		$mid = (int) JRequest::getVar('id');
		//echo '$mid = '.$mid.'<br>';
		$this->idMatch = $mid;
		//$this->idMatch = $mid;
	}
	
	/**
	 * Gets the greeting
	 * @return string The greeting to be displayed to the user
	 */
	function getMatch()
	{
		$db =& JFactory::getDBO();
		//echo '$idMatch = ' . $this->idMatch . ' <BR>';
		$query = 'SELECT * FROM #__kleague_matches WHERE idMatch = '. $this->idMatch;
				
		$db->setQuery($query);
		$match = $db->loadObject();
		$this->match = $match;
		return $match;
	}
	
	function getHomeTeam()
	{
		$db =& JFactory::getDBO();
		$query = 'SELECT tt.*, tc.*
  					FROM    #__kleague_teams tt
       				INNER JOIN
          				#__kleague_clubs tc
      				ON (tt.idClub = tc.idClub) WHERE idTeam = '.$this->match->idHome;
	
		$db->setQuery($query);
		$team = $db->loadObject();
		//print_r($team);
		return $team;
	
	}
	
	function getVisitorTeam()
	{
		$db =& JFactory::getDBO();
		$query = 'SELECT tt.*, tc.*
	  					FROM    #__kleague_teams tt
	       				INNER JOIN
	          				#__kleague_clubs tc
	      				ON (tt.idClub = tc.idClub) WHERE idTeam = '.$this->match->idVisitor;
	
		$db->setQuery($query);
		$team = $db->loadObject();
		//print_r($team);
		return $team;
	
	}
	
	
	function getVenue()
	{
		$db =& JFactory::getDBO();
		//echo '$idvenue = '.$this->match->idVenue. ' <BR>';
		
		$query = 'SELECT tp.*
  					FROM #__kleague_venues tp 
					WHERE idvenue = '. $this->match->idVenue;
	
		$db->setQuery($query);
		$venue = ($venue = $db->loadObject());
	
		return $venue;
	
	}
	
	function getMatchEvents()
	{
		$db =& JFactory::getDBO();
		
	
		$query = 'SELECT tme.*, tet.name, tet.image,
       				thp.firstName AS hFirstName,
      	 			thp.lastName AS hLastName,
       				tvp.firstName AS vFirstName,
       				tvp.lastName AS vLastName,
       				tme.idMatch
  				FROM ((#__kleague_match_events tme INNER JOIN #__kleague_event_types tet
               		ON (tme.idEvent = tet.idEventType))
           		LEFT OUTER JOIN #__kleague_players thp ON (tme.idPlayerHome = thp.idPlayer))
       			LEFT OUTER JOIN #__kleague_players tvp ON (tme.idPlayerVisitor = tvp.idPlayer)
 				WHERE tme.idMatch = '. $this->idMatch;
		
		//echo print_r($query);
	
		$db->setQuery($query);
		$events = ($events = $db->loadObjectList())?$events:array();
	
		return $events;
	
	}
	
	function getLineup()
	{
		$db =& JFactory::getDBO();
		$idmatch = 125;
		$days = 90;
		$no = 25;
	
		$query = 'SELECT * FROM #__kleague_match WHERE idMatch = '. $idMatch;
	
		$db->setQuery($query);
		$match = ($match = $db->loadObjectList())?$match:array();
	
		return $match;
	
	}
}
