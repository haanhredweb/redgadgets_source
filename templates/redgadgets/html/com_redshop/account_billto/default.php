<?php
/**
 * @package     RedSHOP.Frontend
 * @subpackage  Template
 *
 * @copyright   Copyright (C) 2005 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die;
$userhelper = new rsUserhelper;
$user       = JFactory::getUser();
$Itemid     = JRequest::getInt('Itemid');

$post = (array) $this->billingaddresses;
$post["email1"] = $post["email"] = $post ["user_email"];

if ($user->username)
{
	$post["username"] = $user->username;
}

$create_account = 1;

if ($post["user_id"] < 0)
{
	$create_account = 0;
}
?>
<script type="text/javascript">
	function cancelForm(frm) {
		frm.task.value = 'cancel';
		frm.submit();
	}
</script>
<?php
if ($this->params->get('show_page_heading', 1))
{
	?>
	<h1 class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
		<?php echo $this->escape(JText::_('COM_REDSHOP_BILLING_ADDRESS_INFORMATION_LBL')); ?></h1>
<?php
}     ?>

<div class="rsmyaccount">
	<div class="accountbar">
		<div class="step1 active">
			<a href="<?php echo JRoute::_("index.php?option=com_redshop&view=account&Itemid=" . $Itemid) ?>">
				<?php echo JText::_('TPL_REDGADGETS_MY_ACCOUNT');?>
			</a>
		</div>
		<div class="step2">
			<a href="<?php echo JRoute::_("index.php?option=com_redshop&view=account_shipto&Itemid=" . $Itemid) ?>">
				<?php echo JText::_('TPL_REDGADGETS_SHIPPING');?>
			</a>
		</div>
		<div class="step3">
			<a href="<?php echo JRoute::_("index.php?option=com_redshop&view=orders&Itemid=" . $Itemid) ?>">
				<?php echo JText::_('TPL_REDGADGETS_MY_ORDERS');?>
			</a>
		</div>
	</div>

	<div class="billingform">
	<form action="<?php echo JRoute::_($this->request_url); ?>" method="post" name="adminForm" id="adminForm"
	      enctype="multipart/form-data"><!-- id="billinfo_adminForm" -->
		<fieldset class="adminform">
			<table cellspacing="3" cellpadding="0" border="0" align="center">
				<tr>
					<td>
						<legend><?php echo JText::_('COM_REDSHOP_CUSTOMER_INFORMATION');?></legend>
						<?php echo $userhelper->getBillingTable($post, $this->billingaddresses->is_company, $this->lists, 0, 0, $create_account);    ?>
					</td>
				</tr>
				<tr>
					<td align="center"><input type="button" class="btn btn-primary" name="back"
					                         value="<?php echo JText::_('COM_REDSHOP_CANCEL'); ?>"
					                         onclick="javascript:cancelForm(this.form);">
					                   <input type="submit" class="btn btn-default" name="submitbtn"
					                        value="<?php echo JText::_('COM_REDSHOP_SAVE'); ?>"></td>
				</tr>
			</table>
		</fieldset>
		<input type="hidden" name="cid[]" value="<?php echo $this->billingaddresses->users_info_id; ?>"/>
		<input type="hidden" name="user_id" id="user_id" value="<?php echo $post["user_id"]; ?>"/>
		<input type="hidden" name="task" value="save"/>
		<input type="hidden" name="view" value="account_billto"/>
		<input type="hidden" name="address_type" value="BT"/>
		<input type="hidden" name="is_company" id="is_company" value="<?php echo $this->billingaddresses->is_company; ?>"/>
		<input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>"/>
	</form>
	</div>
</div>