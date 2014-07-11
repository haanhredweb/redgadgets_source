<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_login
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
JHtml::_('behavior.keepalive');

$menu = JFactory::getApplication()->getMenu();

$registrationlink = 'index.php?option=com_users&view=registration';
$menuItem = $menu->getItems('link', $registrationlink, true);
$registrationItemid = $menuItem->id;

$loginlink = 'index.php?option=com_users&view=login';
$menuItem = $menu->getItems('link', $loginlink, true);
$loginItemid = $menuItem->id;


$profilelink = 'index.php?option=com_redshop&view=account';
$menuItem = $menu->getItems('link', $profilelink, true);

if (!isset($menuItem->id))
{
	$profileItemid = 113;
}
else
{
	$profileItemid = $menuItem->id;
}

$profilelink = 'index.php?option=com_redshop&view=account&Itemid=' . $profileItemid;

?>
<ul>
<?php if ($type == 'logout') : ?>
<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="login-form">
<?php if ($params->get('greeting')) : ?>
	<li>
	<?php if($params->get('name') == 0) : {
		echo htmlspecialchars($user->get('name'));
	} else : {
		echo htmlspecialchars($user->get('username'));
	} endif; ?>
	<div class="logout-button">
		<div class="logout-button-inner">
			<div class="profile"><a href="<?php echo $profilelink  ?>"><?php echo JText::_('TPL_REDGADGETS_PROFILE'); ?></a></div>
			<div class="logout">
				<input type="submit" name="Submit" value="<?php echo JText::_('JLOGOUT'); ?>" />
				<input type="hidden" name="option" value="com_users" />
				<input type="hidden" name="task" value="user.logout" />
				<input type="hidden" name="return" value="<?php echo $return; ?>" />
				<?php echo JHtml::_('form.token'); ?>
			</div>
		</div>
	</div>
	</li>
<?php endif; ?>
</form>
<?php else : ?>
<?php
$usersConfig = JComponentHelper::getParams('com_users');



if ($usersConfig->get('allowUserRegistration')) : ?>
<li>
	<a id="registration" href="<?php echo JRoute::_('index.php?option=com_users&view=registration&Itemid=' . $registrationItemid . '&tmpl=component'); ?>"><?php echo JText::_('JREGISTER'); ?></a>
</li>
<li>
	<a id="login" href="<?php echo JRoute::_('index.php?option=com_users&view=login&Itemid=' . $loginItemid . '&tmpl=component'); ?>"><?php echo JText::_('JLOGIN'); ?></a>
</li>
<?php endif; ?>
</ul>

<?php endif; ?>


<script type="text/javascript">
jQuery(document).ready(function($){
	$('#registration').colorbox();
	$('#login').colorbox();
});
</script>

