<?php
/**
 * @package     RedSHOP.Backend
 * @subpackage  Template
 *
 * @copyright   Copyright (C) 2005 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */
defined('_JEXEC') or die ('restricted access');
$user = JFactory::getUser();
$model = $this->getModel('statistic');
$option = JRequest::getVar('option');
$start = $this->pagination->limitstart;
$end = $this->pagination->limit;
?>
<form action="<?php echo 'index.php?option=' . $option; ?>" method="post" name="adminForm" id="adminForm">
	<div id="editcell">
		<table width="100%">
			<tr>
				<td><?php echo JText::_('COM_REDSHOP_FILTER') . ": " . $this->lists['filteroption'];?></td>
			</tr>
			<?php /*<tr><td><?php echo JText::_('COM_REDSHOP_STARTDATE');?></td>
		<td><?php echo JHTML::_('calendar', $this->startdate , 'startdate', 'startdate',$format = '%d-%m-%Y',array('class'=>'inputbox', 'size'=>'15',  'maxlength'=>'19'));?></td></tr>
	<tr><td><?php echo JText::_('COM_REDSHOP_ENDDATE');?></td>
		<td><?php echo JHTML::_('calendar', $this->enddate , 'enddate', 'enddate',$format = '%d-%m-%Y',array('class'=>'inputbox', 'size'=>'15',  'maxlength'=>'19'));?></td></tr>
	<tr><td colspan="2"><input type="submit" name="filter" value=<?php echo JText::_('COM_REDSHOP_SUBMIT');?> /></td></tr><?php */?>
		</table>
		<table class="adminlist">
			<thead>
			<tr>
				<th align="center"><?php echo JText::_('COM_REDSHOP_HASH'); ?></th>
				<th align="center"><?php echo JText::_('COM_REDSHOP_SECTION'); ?></th>
				<th align="center"><?php echo JText::_('COM_REDSHOP_TOTAL_PAGEVIEWERS'); ?></th>
			</tr>
			</thead>
			<?php    $disdate = "";
			for ($i = $start, $j = 0; $i < ($start + $end); $i++, $j++)
			{
				$row = & $this->pageviewer[$i];
				if (!is_object($row))
				{
					break;
				}
				if ($this->filteroption && $row->viewdate != $disdate)
				{
					$disdate = $row->viewdate;    ?>
					<tr>
						<td colspan="3"><?php echo JText::_("COM_REDSHOP_DATE") . ": " . $disdate;?></td>
					</tr>
				<?php
				}
				$secinfo = $model->getSectionDetail($row->section, $row->section_id);
				if (count($secinfo) > 0)
				{
					$link = JRoute::_('index.php?option=' . $option . '&view=' . $row->section . '_detail&task=edit&cid[]=' . $secinfo->id);
					$sectionname = "<a href='" . $link . "'>" . $row->section . " :: " . $secinfo->sname . "</a>";
				}
				else
				{
					$sectionname = $row->section;
				}    ?>
				<tr>
					<td align="center"><?php echo $i + 1; ?></td>
					<td><?php echo $sectionname;?></td>
					<td align="center"><?php echo $row->totalpage;?></td>
				</tr>
			<?php }    ?>
			<tfoot>
			<td colspan="3"><?php echo $this->pagination->getListFooter(); ?></td>
			</tfoot>
		</table>
	</div>
	<input type="hidden" name="view" value="statistic"/>
	<input type="hidden" name="layout" value="<?php echo $this->layout; ?>"/>
	<input type="hidden" name="boxchecked" value="0"/>
</form>
