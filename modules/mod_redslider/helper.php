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

defined('_JEXEC') or die;

class modRedSliderHelper
{
	public static function getGalleryItem($params)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query->select('*');
		$query->from('#__redslider_galleries AS g');
		$query->where('g.id = ' . $params->get('redslider_gallery_id', 0));

		$db->setQuery($query);

		$list = $db->loadObjectList();

		return $list;
	}

	public static function getSlideList($params)
	{
		$component = JComponentHelper::getComponent("com_redslider");

		if (!isset($component->id))
		{
			JError::raiseError('500', 'redSlider Component is not installed');
		}

		$db = JFactory::getDbo();
		$query = $db->getQuery(true)
					->select('s.*, t.description AS template_description')
					->from('#__redslider_slides AS s')
					->leftJoin('#__redslider_templates AS t ON s.redslider_template_id = t.redslider_template_id')
					->where('s.enabled = 1')
					->where('s.redslider_gallery_id = ' . $params->get('redslider_gallery_id', 0))
					->order('s.ordering');

		// Get the slides.
		$db->setQuery($query);

		$list = $db->loadObjectList();

		return $list;
	}

	public static function getProductItem($params)
	{
		if ($params->product_id)
		{
			$product = self::getProductDetail($params->product_id);
			$product->background_image = $params->product_image;
		}

		return $product;
	}

	private static function getProductDetail($id)
	{
		$component = JComponentHelper::getComponent("com_redshop");

		if (!isset($component->id))
		{
			JError::raiseError('500', 'redShop Component is not installed');
		}

		if (!defined('TABLE_PREFIX'))
		{
			require_once JPATH_ADMINISTRATOR . '/components/com_redshop/helpers/redshop.cfg.php';
		}

		require_once JPATH_SITE . '/components/com_redshop/helpers/helper.php';
		$objhelper = new redhelper;
		$producthelper = new producthelper;

		$ItemData = $producthelper->getMenuInformation(0, 0, '', 'product&pid=' . $id);

		if (count($ItemData) > 0)
		{
			$pItemid = $ItemData->id;
		}
		else
		{
			$pItemid = $objhelper->getItemid($id);
		}

		$link = JRoute::_('index.php?option=com_redshop&view=product&pid=' . $id . '&Itemid=' . $pItemid);

		$product = $producthelper->getProductById($id);
		$product->product_price = $producthelper->getProductPrice($id);
		$product->link = $link;

		return $product;
	}

	public static function getEventItem($params)
	{
		if ($params->session_id)
		{
			$event_item = self::getEventDetail($params->session_id);
		}

		return $event_item;
	}

	private static function getEventDetail($id)
	{
		$component = JComponentHelper::getComponent("com_redevent");

		if (!isset($component->id))
		{
			JError::raiseError('500', 'redEvent Component is not installed');
		}

		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query->select('e.id, e.title as event_title, e.datdescription as event_description, e.datimage as event_image');
		$query->select('evx.title as session_title, DATE_FORMAT(evx.dates, "%d-%m-%Y") as session_date');
		$query->from('#__redevent_events as e');
		$query->from('#__redevent_event_venue_xref evx');
		$query->where('e.id = ' . $id);
		$query->where('e.id = evx.eventid');

		$db->setQuery($query);

		$event_items = $db->loadObjectList();

		return $event_items[0];
	}

	public static function getArticleItem($params)
	{
		if ($params->article_id)
		{
			$article_item = self::getArticleDetail($params->article_id);
		}

		return $article_item;
	}

	private static function getArticleDetail($id)
	{
		$component = JComponentHelper::getComponent("com_content");

		if (!isset($component->id))
		{
			JError::raiseError('500', 'Content component is not installed');
		}

		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query->select('content.id, content.title, content.introtext, content.fulltext');
		$query->from('#__content as content');
		$query->where('content.id = ' . $id);

		$db->setQuery($query);

		$article_items = $db->loadObjectList();

		return $article_items[0];
	}

	public static function createImg($slide_list, $slide_width, $slide_height, $thumbnail, $thumbnail_width, $thumbnail_height, $module_id)
	{
		foreach ($slide_list as $slide)
		{
			$slide_params = json_decode($slide->params);
			$slide->imgname = $slide_params->background_image;

			if (stristr($slide->imgname, "http"))
			{
				$slide->imgthumb = $slide->imgname;
			}
			else
			{
				$thumbext = explode(".", $slide->imgname);
				$thumbext = end($thumbext);

				if ($thumbnail)
				{
					$slide->imgthumb = JURI::base(true) . '/' . self::resizeImg($slide->imgname, 'rs_thumb_' . $module_id, $thumbnail_width, $thumbnail_height);
				}
				else
				{
					$slide->imgthumb = JURI::base(true) . '/' . str_replace('.' . $thumbext, '_rs_' . $module_id . '.' . $thumbext, $slide->imgname);
				}

				if ($slide_height)
				{
					$slide->imgslide = JURI::base(true) . '/' . self::resizeImg($slide->imgname, 'rs_slide_' . $module_id, $slide_width, $slide_height);
				}
				else
				{
					$slide->imgslide = JURI::base(true) . '/' . $slide->imgname;
				}
			}
		}
	}

	private function resizeImg($img_file, $folder_name, $new_width, $new_height)
	{
		jimport('joomla.filesystem.file');
		jimport('joomla.filesystem.folder');

		if (!$img_file)
		{
			return;
		}

		$filetmp = JPATH_ROOT . '/' . $img_file;
		$filetmp = str_replace('%20', ' ', $filetmp);

		$size = getimagesize($filetmp);

		if (!$new_width)
		{
			$new_width = round(($size[0] * $new_height) / $size[1]);
		}

		$thumbext = explode('.', $img_file);
		$thumbext = end($thumbext);

		$thumbfile = str_replace(JFile::getName($img_file), $folder_name . '/' . JFile::getName($img_file), $img_file);
		$thumbfile = str_replace('.' . $thumbext, '_' . $folder_name . '.' . $thumbext, $thumbfile);

		if ($size)
		{
			$thumbfolder = str_replace(JFile::getName($img_file), $folder_name . '/', $filetmp);

			if (!JFolder::exists($thumbfolder))
			{
				JFolder::create($thumbfolder);
			}

			if (JFile::exists($thumbfile))
			{
				$thumbsize = getimagesize(JPATH_ROOT . '/' . $thumbfile);

				if ($thumbsize[0] == $new_width and $thumbsize[1] == $new_height)
				{
					return $thumbfile;
				}
			}

			if ($size['mime'] == 'image/jpeg')
			{
				$img_big = imagecreatefromjpeg($filetmp);

				$img_mini = imagecreatetruecolor($new_width, $new_height) or $img_mini = imagecreate($new_width, $new_height);
				imagecopyresized($img_mini, $img_big, 0, 0, 0, 0, $new_width, $new_height, $size[0], $size[1]);

				imagejpeg($img_mini, JPATH_ROOT . '/' . $thumbfile);
			}
			elseif ($size['mime'] == 'image/png')
			{
				$img_big = imagecreatefrompng($filetmp);
				$img_mini = imagecreatetruecolor($new_width, $new_height) or $img_mini = imagecreate($new_width, $new_height);
				imagecopyresized($img_mini, $img_big, 0, 0, 0, 0, $new_width, $new_height, $size[0], $size[1]);

				imagepng($img_mini, JPATH_ROOT . '/' . $thumbfile);
			}
			elseif ($size['mime'] == 'image/gif')
			{
				$img_big = imagecreatefromgif($filetmp);
				$img_mini = imagecreatetruecolor($new_width, $new_height) or $img_mini = imagecreate($new_width, $new_height);
				imagecopyresized($img_mini, $img_big, 0, 0, 0, 0, $new_width, $new_height, $size[0], $size[1]);

				imagegif($img_mini, JPATH_ROOT . '/' . $thumbfile);
			}
		}

		return $thumbfile;
	}
}
