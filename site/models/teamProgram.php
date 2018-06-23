<?php
/**
 * TeamProgram Model for Kleague Component
 * 
 * @package    Joomla.Tutorials
 * @subpackage Components
 * @since 0.0.6
 * @version 0.1.0
 * @license		GNU/GPL
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.model' );

class KleagueModelTeamProgram extends JModelLegacy
{
	
	/**
	* @var array matches
	*/
	protected $matches;
	var $no = null;
	var $days = null;
	var $team = null;
	var $season = null;
	var $league = null;
	
	function __construct()
	{
		parent::__construct();
		// get the application object
		$application =& JFactory::getApplication();
		// get the page parameters
		$params =& $application->getParams();
		//print_r($params);
		$this->team = (int) $params->get('team', '1');
		$this->days = (int) $params->get('days', '25');
		$this->no = (int) $params->get('no', '20');
		$this->season = (int) $params->get('season', '20');
		$this->league = (int) $params->get('league', '1');
		
		//for debugging;
		/*
		echo "team: ";
		echo $this->team;
		echo " - season: ";
		echo $params->get('season', '20');
		echo " - number: ";
		echo $this->no;
		echo " - days: ";
		echo $params->get('days', '25');
		echo " - league: ";
		echo $params->get('league', '1');
		*/
	}
	
	function getTeamName()
	{
		$db =& JFactory::getDBO();
		$query = 'SELECT * FROM #__kleague_teams WHERE idTeam = '. $this->team;
		$db->setQuery($query);
		$team = $db->loadObject();
		return $team->teamName;
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
       				tv.teamName AS visitorName
  					FROM ( ( #__kleague_matches tm INNER JOIN #__kleague_teams th ON (tm.idHome = th.idTeam))
           			INNER JOIN #__kleague_teams tv ON (tm.idVisitor = tv.idTeam))
      	 			INNER JOIN #__kleague_leagues tl ON (tl.idLeague = tm.idLeague)
		       		WHERE (tm.idHome = ' . $this->team . ' OR tm.idVisitor = ' . $this->team . ') AND (tm.active = 1) 
		       			AND (tm.date > NOW()- INTERVAL '.$this->days.' DAY) AND (tl.idSeason = '. $this->season .')
					ORDER BY date LIMIT '. $this->no;
		
		$db->setQuery($query);
		$matches = ($matches = $db->loadObjectList())?$matches:array();
				
		return $matches;
	}
		
	/**
	* @var array Results
	*/
	function getResults()
	{
		$db =& JFactory::getDBO();
			
		$query = 'SELECT tm.*, th.*, tv.*, tl.*,
       				th.teamName AS homeName,
       				tv.teamName AS visitorName
  					FROM ( ( #__kleague_matches tm INNER JOIN #__kleague_teams th ON (tm.idHome = th.idTeam))
           			INNER JOIN #__kleague_teams tv ON (tm.idVisitor = tv.idTeam))
      	 			INNER JOIN #__kleague_leagues tl ON (tl.idLeague = tm.idLeague)
		       		WHERE (tm.idHome = ' . $this->team . ' OR tm.idVisitor = ' . $this->team . ') AND (tm.active = 1) 
		       			AND (tm.date < NOW()) AND (tl.idSeason = '. $this->season .')
					ORDER BY date LIMIT '. $this->no;
		
		$db->setQuery($query);
		$results = ($results = $db->loadObjectList())?$results:array();
		
		return $results;
	}

	/**
	* @var array Ranking
	*/
	
	function getRanking()
	{
		$db =& JFactory::getDBO();
		
	
		$query = 'SELECT * FROM #__kleague_league_teams 
	       			WHERE idLeague = '.$this->league.' AND active = 1 ';
	       			
		$ranking;
		// load teams
		$db->setQuery($query);
		$teams = ($teams = $db->loadObjectList())?$teams:array();
		$i=0;
		foreach ($teams as $team) 
		{
			$rank[i] = array('rank'=> 1,
								'team'=> $team->name,
								'matches'=> 0,
								'win'=> 0,
								'even'=> 0,
								'lost'=> 0,
								'points'=> $team.initalPoints,
								'scorePlus'=> 0,
								'scoreMinus'=> 0);
					$i++;
					$ranking.add($rank);
		}
		//process matches
		$this->resultList = $this->get('Results');
		foreach ($this->resultList as $result) 
		{
			
			$resultString = $result->homeName. " - " .$result->visitorName;
			
        	$result->FT_Home .' - '. $result->FT_Visitor;
       				
		} 
		// sort table
		
		return $ranking;
		
	}
	
}
