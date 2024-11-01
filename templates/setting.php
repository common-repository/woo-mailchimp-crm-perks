<?php
if ( ! defined( 'ABSPATH' ) ) {
     exit;
 }                                         
 ?><h3><?php echo sprintf(__("Account ID# %d",'woo-mailchimp-crm-perks'),esc_attr($id));
if($new_account_id != $id){
 ?> <a href="<?php echo esc_url($new_account); ?>" title="<?php esc_html_e('Add New Account','woo-mailchimp-crm-perks'); ?>" class="add-new-h2"><?php esc_html_e("Add New Account",'woo-mailchimp-crm-perks'); ?></a> 
 <?php
}
$name=$this->post('name',$info);    
 ?>
 <a href="<?php echo esc_url($link) ?>" class="add-new-h2" title="<?php esc_html_e('Back to Accounts','woo-mailchimp-crm-perks'); ?>"><?php esc_html_e('Back to Accounts','woo-mailchimp-crm-perks'); ?></a></h3>
  <div class="crm_fields_table">
    <div class="crm_field">
  <div class="crm_field_cell1"><label for="vx_name"><?php esc_html_e("Account Name",'woo-mailchimp-crm-perks'); ?></label>
  </div>
  <div class="crm_field_cell2">
  <input type="text" name="crm[name]" value="<?php echo !empty($name) ? esc_html($name) : esc_html('Account #'.$id); ?>" id="vx_name" class="crm_text">

  </div>
  <div class="clear"></div>
  </div>
  
  
  <div class="crm_field">
  <div class="crm_field_cell1"><label for="vx_pass"><?php esc_html_e('API Key','woo-mailchimp-crm-perks'); ?></label></div>
  <div class="crm_field_cell2">
  <div class="vx_tr" >
  <div class="vx_td">
  <input type="password" id="vx_pass" name="crm[api_key]" class="crm_text" placeholder="<?php esc_html_e('MailChimp API Key','woo-mailchimp-crm-perks'); ?>" value="<?php echo esc_html($this->post('api_key',$info)); ?>" required>
  </div>
  <div class="vx_td2">
  <a href="#" class="button vx_toggle_btn vx_toggle_key" title="<?php esc_html_e('Toggle Key','woo-mailchimp-crm-perks'); ?>"><?php esc_html_e('Show Key','woo-mailchimp-crm-perks') ?></a>
  
  </div>
  </div>
  </div>
  <div class="clear"></div>
  </div>  
  
  
  <div class="crm_field">
  <div class="crm_field_cell1"><label for="vx_error_email"><?php esc_html_e("Notify by Email on Errors",'woo-mailchimp-crm-perks'); ?></label></div>
  <div class="crm_field_cell2"><textarea name="crm[error_email]" id="vx_error_email" placeholder="<?php esc_html_e("Enter comma separated email addresses",'woo-mailchimp-crm-perks'); ?>" class="crm_text" style="height: 70px"><?php echo isset($info['error_email']) ? esc_html($info['error_email']) : ""; ?></textarea>
  <span class="howto"><?php esc_html_e("Enter comma separated email addresses. An email will be sent to these email addresses if an order is not properly added to Salesforce. Leave blank to disable.",'woo-mailchimp-crm-perks'); ?></span>
  </div>
  <div class="clear"></div>
  </div>   


  <button type="submit" value="save" class="button-primary" title="<?php esc_html_e('Save Changes','woo-mailchimp-crm-perks'); ?>" name="save"><?php esc_html_e('Save Changes','woo-mailchimp-crm-perks'); ?></button>  
  </div>  

  <script type="text/javascript">

  jQuery(document).ready(function($){


  $(".vx_tabs_radio").click(function(){
  $(".vx_tabs").hide();   
  $("#tab_"+this.id).show();   
  }); 
$(".sf_login").click(function(e){
    if($("#vx_custom_app_check").is(":checked")){
    var client_id=$(this).data('id');
    var new_id=$("#app_id").val();
    if(client_id!=new_id){
          e.preventDefault();   
     alert("<?php esc_html_e('MailChimp Client ID Changed.Please save new changes first','woo-mailchimp-crm-perks') ?>");   
    }    
    }
})
  $("#vx_custom_app_check").click(function(){
     if($(this).is(":checked")){
         $("#vx_custom_app_div").show();
     }else{
            $("#vx_custom_app_div").hide();
     } 
  });
    $(document).on('click','#vx_revoke',function(e){
  
  if(!confirm('<?php esc_html_e('Notification - Remove Connection?','woo-mailchimp-crm-perks'); ?>')){
  e.preventDefault();   
  }
  })   
  })
  </script>  