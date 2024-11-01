<?php
// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

if( !class_exists( 'vx_crmperks_notice_vxc_mailchimp' )):
class vx_crmperks_notice_vxc_mailchimp extends vxc_mailchimp{
public $plugin_url="https://www.crmperks.com";
public $review_link='https://wordpress.org/support/plugin/woo-mailchimp-crm-perks/reviews/?filter=5#new-post';

public function __construct(){
   
  add_action('add_section_tab_wc_'.$this->id, array($this, 'add_section_wc'),99);
  add_action('crmperks_wc_settings_end_'.$this->id, array($this, 'notice'),99);
    add_action( 'vx_plugin_upgrade_notice_plugin_'.$this->type, array( $this, 'notice' ) );
    add_action( 'manage_posts_extra_tablenav', array( $this, 'feed_notice' ) );
    
        add_action( 'wp_ajax_review_dismiss_'.$this->id, array( $this, 'review_dismiss' ) );
          add_action( 'admin_notices', array( $this, 'review_notice' ) );
     // html section
  add_filter( 'add_section_html_'.$this->id, array( $this, 'license_section_wc' ) );
  add_filter( 'menu_links_'.$this->id, array( $this, 'menu_link' ) );
  add_filter( 'plugin_row_meta', array( $this , 'pro_link' ), 10, 2 );
}
   public function add_section_wc($tabs){
    $tabs["vxc_notice"]='<b>'.__('Go Premium','woocommerce-base-crm').'</b>';
    return $tabs;
}
public function feed_notice($pos=''){
   if($pos == 'bottom'){
       global $pagenow;
       $screen = get_current_screen();
       if(is_object($screen) && isset($screen->post_type) && $screen->post_type == $this->id){
     echo '<div style="clear: both; padding-top: 10px;"></div>';      
    $this->notice();       
       }
   } 
}
public function license_section_wc($page_added){
    if(!$page_added){
        global $current_section;
        if($current_section == 'vxc_notice'){
            $this->notice();
          $page_added=true;
        } 
    }
return $page_added;
}
public function notice(){
$plugin_url=$this->plugin_url.'?vx_product='.$this->domain;
?>
<style type="text/css">
.vx_pro_version .fa{
color: #727f30; font-size: 18px; vertical-align: middle;   
} 
</style>
 <div class="updated below-h2 vx_pro_version" style="border: 1px solid  #1192C1; border-left-width: 6px; padding: 2px 12px; margin-top: 30px;">
<h2 style="font-size: 22px;">Premium Version</h2>
<p><i class="fa fa-check"></i> Mailchimp memeber's tags.</p>
<p><i class="fa fa-check"></i> Mailchimp Phone Number and All Custom fields.</p>
<p><i class="fa fa-check"></i> Sync historical WooCommerce Orders to Mailchimp.</p>
<p><i class="fa fa-check"></i> Mailchimp memeber's interest groups .</p>
<p><i class="fa fa-check"></i> Google Analytics Parameters and Geolocation of a visitor who submitted the form.</p>
<p><i class="fa fa-check"></i> Lookup lead's email using email lookup apis.We support all googd email lookup apis like Fullcontact , Towerdata and pipl.com API.</p>
<p><i class="fa fa-check"></i> Verify lead's phone number and get detailed information about phone number using phone lookup apis, We support many good phone lookup apis like everyoneapi, Clearbit api , whitepages api , twilio api and numverify api.</p>
<p>
<a href="<?php echo esc_attr($plugin_url) ?>" target="_blank" class="button-primary button">Go Premium</a>
</p>
</div>
<?php
}
public function review_dismiss(){
$install_time=get_option($this->id."_install_data");
if(!is_array($install_time)){ $install_time =array(); }
$install_time['review_closed']='true';
update_option($this->id."_install_data",$install_time,false);
die();
}

public function review_notice() { 
 $install_time=get_option($this->id."_install_data");
   if(!is_array($install_time)){ $install_time =array(); }
   if(empty($install_time['time'])){
       $install_time['time']=current_time( 'timestamp' , 1 );
      update_option($this->id."_install_data",$install_time,false); 
   }
   
    $time=current_time( 'timestamp' , 1 )-(7200*15);
// $time=time(); //$install_time['review_closed']='';
 if(!empty($install_time) && is_array($install_time) && !empty($install_time['time']) && empty($install_time['review_closed'])){ 
   $time_i=(int)$install_time['time'];
    if($time > $time_i){ 
        ?>
        <div class="notice notice-info is-dismissible vxcf-review-notice">
  <p><?php echo sprintf(__( 'You\'ve been using WooCommerce MailChimp Plugin for some time now; we hope you love it!.%s If you do, please %s leave us a %s rating on WordPress.org%s to help us spread the word and boost our motivation.','contact-form-entries'),'<br/>','<a href="'.$this->review_link.'" target="_blank" rel="noopener noreferrer">','&#9733;&#9733;&#9733;&#9733;&#9733;','</a>'); ?></p>
  <p><a href="<?php echo $this->review_link ?>" class="vxcf_close_notice_a"  target="_blank" rel="noopener noreferrer"><?php esc_html_e('Yes, you deserve it','contact-form-entries') ?></a> | <a href="#" class="vxcf_close_notice_a"><?php esc_html_e('Dismiss this notice','contact-form-entries'); ?></a></p>
        </div>
        <script type="text/javascript">
            jQuery( document ).ready( function ( $ ) {
                $( document ).on( 'click', '.vxcf-review-notice .vxcf_close_notice_a', function ( e ) {
                       //e.preventDefault(); 
                       $('.vxcf-review-notice .notice-dismiss').click();
 //$.ajax({ type: "POST", url: ajaxurl, async : false, data: {action:"vxcf_form_review_dismiss"} });          
        $.post( ajaxurl, { action: 'review_dismiss_<?php echo esc_attr($this->id) ?>' } );
                } );
            } );
        </script>
        <?php
    } }
}
public function pro_link($links,$file){
    $slug=$this->get_slug();
    if($file == $slug){
        $url=$this->plugin_url.'?vx_product='.$this->domain;
      //  $url=admin_url('admin.php?page=vx-addons');
        $links[]='<a href="'.$url.'"><b>Go Premium</b></a>';
    }
   return $links; 
}
public function menu_link($links){
     $url=$this->plugin_url.'?vx_product='.$this->domain;
   $links[]=array("title"=>'<b>Go Premium</b>',"link"=>$url );
    return $links;
}

}
new vx_crmperks_notice_vxc_mailchimp();
endif;
