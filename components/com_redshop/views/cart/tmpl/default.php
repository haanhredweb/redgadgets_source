<?php
/**
 * @package     RedSHOP.Frontend
 * @subpackage  Template
 *
 * @copyright   Copyright (C) 2005 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die;

include_once JPATH_COMPONENT . '/helpers/helper.php';
include_once JPATH_COMPONENT . '/helpers/product.php';
include_once JPATH_COMPONENT . '/helpers/cart.php';
$adminpath = JPATH_ADMINISTRATOR . '/components/com_redshop';
include_once $adminpath . '/helpers/shipping.php';

JHTML::_('behavior.tooltip');
JHTMLBehavior::modal();

$dispatcher    = JDispatcher::getInstance();
$producthelper = new producthelper;
$objshipping   = new shipping;
$redhelper     = new redhelper;
$carthelper    = new rsCarthelper;
$redTemplate   = new Redtemplate;

$url     = JURI::base();
$cart    = $this->cart;
$idx     = $cart['idx'];
$model   = $this->getModel('cart');
$session = JFactory::getSession();
$user    = JFactory::getUser();
$print   = JRequest::getInt('print');
$Itemid  = $redhelper->getCheckoutItemid();

// Define array to store product detail for ajax cart display
$cart_data = $this->data [0]->template_desc;

// Process the product plugin before cart template replace tag
JPluginHelper::importPlugin('redshop_product');
$results = $dispatcher->trigger('onStartCartTemplateReplace', array(& $cart_data, $cart));

// End

if ($cart_data == "")
{
	if (DEFAULT_QUOTATION_MODE)
	{
		$cart_data = '<h1>{cart_lbl}</h1><div class="category_print">{print}</div><br/><br/><table style="width: 90%;" border="0" cellspacing="10" cellpadding="10"><tbody><tr><td><table class="tdborder" style="width: 100%;" border="0" cellspacing="0" cellpadding="0"><thead><tr><th width="40%" align="left">{product_name_lbl}</th> <th width="35%"> </th><th width="25%">{quantity_lbl}</th></tr></thead><tbody>{product_loop_start}<tr class="tdborder"><td><div class="cartproducttitle">{product_name}</div><div class="cartattribut">{product_attribute}</div><div class="cartaccessory">{product_accessory}</div><div class="cartwrapper">{product_wrapper}</div><div class="cartuserfields">{product_userfields}</div></td><td>{product_thumb_image}</td><td><table border="0"><tbody><tr><td>{update_cart}</td><td>{remove_product}</td></tr></tbody></table></td></tr>{product_loop_end}</tbody></table></td></tr><tr><td><br></td></tr><tr><td><table style="width: 100%;" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td>{update}</td><td>{empty_cart}</td><td>{quotation_request}</td><td>{shop_more}</td></tr></tbody></table></td></tr></tbody></table>';
	}
	else
	{
		$cart_data = '<h1>{cart_lbl}</h1><div class="category_print">{print}</div><table class="tdborder" style="width: 100%;" border="0" cellspacing="0" cellpadding="0"><thead><tr><th>{product_name_lbl}</th> <th> <br /></th><th>{price_lbl} </th><th>{product_price_excl_lbl}</th><th>{quantity_lbl}</th><th>{total_price_lbl}</th><th>{total_price_exe_lbl}</th></tr></thead><tbody>{product_loop_start}<div class="category_print">{attribute_price_with_vat}</div><tr class="tdborder"><td><div class="cartproducttitle">{product_name}</div><div class="cartproducttitle">{product_old_price}</div><div class="cartattribut">{product_attribute}</div><div class="cartaccessory">{product_accessory}</div><div class="cartwrapper">{product_wrapper}</div><div class="cartuserfields">{product_userfields}</div></td><td>{product_thumb_image}</td><td>{product_price}<br />{vat_info}</td><td>{product_price_excl_vat}</td><td><table border="0"><tbody><tr><td>{update_cart}</td><td>{remove_product}</td></tr></tbody></table></td><td>{product_total_price}</td><td>{product_total_price_excl_vat}</td></tr>{product_loop_end}</tbody></table><p><strong class="discount_text"><br /><strong></p><table style="width: 100%;" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td width="50%" valign="top"><table border="0"><tbody><tr><td>{update}</td><td>{empty_cart}</td></tr><tr><td class="cart_discount_form" colspan="2">{discount_form_lbl}{coupon_code_lbl}<br />{discount_form}</td></tr></tbody></table><br /></td><td width="50%" align="right" valign="top"><br /><br /><table class="cart_calculations" border="0" width="100%"><tbody><tr class="tdborder"><td><b>{product_subtotal_lbl}:</b></td><td width="100">{product_subtotal}</td><td><b>{product_subtotal_excl_vat_lbl}:</b></td><td width="100">{product_subtotal_excl_vat}</td></tr><tr><td><b>{shipping_with_vat_lbl}:</b></td><td width="100">{shipping}</td><td><b>{shipping_excl_vat_lbl}:</b></td><td width="100">{shipping_excl_vat}{shipping_denotation}</td></tr>{if discount}<tr class="tdborder"><td>{discount_lbl}</td><td width="100">{discount}</td><td>{discount_lbl}</td><td width="100">{discount_excl_vat}{discount_denotation}</td></tr>{discount end if}<tr class="tdborder"><td><b>{totalpurchase_lbl}:</b></td><td width="100">{subtotal}</td><td><b>{subtotal_excl_vat_lbl} :</b></td><td width="100">{subtotal_excl_vat}</td></tr>{if vat}<tr><td>{vat_lbl}</td><td width="100">{tax}</td><td>{vat_lbl}</td><td width="100">{sub_total_vat}</td></tr>{vat end if}{if payment_discount}<tr><td>{payment_discount_lbl}</td><td width="100">{payment_order_discount}</td></tr>{payment_discount end if}<tr><td><div class="singleline"><strong>{total_lbl}:</strong></div></td><td width="100"><div class="singleline">{total}</div></td><td><div class="singleline"><b>{total_lbl}:</b></div></td><td width="100"><div class="singleline">{total_excl_vat}</div></td></tr><tr><td colspan="4"><strong>{denotation_label}</strong></div></td></tr></tbody></table>{checkout}<br /><br />{shop_more}</td></tr></tbody></table>';
	}
}

if ($print)
{
	$onclick = "onclick='window.print();'";
}
else
{
	$print_url = $url . "index.php?option=com_redshop&view=cart&print=1&tmpl=component&Itemid=" . $Itemid;
	$onclick   = "onclick='window.open(\"$print_url\",\"mywindow\",\"scrollbars=1\",\"location=1\")'";
}

$print_tag = "<a " . $onclick . " title='" . JText::_('COM_REDSHOP_PRINT_LBL') . "'>";
$print_tag .= "<img src='" . JSYSTEM_IMAGES_PATH . "printButton.png' alt='" . JText::_('COM_REDSHOP_PRINT_LBL') . "' title='" . JText::_('COM_REDSHOP_PRINT_LBL') . "' />";
$print_tag .= "</a>";

$cart_data = str_replace("{print}", $print_tag, $cart_data);

$q_id = '';
$pr_id = '';

for ($i = 0; $i < $idx; $i++)
{
	$product_id = $cart[$i]['product_id'];
	$pr_id .= $product_id;
	$q_id .= $cart[$i]['quantity'];

	if ($i != $idx - 1)
	{
		$pr_id .= ",";
		$q_id .= ",";
	}
}

$cart_data = $carthelper->replaceTemplate($cart, $cart_data, 0);
$session->set('cart', $cart);

if (strstr($cart_data, '{shipping_calculator}') && SHIPPING_METHOD_ENABLE)
{
	if (SHOW_SHIPPING_IN_CART)
	{
		$shipping_calc = $model->shippingrate_calc();
		$cart_data     = str_replace("{shipping_calculator}", $shipping_calc, $cart_data);
		$cart_data     = str_replace("{shipping_calculator_label}", JText::_('COM_REDSHOP_SHIPPING_CALCULATOR'), $cart_data);
	}
	else
	{
		$cart_data = str_replace("{shipping_calculator}", '', $cart_data);
		$cart_data = str_replace("{shipping_calculator_label}", '', $cart_data);
	}
}

if (DEFAULT_QUOTATION_MODE)
{
	$checkout = '';
}
else
{
	$checkout = '';
	JPluginHelper::importPlugin('redshop_payment');
	$dispatcher   = JDispatcher::getInstance();
	$pluginButton = $dispatcher->trigger('onPaymentCheckoutButton', array($cart));
	$pluginButton = implode("<br>", $pluginButton);

	// Google checkout start Div
	if ($pluginButton)
		$checkout .= '<div class="googlecheckout-button" style="float:left;">' . $pluginButton . '</div>';

	if (SSL_ENABLE_IN_CHECKOUT)
	{
		$uri    = JURI::getInstance();
		$c_link = new JURI;
		$c_link->setScheme('https');
		$c_link->setHost($uri->getHost());

		$c_link->setPath(JRoute::_('index.php?option=com_redshop&view=checkout&Itemid=' . $Itemid));
		$link = $c_link->toString();
	}
	else
	{
		$link = JRoute::_('index.php?option=com_redshop&view=checkout&Itemid=' . $Itemid);
	}

	$checkout .= '<div class="checkout_button"  style="float:right;">';
	$checkout .= '<input type=button class="greenbutton" value="' . JText::_('COM_REDSHOP_CART_CHECKOUT') . '" ';

	if (MINIMUM_ORDER_TOTAL > 0 && $cart ['total'] < MINIMUM_ORDER_TOTAL)
	{
		$checkout .= ' onclick="alert(\'' . JText::_('COM_REDSHOP_MINIMUM_ORDER_TOTAL_HAS_TO_BE_MORE_THAN') . ' ' . MINIMUM_ORDER_TOTAL . '\');">';
	}
	else
	{
		$checkout .= ' onclick="javascript:document.location=\'' . $link . '\'">';
	}

	$checkout .= '</div>';
}

$cart_data = str_replace("{checkout}", $checkout, $cart_data);
$cart_data = str_replace("{checkout_button}", $checkout, $cart_data);

$qlink = $url . 'index.php?option=com_redshop&view=quotation&tmpl=component&for=true&return=1&Itemid=' . $Itemid;
$quotation_request = '<a href="' . $qlink . '" class="modal" rel="{handler: \'iframe\', size: {x: 570, y: 550}}"><input type=button class="greenbutton" value= "' . JText::_('COM_REDSHOP_REQUEST_QUOTATION') . '" /></a>';
$cart_data = str_replace("{quotation_request}", $quotation_request, $cart_data);
/*
 * continue redirection link
 */
