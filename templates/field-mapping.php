<?php
if ( ! defined( 'ABSPATH' ) ) {
     exit;
 }                                            
 ?><div class="vx_div">
      <div class="vx_head">
<div class="crm_head_div"> <?php esc_html_e('3. Map Form Fields to MailChimp Fields.',  'woo-mailchimp-crm-perks' ); ?></div>
<div class="crm_btn_div"><i class="fa crm_toggle_btn fa-minus" title="<?php esc_html_e('Expand / Collapse','woo-mailchimp-crm-perks') ?>"></i></div>
<div class="crm_clear"></div> 
  </div>

  <div class="vx_group  fields_div" style="padding: 0px; border-width: 0px; background: transparent;">
<?php
 $req_span=" <span class='vx_red vx_required'>(".__('Required','woo-mailchimp-crm-perks').")</span>";
 $req_span2=" <span class='vx_red vx_required vx_req_parent'>(".__('Required','woo-mailchimp-crm-perks').")</span>";
 
  foreach($map_fields as $k=>$v){
    
      
  $req=$this->post('req',$v);
  $v['type']=ucfirst($v['type']);

  $sel_val=isset($map[$k]['field']) ? $map[$k]['field'] : ""; 
    $val_type=isset($map[$k]['type']) && !empty($map[$k]['type']) ? $map[$k]['type'] : "field";  
   
  $display="none"; $btn_icon="fa-plus";
  if(isset($map[$k][$val_type]) && !empty($map[$k][$val_type])){
    $display="block"; 
    $btn_icon="fa-minus";   
  }

  $req_html=$req == "true" ? $req_span : ""; $k=esc_attr($k);
 ?> 
<div class="crm_panel crm_panel_100">
<div class="crm_panel_head2 ">
<div class="crm_head_div"><span class="crm_head_text"> <?php echo esc_html($v['label'])?></span>
<?php echo wp_kses_post($req_html); ?>
</div>
<div class="crm_btn_div">
<?php
 if(isset($v['name_c']) || ($api_type != 'web' && $req != 'true')){   
?>
<i class="vx_icons vx_remove_btn vx_remove_custom fa fa-trash-o" title="<?php esc_html_e('Delete','woo-mailchimp-crm-perks'); ?>"></i>
<?php } ?>
<i class="fa crm_toggle_btn vx_btn_inner <?php echo esc_attr($btn_icon) ?>" title="<?php esc_html_e('Expand / Collapse','woo-mailchimp-crm-perks') ?>"></i>

</div>
<div class="crm_clear"></div> </div>
<div class="more_options crm_panel_content " style="display: <?php echo esc_attr($display) ?>;">
  <?php if(!isset($v['name_c'])){ ?>

  <div class="crm-panel-description">
  <span class="crm-desc-name-div"><?php echo __('Name:','woo-mailchimp-crm-perks')." ";?><span class="crm-desc-name"><?php echo esc_html($v['name']); ?></span> </span>
  <?php if($this->post('type',$v) !=""){ ?>
    <span class="crm-desc-type-div">, <?php echo __('Type:','woo-mailchimp-crm-perks')." ";?><span class="crm-desc-type"><?php echo esc_html($v['type']) ?></span> </span>
<?php
   }
  if($this->post('maxlength',$v) !=""){ 
   ?>
   <span class="crm-desc-len-div">, <?php echo __('Max Length:','woo-mailchimp-crm-perks')." ";?><span class="crm-desc-len"><?php echo esc_html($v['maxlength']); ?></span> </span>
  <?php 
  }
  ?>
   </div> 
  <?php
  }
  ?>
<div class="vx_margin">
<?php
    if(isset($v['name_c'])){
?>
<div class="entry_row">
<div class="entry_col1 vx_label"><?php esc_html_e('Field API Name','woo-mailchimp-crm-perks') ?></div>
<div class="entry_col2">
<input type="text" name="meta[map][<?php echo esc_attr($k) ?>][name_c]" value="<?php echo $v['name_c'] ?>" placeholder="<?php esc_html_e('Field API Name','woo-mailchimp-crm-perks') ?>" class="vx_input_100">
</div>
<div class="crm_clear"></div>
</div> 
<?php             
    }
?>
<div class="entry_row">
<div class="entry_col1 vx_label"><label for="vx_type_<?php echo esc_attr($k) ?>"><?php esc_html_e('Field Type','woo-mailchimp-crm-perks') ?></label></div>
<div class="entry_col2">
<select name='meta[map][<?php echo esc_attr($k) ?>][type]' id="vx_type_<?php echo esc_attr($k) ?>"  class='vxc_field_type vx_input_100'>
<?php
  foreach($sel_fields as $f_key=>$f_val){
  $select="";
  if($this->post2($k,'type',$map) == $f_key)
  $select='selected="selected"';
  ?>
  <option value="<?php echo esc_attr($f_key) ?>" <?php echo $select ?>><?php echo esc_html($f_val)?></option>    
  <?php } ?> 
</select>
</div>
<div class="crm_clear"></div>
</div>  

<div class="entry_row entry_row2">
<div class="entry_col1 vx_label">

<div class="vx_label vxc_fields vxc_field_" style="<?php if($this->post2($k,'type',$map) != ''){echo 'display:none';} ?>">
<label for="vx_field_<?php echo esc_attr($k) ?>"><?php esc_html_e('Select Field','woo-mailchimp-crm-perks') ?></label>
</div>

<div class="vxc_fields vxc_field_custom" style="<?php if($this->post2($k,'type',$map) != 'custom'){echo 'display:none';} ?>">
<label for="vx_custom_<?php echo esc_attr($k) ?>"> <?php esc_html_e('Custom Field','woo-mailchimp-crm-perks') ?></label>
</div>

<div class="vxc_fields vxc_field_value" style="<?php if($this->post2($k,'type',$map) != 'value'){echo 'display:none';} ?>">
<label for="vx_value_<?php echo esc_attr($k) ?>"> <?php esc_html_e('Custom Value','woo-mailchimp-crm-perks') ?></label>
</div>

</div>

<div class="entry_col2">


<div class="vxc_fields vxc_field_custom" style="<?php if($this->post2($k,'type',$map) != 'custom'){echo 'display:none';} ?>">
<input type="text" name='meta[map][<?php echo esc_attr($k)?>][custom]' id="vx_custom_<?php echo esc_attr($k) ?>"  value='<?php echo $this->post2($k,'custom',$map)?>' placeholder='<?php esc_html_e("Custom Field Name",'woo-mailchimp-crm-perks')?>' class='vx_input_100' >
</div>

<div class="vxc_fields vxc_field_value" style="<?php if($this->post2($k,'type',$map) != 'value'){echo 'display:none';} ?>">
<textarea name='meta[map][<?php echo esc_attr($k)?>][value]'  id="vx_value_<?php echo esc_attr($k) ?>"  placeholder="<?php esc_html_e("Custom Value",'woo-mailchimp-crm-perks')?>" class="vx_input_100 vxc_field_input"><?php echo $this->post2($k,'value',$map)?></textarea>
<div class="howto"><?php echo sprintf(__('You can add a form field %s in custom value from following form fields','woo-mailchimp-crm-perks'),'<code>{field_id}</code>')?></div>
</div>

<div class="vxc_fields vxc_field_ vxc_field_standard" style="<?php if($this->post2($k,'type',$map) == 'custom'){echo 'display:none';} ?>">
<select name="meta[map][<?php echo esc_attr($k) ?>][field]"  id="vx_field_<?php echo esc_attr($k) ?>" class="vxc_field_option vx_input_100">
<?php echo $this->wc_select($sel_val); ?>
</select>
</div>


</div> 

<div class="crm_clear"></div>
</div>
 

  </div></div>
  <div class="clear"></div>
  </div>
  <?php
  }

  ?>
