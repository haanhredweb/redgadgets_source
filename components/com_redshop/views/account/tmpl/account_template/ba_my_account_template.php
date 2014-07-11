
<div class="row">
	<div class="col-md-12 ">
		 <table border="0" cellspacing="0" cellpadding="2" class="table_billing">
           <tbody>
              <tr>
                 <td class="account_label">{fullname_lbl}</td>
                 <td class="account_field">{fullname}</td>
              </tr>
              <tr>
                 <td class="account_label">{state_lbl}</td>
                 <td class="account_field">{state}</td>
              </tr>
              <tr>
                 <td class="account_label">{country_lbl}</td>
                 <td class="account_field">{country}</td>
              </tr>
              <tr>
                 <td class="account_label">{vatnumber_lbl}</td>
                 <td class="account_field">{vatnumber}</td>
              </tr>
              <tr>
                 <td class="account_label">{ean_number_lbl}</td>
                 <td class="account_field">{ean_number}</td>
              </tr>
              <tr>
                 <td class="account_label">{email_lbl}</td>
                 <td class="account_field">{email}</td>
              </tr>
              <tr>
                 <td class="account_label">{company_name_lbl}</td>
                 <td class="account_field">{company_name}</td>
              </tr>
              <tr>
                 <td colspan="2">{edit_account_link}</td>
              </tr>
           </tbody>
        </table>
	</div>

	<div class="hidden">
		<!-- {order_loop_start} -->
		{order_index} {order_id} {order_detail_link}
		<!-- {order_loop_end} -->
		{more_orders}
	</div>
	
</div>