if (strstr($cart_data, "{shop_more}"))
{
	if (CONTINUE_REDIRECT_LINK != '')
	{
		$shopmorelink = JRoute::_(CONTINUE_REDIRECT_LINK);
	}
	else
	{
		$shopmorelink = JRoute::_('index.php?option=com_redshop&view=category&Itemid=' . $Itemid);
	}

	$shop_more = '<input type=button class="blackbutton" value="' . JText::_('COM_REDSHOP_SHOP_MORE') . '" onclick="javascript:document.location=\'' . $shopmorelink . '\'">';
	$cart_data = str_replace("{shop_more}", $shop_more, $cart_data);
}

$product_all = $pr_id;

$update_all = '<form style="padding:0px;margin:0px;" name="update_cart" method="POST" >
		<input class="inputbox" type="hidden" value="" name="quantity_all" id="quantity_all" size="3">
		<input type="hidden" name="product_all" value="' . $product_all . '">
		<input type="hidden" name="task" value="">
		<input type="hidden" name="Itemid" value="' . $Itemid . '">
		<input type=button class="blackbutton" value="' . JText::_('COM_REDSHOP_UPDATE') . '" onclick="all_update(' . $i . ');">
		</form>';

if (QUANTITY_TEXT_DISPLAY)
{
	$cart_data = str_replace("{update}", $update_all, $cart_data);
}
else
{
	$cart_data = str_replace("{update}", '', $cart_data);
}

