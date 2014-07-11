<table class="admintable" border="0" cellspacing="0" cellpadding="0">
   <tbody>
      <tr valign="top">
         <td>{private_billing_template:ba_private_billing_template}{company_billing_template:ba_company_billing_template}</td>
      </tr>
      <tr>
         <td>
            {account_creation_start}
            <legend>Account Information</legend>
            <table class="admintable" border="0" width="100%">
               <tbody>
                  <tr>
                     <td>{username_lbl}</td>
                     <td>{username}</td>
                  </tr>
                  <tr>
                     <td width="100">{password_lbl}</td>
                     <td>{password}</td>
 
                     <td width="100">{confirm_password_lbl}</td>
                     <td>{confirm_password}</td>
                     
                  </tr>
                  <tr>
                     <td colspan="4">{newsletter_signup_chk}{newsletter_signup_lbl}</td>
                  </tr>
               </tbody>
            </table>
            {account_creation_end}
         </td>
      </tr>
     
      <tr class="trshipping_add">
         <td class="tdshipping_add" colspan="2">{sipping_same_as_billing_lbl} {sipping_same_as_billing}</td>
      </tr>
   </tbody>
</table>