<legend>Ordered items</legend>
<table class="table table-hover table-responsive orderlist" width="100%" border="0" cellspacing="5" cellpadding="5">
<tbody>
<tr><th>{order_id_lbl}</th><th>{product_name_lbl}</th><th>{total_price_lbl}</th><th>{order_date_lbl}</th><th>{order_status_lbl}</th><th>{order_detail_lbl}</th></tr>
<!--  {product_loop_start} -->
<tr>
<td>{order_id}</td>
<td>{order_products}</td>
<td>{order_total}</td>
<td>{order_date}</td>
<td>{order_status}</td>
<td>{order_detail_link}{reorder_link}</td>
</tr>
<!--  {product_loop_end} --></tbody>
</table>
<p>{pagination}</p>