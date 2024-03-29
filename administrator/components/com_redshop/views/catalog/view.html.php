<?php
/**
 * @package     RedSHOP.Backend
 * @subpackage  View
 *
 * @copyright   Copyright (C) 2005 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class catalogViewcatalog extends JView
{
	public function display($tpl = null)
	{
		global $context;

		$app = JFactory::getApplication();

		$context = 'catalog_id';
		$document = JFactory::getDocument();
		$document->setTitle(JText::_('COM_REDSHOP_CATALOG'));

		JToolBarHelper::title(JText::_('COM_REDSHOP_CATALOG_MANAGEMENT'), 'redshop_catalogmanagement48');

		JToolBarHelper::addNewX();
		JToolBarHelper::editListX();
		JToolBarHelper::deleteList();
		JToolBarHelper::publishList();
		JToolBarHelper::unpublishList();

		$uri = JFactory::getURI();

		$filter_order     = $app->getUserStateFromRequest($context . 'filter_order', 'filter_order', 'catalog_id');
		$filter_order_Dir = $app->getUserStateFromRequest($context . 'filter_order_Dir', 'filter_order_Dir', '');

		$lists['order'] = $filter_order;
		$lists['order_Dir'] = $filter_order_Dir;
		$catalog = $this->get('Data');
		$total = $this->get('Total');
		$pagination = $this->get('Pagination');


		$this->user = JFactory::getUser();
		$this->lists = $lists;
		$this->catalog = $catalog;
		$this->pagination = $pagination;
		$this->request_url = $uri->toString();

		parent::display($tpl);
	}
}
