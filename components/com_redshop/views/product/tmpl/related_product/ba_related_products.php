<div class="gd_header">Similiar Product</div>
<div class="category_box clearfix">
	<div class="related_product_wrapper">
		{related_product_start}
		<div class="related_product_inside">
			<div class="category_box_inside">
				<div class="category_product_image">{relproduct_image}</div>
				{if product_on_sale}
					<div class="category_product_oldprice">{relproduct_old_price}</div>
					<div class="category_product_conner">Sale</div>
				{product_on_sale end if}
				<div class="category_product_price">{relproduct_price}</div>
				
				<div class="category_product_name">{relproduct_name}</div>
				<div class="category_product_s_desc">{relproduct_s_desc}</div>
				<div class="category_product_addtocart">{form_addtocart:add_to_cart1}</div>
			</div>

		</div>
		{related_product_end}
	</div>
</div>