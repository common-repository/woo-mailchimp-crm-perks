<?php
if ( ! defined( 'ABSPATH' ) ) {
     exit;
 }                                            
 ?>
<h3><?php esc_html_e('MailChimp Accounts','woo-mailchimp-crm-perks'); ?> <a href="<?php echo esc_url($new_account); ?>" title="<?php esc_html_e('Add New Account','woo-mailchimp-crm-perks'); ?>" class="add-new-h2"><?php esc_html_e('Add New Account','woo-mailchimp-crm-perks'); ?></a> </h3>
  <p><?php echo sprintf(__("If you don't have a MailChimp account, you can %ssign up for one here%s.",'woo-mailchimp-crm-perks'),'<a href="http://www.MailChimp.com/" class="help_tip" data-tip="'.__('MailChimp Signup','woo-mailchimp-crm-perks').'" target="_blank">','</a>'); ?> </p>

<table class="widefat fixed sort striped vx_accounts_table">
<thead>
<tr>
<th class="manage-column column-cb vx_pointer" style="width: 30px" ><?php esc_html_e("#",'woo-mailchimp-crm-perks'); ?> <i class="fa fa-caret-up"></i><i class="fa fa-caret-down"></i></th>  
<th class="manage-column vx_pointer"> <?php esc_html_e("Account",'woo-mailchimp-crm-perks'); ?> <i class="fa fa-caret-up"></i><i class="fa fa-caret-down"></i> </th> 
<th class="manage-column"> <?php esc_html_e("Status",'woo-mailchimp-crm-perks'); ?></th> 
<th class="manage-column vx_pointer"> <?php esc_html_e("Created",'woo-mailchimp-crm-perks'); ?> <i class="fa fa-caret-up"></i><i class="fa fa-caret-down"></i></th> 
<th class="manage-column vx_pointer"> <?php esc_html_e("Last Connection",'woo-mailchimp-crm-perks'); ?> <i class="fa fa-caret-up"></i><i class="fa fa-caret-down"></i></th> 
<th class="manage-column"> <?php esc_html_e("Action",'woo-mailchimp-crm-perks'); ?> </th> </tr>
</thead>
<tbody>
<?php

$nonce=wp_create_nonce("vx_nonce");
if(is_array($accounts) && count($accounts) > 0){
 $sno=0;   
foreach($accounts as $id=>$v){
    $sno++; $id=$v['id'];
    $icon= $v['status'] == "1" ? 'fa-check vx_green' : 'fa-times vx_red';
    $icon_title= $v['status'] == "1" ? __('Connected','woo-mailchimp-crm-perks') : __('Disconnected','woo-mailchimp-crm-perks');
 ?>
<tr> <td><?php echo esc_attr($id) ?></td>  <td> <?php echo esc_html($v['name']) ?></td> 
<td> <i class="fa <?php echo esc_html($icon) ?> help_tip" data-tip="<?php echo esc_html($icon_title) ?>"></i> </td> <td> <?php echo date('M-d-Y H:i:s', strtotime($v['time'])+$offset) ?> </td>
 <td> <?php echo date('M-d-Y H:i:s', strtotime($v['updated'])+$offset); ?> </td> 
<td><span class="row-actions visible"> 
<a href="<?php echo esc_url($link."&id=".$id) ?>" title="<?php esc_html_e('View/Edit','woo-mailchimp-crm-perks'); ?>"><?php 
if($v['status'] == "1"){
esc_html_e("View",'woo-mailchimp-crm-perks');
}else{ 
esc_html_e("Edit",'woo-mailchimp-crm-perks'); 
}
?></a>
 | <span class="delete"><a href="<?php echo esc_url($link.'&'.$this->id.'_tab_action=del_account&id='.$id.'&vx_nonce='.$nonce) ?>" class="vx_del_account" title="<?php esc_html_e("Delete",'woo-mailchimp-crm-perks'); ?>" > <?php esc_html_e("Delete",'woo-mailchimp-crm-perks'); ?> </a></span></span> </td> </tr>
<?php
} }else{
?>
<tr><td colspan="6"><p><?php echo sprintf(__("No MailChimp Account Found. %sAdd New Account%s",'woo-mailchimp-crm-perks'),'<a href="'.esc_url($new_account).'">','</a>'); ?></p></td></tr>
<?php
}
?>
</tbody>
<tfoot>
<tr> <th class="manage-column column-cb" style="width: 30px" ><?php esc_html_e("#",'woo-mailchimp-crm-perks'); ?></th>  
<th class="manage-column"> <?php esc_html_e("Account",'woo-mailchimp-crm-perks'); ?> </th> 
<th class="manage-column"> <?php esc_html_e("Status",'woo-mailchimp-crm-perks'); ?> </th> 
<th class="manage-column"> <?php esc_html_e("Created",'woo-mailchimp-crm-perks'); ?> </th> 
<th class="manage-column"> <?php esc_html_e("Last Connection",'woo-mailchimp-crm-perks'); ?> </th> 
<th class="manage-column"> <?php esc_html_e("Action",'woo-mailchimp-crm-perks'); ?> </th> </tr>
</tfoot>
</table>
<div style="margin-top: 40px;">

