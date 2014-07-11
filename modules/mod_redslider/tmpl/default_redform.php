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

// No direct access
defined('_JEXEC') or die;

$document->addStyleSheet(JURI::base(true) . '/modules/mod_redslider/assets/css/redform.css');
?>

<?php
	$slide_params = json_decode($slide->params);

	JPluginHelper::importPlugin('content');
	$form_template = '{redform}' . $slide_params->form_id . '{/redform}';
	$form_template = JHtml::_('content.prepare', $form_template);
?>

<li>
	<div class="content">
		<img src="<?php echo $slide->imgslide; ?>" />
	</div>

	<div class="form-template">
		<?php echo $form_template; ?>
	</div>

	<div class="caption-description">
		<?php if ($slide_params->caption): ?>
			<h1><?php echo $slide_params->caption; ?></h1>
		<?php endif;?>
		<?php if ($slide_params->description): ?>
			<p><?php echo $slide_params->description; ?></p>
		<?php endif;?>
		<?php if ($slide_params->link): ?>
			<?php
			$link_text = $slide_params->link_text;
			$link = $slide_params->link;

			if (!$link_text)
			{
				$link_text = $link;
			}

			if (strpos($link, 'http://') === false)
			{
				$link = 'http://' . $link;
			}
			?>
			<?php echo '<a href="' . JRoute::_($link) . '">' . $link_text . '</a>'; ?>
		<?php endif;?>
	</div>
</li>