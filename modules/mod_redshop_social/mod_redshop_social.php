<?php
/**
 * @package		redSlider
 * @subpackage	mod_redslider
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once dirname(__FILE__).'/helper.php';

$list = modRedShopSocialHelper::getList($params);

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
$introtext = $params->get('introtext', '');

require JModuleHelper::getLayoutPath('mod_redshop_social', $params->get('layout', 'default'));
