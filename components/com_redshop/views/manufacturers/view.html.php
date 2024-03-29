<?php
/**
 * @package     RedSHOP.Frontend
 * @subpackage  View
 *
 * @copyright   Copyright (C) 2005 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die;
JLoader::import('joomla.application.component.view');

class manufacturersViewmanufacturers extends JView
{
	public function display($tpl = null)
	{
		$app = JFactory::getApplication();

		$producthelper = new producthelper;
		$redhelper     = new redhelper;
		$document      = JFactory::getDocument();
		$print         = JRequest::getInt('print');
		$layout        = JRequest::getCmd('layout', 'default');
		$params        = $app->getParams('com_redshop');
		$Itemid        = $app->input->getInt('itemid', null);

		$mid    = 0;
		$lists  = array();
		$model  = $this->getModel('manufacturers');
		$detail = $this->get('data');
		$limit  = $params->get('maxproduct');

		if (!$limit && $detail)
		{
			$limit = $detail[0]->product_per_page;
		}

		$model->setProductLimit($limit);
		$pageheadingtag = '';
		$disabled       = "";

		if ($print)
		{
			$disabled = "disabled";
		}

		JHTML::Script('attribute.js', 'components/com_redshop/assets/js/', false);
		JHTML::Script('common.js', 'components/com_redshop/assets/js/', false);
		JHTML::Script('fetchscript.js', 'components/com_redshop/assets/js/', false);
		JHTML::Stylesheet('fetchscript.css', 'components/com_redshop/assets/css/');

		if ($layout != 'default')
		{
			$manufacturer = $detail[0];
			$mid          = $manufacturer->manufacturer_id;

			if ($manufacturer->manufacturer_id)
			{
				$document->setMetaData('robots', $manufacturer->metarobot_info);

				// For page title

				if (AUTOGENERATED_SEO && SEO_PAGE_TITLE_MANUFACTUR != '')
				{
					$pagetitletag = SEO_PAGE_TITLE_MANUFACTUR;
					$pagetitletag = str_replace("{manufacturer}", $manufacturer->manufacturer_name, $pagetitletag);
					$pagetitletag = str_replace("{shopname}", SHOP_NAME, $pagetitletag);
				}

				if ($manufacturer->pagetitle != '' && AUTOGENERATED_SEO && SEO_PAGE_TITLE_MANUFACTUR != '')
				{
					$pagetitletag = $pagetitletag . " " . $manufacturer->pagetitle;
					$document->setTitle($pagetitletag);
				}
				else
				{
					if ($manufacturer->pagetitle != '')
					{
						$pagetitletag = $manufacturer->pagetitle;
						$document->setTitle($manufacturer->pagetitle);
					}
					elseif (AUTOGENERATED_SEO && SEO_PAGE_TITLE_MANUFACTUR != '')
					{
						$document->setTitle($pagetitletag);
					}
					else
					{
						$pagetitletag = $app->getCfg('sitename');
						$document->setTitle($app->getCfg('sitename'));
					}
				}

				if ($layout == 'products')
				{
					$pagetitletag = JText::_("COM_REDSHOP_MANUFACTURER_PRODUCT") . " " . $pagetitletag;
					$document->setTitle($pagetitletag);
				}

				// For meta keyword
				if (AUTOGENERATED_SEO && SEO_PAGE_KEYWORDS_MANUFACTUR != '')
				{
					$pagekeywordstag = SEO_PAGE_KEYWORDS_MANUFACTUR;
					$pagekeywordstag = str_replace("{manufacturer}", $manufacturer->manufacturer_name, $pagekeywordstag);
					$pagekeywordstag = str_replace("{shopname}", SHOP_NAME, $pagekeywordstag);
				}

				if ($manufacturer->metakey != '' && AUTOGENERATED_SEO && SEO_PAGE_KEYWORDS_MANUFACTUR != '')
				{
					$pagekeywordstag = $pagekeywordstag . ", " . $manufacturer->metakey;
					$document->setMetaData('keywords', $pagekeywordstag);
				}
				else
				{
					if ($manufacturer->metakey != '')
					{
						$document->setMetaData('keywords', $manufacturer->metakey);
					}
					elseif (AUTOGENERATED_SEO && SEO_PAGE_KEYWORDS_MANUFACTUR != '')
					{
						$document->setMetaData('keywords', $pagekeywordstag);
					}
					else
					{
						$document->setMetaData('keywords', $manufacturer->manufacturer_name);
					}
				}

				// For meta description
				if (AUTOGENERATED_SEO && SEO_PAGE_DESCRIPTION_MANUFACTUR != '')
				{
					$pagedesctag = SEO_PAGE_DESCRIPTION_MANUFACTUR;
					$pagedesctag = str_replace("{manufacturer}", $manufacturer->manufacturer_name, $pagedesctag);
					$pagedesctag = str_replace("{shopname}", SHOP_NAME, $pagedesctag);
				}

				if ($manufacturer->metadesc != '' && AUTOGENERATED_SEO && SEO_PAGE_DESCRIPTION_MANUFACTUR != '')
				{
					$pagedesctag = $pagedesctag . " " . $manufacturer->metadesc;
					$document->setMetaData('description', $pagedesctag);
				}
				else
				{
					if ($manufacturer->metadesc != '')
					{
						$document->setMetaData('description', $manufacturer->metadesc);
					}
					elseif (AUTOGENERATED_SEO && SEO_PAGE_DESCRIPTION_MANUFACTUR != '')
					{
						$document->setMetaData('description', $pagedesctag);
					}
					else
					{
						$document->setMetaData('description', $manufacturer->manufacturer_name);
					}
				}

				if ($manufacturer->metarobot_info != '')
				{
					$document->setMetaData('robots', $manufacturer->metarobot_info);
				}
				else
				{
					if (AUTOGENERATED_SEO && SEO_PAGE_ROBOTS != '')
					{
						$pagerobotstag = SEO_PAGE_ROBOTS;
						$document->setMetaData('robots', $pagerobotstag);
					}
					else
					{
						$document->setMetaData('robots', "INDEX,FOLLOW");
					}
				}

				// For page heading
				if (AUTOGENERATED_SEO && SEO_PAGE_HEADING_MANUFACTUR != '')
				{
					$pageheadingtag = SEO_PAGE_HEADING_MANUFACTUR;
					$pageheadingtag = str_replace("{manufacturer}", $manufacturer->manufacturer_name, $pageheadingtag);
				}

				if (trim($manufacturer->pageheading) != '' && AUTOGENERATED_SEO && SEO_PAGE_HEADING_MANUFACTUR != '')
				{
					$pageheadingtag = $pageheadingtag . " " . $manufacturer->pageheading;
				}
				else
				{
					if (trim($manufacturer->pageheading) != '')
					{
						$pageheadingtag = $manufacturer->pageheading;
					}
					elseif (AUTOGENERATED_SEO && SEO_PAGE_HEADING_MANUFACTUR != '')
					{
						$pageheadingtag = $pageheadingtag;
					}
				}

				// FOr Canonical In Manufacturer Page
				if (AUTOGENERATED_SEO && SEO_PAGE_CANONICAL_MANUFACTUR != '' && $layout != "products")
				{
					$canonicalurl = SEO_PAGE_CANONICAL_MANUFACTUR;

					$manufacturer_products_url = substr_replace(JURI::root(), "", -1)
						. JRoute::_('index.php?option=com_redshop&view=manufacturers&layout=products&mid=' . $manufacturer->manufacturer_id . '&Itemid=' . $Itemid);
					$canonicalurl_content      = '<link rel="canonical" href="' . $manufacturer_products_url . '" />';
					$canonicalurl              = str_replace("{manufacturerproductslink}", $canonicalurl_content, $canonicalurl);
					$document->addCustomTag($canonicalurl);
				}
			}
			else
			{
				$document->setMetaData('keywords', $app->getCfg('sitename'));
				$document->setMetaData('description', $app->getCfg('sitename'));
				$document->setMetaData('robots', $app->getCfg('sitename'));
			}

			$this->setLayout($layout);
		}

		// Breadcrumbs
		$producthelper->generateBreadcrumb($mid);

		// Breadcrumbs end

		if ($layout == "products")
		{
			$order_by_select = JRequest::getString('order_by', DEFAULT_MANUFACTURER_PRODUCT_ORDERING_METHOD);
			$order_data      = $redhelper->getOrderByList();
		}
		else
		{
			$order_by_select = JRequest::getString('order_by', DEFAULT_MANUFACTURER_ORDERING_METHOD);
			$order_data      = $redhelper->getManufacturerOrderByList();
		}

		$lists['order_select'] = JHTML::_('select.genericlist', $order_data, 'order_by', 'class="inputbox" size="1" onchange="document.orderby_form.submit();" ' . $disabled . ' ', 'value', 'text', $order_by_select);

		$categorylist           = $model->getCategoryList();

		$temps                  = array();
		$temps[0]				= new StdClass;
		$temps[0]->value        = "0";
		$temps[0]->text         = JText::_('COM_REDSHOP_SELECT');
		$categorylist           = array_merge($temps, $categorylist);
		$filter_by_select       = JRequest::getString('filter_by', 0);
		$lists['filter_select'] = JHTML::_('select.genericlist', $categorylist, 'filter_by', 'class="inputbox" size="1" onchange="document.filter_form.submit();" ' . $disabled . ' ', 'value', 'text', $filter_by_select);

		$pagination = $this->get('Pagination');

		$this->detail = $detail;
		$this->lists = $lists;
		$this->pagination = $pagination;
		$this->pageheadingtag = $pageheadingtag;
		$this->params = $params;
		parent::display($tpl);
	}
}
