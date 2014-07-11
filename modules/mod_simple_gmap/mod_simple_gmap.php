<?php
/**
 * @package     RedITEM.Frontend
 * @subpackage  mod_reditem_categories
 *
 * @copyright   Copyright (C) 2005 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die;

$doc = JFactory::getDocument();

$doc->addScript('https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false');
$doc->addScript('http://www.google.com/jsapi');

$doc->addScript(JURI::root() . 'media/mod_simple_gmap/js/markerwithlabel.min.js');
$doc->addScript(JURI::root() . 'media/mod_simple_gmap/js/infobubble.min.js');
$doc->addScript('https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js');
$doc->addStyleSheet(JURI::root() . 'media/mod_simple_gmap/css/mod_simple_gmap.css');

$parentCategory = $params->get('parent', 0);
$country = $params->get('country', 'Denmark');
$gmapWidth = $params->get('gmap_width', '');
$gmapHeight = $params->get('gmap_height', '');
$gmapZoom = $params->get('gmap_zoom', '5');
$gmapLatlng = $params->get('gmap_latlng', '55.22811,10.21298');

$pinicon = $params->get('gmap_pinicon', '');

$inforbox = $params->get('inforbox', '');
$inforbox = str_replace(array('.', "\n", "\t", "\r"), '', $inforbox);

if ($gmapWidth)
{
	$gmapWidth = 'width: ' . $gmapWidth;
}

if ($gmapHeight)
{
	$gmapHeight = 'height: ' . $gmapHeight;
}

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require JModuleHelper::getLayoutPath('mod_simple_gmap', $params->get('layout', 'default'));
