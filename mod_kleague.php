<?php

// No direct access
defined('_JEXEC') or die;
// Include the syndicate functions only once
require_once dirname(__FILE__) . '/helper.php';

// get a parameter from the module's configuration


$show = (int) $params->get('show');
$no = (int) $params->get('no') ;
$days = (int) $params->get('days') ;
$club = (int) $params->get('club');

//echo $days;

if ($show==0)
{
	$matches = modKleagueHelper::getResults($no, $days, $club);
}
else 
{
	$matches = modKleagueHelper::getMatches($no, $days, $club);
}
require( JModuleHelper::getLayoutPath( 'mod_kleague' ) );
?>
