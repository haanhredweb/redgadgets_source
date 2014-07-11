<?php
/**
* @version     1.0
* @package     Joomla
* @subpackage  com_redslider
* @author      redWEB Aps <khai@redweb.dk>
* @copyright   com_redslider (C) 2008 - 2012 redCOMPONENT.com
* @license     GNU/GPL, see LICENSE.php
* com_redslider can be downloaded from www.redcomponent.com
* com_redslider is free software; you can redistribute it and/or
* modify it under the terms of the GNU General Public License 2
* as published by the Free Software Foundation.
* com_redslider is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
* You should have received a copy of the GNU General Public License
* along with com_redslider; if not, write to the Free Software
* Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
**/

// No direct access
defined('_JEXEC') or die;

// Load FOF
include_once JPATH_LIBRARIES . '/fof/include.php';

// Check if FOF library installed or not
if (!defined('FOF_INCLUDED'))
{
	JError::raiseError('500', 'FOF is not installed');
}

FOFDispatcher::getTmpInstance('com_redslider')->dispatch();