<div id="vx_field_temp" style="display:none">
<div class="crm_panel crm_panel_100 vx_fields">
<div class="crm_panel_head2">
<div class="crm_head_div"><span class="crm_head_text">  <label class="crm_text_label"><?php esc_html_e('Custom Field','woo-mailchimp-crm-perks');?></label></span></div>
<div class="crm_btn_div">
<i class="vx_icons vx_remove_btn vx_remove_custom fa fa-trash-o" data-tip="<?php esc_html_e('Delete','woo-mailchimp-crm-perks'); ?>"></i>
<i class="fa crm_toggle_btn vx_btn_inner fa-minus " title="<?php esc_html_e('Expand / Collapse','woo-mailchimp-crm-perks') ?>"></i>
</div>
<div class="crm_clear"></div> </div>
<div class="more_options crm_panel_content" style="display: block;">


  <div class="crm-panel-description">
  <span class="crm-desc-name-div"><?php echo __('Name:','woo-mailchimp-crm-perks')." ";?><span class="crm-desc-name"></span> </span>
  <span class="crm-desc-type-div">, <?php echo __('Type:','woo-mailchimp-crm-perks')." ";?><span class="crm-desc-type"></span> </span>
  <span class="crm-desc-len-div">, <?php echo __('Max Length:','woo-mailchimp-crm-perks')." ";?><span class="crm-desc-len"></span> </span>

   </div> 


