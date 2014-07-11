<?php


// No direct access
defined('_JEXEC') or die;

$document->addStyleSheet(JURI::base(true) . '/modules/mod_redslider/assets/css/redevent.css');
?>

<?php
	$slide_params = json_decode($slide->params);

	$event_item = modRedSliderHelper::getEventItem($slide_params);

	$event_template = $slide->template_description;
	$event_template = str_replace("{session_title}", "<h1>" . $event_item->session_title . "</h1>", $event_template);
	$event_template = str_replace("{session_date}", "<h4>" . $event_item->session_date . "</h4>", $event_template);
	$event_template = str_replace("{event_title}", "<h2>" . $event_item->event_title . "</h2>", $event_template);
	$event_template = str_replace("{event_description}", $event_item->event_description, $event_template);
	$event_template = str_replace("{event_button}", "<input class=\"event-button\" type=\"button\" value=\"Buy ticket\">", $event_template);

?>

<li>
	<div class="content">
		<img src="<?php echo $slide->imgslide; ?>" />
	</div>

	<div class="event-template">
		<?php echo $event_template; ?>
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


