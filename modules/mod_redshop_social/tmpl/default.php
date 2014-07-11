<?php
/**
 * @package		redSlider
 * @subpackage	mod_redslider
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

?>


<div class="mod_redshop_social">

	<?php
	$links = $list['link'];

	if (count($list) > 0)
	{
		echo '<ul>';

		foreach ($links as $i => $link)
		{
			if ($list['show'][$i])
			{
				$image = $list['image'][$i];
				$name = $list['name'][$i];
				echo '<li>';
				echo JHtml::_('link', $link, '<img alt="' . $name . '" src="' . $image . '">');
				echo '</li>';
			}
		}

		echo '</ul>';
	}

	if (!empty($introtext))
	{
		echo '<div class="introtext">' . $introtext . '</div>';
	}

	?>

</div>
