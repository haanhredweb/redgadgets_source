<div class="table_billing">
	<div class="row billing">
		<div class="col-md-6 col-sm-6">
			<div class="adminform">
				<fieldset><legend><strong>{billing_address_information_lbl}</strong></legend>
				<div>{billing_address}<br />{edit_billing_address}</div>
				</fieldset>
			</div>
		</div>
		<div class="col-md-6 col-sm-6">
			<div class="adminform">
				<fieldset><legend><strong>{shipping_address_information_lbl}</strong></legend>
				<div>{shipping_address}</div>
				</fieldset>
			</div>
		</div>
	</div>

	<div class="row method">
		<div class="col-md-6 col-sm-6">
			<div class="adminform">
				{shipping_template:shipping_method}
				{shippingbox_template:shipping_box}
			</div>
		</div>
		<div class="col-md-6 col-sm-6">
			<div class="adminform">
				{payment_template:payment_method}
			</div>
		</div>
	</div>

</div>



{checkout_template:ba_checkout}


