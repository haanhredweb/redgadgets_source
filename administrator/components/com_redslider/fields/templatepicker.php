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

class FOFFormFieldTemplatepicker extends FOFFormFieldList
{
	protected function getOptions()
	{
		$section = $this->element->getAttribute('section');

		// Initialise variables.
		$options = array();

		$db	= JFactory::getDbo();
		$query = $db->getQuery(true)
			->select('t.redslider_template_id AS value, t.name AS text')
			->from('#__redslider_templates AS t')
			->where('t.section = "' . $section . '"');

		// Get the options.
		$db->setQuery($query);

		$options = $db->loadObjectList();

		return $options;
	}
}