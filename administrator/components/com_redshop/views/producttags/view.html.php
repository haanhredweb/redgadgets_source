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

class producttagsViewproducttags extends JView
{
	public function display($tpl = null)
	{
		$context = 't.tags_id';

		$uri      = JFactory::getURI();
		$app      = JFactory::getApplication();
		$document = JFactory::getDocument();

		$document->setTitle(JText::_('COM_REDSHOP_TAGS'));

		JToolBarHelper::title(JText::_('COM_REDSHOP_TAGS_MANAGEMENT'), 'redshop_textlibrary48');
		JToolBarHelper::editListX();
		JToolBarHelper::deleteList();
		JToolBarHelper::publishList();
		JToolBarHelper::unpublishList();

		$filter_order     = $app->getUserStateFromRequest($context . 'filter_order', 'filter_order', 'tags_id');
		$filter_order_Dir = $app->getUserStateFromRequest($context . 'filter_order_Dir', 'filter_order_Dir', '');

		$lists['order']     = $filter_order;
		$lists['order_Dir'] = $filter_order_Dir;

		$tags       = $this->get('Data');
		$total      = $this->get('Total');
		$pagination = $this->get('Pagination');

		$this->user = JFactory::getUser();
		$this->lists = $lists;
		$this->tags = $tags;
		$this->pagination = $pagination;
		$this->request_url = $uri->toString();

		parent::display($tpl);
	}
}
