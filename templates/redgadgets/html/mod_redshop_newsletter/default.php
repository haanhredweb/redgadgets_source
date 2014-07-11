<?php
/**
 * @package     RedSHOP.Frontend
 * @subpackage  mod_redshop_newsletter
 *
 * @copyright   Copyright (C) 2005 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');
//$app = JFactory::getApplication();
$app = JFactory::getApplication();
$user = JFactory::getUser();
$email = JRequest::getString('email');
$name = JRequest::getString('name');
$option = JRequest::getCmd('option');
$Itemid = JRequest::getInt('Itemid');
$newsletteritemid = $params->get('redirectpage');
if ($user->id != "")
{
	$email = $user->email;
	$name  = $user->name;
}

if(empty($email))
{
	$email = JText::_('COM_REDSHOP_EMAIL');
}


?>
<form method="post" action="" name="subscribeForm" onsubmit="return validation();">
	<div class="redshop_newsletter">
		<div class="redshop_newsletter_label">
			<?php echo JText::_('COM_REDSHOP_NEWSLETTER_SUBSCRIPTION'); ?>
		</div>
		<div class="redshop_newsletter_input_name">
			<label><?php echo JText::_('COM_REDSHOP_FULLNAME');?> : </label>
			<input type="text" name="name" id="name" value="<?php echo $email; ?>" class="redshop_newsletter_name"/>
		</div>
		<div class="redshop_newsletter_input_email">
			<input type="text" name="email1" id="email12" value="<?php echo $email; ?>"
			       class="redshop_newsletter_email"
			       onfocus="if (this.value=='<?php echo JText::_('COM_REDSHOP_EMAIL');?>') this.value='';"
			       onblur="if (this.value=='') {this.value='<?php echo JText::_('COM_REDSHOP_EMAIL');?>'}; document.subscribeForm.name.value=this.value;"/>
		</div>
		<div class="redshop_newsletter_buttons">
			<input type="submit" name="subscribe" id="subscribe"
			       onClick="document.subscribeForm.elements['task'].value='subscribe';"
			       value=<?php echo JText::_('COM_REDSHOP_SUBSCRIBE'); ?> class="redshop_newsletter_tilmeld"/>
		</div>
	</div>
	<input type="hidden" name="option" value="com_redshop"/>
	<input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>"/>
	<input type="hidden" name="task" value=""/>
	<input type="hidden" name="view" value="newsletter"/>
	<input type="hidden" name="newsletteritemid" id="newsletteritemid" value="<?php echo $newsletteritemid; ?>">
	<input type="hidden" name="layout" value="default"/>
</form>

<script type="text/javascript">
	function validation() {
		var name = document.subscribeForm.name.value;
		var email = document.subscribeForm.email1.value;
		var patt1 = new RegExp("([a-z0-9_]+)@([^\\s+@\\s+$]+)[.][a-z]");

		if (name == '') {
			alert("<?php echo JText::_('COM_REDSHOP_ENTER_A_NAME');?>");
			return false;
		} else if (email == '') {
			alert("<?php echo JText::_('COM_REDSHOP_ENTER_AN_EMAIL_ADDRESS');?>");
			return false;
		} else if (patt1.test(email) == false) {
			alert("<?php echo JText::_('COM_REDSHOP_EMAIL_ADDRESS_NOT_VALID');?>");
			return false;
		}
		else {
			return true;
		}

	}
</script>