$empty_cart = '<form style="padding:0px;margin:0px;" name="empty_cart" method="POST" >
		<input type="hidden" name="task" value="empty_cart">
		<input type=button class="blackbutton" value="' . JText::_('COM_REDSHOP_EMPTY') . '" onclick="document.empty_cart.submit();">
		</form>';

$cart_data = str_replace("{empty_cart}", $empty_cart, $cart_data);

$discount = $producthelper->getDiscountId(0);

if (count($discount) > 0)
{
	$text = '';

	if ($discount->discount_type == 0)
	{
		$discount_amount = $discount->discount_amount;
		$discount_sign   = " " . REDCURRENCY_SYMBOL;
	}
	else
	{
		$discount_amount = ($discount->amount * $discount->discount_amount) / (100);
		$discount_sign   = " %";
	}

	$diff  = $discount->amount - $cart ['product_subtotal'];
	$price = number_format($discount->discount_amount, PRICE_DECIMAL, PRICE_SEPERATOR, THOUSAND_SEPERATOR);

	if ($diff > 0)
	{
		$text = sprintf(JText::_('COM_REDSHOP_DISCOUNT_TEXT'), $producthelper->getProductFormattedPrice($diff, true), $producthelper->getProductFormattedPrice($discount_amount, true), $price . $discount_sign);
	}

	/*
 	  *  Discount type =  1 // Discount/coupon/voucher
	  *  Discount type =  2 // Discount + coupon/voucher
	  *  Discount type =  3 // Discount + coupon + voucher
	  *  Discount type =  4 // Discount + coupons + voucher
	  */
	if (DISCOUNT_TYPE && DISCOUNT_ENABLE == 1)
	{
		$cart_data = str_replace("{discount_rule}", $text, $cart_data);
	}
	else
	{
		$cart_data = str_replace("{discount_rule}", '', $cart_data);
	}
}
else
{
	$cart_data = str_replace("{discount_rule}", '', $cart_data);
}

