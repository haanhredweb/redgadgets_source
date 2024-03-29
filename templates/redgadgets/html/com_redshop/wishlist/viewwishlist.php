<?php
/**
 * @package     RedSHOP.Frontend
 * @subpackage  Template
 *
 * @copyright   Copyright (C) 2005 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die;

JHTML::_('behavior.tooltip');
JHTML::_('behavior.modal');

require_once JPATH_ADMINISTRATOR . '/components/com_redshop/helpers/category.php';
require_once JPATH_ROOT . '/components/com_redshop/helpers/product.php';
require_once JPATH_ROOT . '/components/com_redshop/helpers/helper.php';

$config = new Redconfiguration;
$producthelper = new producthelper;
$redhelper = new redhelper;

$url = JURI::base();
$Itemid = JRequest::getInt('Itemid');
$wishlists = $this->wishlists;
$product_id = JRequest::getInt('product_id');
$user = JFactory::getUser();

$pagetitle = JText::_('COM_REDSHOP_MY_WISHLIST');

$redTemplate = new Redtemplate;
$extraField = new extraField;
$template = $redTemplate->getTemplate("wishlist_template");
$wishlist_data1 = $template[0]->template_desc;
$returnArr = $producthelper->getProductUserfieldFromTemplate($wishlist_data1);
$template_userfield = $returnArr[0];
$userfieldArr = $returnArr[1];

	if ($this->params->get('show_page_heading', 1))
	{
		?>
		<h1 class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>"><?php echo $pagetitle; ?></h1>
		<div>&nbsp;</div>
	<?php
	}

if (!$user->id)
{
	$rows = $this->wish_session;

	echo "<div class='mod_redshop_wishlist'>";

	if (count($rows) > 0)
	{
		// Send mail link
		$mlink = JURI::root() . "index.php?option=com_redshop&view=account&layout=mywishlist&mail=1&tmpl=component";

		display_products($rows);
		$reglink = JRoute::_("index.php?wishlist=1&option=com_redshop&view=login&Itemid=" . $Itemid);

		for ($p = 0; $p < count($rows); $p++)
		{
			for ($ui = 0; $ui < count($userfieldArr); $ui++)
			{
				$product_userfileds = $extraField->list_all_user_fields($userfieldArr[$ui], 12, '', 0, 0, $rows[$p]->product_id);

				$ufield .= $product_userfileds[1];

				//
				if ($product_userfileds[1] != "")
				{
					$count_no_user_field++;
				}
			}

			$myproductid .= $rows[$p]->product_id . ",";
		}
		?>
		<script language="javascript">
			function clickMe() {
				window.location = "<?php echo $reglink ?>";
			}
		</script>

		<?php
		//echo "<br /><div><a href=\"".$reglink."\"><input type='button' onClick="clickMe();"  value='".JText::_('COM_REDSHOP_SAVE_WISHLIST')."' onclick="" ></a></div>";

		if ($count_no_user_field > 0)
		{
			echo "<br /><div id='saveid' style='clear:both;' style='display:block'><form method='post' ><input type='hidden' name='product_id' value='" . $myproductid . "' ><input type='button' onClick='return productalladdprice(1)'  value='" . JText::_('SAVE_WISHLIST') . "' ></form></div>";
		}
		else
		{
			echo "<br /><div id='saveid' style='clear:both;'><input type='button' onClick='clickMe()'  value='" . JText::_('COM_REDSHOP_SAVE_WISHLIST') . "' ></div>";
		}
	}
	else
	{
		echo "<div>" . JText::_('COM_REDSHOP_NO_PRODUCTS_IN_WISHLIST') . "</div>";
	}
	echo "</div>";
}
else
{
	// If user logged in than display this code.
	echo "<div class='mod_redshop_wishlist'>";

	if (count($this->wish_session) > 0)
	{
		$mlink = JURI::root() . "index.php?option=com_redshop&view=account&layout=mywishlist&mail=1&tmpl=component";

		display_products($this->wish_session);

		for ($p = 0; $p < count($mysesspro); $p++)
		{
			for ($ui = 0; $ui < count($userfieldArr); $ui++)
			{
				$product_userfileds = $extraField->list_all_user_fields($userfieldArr[$ui], 12, '', 0, 0, $rows[$p]->product_id);

				$ufield .= $product_userfileds[1];

				if ($product_userfileds[1] != "")
				{
					$count_no_user_field++;
				}
			}

			$myproductid .= $mysesspro[$p]->product_id . ",";
		}

		echo "<br />";
		$mywishlist_link = "index.php?tmpl=component&option=com_redshop&view=wishlist&task=addtowishlist&tmpl=component";

		if ($count_no_user_field > 0)
		{
			echo "<br /><div style='clear:both;' ><a class=\"redcolorproductimg\" href=\"" . $mywishlist_link . "\"  ><form method='post' ><input type='hidden' name='product_id' value='" . $myproductid . "' ><input type='button' onClick='return productalladdprice(2)'  value='" . JText::_('COM_REDSHOP_SAVE_WISHLIST') . "' ></form></a></div>";
		}
		else
		{
			echo "<div style=\"clear:both;\" ><a class=\"redcolorproductimg\" href=\"" . $mywishlist_link . "\"  ><input type='button'  value='" . JText::_('SAVE_WISHLIST') . "'></a></div><br /><br />";
		}
	}

	if (count($wishlists) > 0)
	{
		$wish_products = $this->wish_products;

		// Send mail link
		echo "<p class='redcolor'>". JText::_('TPL_REDGADGETS_YOURS_WISHLISTS') . "</p>";
		echo "<table class='table table-hover table-responsive'>";

		for ($j = 0; $j < count($wishlists); $j++)
		{
			$wishlist_link = JRoute::_("index.php?view=account&layout=mywishlist&wishlist_id=" . $wishlists[$j]->wishlist_id . "&option=com_redshop&Itemid=" . $Itemid);
			$del_wishlist  = JRoute::_("index.php?view=wishlist&task=delwishlist&wishlist_id=" . $wishlists[$j]->wishlist_id . "&option=com_redshop&Itemid=" . $Itemid);
			echo "<tr><td><a class='wishlist_item' href=\"" . $wishlist_link . "\">" . $wishlists[$j]->wishlist_name . "</a></td>"
				. "<td align='right'><a class='' href=\"" . $del_wishlist . "\">" . JText::_('COM_REDSHOP_DELETE') . "</a></td></tr>";
		}

		echo "</table>";
	}
	elseif (count($this->wish_session) <= 0 && count($wishlists) <= 0)
	{
		echo "<div>" . JText::_('COM_REDSHOP_NO_PRODUCTS_IN_WISHLIST') . "</div>";
	}

	echo "</div>";
}

function display_products($rows)
{
	$url           = JURI::base();
	$extraField    = new extraField;
	$session       = JFactory::getSession();
	$producthelper = new producthelper;
	$redhelper     = new redhelper;
	$config        = new Redconfiguration;
	$redTemplate   = new Redtemplate;
	$template      = $redTemplate->getTemplate("wishlist_template");

	if (count($template) <= 0)
	{
		for ($i = 0; $i < count($rows); $i++)
		{
			$row = $rows[$i];

			$Itemid = $redhelper->getItemid($row->product_id);
			$link   = JRoute::_('index.php?option=com_redshop&view=product&pid=' . $row->product_id . '&Itemid=' . $Itemid);

			$product_price          = $producthelper->getProductPrice($row->product_id);
			$product_price_discount = $producthelper->getProductNetPrice($row->product_id);

			echo "<div id='wishlist_box'>";

			if ($row->product_full_image)
			{
				echo $thum_image = "<div class='wishlist_left'><div class='mod_wishlist_product_image wishlist_image'>" .
					$thum_image = $producthelper->getProductImage($row->product_id, $link, "85", "63") . "</div></div>";
			}
			else
			{
				$maindefaultpath = REDSHOP_FRONT_IMAGES_ABSPATH . "product/" . PRODUCT_DEFAULT_IMAGE;
				echo  $thum_image = "<div class='wishlist_left'><div class='mod_wishlist_product_image wishlist_image'><a href='" . $link . "'><img src='" . $maindefaultpath . "' height='85' width='63' /></a></div></div>";
			}

			echo "<div class='wishlist_center'><div class='wishlist_title'><a href='" . $link . "'>" . $row->product_name . "</a></div><br>";

			if (!$row->not_for_sale)
			{
				if ($row->product_on_sale && $product_price_discount > 0)
				{
					if ($product_price > $product_price_discount)
					{
						$s_price = $product_price - $product_price_discount;

						if ($this->show_discountpricelayout)
						{
							echo "<div id='mod_redoldprice' class='mod_redoldprice'><span style='text-decoration:line-through;'>" . $producthelper->getProductFormattedPrice($product_price) . "</span></div>";
							$product_price = $product_price_discount;
							echo "<div id='mod_redmainprice' class='mod_redmainprice wishlist_price'>" . $producthelper->getProductFormattedPrice($product_price_discount) . "</div>";
							echo "<div id='mod_redsavedprice' class='mod_redsavedprice'>" . JText::_('COM_REDSHOP_PRODCUT_PRICE_YOU_SAVED') . ' ' . $producthelper->getProductFormattedPrice($s_price) . "</div>";
						}
						else
						{
							$product_price = $product_price_discount;
							echo "<div class='mod_redproducts_price wishlist_price'>" . $producthelper->getProductFormattedPrice($product_price) . "</div>";
						}
					}
					else
					{
						echo "<div class='mod_redproducts_price wishlist_price'>" . $producthelper->getProductFormattedPrice($product_price) . "</div>";
					}
				}
				else
				{
					echo "<div class='mod_redproducts_price wishlist_price'>" . $producthelper->getProductFormattedPrice($product_price) . "</div>";
				}
			}

			echo "<br><div class='wishlist_readmore'><a href='" . $link . "'>" . JText::_('COM_REDSHOP_READ_MORE') . "</a></div>&nbsp;</div> ";

			$addtocartdata = $producthelper->replaceCartTemplate($row->product_id, 0, 0, $row->product_id);

			echo "<div class='wishlist_right'>" . $addtocartdata . "</div><br class='clear' /></div><br class='clear' />";
		}
	}
	else
	{
		$ph_thumb       = CATEGORY_PRODUCT_THUMB_HEIGHT;
		$pw_thumb       = CATEGORY_PRODUCT_THUMB_WIDTH;
		$wishlist_data1 = $template[0]->template_desc;

		$mlink          = JURI::root() . "index.php?option=com_redshop&view=account&layout=mywishlist&mail=1&tmpl=component&wishlist_id=" . $wishlist_id;
		$mail_link      = '<a class="redcolorproductimg" href="' . $mlink . '"  ><img src="' . REDSHOP_ADMIN_IMAGES_ABSPATH . 'mailcenter16.png" ></a>';
		$wishlist_data1 = str_replace('{mail_link}', $mail_link, $wishlist_data1);
		$template_d1    = explode("{product_loop_start}", $wishlist_data1);
		$template_d2    = explode("{product_loop_end}", $template_d1[1]);
		$temp_template  = '';
		$extraFieldName = $extraField->getSectionFieldNameArray(1, 1, 1);

		for ($i = 0; $i < count($rows); $i++)
		{
			$row           = $rows[$i];
			$wishlist_data = $template_d2[0];

			$Itemid = $redhelper->getItemid($rows[$i]->product_id);
			$link   = JRoute::_('index.php?option=com_redshop&view=product&pid=' . $rows[$i]->product_id . '&Itemid=' . $Itemid);

			$product_price          = $producthelper->getProductPrice($row->product_id);
			$product_price_discount = $producthelper->getProductNetPrice($row->product_id);

			if ($row->product_full_image)
			{
				$thum_image    = $producthelper->getProductImage($row->product_id, $link, $pw_thumb, $ph_thumb);
				$wishlist_data = str_replace('{product_thumb_image}', $thum_image, $wishlist_data);
			}
			else
			{
				$maindefaultpath = RedShopHelperImages::getImagePath(
								PRODUCT_DEFAULT_IMAGE,
								'',
								'thumb',
								'product',
								$pw_thumb,
								$ph_thumb,
								USE_IMAGE_SIZE_SWAPPING
							);
				$thum_image      = "<a href='" . $link . "'><img src='" . $maindefaultpath . "'  /></a>";
				$wishlist_data   = str_replace('{product_thumb_image}', $thum_image, $wishlist_data);
			}

			$pname   = "<a href='" . $link . "'>" . $row->product_name . "</a>";
			$pnumber = $row->product_number;
			$pdesc   = $row->product_s_desc;

			// Checking for child products start
			if (strstr($wishlist_data, "{child_products}"))
			{
				$parentproductid = $row->product_id;

				if ($this->data->product_parent_id != 0)
				{
					$parentproductid = $producthelper->getMainParentProduct($row->product_id);
				}

				$frmChild = "";

				if ($parentproductid != 0)
				{
					$productInfo = $producthelper->getProductById($parentproductid);

					// Get child products
					$childproducts = $model->getAllChildProductArrayList(0, $parentproductid);

					if (count($childproducts) > 0)
					{
						$childproducts = array_merge(array($productInfo), $childproducts);

						$cld_name = array();

						if (count($childproducts) > 0)
						{
							$parentid = 0;

							for ($c = 0; $c < count($childproducts); $c++)
							{
								if ($childproducts[$c]->product_parent_id == 0)
								{
									$level = "";
								}
								else
								{
									if ($parentid != $childproducts[$c]->product_parent_id)
									{
										$level = $level;
									}
								}

								$parentid = $childproducts[$c]->product_parent_id;

								$childproducts[$c]->product_name = $level . $childproducts[$c]->product_name;
							}

							$cld_name = @array_merge($cld_name, $childproducts);
						}

						$selected                  = array($row->product_id);
						$lists['product_child_id'] = JHTML::_('select.genericlist', $cld_name, 'pid', 'class="inputbox" size="1"  onchange="document.frmChild.submit();"', 'product_id', 'product_name', $selected);

						$frmChild .= "<form name='frmChild' method='get'>";
						$frmChild .= JText::_('COM_REDSHOP_CHILD_PRODUCTS') . $lists ['product_child_id'];
						$frmChild .= "<input type='hidden' name='Itemid' value='" . $Itemid . "'>";
						$frmChild .= "<input type='hidden' name='cid' value='" . $row->category_id . "'>";
						$frmChild .= "<input type='hidden' name='view' value='product'>";
						$frmChild .= "<input type='hidden' name='option' value='com_redshop'>";
						$frmChild .= "</form>";

					}
				}

				$wishlist_data = str_replace("{child_products}", $frmChild, $wishlist_data);
			}

			$childproduct = $producthelper->getChildProduct($row->product_id);

			if (count($childproduct) > 0)
			{
				if (PURCHASE_PARENT_WITH_CHILD == 1)
				{
					$isChilds       = false;
					$attributes_set = array();

					if ($row->attribute_set_id > 0)
					{
						$attributes_set = $producthelper->getProductAttribute(0, $row->attribute_set_id, 0, 1);
					}

					$attributes = $producthelper->getProductAttribute($row->product_id);
					$attributes = array_merge($attributes, $wishlist_data);
				}
				else
				{
					$isChilds   = true;
					$attributes = array();
				}
			}
			else
			{
				$isChilds       = false;
				$attributes_set = array();

				if ($row->attribute_set_id > 0)
				{
					$attributes_set = $producthelper->getProductAttribute(0, $row->attribute_set_id, 0, 1);
				}

				$attributes = $producthelper->getProductAttribute($row->product_id);
				$attributes = array_merge($attributes, $attributes_set);
			}

			$attribute_template = $producthelper->getAttributeTemplate($wishlist_data);

			// Check product for not for sale
			$wishlist_data = $producthelper->getProductNotForSaleComment($row, $wishlist_data, $attributes);

			$wishlist_data = $producthelper->replaceProductInStock($row->product_id, $wishlist_data, $attributes, $attribute_template);

			/////////////////////////////////// Product attribute  Start /////////////////////////////////
			$totalatt      = count($attributes);
			$wishlist_data = $producthelper->replaceAttributeData($row->product_id, 0, 0, $attributes, $wishlist_data, $attribute_template, $isChilds);

			/////////////////////////////////// Product attribute  End  	// Checking for child products end/////////////////////////////////

			if (!$row->not_for_sale)
			{
				if ($row->product_on_sale && $product_price_discount > 0)
				{
					if ($product_price > $product_price_discount)
					{
						$s_price = $product_price - $product_price_discount;

						if ($this->show_discountpricelayout)
						{
							$mainproduct_price = $producthelper->getProductFormattedPrice($product_price);
							$product_price     = $product_price_discount;
							$mainproduct_price = $producthelper->getProductFormattedPrice($product_price_discount);

						}
						else
						{
							$product_price     = $product_price_discount;
							$mainproduct_price = $producthelper->getProductFormattedPrice($product_price);
						}
					}
					else
					{
						$mainproduct_price = $producthelper->getProductFormattedPrice($product_price);

					}
				}
				else
				{
					$mainproduct_price = $producthelper->getProductFormattedPrice($product_price);

				}

				$wishlist_data = str_replace('{product_price}', $mainproduct_price, $wishlist_data);
			}

			// Product User Field Start
			$count_no_user_field = 0;
			$returnArr           = $producthelper->getProductUserfieldFromTemplate($wishlist_data);
			$template_userfield  = $returnArr[0];

			$userfieldArr = $returnArr[1];

			if (strstr($wishlist_data, "{if product_userfield}") && strstr($wishlist_data, "{product_userfield end if}") && $template_userfield != "")
			{
				$ufield = "";
				$cart   = $session->get('cart');

				if (isset($cart['idx']))
				{
					$idx = (int) ($cart['idx']);
				}

				$idx     = 0;
				$cart_id = '';

				for ($j = 0; $j < $idx; $j++)
				{
					if ($cart[$j]['product_id'] == $row->product_id)
					{
						$cart_id = $j;
					}
				}

				for ($ui = 0; $ui < count($userfieldArr); $ui++)
				{
					if (!$idx)
					{
						$cart_id = "";
					}

					$mysesspro = "productuserfield_" . $ui;

					for ($check_i = 1; $check_i <= $_SESSION ["no_of_prod"]; $check_i++)
					{
						if ($_SESSION ['wish_' . $check_i]->product_id == $row->product_id)
						{
							$product_userfileds_final = $_SESSION['wish_' . $check_i]->$mysesspro;
						}
					}

					if ($product_userfileds_final != '')
					{
						$product_userfileds = $extraField->list_all_user_fields($userfieldArr[$ui], 12, '', '', 0, $row->product_id, $product_userfileds_final, 1);
					}
					else
					{
						$product_userfileds = $extraField->list_all_user_fields($userfieldArr[$ui], 12, '', $cart_id, 0, $row->product_id);
					}

					$ufield .= $product_userfileds[1];

					//
					if ($product_userfileds[1] != "")
					{
						$count_no_user_field++;
					}

					if ($product_userfileds_final != '')
					{
						$wishlist_data = str_replace('{' . $userfieldArr[$ui] . '_lbl}', $product_userfileds[0], $wishlist_data);
						$wishlist_data = str_replace('{' . $userfieldArr[$ui] . '}', $product_userfileds[1], $wishlist_data);
					}
					else
					{
						$wishlist_data = str_replace('{' . $userfieldArr[$ui] . '_lbl}', $product_userfileds[0], $wishlist_data);
						$wishlist_data = str_replace('{' . $userfieldArr[$ui] . '}', $product_userfileds[1], $wishlist_data);
					}
				}

				$product_userfileds_form = "<form method='post' action='' id='user_fields_form' name='user_fields_form'>";

				if ($ufield != "")
				{
					$wishlist_data = str_replace("{if product_userfield}", $product_userfileds_form, $wishlist_data);
					$wishlist_data = str_replace("{product_userfield end if}", "</form>", $wishlist_data);
				}
				else
				{
					$wishlist_data = str_replace("{if product_userfield}", "", $wishlist_data);
					$wishlist_data = str_replace("{product_userfield end if}", "", $wishlist_data);
				}
			}

			// Product User Field End

			/////////////////////////////////// Product accessory Start /////////////////////////////////
			$accessory      = $producthelper->getProductAccessory(0, $row->product_id);
			$totalAccessory = count($accessory);

			$wishlist_data = $producthelper->replaceAccessoryData($row->product_id, 0, $accessory, $wishlist_data, $isChilds);

			/////////////////////////////////// Product accessory End /////////////////////////////////

			$wishlist_data = str_replace('{product_name}', $pname, $wishlist_data);
			$wishlist_data = str_replace('{product_number}', $pnumber, $wishlist_data);
			$wishlist_data = str_replace('{product_s_desc}', $pdesc, $wishlist_data);

			$wishlist_data = $producthelper->getExtraSectionTag($extraFieldName, $row->product_id, "1", $wishlist_data, 1);
			$wishlist_data = $producthelper->replaceCartTemplate($row->product_id, $row->category_id, 0, 0, $wishlist_data, $isChilds, $userfieldArr, $totalatt, $totalAccessory, $count_no_user_field);

			$rmore         = "<a href='" . $link . "' title='" . $row->product_name . "'>" . JText::_('COM_REDSHOP_READ_MORE') . "</a>";
			$wishlist_data = str_replace("{read_more}", $rmore, $wishlist_data);
			$wishlist_data = str_replace("{read_more_link}", $link, $wishlist_data);
			$wishlist_data = str_replace("{product_loop_start}", '', $wishlist_data);
			$wishlist_data = str_replace("{product_loop_end}", '', $wishlist_data);
			$wishlist_data = str_replace("{back_link}", '', $wishlist_data);
			$wishlist_data = str_replace("{back_link}", '', $wishlist_data);
			$wishlist_data = str_replace("{mail_link}", '', $wishlist_data);
			$wishlist_data = str_replace("{if product_on_sale}", '', $wishlist_data);
			$wishlist_data = str_replace("{product_on_sale end if}", '', $wishlist_data);
			$wishlist_data = str_replace("<table></table>", '', $wishlist_data);
			$wishlist_data = str_replace("{all_cart}", '', $wishlist_data);
			$wishlist_data = str_replace("{if product_on_sale}", "", $wishlist_data);
			$wishlist_data = str_replace("{product_on_sale end if}", "", $wishlist_data);

			$regdellink     = JRoute::_("index.php?mydel=1&view=wishlist&wishlist_id=" . $row->product_id . "&task=mysessdelwishlist");
			$mainregdellink = "<div><a href=\"" . $regdellink . "\">" . JText::_('COM_REDSHOP_REMOVE_PRODUCT_FROM_WISHLIST') . "</a></div>";

			$wishlist_data = str_replace('{remove_product_link}', $mainregdellink, $wishlist_data);

			$mainid .= $row->product_id . ",";
			$totattid .= $totalatt . ",";
			$totcount_no_user_field .= $count_no_user_field . ",";

			$temp_template .= $wishlist_data;
		}

		$my = "<form name='frm' method='POST' action=''>";

		$my .= "<input type='hidden' name='product_id' id='product_id' value='" . $mainid . "' >

			<input type='hidden' name='totacc_id' id='totacc_id' value='" . $totattid . "' >
			<input type='hidden' name='totcount_no_user_field' id='totcount_no_user_field' value='" . $totcount_no_user_field . "' >
			<input type='button' name='submit' onclick='return productalladdprice();' value='" . JText::_('COM_REDSHOP_ADD_TO_CART') . "'>
			</form>";
		$data = $template_d1[0] . $temp_template . $template_d2[1];
		$data = str_replace('{back_link}', '', $data);
		$data = str_replace('{all_cart}', $my, $data);
		$data = $redTemplate->parseredSHOPplugin($data);
		echo eval("?>" . $data . "<?php ");
	}
}


