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

class RedsliderControllerSlide extends FOFController
{
	public function settype()
	{
		// Initialise variables.
		$app = JFactory::getApplication();

		// Get the posted values from the request.
		$slide_type = JRequest::getCmd('type', '');

		$slide_id = JRequest::getCmd('slide_id', 0);

		$slide_type = json_decode(base64_decode($slide_type));

		$type = isset($slide_type->type) ? $slide_type->type : null;

		$type_name = isset($slide_type->name) ? $slide_type->name : null;

		$data['type'] = $type;

		$data['type_name'] = $type_name;

		$app->setUserState('com_redslider.edit.slide.data', $data);

		$this->setRedirect(JRoute::_('index.php?option=' . $this->config['option'] . '&view=' . $this->config['view'] . '&id=' . $slide_id, false));
	}
}
