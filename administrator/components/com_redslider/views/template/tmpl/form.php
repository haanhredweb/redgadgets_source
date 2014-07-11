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

defined('_JEXEC') or die();

if (version_compare(JVERSION, '3.0', 'ge'))
{
	JHTML::_('behavior.framework');
}
else
{
	JHTML::_('behavior.mootools');
}

echo $this->getRenderedForm();
?>

<form id='adminForm' name='adminForm'>
	<fieldset id='content_params' class="span6">
		<legend>Template Params</legend>
		<p></p>
	</fieldset>

	<fieldset id='content_default' class="span6">
		<legend>Template Default</legend>
		<p></p>
	</fieldset>
</form>