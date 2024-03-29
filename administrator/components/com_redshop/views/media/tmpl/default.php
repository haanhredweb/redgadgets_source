<?php
/**
 * @package     RedSHOP.Backend
 * @subpackage  Template
 *
 * @copyright   Copyright (C) 2005 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die ('Restricted access');

JHTMLBehavior::modal();
jimport('joomla.filesystem.file');

$producthelper = new producthelper;
$uri = JURI::getInstance();
$url = $uri->root();

// For Add Media Detail
$showbuttons = JRequest::getCmd('showbuttons');
$media_section = JRequest::getCmd('media_section');
$section_id = JRequest::getCmd('section_id');
$model = $this->getModel('media');

$sectionadata = array();
$sectiona_primary_image = "";
$section_name = "";
$directory = $media_section;

if ($showbuttons == 1)
{
	switch ($media_section)
	{
		case "product";
			$sectionadata           = $producthelper->getProductById($section_id);
			$section_name           = $sectionadata->product_name;
			$sectiona_primary_image = $sectionadata->product_full_image;
			$directory              = $media_section;
			break;
		case "property";
			$sectionadata           = $producthelper->getAttibuteProperty($section_id);
			$section_name           = $sectionadata[0]->property_name;
			$sectiona_primary_image = $sectionadata[0]->property_main_image;
			$directory              = 'property';
			break;
		case "subproperty";
			$sectionadata           = $producthelper->getAttibuteSubProperty($section_id);
			$section_name           = $sectionadata[0]->subattribute_color_name;
			$sectiona_primary_image = $sectionadata[0]->subattribute_color_main_image;
			$directory              = 'subproperty';
			break;
	}
}

if ($showbuttons == 1)
{
?>
	<fieldset>
	<div style="float: right">
		<button type="button" onclick="Joomla.submitbutton('add');">
			<?php echo JText::_('COM_REDSHOP_ADD'); ?>
		</button>
		<button type="button" onclick="Joomla.submitbutton('edit');">
			<?php echo JText::_('COM_REDSHOP_EDIT'); ?>
		</button><?php
		if ($media_section == 'product' || $media_section == 'property' || $media_section == 'subproperty')
		{
			?>
			<button type="button" onclick="Joomla.submitbutton('defaultmedia');">
			<?php echo JText::_('COM_REDSHOP_DEFAULT_MEDIA'); ?>
			</button><?php
		}    ?>
		<button type="button" onclick="Joomla.submitbutton('remove');">
			<?php echo JText::_('COM_REDSHOP_DELETE'); ?>
		</button>
		<button type="button" onclick="Joomla.submitbutton('publish');">
			<?php echo JText::_('COM_REDSHOP_PUBLISH'); ?>
		</button>
		<button type="button" onclick="Joomla.submitbutton('unpublish');">
			<?php echo JText::_('COM_REDSHOP_UNPUBLISH'); ?>
		</button>
		<button type="button" onclick="window.parent.location.reload();">
			<?php echo JText::_('COM_REDSHOP_CANCEL'); ?>
		</button>
	</div>
	<div class="configuration"><?php echo JText::_('COM_REDSHOP_ADD_MEDIA'); ?></div>
	</fieldset>
<?php

	$action = 'index.php?tmpl=component&option=com_redshop';

	// End
}
else
{
	$action = 'index.php?option=com_redshop';
}
?>
<form action="<?php echo $action; ?>" method="post" name="adminForm" id="adminForm">
	<div id="editcell">
	<?php
		if ($showbuttons != 1)
		{
			?>
			<table class="adminlist">
				<tr>
					<td valign="top" align="right" class="key">
						<?php
							echo JText::_('COM_REDSHOP_MEDIA_TYPE') . ':' . $this->lists['type'] . "&nbsp;" . JText::_('COM_REDSHOP_MEDIA_SECTION') . ':' . $this->lists['section'] . "&nbsp;";
						?>
						<button onclick="this.form.getElementById('media_type').value='0';this.form.getElementById('media_section').value='0';this.form.submit();"><?php echo JText::_('COM_REDSHOP_RESET'); ?></button>
					</td>
				</tr>
			</table>
	<?php
		}
	?>
		<table class="adminlist">
			<thead>
			<tr>
				<th width="5%"><?php echo JText::_('COM_REDSHOP_NUM'); ?></th>
				<th width="5%"><input type="checkbox" name="toggle" value=""
				                      onclick="checkAll(<?php echo count($this->media); ?>);"/></th>
				<th width="15%" class="title"><?php        if ($showbuttons == 1)
						echo JTEXT::_('COM_REDSHOP_MEDIA_NAME');
					else
						echo JHTML::_('grid.sort', 'COM_REDSHOP_MEDIA_NAME', 'media_name', $this->lists ['order_Dir'], $this->lists ['order']);    ?></th>
				<th width="10%"><?php if ($showbuttons == 1)
						echo JTEXT::_('COM_REDSHOP_MEDIA_TYPE');
					else
						echo JHTML::_('grid.sort', 'COM_REDSHOP_MEDIA_TYPE', 'media_type', $this->lists ['order_Dir'], $this->lists ['order']);    ?></th>
			<?php
				if ($showbuttons == 1)
				{
					echo '<th width="10%">' . JTEXT::_('COM_REDSHOP_ADDITIONAL_DOWNLOAD_FILES') . '</th>';
				}

			echo '<th width="15%">';

					if ($showbuttons == 1)
					{
						echo JTEXT::_('COM_REDSHOP_MEDIA_ALTERNATE_TEXT');
					}
					else
					{
						echo JHTML::_('grid.sort', 'COM_REDSHOP_MEDIA_ALTERNATE_TEXT', 'media_alternate_text', $this->lists ['order_Dir'], $this->lists ['order']);
					}

				echo '</th>'
				. '<th width="10%">';

					if ($showbuttons == 1)
					{
						echo JTEXT::_('COM_REDSHOP_MEDIA_SECTION');
					}
					else
					{
						echo JHTML::_('grid.sort', 'COM_REDSHOP_MEDIA_SECTION', 'media_section', $this->lists ['order_Dir'], $this->lists ['order']);
					}

				echo '</th>';

					if ($showbuttons == 1 && ($media_section == 'product' || $media_section == 'property' || $media_section == 'subproperty'))
					{
						echo '<th width="5%" class="title">' . JTEXT::_('COM_REDSHOP_PRIMARY_MEDIA') . '</th>';
					}

					if ($showbuttons == 1)
					{
						echo '<th class="order" width="20%">' . JHTML::_('grid.order', $this->media) . '</th>';
					}

				echo '<th width="5%" nowrap="nowrap">';

					if ($showbuttons == 1)
					{
						echo JTEXT::_('COM_REDSHOP_PUBLISHED');
					}
					else
					{
						echo JHTML::_('grid.sort', 'COM_REDSHOP_PUBLISHED', 'published', $this->lists ['order_Dir'], $this->lists ['order']);
					}

				echo '</th>';
				echo '<th width="5%" nowrap="nowrap">';

					if ($showbuttons == 1)
					{
						echo JTEXT::_('COM_REDSHOP_ID');
					}
					else
					{
						echo JHTML::_('grid.sort', 'COM_REDSHOP_ID', 'media_id', $this->lists ['order_Dir'], $this->lists ['order']);
					}

				echo '</th>'
				. '</tr>'
			. '</thead>';

			$k = 0;

			for ($i = 0, $n = count($this->media); $i < $n; $i++)
			{
				$row       = & $this->media[$i];
				$row->id   = $row->media_id;
				$published = JHTML::_('grid.published', $row, $i);    ?>

				<tr class="<?php echo "row$k"; ?>">
					<td align="center"><?php echo $this->pagination->getRowOffset($i); ?></td>
					<td align="center"><?php echo JHTML::_('grid.id', $i, $row->id); ?></td>
					<td>
					<?php

						$filetype = strtolower(JFile::getExt(trim($row->media_name)));

						if ($filetype == 'png' || $filetype == 'jpg' || $filetype == 'jpeg' || $filetype == 'gif')
						{
							$media_img = $url . 'components/com_redshop/assets/' . $row->media_type . '/' . $row->media_section . '/' . trim($row->media_name);    ?>
							<a class="modal" href="<?php echo $media_img; ?>"
							   title="<?php echo JText::_('COM_REDSHOP_VIEW_IMAGE'); ?>"
							   rel="{handler: 'image', size: {}}">
								<img src="<?php echo $media_img ?>" height="50" width="50"/></a>
						<?php
						}
						else
						{
							echo $row->media_name;
						}

					echo '</td>';
					echo '<td align="center" class="order">' . $row->media_type . '</td>';

					if ($showbuttons == 1)
					{
						echo '<td class="order">';

						if ($row->media_type == 'download')
						{
							$additionalfiles = $model->getAdditionalFiles($row->id);
					?>
							<a href="index3.php?option=com_redshop&view=media&layout=additionalfile&media_id=<?php echo $row->id; ?>&showbuttons=1"
								   class="modal" rel="{handler: 'iframe', size: {x: 1000, y: 400}}"
								   title="<?php echo JText::_('COM_REDSHOP_ADDITIONAL_DOWNLOAD_FILES') . '&nbsp;(' . count($additionalfiles) . ')'; ?>">
									<?php echo JText::_('COM_REDSHOP_ADDITIONAL_DOWNLOAD_FILES') . '&nbsp;(' . count($additionalfiles) . ')'; ?>
							</a>
					<?php
						}

					echo '</td>';
					}

					echo '<td class="order">' . $row->media_alternate_text . '</td>';
					echo '<td align="center" class="order">' . $row->media_section . '</td>';

					if ($showbuttons == 1 && ($media_section == 'product' || $media_section == 'property' || $media_section == 'subproperty'))
					{
						echo '<td align="center">';
						echo JHtml::_('jgrid.isdefault', trim($sectiona_primary_image) == trim($row->media_name), 0, '', false);
						echo '</td>';
					}

					if ($showbuttons == 1)
					{
						?>
						<td align="center"><?php  echo $this->pagination->orderUpIcon($i, true, 'orderup', JText::_('JLIB_HTML_MOVE_UP'), $row->ordering);
							echo $this->pagination->orderDownIcon($i, $n, true, 'orderdown', JText::_('JLIB_HTML_MOVE_DOWN'), $row->ordering);?>
							<input type="text" name="order[]" size="5" value="<?php echo $row->ordering; ?>"
							       class="text_area" style="text-align: center"/></td>
					<?php
					}
					?>
					<td align="center"><?php echo $published; ?></td>
					<td align="center"><?php echo $row->media_id; ?></td>
				</tr>
			<?php
				$k = 1 - $k;
			}
			?>
			<input type="hidden" name="showbuttons" value="<?php echo $showbuttons; ?>"/>
			<input type="hidden" name="section_id" value="<?php echo $section_id; ?>"/>
			<input type="hidden" name="media_section" value="<?php echo $media_section; ?>"/>
			<input type="hidden" name="section_name" value="<?php echo $section_name; ?>"/>
			<?php
			if ($showbuttons != 1)
			{
				echo '<tfoot>'
				. '<td colspan="9">' . $this->pagination->getListFooter() . '</td>'
				. '</tfoot>';
			}
			?>
		</table>
	</div>
	<input type="hidden" name="view" value="media"/>
	<input type="hidden" name="task" value=""/>
	<input type="hidden" name="boxchecked" value="0"/>
	<input type="hidden" name="filter_order" value="<?php echo $this->lists ['order']; ?>"/>
	<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists ['order_Dir']; ?>"/>
</form>
<script type="text/javascript">
Joomla.submitbutton = function (pressbutton) {
	submitbutton(pressbutton);
}
submitbutton = function (pressbutton) {
	var form = document.adminForm;
	if (pressbutton) {
		form.task.value = pressbutton;
	}
	if ((pressbutton == 'add') || (pressbutton == 'edit') || (pressbutton == 'publish') || (pressbutton == 'unpublish')
		|| (pressbutton == 'remove') || (pressbutton == 'copy') || (pressbutton == 'edit') || (pressbutton == 'defaultmedia') || (pressbutton == 'saveorder') || (pressbutton == 'orderup') || (pressbutton == 'orderdown')) {
		form.view.value = "media_detail";
	}
	try {
		form.onsubmit();
	}
	catch (e) {
	}
	form.submit();
}
</script>
