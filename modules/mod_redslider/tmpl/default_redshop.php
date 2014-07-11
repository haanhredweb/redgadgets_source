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

$document->addStyleSheet(JURI::base(true) . '/modules/mod_redslider/assets/css/redshop.css');
?>

<?php
	$slide_params = json_decode($slide->params);

	$product_item = modRedSliderHelper::getProductItem($slide_params);

	$product_image = $slide_params->product_image;

	if ($product_item->product_full_image)
	{
		$product_image = JURI::base(true) . '/components/com_redshop/assets/images/product/' . $product_item->product_full_image;
	}

	$product_template = $slide->template_description;
	$product_template = str_replace("{product_image}", '<img src="' . $product_image . '">', $product_template);
	$product_template = str_replace("{product_name}", $product_item->product_name, $product_template);
	$product_template = str_replace("{product_description}", $product_item->product_s_desc, $product_template);
	$product_template = str_replace("{product_price}", $product_item->product_price, $product_template);
	$product_template = str_replace("{product_quantity}", "<input class=\"product-quantity\" type=\"number\" value=\"1\" style=\"width:30px\">", $product_template);
	$product_template = str_replace("{addtocart_button}", "<input class=\"addtocart-button\" type=\"submit\" value=\"Add to cart\" style=\"width:100px\">", $product_template);

	require_once JPATH_SITE . '/components/com_redshop/helpers/helper.php';
	$product_helper = new producthelper;
	$attribute_list = $product_helper->getProductAttribute($product_item->product_id);

	$product_attribute_html = "";

	foreach ($attribute_list as $attribute)
	{
		$attribute_properties = $product_helper->getAttibuteProperty(0, $attribute->attribute_id);
		$select_row = new stdClass;
		$select_row->value = "0";
		$select_row->text = "Select " . $attribute->text;
		$attribute_properties = array_merge(array(0 => $select_row), $attribute_properties);
		$product_attribute_html .= "<div>" . JHtml::_('select.genericlist', $attribute_properties, '', 'class="product-attribute" name="product-attribute" style="width:100px"') . "</div>";
	}

	$product_template = str_replace("{product_attribute}", $product_attribute_html, $product_template);

?>

<li>
	<div class="content">
		<img src="<?php echo $slide->imgslide; ?>" />
	</div>

	<div class="product-content">
		<form id="addtocart_prd_<?php echo $product_item->product_id; ?>" name="addtocart_prd_<?php echo $product_item->product_id; ?>"
			class="addtocart_formclass" method="post" action="index.php?option=com_redshop&view=product&pid=<?php echo $product_item->product_id; ?>">
				<?php echo $product_template; ?>
		</form>
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