<div class="vx_margin">

<div class="entry_row">
<div class="entry_col1 vx_label"><?php esc_html_e('Field Type','woo-mailchimp-crm-perks') ?></div>
<div class="entry_col2">
<select name='type' class='vxc_field_type vx_input_100'>
<?php
  foreach($sel_fields as $f_key=>$f_val){
  ?>
  <option value="<?php echo esc_attr($f_key) ?>"><?php echo esc_attr($f_val)?></option>    
  <?php } ?> 
</select>
</div>
<div class="crm_clear"></div>
</div>  

<div class="entry_row entry_row2">
<div class="entry_col1 vx_label">

<div class="vx_label vxc_fields vxc_field_">
<label><?php esc_html_e('Select Field','woo-mailchimp-crm-perks') ?></label>
</div>

<div class="vxc_fields vxc_field_custom" style="display:none;">
<label> <?php esc_html_e('Custom Field','woo-mailchimp-crm-perks') ?></label>
</div>

<div class="vxc_fields vxc_field_value" style="display:none;">
<label> <?php esc_html_e('Custom Value','woo-mailchimp-crm-perks') ?></label>
</div>

</div>

<div class="entry_col2">

<div class="vxc_fields vxc_field_custom" style="display:none;">
<input type="text" name='custom'   value='' placeholder='<?php esc_html_e("Custom Field Name",'woo-mailchimp-crm-perks')?>' class='vx_input_100' >
</div>

<div class="vxc_fields vxc_field_value" style="display:none">
<textarea name="value"  value="" placeholder='<?php esc_html_e("Custom Value",'woo-mailchimp-crm-perks')?>' class="vx_input_100 vxc_field_input"></textarea>
<div class="howto"><?php echo sprintf(__('You can add a form field %s in custom value from following form fields','woo-mailchimp-crm-perks'),'<code>{field_id}</code>')?></div>
</div>

<div class="vxc_fields vxc_field_ vxc_field_standard">
<select name="field" class="vxc_field_option vx_input_100">
<?php echo $this->wc_select();  ?>
</select>
</div>


</div> 

<div class="crm_clear"></div>
</div>  


<i class="vx_icons-h  vx vx-bin-2" data-tip="Delete"></i>    
 
  </div></div>
  <div class="clear"></div>
  </div>
  
  </div>

<div class="crm_panel crm_panel_100 vx_fields">
<div class="crm_panel_head2">
<div class="crm_head_div"><span class="crm_head_text">  <label class="crm_text_label"><?php esc_html_e('Add New Field','woo-mailchimp-crm-perks');?></label></span></div>
<div class="crm_btn_div"><i class="fa crm_toggle_btn vx_btn_inner fa-minus" style="display: none;" title="<?php esc_html_e('Expand / Collapse','woo-mailchimp-crm-perks') ?>"></i></div>
<div class="crm_clear"></div> </div>
<div class="more_options crm_panel_content" style="display: block;">

<div class="vx_margin">

<div class="vx_tr">
<div class="vx_td">
<select id="vx_add_fields_select" class="vx_input_100" style="width: 100%" autocomplete="off">
<option value=""></option>
<?php
$json_fields=array();
 foreach($fields as $k=>$v){
     $v['type']=ucfirst($v['type']);
     $json_fields[$k]=$v;
   $disable='';
   if(isset($map_fields[$k]) || isset($skipped_fields[$k])){ 
    $disable='disabled="disabled"';   
   } 
echo '<option value="'.esc_attr($k).'" '.$disable.' >'.esc_html($v['label']).'</option>';    
} ?>
</select>
</div>
<div class="vx_td2">
 <button type="button" class="button button-default" style="vertical-align: middle;" id="xv_add_custom_field"><i class="fa fa-plus-circle" ></i> <?php esc_html_e('Add Field','woo-mailchimp-crm-perks')?></button>
 </div>
</div> 
<div class="entry_row vxc_fields vxc_field_custom" style="text-align: center;">
 
</div> 

<i class="vx_icons-h  vx vx-bin-2" data-tip="Delete"></i>    
 
  </div></div>
  <div class="clear"></div>
