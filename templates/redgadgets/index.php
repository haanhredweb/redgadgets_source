<?php
/**
 * @copyright      Copyright (C) 2013 redComponent
 * @author         redComponent
 * @package        Template
 *
 */

// No direct access
defined('_JEXEC') or die('Restricted access');

JHTML::_('behavior.modal');

// Include the framework
require dirname(__FILE__) . '/wright/wright.php';

// Initialize the framework and
$tpl = Wright::getInstance();
$tpl->addJSScript(JURI::root() . 'templates/' . $this->template . '/js/select2.min.js');
$tpl->addJSScript(JURI::root() . 'templates/' . $this->template . '/js/jquery.flexisel.js');
$tpl->addJSScript(JURI::root() . 'templates/' . $this->template . '/js/jquery.colorbox-min.js');
$tpl->addJSScript('//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-52d799a019fb782a');

$tpl->addJSScript(JURI::root() . 'templates/' . $this->template . '/js/js.js');
$tpl->display();