$discount_form = '<div class="update_cart"><form name="discount_form" method="POST" >';
$coupon_lableFLG = 0;
$coupon_lable = '';
$confirmMsg = '';
$radiobttn = '';

if (COUPONS_ENABLE == 1 && VOUCHERS_ENABLE == 1)
{
	$discount_form .= '<input class="inputbox" type="text" value="" name="discount_code" id="coupon_input" size="5">';
	$discount_form .= '<input type="submit" id="coupon_button"  class="blackbutton" value="' . JText::_('COM_REDSHOP_SUBMIT_CODE') . '" onclick="document.discount_form.task.value=\'coupon\';document.discount_form.submit();" />';
	$coupon_lableFLG = 1;
}
elseif (COUPONS_ENABLE == 1 && VOUCHERS_ENABLE == 0)
{
	$discount_form .= '<input class="inputbox" type="text" value="" name="discount_code" id="coupon_input" size="5">';
	$discount_form .= '<input type="submit" id="coupon_button"  class="blackbutton" value="' . JText::_('COM_REDSHOP_SUBMIT_CODE') . '" onclick="document.discount_form.task.value=\'coupon\';document.discount_form.submit();" />';
	$coupon_lableFLG = 1;
}
elseif (COUPONS_ENABLE == 0 && VOUCHERS_ENABLE == 1)
{
	$discount_form .= '<input class="inputbox" id="coupon_input" type="text" value="" name="discount_code" size="5">';
	$discount_form .= '<input type="submit" id="coupon_button" class="blackbutton" value="' . JText::_('COM_REDSHOP_SUBMIT_CODE') . '" onclick="document.discount_form.task.value=\'voucher\';document.discount_form.submit();" />';
	$coupon_lableFLG = 1;
}

$discount_form .= '<input type="hidden" name="task" value=""><input type="hidden" name="Itemid" value="' . $Itemid . '">';
$discount_form .= '</form></div>';

if (DISCOUNT_TYPE == "0" || DISCOUNT_TYPE == "")
{
	$discount_form   = "";
	$coupon_lableFLG = 0;
}

if ($coupon_lableFLG)
{
	$coupon_lable = "<div id='coupon_label' class='coupon_label'>" . JText::_('COM_REDSHOP_CART_COUPON_CODE_TBL') . "</div>";
}

$cart_data = str_replace("{discount_form_lbl}", "", $cart_data);
$cart_data = str_replace("{discount_form}", $discount_form, $cart_data);
$cart_data = str_replace("{coupon_code_lbl}", $coupon_lable, $cart_data);
$cart_data = str_replace("{without_vat}", '', $cart_data);
$cart_data = str_replace("{with_vat}", '', $cart_data);

// Process the product plugin for cart item
JPluginHelper::importPlugin('redshop_product');
$results = $dispatcher->trigger('atEndCartTemplateReplace', array(& $cart_data, $cart));

$cart_data = $redTemplate->parseredSHOPplugin($cart_data);
echo eval ("?>" . $cart_data . "<?php ");
?>
<script type="text/javascript" language="javascript">
	function all_update(u) {
		q = "";

		for (var i = 0; i < u; i++) {
			qi = "quantitybox" + i;
			r = parseInt(document.getElementById(qi).value);

			q += r
			if (i != u - 1)
				q += ",";
		}
		document.update_cart.quantity_all.value = q;
		document.update_cart.task.value = 'update_all';
		document.update_cart.submit();
	}
</script>
