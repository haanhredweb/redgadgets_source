<div class="product_print">{print}</div>

<div class="table_billing">
    <div class="row method">
        <div class="col-md-6 col-sm-6">
            <div class="adminform">
                <fieldset><legend>{order_information_lbl}</legend></legend>
                    <table>
                        <tr>
                            <td>{order_id_lbl} : {order_id}</td>
                        </tr>
                        <tr>
                            <td>{order_number_lbl} : {order_number}</td>
                        </tr>
                        <tr>
                            <td>{order_date_lbl} : {order_date}</td>
                        </tr>
                        <tr>
                            <td>{order_status_lbl} : {order_status}</td>
                        </tr>
                    </table>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="adminform">
                <fieldset><legend><strong>{discount_type_lbl}</strong></legend>
                <div>{discount_type}</div>
                </fieldset>
            </div>
        </div>
    </div>

    <div class="row billing">
        <div class="col-md-6 col-sm-6">
            <div class="adminform">
                <fieldset><legend><strong>{billing_address_information_lbl}</strong></legend>
                <div>{billing_address}</div>
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
                <fieldset><legend><strong>{shipping_method_lbl}</strong></legend>
                <div>{shipping_method}</div>
                </fieldset>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="adminform">
                <fieldset><legend><strong>{payment_lbl}</strong></legend>
                <div>{payment_method}: <strong>{payment_status}</strong></div>
                </fieldset>
            </div>
        </div>
    </div>

    <div class="row method">
        <div class="col-md-6 col-sm-6">
            <div class="adminform">
                <fieldset><legend><strong>{customer_note_lbl}</strong></legend>
                <div>{customer_note}</div>
                </fieldset>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="adminform">
                <fieldset><legend><strong>{requisition_number_lbl}</strong></legend>
                <div>{requisition_number}</div>
                </fieldset>
            </div>
        </div>
    </div>

</div>


<table class="cartproducts fixcheckout">
    <thead>
    <tr>
        <th class="cart_product_thumb_image"> </th>
        <th class="cart_product_name">{product_name_lbl}</th>
        <th class="cart_product_price">
            <table width="100%">
                <tbody>
                <tr>
                    <th class="tdproduct_price">{price_lbl}</th>
                    <th class="tdupdatecart">{quantity_lbl}</th>
                    <th class="tdproduct_total">{total_price_lbl}</th>
                </tr>
                </tbody>
            </table>
        </th>
    </tr>
    </thead>
    <tbody>
    <!-- {product_loop_start} -->
    <div class="category_print">{attribute_price_without_vat}</div>
    <tr>
        <td class="cart_product_thumb_image">{product_thumb_image}</td>
        <td class="cart_product_name">{attribute_price_with_vat}
            <div class="cartproducttitle">{product_name}</div>
            <div class="cartattribut">{product_attribute}</div>
            <div class="cartaccessory">{product_accessory}</div>
            <div class="cartwrapper">{product_wrapper}</div>
            <div class="cartuserfields">{product_userfields}</div>
        </td>
        <td class="cart_product_price">
            <table width="100%">
                <tbody>
                <tr>
                    <td class="tdproduct_price">{product_price_excl_vat}</td>
                    <td class="tdupdatecart">{product_quantity}</td>
                    <td class="tdproduct_total">{product_total_price_excl_vat}</td>
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
        <td class="carttotal_left"><br /></td>
        <td class="carttotal_right">
            <table class="cart_calculations" width="100%" border="0">
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
                    <td>{order_total}</td>
                </tr>
              
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>



