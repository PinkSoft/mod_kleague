<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$show = $params->get('show');
$days = $params->get('days');

if ($show==0) //results
{
	if (count($matches)==0)
	{
		
		echo 'Er zijn de afgelopen '. $days . " dagen geen wedstrijden gespeeld";
		
	}
	else 
	{	
		?><table><?php
		foreach ($matches as $match) 
		{
			// only php 5.3: $date = date_create_from_format('Y-m-d H:i:s', $match->date);
			// only php 5.3: $matchDate = date_format($date, 'd-m');
			$date = new DateTime($match->date);
			$matchDate = $date->format('d-m');
			$matchString = $match->home. " - " .$match->visitor;
			$matchResult = $match->FT_Home. " - " .$match->FT_Visitor;
       		$link = 'index.php?option=com_kleague&id='.$match->idMatch.'&view=match';
       		// table
       		?>
       		<tr>
    			<td><?php echo '<a href="'.$link.'"> '. JText::sprintf($matchDate) . '   '. JText::sprintf($matchString) . ' </a>'; ?></td>
    			<td><div align = right><?php echo JText::sprintf($matchResult); ?></div></td>
			</tr>
			<?php 
		}	
		?></table><?php
	}
}
else //matches
{
	if (count($matches)==0)
	{
		
		?><ul><?php
		 	echo 'Er zijn de komende '. $days . " dagen geen wedstrijden";
		?></ul><?php
	}
	else 
	{
		?><ul><?php
		foreach ($matches as $match) 
		{
			// only php 5.3: $date = date_create_from_format('Y-m-d H:i:s', $match->date);
			// only php 5.3: $matchDate = date_format($date, 'd-m  H:i');
			$date = new DateTime($match->date);
			$matchDate = $date->format('d-m  H:i');
			$matchString = $match->home. " - " .$match->visitor;
			$matchCity = $match->FT_Home. " - " .$match->FT_Visitor;
        	$link = 'index.php?option=com_kleague&id='.$match->idMatch.'&view=match';?>
			<li>
                <?php echo '<a href="'.$link.'"> '. JText::sprintf($matchDate) . '   '. JText::sprintf($matchString) . ' </a>'; ?>
			</li>
			<?php 
		}
		?></ul><?php
	}
}
