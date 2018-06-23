<?php
class modKleagueHelper
{
	/**
	 * Retrieves the comming matches
	 *
	 * @param array $params An object containing the module parameters
	 * @access public
	 */
	function getMatches($no, $days, $club)
	{
		//get a reference to the database
		$db = &JFactory::getDBO();
		
		// get a list of schedulerd matches
		$query = 'SELECT km.idMatch,
       				kh.teamName AS home,
       				kv.teamName AS visitor,
       				km.date,
       				km.FT_Home,
       				km.FT_Visitor,
       				kh.idClub,
       				kv.idClub,
       				km.active
  				FROM (#__kleague_matches km 
  				INNER JOIN #__kleague_teams kv ON (km.idVisitor = kv.idTeam))
       			INNER JOIN #__kleague_teams kh ON (km.idHome = kh.idTeam)
				WHERE ((kh.idClub = '. $club .') OR (kv.idClub = '. $club .')) 
					AND (km.active = 1) AND (km.date > NOW())
				ORDER BY km.date LIMIT '.$no;
				
		$db->setQuery($query);
		$matches = ($matches = $db->loadObjectList())?$matches:array();
		
		return $matches;
		
		
		//return 'De wedstrijden';
	}
	
	/**
	* Retrieves the results of the matches
	*
	* @param array $params An object containing the module parameters
	* @access public
	*/
	function getResults($no, $days, $club)
	{
		//get a reference to the database
		$db = &JFactory::getDBO();
		
		// get a list of p-laued matches
		$query = 'SELECT km.idMatch,
       				kh.teamName AS home,
       				kv.teamName AS visitor,
       				km.date,
       				km.FT_Home,
       				km.FT_Visitor,
       				kh.idClub,
       				kv.idClub,
       				km.active
  				FROM (#__kleague_matches km 
  				INNER JOIN #__kleague_teams kv ON (km.idVisitor = kv.idTeam))
       			INNER JOIN #__kleague_teams kh ON (km.idHome = kh.idTeam)
				WHERE ((kh.idClub = '. $club .') OR (kv.idClub = '. $club .')) 
					AND (km.active = 1) AND (km.date < NOW())
				ORDER BY km.date DESC LIMIT '.$no;
		//echo $query;
				
		$db->setQuery($query);
		$matches = ($matches = $db->loadObjectList())?$matches:array();
		//echo count($matches);
		
		return $matches;
	}
}

