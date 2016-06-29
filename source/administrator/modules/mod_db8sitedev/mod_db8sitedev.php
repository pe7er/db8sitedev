<?php
/**
 * @version    CVS: 0.9.4
 * @package    Mod_Db8SiteDev
 * @author     Peter Martin <joomla@db8.nl>
 * @copyright  Copyright (C) 2016 Peter Martin. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die;

// Include dependencies.
require_once __DIR__ . '/helper.php';

// Get module data.
$list = ModDb8sitedevHelper::getItems($params);

// Render the module
require JModuleHelper::getLayoutPath('mod_db8sitedev', $params->get('layout', 'default'));
