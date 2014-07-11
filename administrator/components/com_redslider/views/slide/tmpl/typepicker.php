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

$images_url = $this->baseurl . '/components/com_redslider/images';
?>

<script type="text/javascript">
	setmenutype = function(type)
	{
		window.parent.Joomla.submitbutton('slide.settype', type);
		window.parent.SqueezeBox.close();
	}
</script>

<h2 class="modal-title"><?php echo JText::_("COM_REDSLIDER_PICK_TYPE"); ?></h2>
<ul class="menu_types">
	<li>
		<a href="#" title="<?php echo JText::_("COM_REDSLIDER_STANDARD_TYPE"); ?>"
		   onclick="javascript:setmenutype('<?php echo base64_encode(json_encode(array('type' => 'standard', 'name' => 'Standard'))); ?>')">
			<?php echo JText::_("COM_REDSLIDER_STANDARD_TYPE");?>
			<img src="<?php echo $images_url . '/style1-standard.jpg'?>" alt="Standard" width="313" height="116">
		</a>
	</li>

	<li>
		<a href="#" title="<?php echo JText::_("COM_REDSLIDER_ARTICLE_TYPE"); ?>"
			onclick="javascript:setmenutype('<?php echo base64_encode(json_encode(array('type' => 'article', 'name' => 'Article'))); ?>')">
			<?php echo JText::_("COM_REDSLIDER_ARTICLE_TYPE");?>
			<img src="<?php echo $images_url . '/style1-article.jpg'?>" alt="Article" width="313" height="116">
		</a>
	</li>

	<li>
		<a href="#" title="<?php echo JText::_("COM_REDSLIDER_REDEVENT_TYPE"); ?>"
			onclick="javascript:setmenutype('<?php echo base64_encode(json_encode(array('type' => 'redevent', 'name' => 'redEvent'))); ?>')">
			<?php echo JText::_("COM_REDSLIDER_REDEVENT_TYPE");?>
			<img src="<?php echo $images_url . '/style1-redevent.jpg'?>" alt="redEvent" width="313" height="116">
		</a>
	</li>

	<li><a href="#" title="<?php echo JText::_("COM_REDSLIDER_REDFORM_TYPE"); ?>"
			onclick="javascript:setmenutype('<?php echo base64_encode(json_encode(array('type' => 'redform', 'name' => 'redForm'))); ?>')">
			<?php echo JText::_("COM_REDSLIDER_REDFORM_TYPE");?>
			<img src="<?php echo $images_url . '/style1-redform.jpg'?>" alt="redForm" width="313" height="116">
		</a>
	</li>

	<li><a href="#" title="<?php echo JText::_("COM_REDSLIDER_REDSHOP_TYPE"); ?>"
			onclick="javascript:setmenutype('<?php echo base64_encode(json_encode(array('type' => 'redshop', 'name' => 'redShop'))); ?>')">
			<?php echo JText::_("COM_REDSLIDER_REDSHOP_TYPE");?>
			<img src="<?php echo $images_url . '/style1-redshop.jpg'?>" alt="redShop" width="313" height="116">
		</a>
	</li>

	<li><a href="#" title="<?php echo JText::_("COM_REDSLIDER_VIDEO_TYPE"); ?>"
	       onclick="javascript:setmenutype('<?php echo base64_encode(json_encode(array('type' => 'video', 'name' => 'Video'))); ?>')">
			<?php echo JText::_("COM_REDSLIDER_VIDEO_TYPE");?>
			<img src="<?php echo $images_url . '/style1-video.jpg'?>" alt="Video" width="313" height="116">
		</a>
	</li>
</ul>