<?php
       $check_events=array(
           '' => 'Do not display checkbox',
           'review_order_before_submit' => 'Before Submit Button',
      'review_order_after_submit' => 'After Submit Button',
      'checkout_before_customer_details' => 'Before Customer Detail',
      'checkout_after_customer_details' => 'After Customer Detail',
      'after_checkout_billing_form' => 'After Billing fields');
    $check_ops=array('hide'=>'Hide Checkbox',''=>'Allow changing preference');  
$check_text=$this->post('check_text',$meta);
$check_text2=$this->post('check_text2',$meta); 
?>
<h3><?php esc_html_e('First Subscribe Checkbox on Checkout Page','woo-mailchimp-crm-perks');  ?></h3>
<table class="form-table">
  <tr>
  <th scope="row"><label><?php esc_html_e('Checkbox', 'woo-mailchimp-crm-perks'); ?></label>
  </th>
  <td>
 <select name="meta[check]" style="width: 100%;" autocomplete="off">
  <?php echo $this->gen_select($check_events,$this->post('check',$meta)); ?>
  </select>
  </td>
  </tr>  
  
  <tr>
  <th scope="row"><label><?php esc_html_e('Checkbox Text', 'woo-mailchimp-crm-perks'); ?></label>
  </th>
  <td>
<textarea  name="meta[check_text]" style="width: 100%;"><?php echo htmlentities(wp_kses_post($check_text)); ?></textarea>
  </td>
  </tr>  
  <tr>
  <th scope="row"><label><?php esc_html_e('Show Checked', 'woo-mailchimp-crm-perks'); ?></label>
  </th>
  <td>
 <input type="checkbox" style="margin-top: 0px;" id="crm_sel_checked" class="crm_toggle_check" name="meta[checked]" value="1" <?php echo !empty($meta['checked']) ? "checked='checked'" : ""?>/>
  <label for="crm_sel_checked">
  <?php esc_html_e('Checkbox should be "Checked" by default ', 'woo-mailchimp-crm-perks'); ?>
  </label>
  </td>
  </tr> 
  <tr>
  <th scope="row"><label><?php esc_html_e('If user is already subscribed', 'woo-mailchimp-crm-perks'); ?></label>
  </th>
  <td>
 <select name="meta[if_checked]" style="width: 100%;" autocomplete="off">
  <?php echo $this->gen_select($check_ops,$this->post('if_checked',$meta)); ?>
  </select>
  </td>
  </tr>
</table>

<h3><?php esc_html_e('Second Subscribe Checkbox on Checkout Page','woo-mailchimp-crm-perks');  ?></h3>
<table class="form-table">
  <tr>
  <th scope="row"><label><?php esc_html_e('Checkbox', 'woo-mailchimp-crm-perks'); ?></label>
  </th>
  <td>
 <select name="meta[check2]" style="width: 100%;" autocomplete="off">
  <?php echo $this->gen_select($check_events,$this->post('check2',$meta)); ?>
  </select>
  </td>
  </tr>  
  
  <tr>
  <th scope="row"><label><?php esc_html_e('Checkbox Text', 'woo-mailchimp-crm-perks'); ?></label>
  </th>
  <td>
