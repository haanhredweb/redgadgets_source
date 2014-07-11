<div class="category_box">
<div class="category_total_product">{total_product} {total_product_lbl}</div>
<div class="order_by"><label>{order_by_lbl}</label>{order_by}</div>
<div class="category_box_wrapper">{product_loop_start}
<div class="category_box_outside">
<div class="category_box_inside">
<div class="category_product_image">{product_thumb_image}</div>
{if product_on_sale}
<div class="category_product_oldprice">{product_old_price}</div>
<div class="category_product_conner">Sale</div>
{product_on_sale end if}
<div class="category_product_price">{product_price}</div>
<div class="category_product_name">{product_name}</div>
<div class="category_product_s_desc">{product_s_desc}</div>
<div class="category_product_buttons col-md-12">
<div class="row">
<div class="category_product_wishlist col-md-3">{wishlist_link} </div>
<div class="category_product_addtocart col-md-6">{form_addtocart:add_to_cart1}</div>
<div id="comp_{product_id}" class="category_product_compare col-md-3">{compare_products_button}</div>
</div>
</div>
</div>
</div>
{product_loop_end}</div>
<div class="category_pagination">{pagination}</div>
</div>
<div class="compare_product_div">
<div class="compare_product_close"> </div>
<div class="compare_product_div_inner">{compare_product_div}</div>
<div class="compare_product_bottom"> </div>
</div>