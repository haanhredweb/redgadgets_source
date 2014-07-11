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

$document->addStyleSheet(JURI::base(true) . '/modules/mod_redslider/assets/css/video.css');

$slide_params = json_decode($slide->params);

$video_link = $slide_params->video_link;

$video_frame = '';

if (strpos($video_link, 'youtube') !== false || strpos($video_link, 'youtu.be') !== false)
{
	$arr_video_link = explode("/", $video_link);

	if (strpos($arr_video_link[count($arr_video_link) - 1], '=') !== false)
	{
		$arr_video_link = explode("=", $video_link);
	}

	$video_id = $arr_video_link[count($arr_video_link) - 1];

	$video_link = 'http://www.youtube.com/embed/' . $video_id;

	$src = $video_link;

	// Create video frame
	$video_frame = '<iframe title="YouTube video player"'
						. ' src=' . $src
						. ' width=' . $params->get('slide_width', 0)
						. ' height=' . $params->get('slide_height', 0)
						. ' frameborder="0"'
						. ' wmode="Opaque"'
						. 'allowfullscreen>'
					. '</iframe>';
}
elseif (strpos($video_link, 'vimeo') !== false)
{
	// Get video information from server vimeo
	$arr_video_link = explode("/", $video_link);
	$video_id = $arr_video_link[count($arr_video_link) - 1];
	/*$video_api_link = 'http://vimeo.com/api/v2/video/' . $video_id . '.xml';

	$curl = curl_init($video_api_link);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($curl, CURLOPT_TIMEOUT, 30);
	$videoData = simplexml_load_string(curl_exec($curl));
	curl_close($curl);*/

	// Default video color
	$vimeo_color = "ff0179";

	if ($slide_params->vimeo_color)
	{
		$vimeo_color = str_replace("#", "", $slide_params->vimeo_color);
	}

	// Show title
	$vimeo_title = 1;

	if ($slide_params->vimeo_title)
	{
		$vimeo_title = $slide_params->vimeo_title;
	}

	// Show byline
	$vimeo_byline = 1;

	if ($slide_params->vimeo_byline)
	{
		$vimeo_byline = $slide_params->vimeo_byline;
	}

	// Show portrait
	$vimeo_portrait = 1;

	if ($slide_params->vimeo_portrait)
	{
		$vimeo_portrait = $slide_params->vimeo_portrait;
	}

	// Create video link
	$video_link = 'http://player.vimeo.com/video/' . $video_id;

	// Create source for video frame
	$src = $video_link . '?'
		. 'title=' . $vimeo_title . '&amp;'
		. 'byline=' . $vimeo_byline . '&amp;'
		. 'portrait=' . $vimeo_portrait . '&amp;'
		. 'color=' . $vimeo_color;

	// Create video frame
	$video_frame = '<iframe src=' . $src
						. ' width=' . $params->get('slide_width', 0)
						. ' height=' . $params->get('slide_height', 0)
						. ' frameborder="0"'
						. ' webkitAllowFullScreen'
						. ' mozallowfullscreen'
						. ' allowFullScreen>'
					. '</iframe>';
}
else
{
	$video_frame = 'No Video';
}
?>

<li>
	<div class="content">
		<?php
		if ($video_frame)
		{
			echo $video_frame;
		}
		?>
	</div>

	<div class="caption-description">
		<?php if ($slide_params->caption): ?>
			<h1><?php echo $slide_params->caption; ?></h1>
		<?php endif;?>
		<?php if ($slide_params->description): ?>
			<p><?php echo $slide_params->description; ?></p>
		<?php endif;?>
		<?php if ($slide_params->link): ?>
			<?php
				  $link_text = $slide_params->link_text;
				  $link = $slide_params->link;

				  if (!$link_text)
				  {
					  $link_text = $link;
				  }

				  if (strpos($link, 'http://') === false)
				  {
					  $link = 'http://' . $link;
				  }
			?>
			<?php echo '<a href="' . JRoute::_($link) . '">' . $link_text . '</a>'; ?>
		<?php endif;?>
	</div>

</li>