<textarea  name="meta[check_text2]" style="width: 100%;"><?php echo htmlentities(wp_kses_post($check_text2)); ?></textarea>
  </td>
  </tr>  
  <tr>
  <th scope="row"><label><?php esc_html_e('Show Checked', 'woo-mailchimp-crm-perks'); ?></label>
  </th>
  <td>
 <input type="checkbox" style="margin-top: 0px;" id="crm_sel_checked" class="crm_toggle_check" name="meta[checked2]" value="1" <?php echo !empty($meta['checked2']) ? "checked='checked'" : ""?>/>
  <label for="crm_sel_checked">
  <?php esc_html_e('Checkbox should be "Checked" by default ', 'woo-mailchimp-crm-perks'); ?>
  </label>
  </td>
  </tr> 
  <tr>
  <th scope="row"><label><?php esc_html_e('If user is already subscribed', 'woo-mailchimp-crm-perks'); ?></label>
  </th>
  <td>
 <select name="meta[if_checked2]" style="width: 100%;" autocomplete="off">
  <?php echo $this->gen_select($check_ops,$this->post('if_checked2',$meta)); ?>
  </select>
  </td>
  </tr>
</table>
  
<h3><?php esc_html_e('Optional Settings','woo-mailchimp-crm-perks');  ?></h3>

<table class="form-table">
  <tr>
  <th scope="row"><label for="vx_plugin_data"><?php esc_html_e("Plugin Data", 'woo-mailchimp-crm-perks'); ?></label>
  </th>
  <td>
<label for="vx_plugin_data"><input type="checkbox" name="meta[plugin_data]" value="yes" <?php if($this->post('plugin_data',$meta) == "yes"){echo 'checked="checked"';} ?> id="vx_plugin_data"><?php esc_html_e('On deleting this plugin remove all of its data','woo-mailchimp-crm-perks'); ?></label>
  </td>
  </tr>

<tr>
<th><label for="update_meta"><?php esc_html_e("Update Order",'woo-mailchimp-crm-perks');  ?></label></th>
<td><label for="update_meta"><input type="checkbox" id="update_meta" name="meta[update]" value="yes" <?php if($this->post('update',$meta) == "yes"){echo 'checked="checked"';} ?> ><?php esc_html_e("Send order data to MailChimp when updated in WooCommerce",'woo-mailchimp-crm-perks');  ?></label></td>
</tr>
<tr>
<th><label for="delete_meta"><?php esc_html_e("Trash Order",'woo-mailchimp-crm-perks');  ?></label></th>
<td><label for="delete_meta"><input type="checkbox" id="delete_meta" name="meta[delete]" value="yes" <?php if($this->post('delete',$meta) == "yes"){echo 'checked="checked"';} ?> ><?php esc_html_e("Delete order data from MailChimp when trashed from WooCommerce",'woo-mailchimp-crm-perks');  ?></label></td>
</tr>
<tr>
<th><label for="restore_meta"><?php esc_html_e("Restore Order",'woo-mailchimp-crm-perks');  ?></label></th>
<td><label for="restore_meta"><input type="checkbox" id="restore_meta" name="meta[restore]" value="yes" <?php if($this->post('restore',$meta) == "yes"){echo 'checked="checked"';} ?> ><?php esc_html_e("Restore order data in MailChimp when restored in WooCommerce",'woo-mailchimp-crm-perks');  ?></label></td>
</tr>
<tr>
<th><label for="notes_meta"><?php esc_html_e("Order Notes",'woo-mailchimp-crm-perks');  ?></label></th>
<td><label for="notes_meta"><input type="checkbox" id="notes_meta" name="meta[notes]" value="yes" <?php if($this->post('notes',$meta) == "yes"){echo 'checked="checked"';} ?> ><?php esc_html_e("Add / Delete Notes to MailChimp when added / deleted in WooCommerce",'woo-mailchimp-crm-perks'); ?></label></td>
</tr>
</table>
<p class="submit_vx">
  <button type="submit" value="save" class="button-primary" title="<?php esc_html_e('Save Changes','woo-mailchimp-crm-perks'); ?>" name="save"><?php esc_html_e('Save Changes','woo-mailchimp-crm-perks'); ?></button>
  <input type="hidden" name="vx_meta" value="1"> 
</p>
</div>
 
<script>
jQuery(document).ready(function($){
    $('.vx_accounts_table').tablesorter( {headers: { 2:{sorter: false}, 5:{sorter: false}}} );

   $(".vx_del_account").click(function(e){
     if(!confirm('<?php esc_html_e('Are you sure to delete Account ?','woo-mailchimp-crm-perks') ?>')){
         e.preventDefault();
     }  
   }) 
})
</script>
<?php
    do_action('crmperks_wc_settings_end_'.$this->id);
?>  