</div>
<script type="text/javascript">
var crm_fields=<?php echo json_encode($json_fields); ?>;
</script> 

  </div> 
 <!---fields end--->
  </div>
  <div class="vx_div ">
    <div class="vx_head ">
<div class="crm_head_div"> <?php esc_html_e('4. When to Send the Order to MailChimp.',  'woo-mailchimp-crm-perks' ); ?></div>
<div class="crm_btn_div"><i class="fa crm_toggle_btn fa-minus" title="<?php esc_html_e('Expand / Collapse','woo-mailchimp-crm-perks') ?>"></i></div>
<div class="crm_clear"></div> 
  </div> 
  <div class="vx_group ">
  <div class="vx_row">
  <div class="vx_col1">
  <label for="vxc_event"><?php esc_html_e('Select Event','woo-mailchimp-crm-perks'); $this->tooltip($tooltips['manual_export']); ?></label>
  </div>
  <div class="vx_col2">
  <select id="vxc_event" name="meta[event]" class="vx_sel" autocomplete="off">
  <?php  
  foreach($events as $f_key=>$f_val){
  $select="";
  if($this->post('event',$feed) == $f_key)
  $select='selected="selected"';
  echo '<option value="'.esc_attr($f_key).'" '.$select.'>'.esc_html($f_val).'</option>';    
  }    
  ?>
  </select> 
