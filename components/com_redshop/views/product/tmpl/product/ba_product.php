<div class="product">
<div class="redshop_product_box row"><!--Product Image-->
<div class="col-md-6">
<div class="product_image">{product_thumb_image}</div>
<div class="product_more_images">{more_images}</div>
</div>
<!--Product Details-->
<div class="col-md-6">
<div class="product_detail_box">
<div class="product_name">
<h1>{product_name}</h1>
</div>
<!-- AddThis Button Share Social -->
<div class="product_share">
<div class="addthis_toolbox addthis_default_style addthis_32x32_style">  <!-- AddThis Button END --></div>
<div class="div_product_rating_summary"><span class="product_rating_summary">{product_rating_summary}</span> <span class="form_rating">{form_rating}</span></div>
</div>
<div class="ask_question_about_product">{ask_question_about_product}</div>
<div class="product_attribute">{attribute_template:ba_attributes}</div>
<div class="product_stock_status">
<div class="product_stock_status_left"><span class="product_stock_status_title">AVAILABILITY: </span> {stock_status:stock_status:stock_status:stock_status}</div>
<div class="product_stock_status_right"><span class="stock_notify_flag">{stock_notify_flag}</span></div>
</div>
<div class="product_price_main">{if product_on_sale}
<div class="product_oldprice">{product_old_price}</div>
{product_on_sale end if}
<div class="product_price">{product_price}</div>
</div>
<!--Product Add to cart-->
<div class="div_product_addtocart md-col-6">
<div class="form_addtocart">{form_addtocart:ba_add_to_cart}</div>
<h2 class="or">OR</h2>
<div class="product_functions md-col-6">
<div class="product_wishlist">{wishlist_link}</div>
<div id="comp_{product_id}" class="product_compare">{compare_products_button}</div>
</div>
</div>
<div class="product_desc">
<ul class="nav nav-tabs">
<li class="active"><a href="#description" data-toggle="tab">Description</a></li>
<li><a href="#review" data-toggle="tab">Review</a></li>
</ul>
<div class="tab-content">
<div id="description" class="tab-pane fade in active">
<div class="product_desc_row"><span class="title">Manufacturer:</span><span>{manufacturer_name}</span></div>
<div class="product_desc_row"><span class="title">{product_number_lbl}</span><span>{product_number}</span></div>
<div class="product_desc_row"><span class="title">Info:</span><span>{product_desc}</span></div>
</div>
<div id="review" class="tab-pane fade">{product_rating}</div>
</div>
</div>
</div>
</div>
</div>
{related_product:ba_related_products}</div>
<div class="compare_product_div">
<div class="compare_product_close"> </div>
<div class="compare_product_div_inner">{compare_product_div}</div>
<div class="compare_product_bottom"> </div>
</div>