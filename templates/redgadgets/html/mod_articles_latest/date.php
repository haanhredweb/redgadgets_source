<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_articles_latest
 * @copyright	Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
?>
<ul class="latestnews">
<?php foreach ($list as $item) : ?>
	<li>
		<div class="itemdate">
			<span class="itemday"><?php echo JHtml::_('date', $item->publish_up, 'd') ?></span>
			<span class="itemmonth"><?php echo JHtml::_('date', $item->publish_up, 'M') ?></span>
		</div>
		<div class="itemtext">
			<?php echo JHTML::_('string.truncate', ($item->introtext), 80, true, false); ?>
			<a href="<?php echo $item->link; ?>"><?php echo JText::_('TPL_REDGADGETS_READ_MORE'); ?></a>
		</div>
	</li>
<?php endforeach; ?>
</ul>