</div>
<div class="clear"></div>
</div>
  <div style="margin-top: 10px; padding-top: 10px; border-top: 1px dashed #ccc">
  <div class="vx_row">
  <div class="vx_col1">
  <label for="crm_optin"><?php esc_html_e('Custom Filter', 'woo-mailchimp-crm-perks'); $this->tooltip($tooltips['optin_condition']);?></label>
  </div>
  <div class="vx_col2">
  <input type="checkbox" style="margin-top: 0px;" id="crm_optin" class="crm_toggle_check" name="meta[optin_enabled]" value="1" <?php echo !empty($feed['optin_enabled']) ? 'checked="checked"' : ''?> autocomplete="off"/>
    <label for="crm_optin"><?php esc_html_e('Enable', 'woo-mailchimp-crm-perks'); ?></label>
  
  </div>
  <div class="clear"></div>
  </div>
  <div id="crm_optin_div" style="margin: 10px auto; width: 90%;<?php echo empty($feed['optin_enabled']) ? 'display:none' : ''?>">
  
        <div>
            <?php
            $sno=0; 
                foreach($filters as $filter_k=>$filter_v){ $filter_k=esc_attr($filter_k);
  $sno++;
                    ?>
  <div class="vx_filter_or" data-id="<?php echo esc_attr($filter_k) ?>"> 
  <?php if($sno>1){ ?>
  <div class="vx_filter_label">OR</div>
  <?php } ?>                 
  <div class="vx_filter_div">
  <?php
  if(is_array($filter_v)){
  $sno_i=0;
   foreach($filter_v as $s_k=>$s_v){   $s_k=esc_attr($s_k);   
  $sno_i++;
  
  ?> 
      <div class="vx_filter_and">
      <?php if($sno_i>1){ ?>
  <div class="vx_filter_label">AND</div>
  <?php } ?>   
     <div class="vx_filter_field vx_filter_field1">    
     <select id="crm_optin_field" name="meta[filters][<?php echo esc_attr($filter_k) ?>][<?php echo esc_attr($s_k) ?>][field]"><?php 
  echo $this->wc_select($this->post('field',$s_v));
      ?></select></div>
       <div class="vx_filter_field vx_filter_field2">   
    <select name="meta[filters][<?php echo esc_attr($filter_k) ?>][<?php echo esc_attr($s_k) ?>][op]" >
    <?php
       foreach($vx_op as $k=>$v){
  $sel="";
  if($this->post('op',$s_v) == $k)
  $sel='selected="selected"';
         echo "<option value='".esc_attr($k)."' $sel >".esc_html($v)."</option>";
     } 
    ?>
            </select></div>
             <div class="vx_filter_field vx_filter_field3">    
           <input type="text" class="vxc_filter_text" placeholder="<?php esc_html_e('Value','woo-mailchimp-crm-perks') ?>" value="<?php echo $this->post('value',$s_v) ?>" name="meta[filters][<?php echo esc_attr($filter_k) ?>][<?php echo esc_attr($s_k) ?>][value]"> 
            </div>
                <?php if( $sno_i>1){ ?> 
  <div class="vx_filter_field vx_filter_field4"><i class="vx_icons-h vx_trash_and fa fa-trash-o"></i></div>
           <?php } ?>
           <div style="clear: both;"></div> 
           </div>
           <?php
  } }
           ?>
           <div class="vx_btn_div">
           <button class="button button-default button-small vx_add_and"><i class="vx_trash_and fa fa-hand-o-right"></i> <?php esc_html_e('Add AND Filter','woo-mailchimp-crm-perks') ?></button>
           <?php if($sno>1){ ?>
  <i class="vx_icons-h fa fa-trash-o vx_trash_or"></i>
  <?php } ?> 
        
           </div>
        </div>
        </div>
                    <?php
                }
            ?>
  
          <div class="vx_btn_div">
  <button class="button button-default  vx_add_or"><i class="vx_trash_and fa fa-check"></i> <?php esc_html_e('Add OR Filter','woo-mailchimp-crm-perks') ?></button></div>
        </div>
        
    <p><input type="checkbox" style="margin-top: 0px; " id="crm_unsub" class="crm_toggle_check" name="meta[un_sub]" value="1" <?php echo !empty($meta["un_sub"]) ? "checked='checked'" : ""?> autocomplete="off"/>
    <label for="crm_unsub"><?php esc_html_e('If Condition(s) do not match then remove member from List', 'woo-mailchimp-crm-perks'); ?></label></p>
            
    </div>
   
    
  <div style="display: none;" id="vx_filter_temp">
  <div class="vx_filter_or"> 
  <div class="vx_filter_label">OR</div>
  <div class="vx_filter_div"> 
      <div class="vx_filter_and">  
      <div class="vx_filter_label vx_filter_label_and">AND</div> 
     <div class="vx_filter_field vx_filter_field1">    
     <select id="crm_optin_field" name="field" class='optin_selecta'><?php 
    echo $this->wc_select($this->post('field',$s_v));
      ?></select></div>
       <div class="vx_filter_field vx_filter_field2">    
    <select name="op" >
    <?php
       foreach($vx_op as $k=>$v){
  
         echo "<option value='".esc_attr($k)."' >".esc_html($v)."</option>";
     } 
    ?>
            </select></div>
             <div class="vx_filter_field vx_filter_field3">    
           <input type="text" class="vxc_filter_text" placeholder="<?php esc_html_e('Value','woo-mailchimp-crm-perks') ?>" name="value"> 
            </div>
           <div class="vx_filter_field vx_filter_field4"><i class="vx_icons-h vx_trash_and fa fa-trash-o"></i></div>
           <div style="clear: both;"></div> 
           </div>
           <div class="vx_btn_div">
           <button class="button button-default button-small vx_add_and"><i class=" vx_trash_and fa fa-hand-o-right"></i> <?php esc_html_e('Add AND Filter','woo-mailchimp-crm-perks') ?></button>
           <i class="vx_icons-h vx_trash_and fa fa-trash-o vx_trash_or"></i>
           </div>
        </div>
        </div>
        </div>
  <?php

             $settings=get_option($this->type.'_settings',array());
         if(!empty($settings['notes'])){ 
  ?>
    <div style="margin-top: 10px; padding-top: 10px; border-top: 1px dashed #ccc">
  <div class="vx_row">
  <div class="vx_col1">
  <label for="vx_notes"><?php esc_html_e('Order Notes', 'woo-mailchimp-crm-perks'); $this->tooltip($tooltips['vx_order_notes']);?></label>
  </div>
  <div class="vx_col2">
  <input type="checkbox" style="margin-top: 0px;" id="vx_notes" class="crm_toggle_check" name="meta[order_notes]" value="1" <?php echo !empty($feed['order_notes']) ? 'checked="checked"' : ''?> autocomplete="off"/>
    <label for="vx_notes"><?php esc_html_e('Add Notes to MailChimp when added in WooCommerce', 'woo-mailchimp-crm-perks'); ?></label>
  
  </div>
  <div class="clear"></div>
  </div></div>
  <?php
         } 
  ?>
      
  </div>  
  </div>  
  </div>  
  <?php
  $panel_count=4;

      $panel_count++;
  ?>     
  <div class="vx_div "> 
  <div class="vx_head ">
