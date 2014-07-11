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

class FOFFormFieldTypepicker extends FOFFormFieldList
{
	/**
	 * Method to get the field input markup.
	 *
	 * @access  protected
	 * @return	string	The field input markup.
	 */
	protected function getInput()
	{
		// Initialise variables.
		$html = array();
		$size = ($v = $this->element['size']) ? ' size="' . $v . '"' : '';
		$class = ($v = $this->element['class']) ? ' class="' . $v . '"' : 'class="text_area"';

		if (empty($this->value))
		{
			$this->value = 'Standard';
		}

		$html[] = '<input type="text" readonly="readonly" disabled="disabled" value="' . $this->value . '"' . $size . $class . '/>';
		$html[] = '<input type="button" value="' . JText::_('JSELECT') . '" onclick="SqueezeBox.fromElement(this, {handler:\'iframe\', size: {x: 800, y: 500}, url:\'' . JRoute::_('index.php?option=com_redslider&view=slide&layout=typepicker&tmpl=component') . '\'})"/>';
		$html[] = '<input type="hidden" name="' . $this->name . '" value="' . htmlspecialchars($this->value, ENT_COMPAT, 'UTF-8') . '"/>';

		return implode("\n", $html);
	}
}