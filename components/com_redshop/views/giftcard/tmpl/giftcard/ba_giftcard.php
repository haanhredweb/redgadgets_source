

<div class="product">
	<div class="redshop_product_box row">
		<div class="col-md-6">
			<div class="product_image">{giftcard_image}</div>
		</div>
		<div class="col-md-6">
			<div class="product_detail_box">
				<div class="product_name">
					<h1>{giftcard_name}</h1>
				</div>
				<div class="product_price_main">
					<div class="product_price">{giftcard_price}</div>
					<div class="form_addtocart">{form_addtocart:ba_add_to_cart}</div>
				</div>
				<div class="product_desc">
					<ul class="nav nav-tabs">
					  <li class="active"><a href="#description" data-toggle="tab">Description</a></li>
					  <li><a href="#review" data-toggle="tab">Review</a></li>
					</ul>

					<div class="tab-content">
					  <div class="tab-pane fade in active" id="description">
					  	<div class="product_desc_row"><span class="title">Validity:</span><span>{giftcard_validity}</span></div>
					  	<div class="product_desc_row"><span class="title">Info:</span><span>{giftcard_desc}</span></div>
					  </div>
					  <div class="tab-pane fade" id="review">
					  	<div class="giftcard_reciver_name">{giftcard_reciver_name_lbl}{giftcard_reciver_name}</div>
						<div class="giftcard_reciver_name">{giftcard_reciver_email_lbl}{giftcard_reciver_email}</div>
					  </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