<div class="crm_head_div"> <?php  echo sprintf(__('%s. Choose Primary Key.',  'woo-mailchimp-crm-perks' ),$panel_count); ?></div>
<div class="crm_btn_div"><i class="fa crm_toggle_btn fa-minus" title="<?php esc_html_e('Expand / Collapse','woo-mailchimp-crm-perks') ?>"></i></div>
<div class="crm_clear"></div> 
  </div>                    
  <div class="vx_group ">
  <div class="vx_row">
  <div class="vx_col1">
  <label for="crm_primary_field"><?php esc_html_e('Select Primary Key','%dd%') ?></label>
  </div><div class="vx_col2">
  <select id="crm_primary_field" name="meta[primary_key]" class="vx_sel" autocomplete="off">
  <?php echo $this->crm_select($fields,$this->post('primary_key',$feed) ); ?>
  </select> 
  <div class="description" style="float: none; width: 90%"><?php esc_html_e('If you want to update a pre-existing object, select what should be used as a unique identifier ("Primary Key"). For example, this may be an email address, lead ID, or address. When a new order comes in with the same "Primary Key" you select, a new object will not be created, instead the pre-existing object will be updated.', '%dd%'); ?></div>
  </div>
  <div class="clear"></div>
  </div>
  <div class="vx_row">
  <div class="vx_col1">
  <label for="vx_update">
  <?php esc_html_e('Update Entry', '%dd%'); ?>
  </label>
  </div>
  <div class="vx_col2">
  <input type="checkbox" style="margin-top: 0px;" id="vx_update" class="crm_toggle_check" name="meta[update]" value="1" <?php echo !empty($feed['update']) ? "checked='checked'" : ""?>/>
  <label for="vx_update">
  <?php esc_html_e('Do not update entry, if already exists', '%dd%'); ?>
  </label>
  </div>
  <div style="clear: both;"></div>
  </div>
  </div>

  </div>
  
    <div class="vx_div">
     <div class="vx_head">
<div class="crm_head_div"> <?php echo sprintf(__('%s. Add Note.', 'woo-mailchimp-crm-perks'),$panel_count+=1); ?></div>
<div class="crm_btn_div" title="<?php esc_html_e('Expand / Collapse','woo-mailchimp-crm-perks') ?>"><i class="fa crm_toggle_btn fa-minus"></i></div>
<div class="crm_clear"></div> 
  </div>


  <div class="vx_group">

    <div class="vx_row">
  <div class="vx_col1">
  <label for="crm_note">
  <?php esc_html_e("Add Note", 'woo-mailchimp-crm-perks'); ?>
  <?php $this->tooltip($tooltips["vx_entry_note"]) ?>
  </label>
  </div>
  <div class="vx_col2">
  <input type="checkbox" style="margin-top: 0px;" id="crm_note" class="crm_toggle_check" name="meta[note_check]" value="1" <?php echo !empty($feed['note_check']) ? "checked='checked'" : ""?>/>
  <label for="crm_note_div">
  <?php esc_html_e("Enable", 'woo-mailchimp-crm-perks'); ?>
  </label>
  </div>
  <div style="clear: both;"></div>
  </div>
  <div id="crm_note_div" style="margin-top: 16px; <?php echo empty($feed["note_check"]) ? "display:none" : ""?>">
  <div class="vx_row">
  <div class="vx_col1">
  <label for="crm_note_fields">
  <?php esc_html_e( 'Note Fields', 'woo-mailchimp-crm-perks' ); $this->tooltip($tooltips["vx_note_fields"]) ?>
  </label>
  </div>
  <div class="vx_col2">
  <select name="meta[note_fields][]" id="crm_note_fields" multiple="multiple" class="crm_sel crm_note_sel crm_sel2 vx_input_100"  autocomplete="off">

  <?php echo $this->wc_select($feed['note_fields']); ?>
  </select>
    <span class="howto">
  <?php esc_html_e('You can select multiple fields.', 'woo-mailchimp-crm-perks'); ?>
  </span>
   </div>
  <div style="clear: both;"></div>
  </div>
  
  <div class="vx_row">
  <div class="vx_col1">
  <label for="crm_disable_note">
  <?php esc_html_e( 'Disable Note', 'woo-mailchimp-crm-perks' ); $this->tooltip($tooltips["vx_disable_note"]) ?>
  </label>
  </div>
  <div class="vx_col2">
  
  <input type="checkbox" style="margin-top: 0px;" id="crm_disable_note" class="crm_toggle_check" name="meta[disable_entry_note]" value="1" <?php echo !empty($feed['disable_entry_note']) ? "checked='checked'" : ""?>/>
  <label for="crm_disable_note">
  <?php esc_html_e('Do not Add Note if entry already exists in MailChimp', 'woo-mailchimp-crm-perks'); ?>
  </label>
    
   </div>
  <div style="clear: both;"></div>
  </div>
  
  </div>
  
  </div>
  </div>
  
  <!-------------------------- lead owner -------------------->

  <?php 
