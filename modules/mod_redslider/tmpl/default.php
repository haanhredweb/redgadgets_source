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

$document = JFactory::getDocument();

// Load JS
if ($params->get('load_jquery'))
{
	$path = JURI::base(true) . '/modules/mod_redslider/assets/js/jquery.min.js';
	$document->addScript($path);
}

$path = JURI::base(true) . '/modules/mod_redslider/assets/plugins/jquery.fitvids.js';
$document->addScript($path);

$document->addScript(JURI::base(true) . '/modules/mod_redslider/assets/js/jquery.resize.min.js');

$path = JURI::base(true) . '/modules/mod_redslider/assets/js/jquery.bxslider.min.js';
$document->addScript($path);

// Pre process params from module
$slide_width = preg_replace('/[^0-9]/', '', $params->get('slide_width', 0));
$slide_height = preg_replace('/[^0-9]/', '', $params->get('slide_height', 0));
$adaptive_height = $params->get('adaptive_height', 1);
$slide_controls = $params->get('slide_controls', 1);
$pager = $params->get('pager', 0);
$thumbnail = $params->get('thumbnail', 0);
$thumbnail_width = preg_replace('/[^0-9]/', '', $params->get('thumbnail_width', 0));
$thumbnail_height = preg_replace('/[^0-9]/', '', $params->get('thumbnail_height', 0));
$thumbnail_controls = $params->get('thumbnail_controls', 1);
$num_of_thumbnails = $params->get('num_of_thumbnails', 4);
$animation_effect = $params->get('animation_effect', 'fade');
$auto_play = $params->get('auto_play', 0);
$pause_when_mouseover = $params->get('pause_when_mouseover', 0);
$display_time = $params->get('display_time', 5000);
$transition_duration = $params->get('transition_duration');

$strSlideWidth = "";

if ($slide_width != 0)
{
	$strSlideWidth = "slideWidth: " . $slide_width . ",";
}

if ($thumbnail == 0)
{
	$thumbnail_controls = 0;
}

