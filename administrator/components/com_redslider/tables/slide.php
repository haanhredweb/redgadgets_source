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

class RedsliderTableSlide extends FOFTable
{
	protected function onBeforeStore($updateNulls)
	{
		if (!$this->alias)
		{
			$this->alias = FOFStringUtils::toSlug($this->title);
		}

		if (isset($this->params))
		{
			$this->params = json_encode($this->params);
		}

		return parent::onBeforeStore($updateNulls);
	}

	protected function onAfterLoad(&$result)
	{
		if (isset($this->params))
		{
			$this->params = json_decode($this->params);
		}

		return parent::onAfterLoad($result);
	}
}