$panel_count++;
$statuses=array('subscribed'=>'Subscribed','unsubscribed'=>'UnSubscribed','cleaned'=>'Cleaned','pending'=>'Pending');
$langs=array("en"=>"English","ar"=>"Arabic","af"=>"Afrikaans","be"=>"Belarusian","bg"=>"Bulgarian","ca"=>"Catalan","zh"=>"Chinese","hr"=>"Croatian","cs"=>"Czech","da"=>"Danish","nl"=>"Dutch","et"=>"Estonian","fa"=>"Farsi","fi"=>"Finnish","fr"=>"French (France)","fr_CA"=>"French (Canada)","de"=>"German","el"=>"Greek","he"=>"Hebrew","hi"=>"Hindi","hu"=>"Hungarian","is"=>"Icelandic","id"=>"Indonesian","ga"=>"Irish","it"=>"Italian","ja"=>"Japanese","km"=>"Khmer","ko"=>"Korean","lv"=>"Latvian","lt"=>"Lithuanian","mt"=>"Maltese","ms"=>"Malay","mk"=>"Macedonian","no"=>"Norwegian","pl"=>"Polish","pt"=>"Portuguese (Brazil)","pt_PT"=>"Portuguese (Portugal)","ro"=>"Romanian","ru"=>"Russian","sr"=>"Serbian","sk"=>"Slovak","sl"=>"Slovenian","es"=>"Spanish (Mexico)","es_ES"=>"Spanish (Spain)","sw"=>"Swahili","sv"=>"Swedish","ta"=>"Tamil","th"=>"Thai","tr"=>"Turkish","uk"=>"Ukrainian","vi"=>"Vietnamese");
$email_types=array('html'=>'Html', 'text'=>'Text');
if(empty($feed['status'])){ $feed['status']='subscribed'; }
if(empty($feed['language'])){ $feed['language']='en'; }
if(empty($feed['email_type'])){ $feed['email_type']='html'; }
?>
     <div class="vx_div vx_refresh_panel">    
      <div class="vx_head ">
<div class="crm_head_div"> <?php echo sprintf(__('%s. Status and other settings',  'woo-mailchimp-crm-perks' ),$panel_count); ?></div>
<div class="crm_btn_div"><i class="fa crm_toggle_btn fa-minus" title="<?php esc_html_e('Expand / Collapse','woo-mailchimp-crm-perks') ?>"></i></div>
<div class="crm_clear"></div> 
  </div>                 
    <div class="vx_group ">
   <div class="vx_row"> 
   <div class="vx_col1"> 
  <label for="crm_sel_status"><?php esc_html_e('Status', 'woo-mailchimp-crm-perks'); ?></label>
  </div>
  <div class="vx_col2">
  <select id="crm_sel_status" name="meta[status]" style="width: 100%;" autocomplete="off">
  <?php echo $this->gen_select($statuses,$this->post('status',$feed)); ?>
  </select>
  
  </div>
<div class="clear"></div>
</div>
  
   <div class="vx_row"> 
   <div class="vx_col1"> 
  <label for="crm_sel_language"><?php esc_html_e('Language', 'woo-mailchimp-crm-perks'); ?></label>
  </div>
  <div class="vx_col2">
  <select id="crm_sel_language" name="meta[language]" style="width: 100%;" autocomplete="off">
  <?php echo $this->gen_select($langs,$this->post('language',$feed)); ?>
  </select>
  
  </div>
<div class="clear"></div>
</div>

   <div class="vx_row"> 
   <div class="vx_col1"> 
  <label for="crm_sel_email"><?php esc_html_e('Email Type', 'woo-mailchimp-crm-perks'); ?></label>
  </div>
  <div class="vx_col2">
  <select id="crm_sel_email" name="meta[email_type]" style="width: 100%;" autocomplete="off">
  <?php echo $this->gen_select($email_types,$this->post('email_type',$feed)); ?>
  </select>
  
  </div>
<div class="clear"></div>
</div>

   <div class="vx_row"> 
   <div class="vx_col1"> 
  <label for="crm_sel_vip"><?php esc_html_e('Add to VIP', 'woo-mailchimp-crm-perks'); ?></label>
  </div>
  <div class="vx_col2">
  <select id="crm_sel_vip" name="meta[vip]" style="width: 100%;" autocomplete="off">