echo '<script type="text/javascript">
		var jQuery = jQuery.noConflict();
		jQuery(document).ready(function($){

		var galleryMinSlides = ' . $num_of_thumbnails . ';
		var galleryMaxSlides = ' . $num_of_thumbnails . ';

		var bxslider;
		var gallery;
		var curSlideIdx = 0; // Current slide index
		var beginGallerySlideIdx = 0; // Current index of first slide in gallery

		var thumbnail = ' . $thumbnail . ';

		bxslider = jQuery(".bxslider_' . $module->id . '").bxSlider({
			' . $strSlideWidth . '
			adaptiveHeight: ' . $adaptive_height . ',
			mode: "' . $animation_effect . '",
			captions: true,
			speed: ' . $transition_duration . ',
			pause: ' . $display_time . ',
			auto: ' . $auto_play . ',
			autoHover: ' . $pause_when_mouseover . ',
			autoControls: false,
			controls: ' . $slide_controls . ',
			video: true,
			useCSS: true,
			responsive: true,
			pager: ' . $pager . ',
			onSlideNext: function(){
				if(thumbnail)
				{
					jQuery(".gallery_' . $module->id . ' .slide a[data-slide-index=\"" + curSlideIdx + "\"] img").css("border", "3px solid transparent");
					curSlideIdx ++;
					if(curSlideIdx == bxslider.getSlideCount())
					{
						curSlideIdx = 0;
					}
					jQuery(".gallery_' . $module->id . ' .slide a[data-slide-index=\"" + curSlideIdx + "\"] img").css("border", "3px solid red");

					if(isCurSlideAppearInGallery() == false)
					{
						gallery.goToNextSlide();
					}
				}
			},
			onSlidePrev: function(){
				if(thumbnail)
				{
					jQuery(".gallery_' . $module->id . ' .slide a[data-slide-index=\"" + curSlideIdx + "\"] img").css("border", "3px solid transparent");
					curSlideIdx --;
					if(curSlideIdx == -1)
					{
						curSlideIdx = bxslider.getSlideCount() - 1;
					}
					jQuery(".gallery_' . $module->id . ' .slide a[data-slide-index=\"" + curSlideIdx + "\"] img").css("border", "3px solid red");

					if(isCurSlideAppearInGallery() == false)
					{
						gallery.goToPrevSlide();
					}
				}
			}
	    });

	    gallery = jQuery(".gallery_' . $module->id . '").bxSlider({
	        slideWidth: ' . $thumbnail_width . ',
	        adaptiveHeight: true,
	        minSlides: ' . $num_of_thumbnails . ',
	        maxSlides: ' . $num_of_thumbnails . ',
	        slideMargin: 0,
	        pagerCustom: "#bx-pager",
	        controls: ' . $thumbnail_controls . ',
	        infiniteLoop: true,
	        onSliderLoad: function(){
				jQuery(".gallery_' . $module->id . ' .slide a img").css("border", "3px solid transparent");
				jQuery(".gallery_' . $module->id . ' .slide a[data-slide-index=\"0\"] img").css("border", "3px solid red");
			},
	        onSlideNext: function(){
				beginGallerySlideIdx += galleryMaxSlides;
				if(beginGallerySlideIdx >= gallery.getSlideCount())
				{
					beginGallerySlideIdx = 0;
				}
			},
	        onSlidePrev: function(){
				beginGallerySlideIdx -= galleryMaxSlides;
				if(beginGallerySlideIdx < 0)
				{
					beginGallerySlideIdx = gallery.getSlideCount() - (gallery.getSlideCount() % galleryMaxSlides);
				}
			}
	    });

	    jQuery(".gallery_' . $module->id . ' .slide a").click(function(){
		    jQuery(".gallery_' . $module->id . ' .slide a[data-slide-index=\"" + curSlideIdx + "\"] img").css("border", "3px solid transparent");
	        curSlideIdx = jQuery(this).attr("data-slide-index");
		    jQuery(".gallery_' . $module->id . ' .slide a[data-slide-index=\"" + curSlideIdx + "\"] img").css("border", "3px solid red");
		    bxslider.goToSlide(curSlideIdx);
	    });

	    // Check if the current slide appear in gallery bar
	    var isCurSlideAppearInGallery = function()
		{
			var result = false;

			temp = curSlideIdx - beginGallerySlideIdx;
			if(gallery.getSlideCount() - beginGallerySlideIdx < galleryMaxSlides
				&& curSlideIdx < beginGallerySlideIdx)
			{
				temp += gallery.getSlideCount();
			}

			if(0 <= temp && temp < galleryMaxSlides)
			{
				result = true;
			}

			return result;
		};
	});

	</script>';

// Load CSS
$document->addStyleSheet(JURI::base(true) . '/modules/mod_redslider/assets/css/jquery.bxslider.css');
$document->addStyleSheet(JURI::base(true) . '/modules/mod_redslider/assets/css/redslider.css');

// Create thumb image
modRedSliderHelper::createImg($slide_list, $slide_width, $slide_height, $thumbnail, $thumbnail_width, $thumbnail_height, $module->id);
?>

<div class="redslider_<?php echo $module->id; ?><?php echo $moduleclass_sfx; ?>">

	<ul class="bxslider_<?php echo $module->id; ?>">
		<?php foreach ($slide_list as $slide): ?>
			<?php require JModuleHelper::getLayoutPath('mod_redslider', 'default_' . $slide->type); ?>
		<?php endforeach;?>
	</ul>

	<?php if ($thumbnail): ?>
		<div class="gallery_<?php echo $module->id; ?>">
			<?php foreach ($slide_list as $key => $slide): ?>
				<div class="slide">
					<a data-slide-index="<?php echo $key; ?>">
						<img src="<?php echo $slide->imgthumb; ?>">
					</a>
				</div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>

</div>
