<?php

// Restrict Access to within Joomla
defined('_JEXEC') or die('Restricted access');

$input = JFactory::getApplication()->input;
$document = $this->document;
$option = $input->get('option', '');
$view = $input->get('view', '');

$classmain = '';
$showsidebar1 = true;

if (($option == 'com_redshop' && $view == 'product') || ($option == 'com_redshop' && $view == 'giftcard'))
{
	$showsidebar1 = false;
	$classmain = 'style="width: 100%"';

	$js = '
	function onchangePropertyDropdown(allarg){
		jQuery("#main-content select").select2({
			width: "element",
			dropdownCssClass: "main"
		});
	}

	jQuery(document).ready(function($){
		// Replace stat images
		$(".product_detail_box").find("img").each(function(){
			var src = $(this).attr("src");
			var a = src.replace("administrator/components/com_redshop/assets/images/star_rating", "templates/redgadgets/images/star_rating");
			$(this).attr("src", a);
		});
	});

	';

	$document->addScriptDeclaration($js);
}

$showsidebar2 = true;

if ($option == 'com_content' && $view == 'category')
{
	$showsidebar2 = false;
	$classmain = 'style="width: 100%"';
}

$bodyclass = "";

if ($this->countModules('toolbar'))
{
	$bodyclass = "toolbarpadding";
}

$bodystyle = "";

$backgroundimage = $this->params->get('backgroundimage', '');
$backgroundposition = $this->params->get('backgroundposition', 'tile');

if (!empty($backgroundimage))
{
	$bodystyle = 'style="background: url(\'' . $this->baseurl . '/images/' . $backgroundimage . '\');';

	if ($backgroundposition == 'tile')
	{
		$bodystyle .= 'background-repeat: repeat;';
	}
	else
	{
		$bodystyle .= 'background-repeat: no-repeat;';
		$bodystyle .= 'background-size: 100%';
	}

	$bodystyle .= '"';
}


$classmenu = "col-md-12";

if ($this->countModules('search'))
{
	$classmenu = "col-md-8 col-sm-9";
}
