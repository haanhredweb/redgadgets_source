<table class="cartproducts">
   <thead>
      <tr>
         <th class="cart_product_thumb_image"> </th>
         <th class="cart_product_name">{product_name_lbl}</th>
         <th class="cart_product_price">
            <table>
               <tbody>
                  <tr>
                     <th class="tdproduct_price">{price_lbl}</th>
                     <th class="tdupdatecart">{quantity_lbl}</th>
                     <th class="tdproduct_total">{total_price_lbl}</th>
                     <th class="tdremove_product"> </th>
                  </tr>
               </tbody>
            </table>
         </th>
      </tr>
   </thead>
   <tbody>
      <!-- {product_loop_start} -->
      <tr>
         <td class="cart_product_thumb_image">{product_thumb_image}</td>
         <td class="cart_product_name">
            {attribute_price_with_vat}
            <div class="cartproducttitle">{product_name}</div>
            <div class="cartattribut">{product_attribute}{product_attribute_price}</div>
            <div class="cartaccessory">{product_accessory}</div>
            <div class="cartwrapper">{product_wrapper}</div>
            <div class="cartuserfields">{product_userfields}</div>
            <div>{attribute_change}</div>
         </td>
         <td class="cart_product_price">
            <table>
               <tbody>
                  <tr>
                     <td class="tdproduct_price">{product_price_excl_vat}</td>
                     <td class="tdupdatecart">{update_cart}</td>
                     <td class="tdproduct_total">{product_total_price_excl_vat}</td>
                     <td class="tdremove_product" align="right">{remove_product}</td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
      <!-- {product_loop_end} -->
   </tbody>
</table>

<table class="carttotal">
   <tbody>
      <tr>
         <td class="carttotal_left">
            <table border="0">
               <tbody>
                  <tr>
                     <td class="cart_discount_form" colspan="2">{discount_form_lbl}{coupon_code_lbl}{discount_form}</td>
                  </tr>
               </tbody>
            </table>
         </td>
         <td class="carttotal_right">
            <table class="cart_calculations" width="60%" border="0">
               <tbody>
                  <tr>
                     <td><strong>{product_subtotal_excl_vat_lbl}:</strong></td>
                     <td width="100">{product_subtotal_excl_vat}</td>
                  </tr>
                  <!-- {if discount}-->
                  <tr>
                     <td><strong>{discount_lbl}</strong></td>
                     <td width="100">{discount}</td>
                  </tr>
                  <!-- {discount end if} -->
                  <tr>
                     <td><strong>{shipping_with_vat_lbl}:</strong></td>
                     <td width="100">{shipping_excl_vat}</td>
                  </tr>
                  <!-- {if vat} -->
                  <tr>
                     <td><strong>{vat_lbl}</strong></td>
                     <td width="100">{tax}</td>
                  </tr>
                  <!-- {vat end if} --> <!-- {if payment_discount}-->
                  <tr>
                     <td><strong>{payment_discount_lbl}</strong></td>
                     <td width="100">{payment_order_discount}</td>
                  </tr>
                  <!-- {payment_discount end if}-->
                  <tr class="totalall">
                     <td><strong>{total_lbl}:</strong></td>
                     <td>{total}</td>
                  </tr>
                  <tr>
                     <td colspan="2">
                        {checkout_button}
                        <div class="shop_more">{shop_more}</div>
                     </td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>