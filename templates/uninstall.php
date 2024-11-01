<?php
if ( ! defined( 'ABSPATH' ) ) {
     exit;
 }                                            
 ?>  <h3><?php esc_html_e('Uninstall WooCommerce MailChimp Plugin','woo-mailchimp-crm-perks'); ?></h3>
  <?php
  if(isset($_POST[$this->id.'_uninstall'])){ 
  ?>
  <div class="vxc_alert updated  below-h2">
  <h3><?php esc_html_e('Success','woo-mailchimp-crm-perks'); ?></h3>
  <p><?php esc_html_e('WooCommerce MailChimp Plugin has been successfully uninstalled','woo-mailchimp-crm-perks'); ?></p>
  <p>
  <a class="button button-hero button-primary" href="plugins.php"><?php esc_html_e("Go to Plugins Page",'woo-mailchimp-crm-perks'); ?></a>
  </p>
  </div>
  <?php
  }else{
  ?>
  <div class="vxc_alert error below-h2">
  <h3><?php esc_html_e("Warning",'woo-mailchimp-crm-perks'); ?></h3>
  <p><?php esc_html_e('This Operation will delete all MailChimp logs and feeds.','woo-mailchimp-crm-perks'); ?></p>
  <p><button class="button button-hero button-secondary" id="vx_uninstall" type="submit" onclick="return confirm('<?php esc_html_e("Warning! ALL MailChimp Feeds and Logs will be deleted. This cannot be undone. OK to delete, Cancel to stop.", 'woo-mailchimp-crm-perks')?>');" name="<?php echo esc_attr($this->id) ?>_uninstall" title="<?php esc_html_e("Uninstall",'woo-mailchimp-crm-perks'); ?>" value="yes"><?php esc_html_e("Uninstall",'woo-mailchimp-crm-perks'); ?></button></p>
  </div>
  <?php
  } ?>