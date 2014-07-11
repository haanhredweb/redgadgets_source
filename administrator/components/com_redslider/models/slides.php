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

class RedsliderModelSlides extends FOFModel
{

	public function buildQuery($overrideLimits = false)
	{
		$table = $this->getTable();
		$tableName = $table->getTableName();
		$tableKey = $table->getKeyName();
		$db = $this->getDBO();

		$parentTableName = '#__redslider_galleries';

		$query = $db->getQuery(true)
			->select($tableName . '.*')
			->select($parentTableName . '.title as gallery')
			->from($db->qn($tableName))
			->from($db->qn($parentTableName))
			->where($tableName . '.redslider_gallery_id = ' . $parentTableName . '.redslider_gallery_id');

		$where = array();

		if (version_compare(JVERSION, '3.0', 'ge'))
		{
			$fields = $db->getTableColumns($tableName, true);
		}
		else
		{
			$fieldsArray = $db->getTableFields($tableName, true);
			$fields = array_shift($fieldsArray);
		}

		foreach ($fields as $fieldname => $fieldtype)
		{
			$filterName = ($fieldname == $tableKey) ? 'id' : $fieldname;
			$filterState = $this->getState($filterName, null);

			if (!empty($filterState) || ($filterState === '0'))
			{
				switch ($fieldname)
				{
					case $table->getColumnAlias('title'):
					case $table->getColumnAlias('description'):
						$query->where('(' . $db->qn($fieldname) . ' LIKE ' . $db->q('%' . $filterState . '%') . ')');

						break;

					case $table->getColumnAlias('enabled'):

						if ($filterState !== '')
						{
							$query->where($db->qn($fieldname) . ' = ' . $db->q((int) $filterState));
						}

						break;

					default:
						$query->where('(' . $db->qn($fieldname) . ' = ' . $db->q($filterState) . ')');
						break;
				}
			}
		}

		if (!$overrideLimits)
		{
			$order = $this->getState('filter_order', null, 'cmd');

			if (!in_array($order, array_keys($this->getTable()->getData())))
			{
				$order = $tableKey;
			}

			$dir = $this->getState('filter_order_Dir', 'ASC', 'cmd');
			$query->order($db->qn($order) . ' ' . $dir);
		}

		return $query;
	}

	protected function preprocessForm(FOFForm $form, $data, $group = 'content')
	{
		$form_file = JPATH_COMPONENT_ADMINISTRATOR . "/models/forms/standard.xml";

		$form->loadFile($form_file, false, false);

		$app = JFactory::getApplication();

		$data_ = $app->getUserState('com_redslider.edit.slide.data');

		if ($data_)
		{
			if ($data_['type'] != 'standard')
			{
				$form_file_type = JPATH_COMPONENT_ADMINISTRATOR . "/models/forms/" . $data_['type'] . ".xml";
				$form->loadFile($form_file_type, false, false);
			}
		}
		else
		{
			if ($data['type'] != 'standard')
			{
				$form_file_type = JPATH_COMPONENT_ADMINISTRATOR . "/models/forms/" . $data['type'] . ".xml";
				$form->loadFile($form_file_type, false, false);
			}
		}

		// Trigger the default form events.
		parent::preprocessForm($form, $data, $group);
	}

	protected function onAfterGetItem(&$record)
	{
		$app = JFactory::getApplication();

		$data_ = $app->getUserState('com_redslider.edit.slide.data');


		if ($data_)
		{
			$record->type = $data_['type'];
			$record->type_name = $data_['type_name'];

			// Remove session
			$app->setUserState('com_redslider.edit.slide.data', '');
		}
	}

}