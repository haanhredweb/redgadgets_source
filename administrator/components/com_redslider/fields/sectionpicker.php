<?php
/**
 * @version     1.0
 * @package     Joomla
 * @subpackage  com_redslider
 * @author      redWEB Aps <khai@redweb.dk>
 * @copyright   com_redslider (C) 2008 - 2012 redCOMPONENT.com
 * @license     GNU/GPL, see LICENSE.php
 * com_redslider can be downloaded from www.redcomponent.com
 * com_redslider is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License 2
 * as published by the Free Software Foundation.
 * com_redslider is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with com_redslider; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 **/

class FOFFormFieldSectionpicker extends FOFFormFieldList
{
	protected function getOptions()
	{
		echo    '<script type="text/javascript">

					var article_content_params = "{article_name} Article name <br>" +
						                             "{article_description} Article description";

					var event_content_params = "{event_name} Event name <br>" +
					                           "{event_description} Event description";

					var form_content_params = "{form_name} Form name <br>" +
					                          "{form_description} Form description";

					var product_content_params = "{product_name} Name of product <br>" +
					                             "{product_description} Description of product <br>" +
					                             "{product_attribute} Product attribute <br>" +
					                             "{product_quantity} Product quantity <br>" +
					                             "{addtocart_button} Button Add to cart <br>" +
					                             "{product_image} Product image <br>" +
					                             "{product_price} Product price <br>";

					var article_content_default = "<table>&trade;" +
														"<tbody>&trade;" +
															"<tr>&trade;" +
																"<td>{article_name}</td>&trade;" +
															"</tr>&trade;" +
															"<tr>&trade;" +
																"<td>{article_description}</td>&trade;" +
															"</tr>&trade;" +
														"</tbody>&trade;" +
													"</table>&trade;";

					article_content_default = article_content_default.replace(/</g,"&lt;")
																		.replace(/>/g,"&gt;")
																		.replace(/&trade;/g, "<br/>");

					var event_content_default = "<table>&trade;" +
													"<tbody>&trade;" +
														"<tr>&trade;" +
															"<td>{session_title}</td>&trade;" +
														"</tr>&trade;" +
														"<tr>&trade;" +
															"<td>{session_date}</td>&trade;" +
														"</tr>&trade;" +
														"<tr>&trade;" +
															"<td>{event_title}</td>&trade;" +
														"</tr>&trade;" +
														"<tr>&trade;" +
															"<td>{event_description}</td>&trade;" +
														"</tr>&trade;" +
														"<tr>&trade;" +
															"<td>{event_button}</td>&trade;" +
														"</tr>&trade;" +
													"</tbody>&trade;" +
											    "</table>&trade;";

					event_content_default = event_content_default.replace(/</g,"&lt;")
																	.replace(/>/g,"&gt;")
																	.replace(/&trade;/g, "<br/>");

					var form_content_default = "<table>&trade;" +
													"<tbody>&trade;" +
														"<tr>&trade;" +
															"<td colspan=2>{form_title}</td>&trade;" +
														"</tr>&trade;" +
														"<tr>&trade;" +
															"<td>{form_field}</td>&trade;" +
														"<td>{form_field}</td>&trade;" +
														"</tr>&trade;" +
														"<tr>&trade;" +
															"<td colspan=2>{form_field}</td>&trade;" +
														"</tr>&trade;" +
														"<tr>&trade;" +
															"<td colspan=2>{form_button}</td>&trade;" +
														"</tr>&trade;" +
													"</tbody>&trade;" +
												"</table>&trade;";

					form_content_default = form_content_default.replace(/</g,"&lt;")
																	.replace(/>/g,"&gt;")
																	.replace(/&trade;/g, "<br/>");

					var product_content_default = "<table>&trade;" +
														"<tbody>&trade;" +

															"<tr>&trade;" +
																"<td rowspan=4>{product_image}</td>;" +
																"<td colspan=2>{product_name}</td>&trade;" +
															"</tr>&trade;" +
															"<tr>&trade;" +
																"<td colspan=2>{product_description}</td>&trade;" +
															"</tr>&trade;" +
															"<tr>&trade;" +
																"<td colspan=2>{product_attribute}</td>&trade;" +
															"</tr>&trade;" +
															"<tr>&trade;" +
																"<td>{product_price}</td>&trade;" +
																"<td>{product_quantity}</td>&trade;" +
																"<td>{addtocart_button}</td>&trade;" +
															"</tr>&trade;" +
														"</tbody>&trade;" +
													"</table>&trade;";


					product_content_default = product_content_default.replace(/</g,"&lt;")
																		.replace(/>/g,"&gt;")
																		.replace(/&trade;/g, "<br/>");

					window.onload = function()
					{
						var x = document.getElementById("content_params").getElementsByTagName("p");
						var y = document.getElementById("content_default").getElementsByTagName("p");
						var z = document.getElementById("section");

						setContent(x[0], y[0], z);

						z.onchange = function()
						{
							setContent(x[0], y[0], z);
						};
					};

					function setContent(content_params_area, content_default_area, section)
					{
						if (section.value == "article")
						{
							content_params_area.innerHTML = article_content_params;
							content_default_area.innerHTML = article_content_default;
						}
						else if (section.value == "event")
						{
							content_params_area.innerHTML = event_content_params;
							content_default_area.innerHTML = event_content_default;
						}
						else if (section.value == "form")
						{
							content_params_area.innerHTML = form_content_params;
							content_default_area.innerHTML = form_content_default;
						}
						else if (section.value == "product")
						{
							content_params_area.innerHTML = product_content_params;
							content_default_area.innerHTML = product_content_default;
						}
					}

				</script>';

		return parent::getOptions();
	}
}
?>