<option value=""><?php esc_html_e('No', 'woo-mailchimp-crm-perks'); ?></option>
<option value="yes" <?php if(!empty($feed['vip'])){ echo 'selected="selected"'; } ?>><?php esc_html_e('Yes', 'woo-mailchimp-crm-perks'); ?></option>
  </select>
  
  </div>
<div class="clear"></div>
</div>

  </div>
  </div>

<?php

    
      $stores_arr=$this->post('stores',$meta);
      $stores=array();
      if(!empty($stores_arr)){
       foreach($stores_arr as $k=>$v){
           if($module == $v['list_id']){
               $stores[$k]=$v['name'];
           }
       }   
      }
  ?>
    

 <div class="vx_div vx_refresh_panel ">    
      <div class="vx_head ">
<div class="crm_head_div"> <?php  echo sprintf(__('%s. E-Commerce Data ',  'woo-mailchimp-crm-perks' ),++$panel_count); ?></div>
<div class="crm_btn_div"><i class="fa crm_toggle_btn fa-minus" title="<?php esc_html_e('Expand / Collapse','woo-mailchimp-crm-perks') ?>"></i></div>
<div class="crm_clear"></div> 
  </div>                 
    <div class="vx_group ">
   <div class="vx_row"> 
   <div class="vx_col1"> 
  <label for="crm_comm"><?php esc_html_e('Enable E-Commerce ', 'woo-mailchimp-crm-perks'); ?></label>
  </div>
  <div class="vx_col2">
  <input type="checkbox" style="margin-top: 0px;" id="crm_comm" class="crm_toggle_check" name="meta[enable_orders]" value="1" <?php echo !empty($feed['enable_orders']) ? "checked='checked'" : ""?> autocomplete="off"/>
    <label><?php esc_html_e("Enable", 'woo-mailchimp-crm-perks'); ?></label>
  </div>
<div class="clear"></div>
</div>
    <div id="crm_comm_div" style="<?php echo empty($feed["enable_orders"]) ? "display:none" : ""?>">

    <div class="vx_row">
  <div class="vx_col1">
  <label for="crm_store">
  <?php esc_html_e( 'E-Commerce Store ', 'woo-mailchimp-crm-perks' ) ?>
  </label>
  </div>
  <div class="vx_col2">
  <select name="meta[store]" id="crm_sel_store" class="crm_sel vx_input_100"  autocomplete="off">
  <?php echo $this->gen_select($stores,$feed['store']); ?>
  </select>

   </div>
  <div style="clear: both;"></div>
  </div>
  
  <div class="vx_row">
  <div class="vx_col1">
  <label><?php esc_html_e('E-Commerce Stores ','woo-mailchimp-crm-perks'); ?></label>
  </div>
  <div class="vx_col2">
  <button class="button vx_refresh_data" data-id="refresh_stores" type="button" autocomplete="off" style="vertical-align: baseline;">
  <span class="reg_ok"><i class="fa fa-refresh"></i> <?php esc_html_e('Refresh Stores','woo-mailchimp-crm-perks') ?></span>
  <span class="reg_proc"><i class="fa fa-refresh fa-spin"></i> <?php esc_html_e('Refreshing...','woo-mailchimp-crm-perks') ?></span>
  </button>
  
   <button class="button vx_refresh_data" data-id="refresh_stores_new" type="button" autocomplete="off" style="vertical-align: baseline;">
  <span class="reg_ok"><i class="fa fa-refresh"></i> <?php esc_html_e('Create New Store and Refresh','woo-mailchimp-crm-perks') ?></span>
  <span class="reg_proc"><i class="fa fa-refresh fa-spin"></i> <?php esc_html_e('Refreshing...','woo-mailchimp-crm-perks') ?></span>
  </button>
  <p style="font-weight: bold;"><?php esc_html_e( 'Feed will send New Orders to MailChimp. Use "Wordpress to CRM addon(included in Pro version)" for bulk sending historical WooCommerce orders to Mailchimp', 'woo-mailchimp-crm-perks' ) ?></p>
  </div> 
   <div class="clear"></div>
  </div> 
  
  
  
  </div>
  

  </div>
  </div>
<?php
      $file=self::$path.'pro/pro-mapping.php';
if(self::$is_pr && file_exists($file)){
include_once($file);
} 
  
 do_action('vx_plugin_upgrade_notice_plugin_'.$this->type);
  ?>  
  