<?php
/**
 * program Model for Kleague Component
 * 
 * @package    Joomla.Tutorials
 * @subpackage Components
 * @link http://dev.joomla.org/component/option,com_jd-wiki/Itemid,31/id,tutorials:components/
 * @license		GNU/GPL
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.model' );

class KleagueModelProgram extends JModelLegacy
{
	
	/**
	* @var array matches
	*/
	protected $matches;
	var $no = null;
	var $days = null;
	var $club = null;
	var $season = null;
	
	function __construct()
	{
		parent::__construct();
		// get the application object
		$application =& JFactory::getApplication();
		// get the page parameters
		$params =& $application->getParams();
		//print_r($params);
		$this->club = $params->get('clubId', '1');
		$this->days = $params->get('days', '25');
		$this->no =$params->get('number', '20');
		$this->season =$params->get('season', '20');
		
		//for debugging;
		/*
		 echo "Club: ";
		 echo $this->club;
		 echo " - season: ";
		 echo $this->season;
		 echo " - number: ";
		 echo $this->no;
		 echo " - days: ";
		 echo $this->days;
		*/ 
	}
	
	/**
	 * Gets the greeting
	 * @return string The greeting to be displayed to the user
	 */
	function getMatches()
	{
		$db =& JFactory::getDBO();
		$query = 'SELECT tm.*, th.*, tv.*, tl.*,
       				th.teamName AS homeName,
       				tv.teamName AS visitorName,
       				th.idClub AS idHomeClub,
       				tv.idClub AS idVisitorClub
  				FROM ( ( #__kleague_matches tm INNER JOIN #__kleague_teams th ON (tm.idHome = th.idTeam))
           		INNER JOIN #__kleague_teams tv ON (tm.idVisitor = tv.idTeam))
      	 		INNER JOIN #__kleague_leagues tl ON (tl.idLeague = tm.idLeague)
       			WHERE (th.idclub = ' . $this->club . ' OR tv.idClub = ' . $this->club . ') AND (tm.active = 1) 
       			AND (tm.date > NOW()- INTERVAL '.$this->days.' DAY) AND (tl.idSeason = '. $this->season .')
				ORDER BY date LIMIT '. $this->no;
		
		$db->setQuery($query);
		$matches = ($matches = $db->loadObjectList())?$matches:array();
				
		return $matches;
		
	}
}
