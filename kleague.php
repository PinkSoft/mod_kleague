<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_kleague
 *
 * @copyright   Copyright (C) 2016 Berend Pinkster
 * @license     GNU General Public License version 2 or later
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// Get an instance of the controller prefixed by Kleague
$controller = JControllerLegacy::getInstance('Kleague');

// Perform the Request task
$input = JFactory::getApplication()->input;
$controller->execute($input->getCmd('task'));

// Redirect if set by the controller
$controller->redirect();