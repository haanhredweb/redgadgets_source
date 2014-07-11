<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_articles_latest
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
?>
<ul class="latestnews">
<?php foreach ($list as $item) : ?>
	<?php
	$images = json_decode($item->images);

	$rating = intval($item->rating);
	$rating_count = intval($item->rating_count);


	$starImageOn = JHtml::_('image', 'system/rating_star.png', null, null, true);
	$starImageOff = JHtml::_('image', 'system/rating_star_blank.png', null, null, true);

	$img_rating = "";

	for ($i = 0; $i < $rating; $i++)
	{
		$img_rating .= $starImageOn;
	}

	for ($i = $rating; $i < 5; $i++)
	{
		$img_rating .= $starImageOff;
	}

	$content_rating = '<p class="content_rating">' . $img_rating . "</p>";

	?>
	<li>
		<div class="row">
			<?php if (!empty($images->image_intro) && JFile::exists($images->image_intro)) : ?>
			<div class="col-md-5 col-sm-3 col-xs-5">
				<img src="<?php echo htmlspecialchars($images->image_intro); ?>" alt="<?php echo htmlspecialchars($images->image_intro_alt); ?>" />
			</div>
			<div class="col-md-7 col-sm-9 col-xs-7">
			<?php else : ?>
			<div class="col-md-12">
			<?php endif; ?>

				<a href="<?php echo $item->link; ?>">
					<?php echo $item->title; ?></a>
				<?php echo $content_rating ?>
				<p><?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', $item->hits); ?></p>
			</div>
		</div>
	</li>
<?php endforeach; ?>
</ul>
