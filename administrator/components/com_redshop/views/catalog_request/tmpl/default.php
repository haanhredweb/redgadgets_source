<?php
/**
 * @package     RedSHOP.Backend
 * @subpackage  Template
 *
 * @copyright   Copyright (C) 2005 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

$option = JRequest::getVar('option');
$Redconfiguration = new Redconfiguration();?>
<script language="javascript" type="text/javascript">

	Joomla.submitbutton = function (pressbutton) {
		submitbutton(pressbutton);
	}
	submitbutton = function (pressbutton) {
		var form = document.adminForm;
		if (pressbutton) {
			form.task.value = pressbutton;
		}

		if ((pressbutton == 'add') || (pressbutton == 'edit') || (pressbutton == 'publish') || (pressbutton == 'unpublish')
			|| (pressbutton == 'remove')) {
			form.view.value = "catalog_request";
		}
		try {
			form.onsubmit();
		}
		catch (e) {
		}

		form.submit();
	}
	function clearreset() {
		var form = document.adminForm;
		form.filter.value = "";
		form.submit();
	}
</script>
<form action="<?php echo 'index.php?option=' . $option; ?>" method="post" name="adminForm" id="adminForm">
	<div id="editcell">
		<table class="adminlist">
			<thead>
			<tr>
				<th width="5%">
					<?php echo JText::_('COM_REDSHOP_NUM'); ?>
				</th>
				<th width="5%">
					<input type="checkbox" name="toggle" value=""
					       onclick="checkAll(<?php echo count($this->catalog); ?>);"/>
				</th>
				<th width="20%">
					<?php echo JHTML::_('grid.sort', 'COM_REDSHOP_NAME', 'name', $this->lists['order_Dir'], $this->lists['order']); ?>
				</th>
				<th width="30%">
					<?php echo JHTML::_('grid.sort', 'COM_REDSHOP_EMAIL', 'email', $this->lists['order_Dir'], $this->lists['order']); ?>
				</th>
				<th width="20%">
					<?php echo JHTML::_('grid.sort', 'COM_REDSHOP_REGISTRATORDATE', 'registerDate', $this->lists['order_Dir'], $this->lists['order']); ?>
				</th>
				<th width="5%">
					<?php echo JHTML::_('grid.sort', 'COM_REDSHOP_REMINDER_1', 'remider_1', $this->lists['order_Dir'], $this->lists['order']); ?>
				</th>
				<th width="5%">
					<?php echo JHTML::_('grid.sort', 'COM_REDSHOP_REMINDER_2', 'remider_2', $this->lists['order_Dir'], $this->lists['order']); ?>
				</th>
				<th width="5%">
					<?php echo JHTML::_('grid.sort', 'COM_REDSHOP_REMINDER_3', 'remider_3', $this->lists['order_Dir'], $this->lists['order']); ?>
				</th>
				<th width="5%">
					<?php echo JHTML::_('grid.sort', 'COM_REDSHOP_BLOCK', 'block', $this->lists['order_Dir'], $this->lists['order']); ?>
				</th>
			</tr>
			</thead>
			<?php
			$k = 0;
			for ($i = 0, $n = count($this->catalog); $i < $n; $i++)
			{
				$row = & $this->catalog[$i];
				$row->id = $row->catalog_user_id;
				$row->published = $row->block;
				$published = JHtml::_('jgrid.published', $row->published, $i, '', 1);

				$reminder1 = JHtml::_('jgrid.published', $row->reminder_1, $i, '', 1);
				$reminder2 = JHtml::_('jgrid.published', $row->reminder_2, $i, '', 1);
				$reminder3 = JHtml::_('jgrid.published', $row->reminder_3, $i, '', 1);?>
			<tr class="<?php echo "row$k"; ?>">
				<td align="center"><?php echo $this->pagination->getRowOffset($i); ?></td>
				<td align="center"><?php echo JHTML::_('grid.id', $i, $row->id); ?></td>
				<td><?php echo  $row->name; ?></td>
				<td><?php echo  $row->email; ?></td>
				<td align="center"><?php echo $Redconfiguration->convertDateFormat($row->registerDate); ?></td>
				<td align="center"><?php echo $reminder1;?></td>
				<td align="center"><?php echo $reminder2;?></td>
				<td align="center"><?php echo $reminder3;?></td>
				<td align="center"><?php echo $published;?></td>
				</tr><?php
				$k = 1 - $k;
			}
			?>
			<tfoot>
			<td colspan="9">
				<?php echo $this->pagination->getListFooter(); ?>
			</td>
			</tfoot>
		</table>
	</div>

	<input type="hidden" name="view" value="catalog_request"/>
	<input type="hidden" name="task" value=""/>
	<input type="hidden" name="boxchecked" value="0"/>
	<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>"/>
	<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>"/>
</form>