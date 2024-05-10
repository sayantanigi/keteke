<?php

$arr_default['hiwh'] = ''; 
$arr_default['hiwk'] = ''; 
$arr_default['hiwd'] = '';
$arr_default['spth'] = '';
$arr_default['sptk'] = '';
$arr_default['spthd'] = '';
$arr_default['fqh'] = '';
$arr_default['fqk'] = '';
$arr_default['fqhd'] = '';
$arr_default['blh'] = '';
$arr_default['blk'] = '';
$arr_default['blhd'] = '';
$arr_default['bldh'] = '';
$arr_default['bldk'] = '';
$arr_default['bldd'] = '';
$arr_default['sph'] = '';
$arr_default['spk'] = '';
$arr_default['spd'] = '';
$arr_default['ccph'] = '';
$arr_default['ccpk'] = '';
$arr_default['ccpd'] = '';

$arr_default['hph'] = '';
$arr_default['hpk'] = '';
$arr_default['hpd'] = '';
$_GET['options'] = $options;
$_GET['default'] = $arr_default;
function get_option($fname){
  $arr_options = $_GET['options'];
  $arr_default = $_GET['default'];
  if(isset($arr_options[$fname])){
    return $arr_options[$fname];
 }else{
    if(isset($arr_default[$fname])){
      return $arr_default[$fname];
   }else{
      return NULL;
   }
}
}
?>
<!-- Main content -->
<section class="content">
 <div class="row">
  <!-- left column -->
  <div class="col-md-12">
   <!-- general form elements -->
   <div class="box box-primary">
    <div class="box-header with-border">
     <h3 class="box-title">Content Setting</h3>
  </div>
  <br>
  <!-- /.box-header -->
  <?php echo form_open(admin_url('seo'), array('class' => 'form-horizontal')); ?>
<div class="form-group">
   <label class="col-sm-2 control-label">Home Page Heading</label>
   <div class="col-sm-8">
      <input type="text" name="hph" value="<?= get_option('hph'); ?>" placeholder="" class="form-control input-sm" />
   </div>
</div>
<div class="form-group">
   <label class="col-sm-2 control-label">Home Page Keywords</label>
   <div class="col-sm-8">
      <input type="text" name="hpk" value="<?= get_option('hpk'); ?>" placeholder="" class="form-control input-sm" />
   </div>
</div>
<div class="form-group">
   <label class="col-sm-2 control-label">Home Page Description</label>
   <div class="col-sm-8">
      <textarea name="hpd" class="form-control" rows=2><?= get_option('hpd'); ?></textarea>
   </div>
</div>
  <div class="form-group">
   <label class="col-sm-2 control-label">How it works Heading</label>
   <div class="col-sm-8">
      <input type="text" name="hiwh" value="<?= get_option('hiwh'); ?>" placeholder="" class="form-control input-sm" />
   </div>
</div>
<div class="form-group">
   <label class="col-sm-2 control-label">How it works Keywords</label>
   <div class="col-sm-8">
      <input type="text" name="hiwk" value="<?= get_option('hiwk'); ?>" placeholder="" class="form-control input-sm" />
   </div>
</div>
<div class="form-group">
   <label class="col-sm-2 control-label">How it works Description</label>
   <div class="col-sm-8">
      <textarea name="hiwd" class="form-control" rows=2><?= get_option('hiwd'); ?></textarea>

   </div>
</div>
<div class="form-group">
   <label class="col-sm-2 control-label">Support Heading </label>
   <div class="col-sm-8">
      <input type="text" name="spth" value="<?= get_option('spth'); ?>" placeholder="" class="form-control input-sm" />
   </div>
</div>
<div class="form-group">
   <label class="col-sm-2 control-label">Support keywords </label>
   <div class="col-sm-8">
      <input type="text" name="sptk" value="<?= get_option('sptk'); ?>" placeholder="" class="form-control input-sm" />
   </div>
</div>
<div class="form-group">
   <label class="col-sm-2 control-label">Support Description </label>
   <div class="col-sm-8">
      <textarea name="spthd" class="form-control" rows=2><?= get_option('spthd'); ?></textarea>
   </div>
</div>
<div class="form-group">
   <label class="col-sm-2 control-label">Faqs Heading </label>
   <div class="col-sm-8">
      <input type="text" name="fqh" value="<?= get_option('fqh'); ?>" placeholder="" class="form-control input-sm" />
   </div>
</div>
<div class="form-group">
   <label class="col-sm-2 control-label">Faqs Keywords </label>
   <div class="col-sm-8">
      <input type="text" name="fqk" value="<?= get_option('fqk'); ?>" placeholder="" class="form-control input-sm" />
   </div>
</div>
<div class="form-group">
   <label class="col-sm-2 control-label">Faqs Description </label>
   <div class="col-sm-8">
      <textarea name="fqhd" class="form-control" rows=2><?= get_option('fqhd'); ?></textarea>
   </div>
</div>

<div class="form-group">
   <label class="col-sm-2 control-label">Business Listing Heading </label>
   <div class="col-sm-8">
      <input type="text" name="blh" value="<?= get_option('blh'); ?>" placeholder="" class="form-control input-sm" />
   </div>
</div>
<div class="form-group">
   <label class="col-sm-2 control-label">Business Listing Keywords </label>
   <div class="col-sm-8">
      <input type="text" name="blk" value="<?= get_option('blk'); ?>" placeholder="" class="form-control input-sm" />
   </div>
</div>
<div class="form-group">
   <label class="col-sm-2 control-label">Business Listing Description </label>
   <div class="col-sm-8">
      <textarea name="blhd" class="form-control" rows=2><?= get_option('blhd'); ?></textarea>
   </div>
</div>

<div class="form-group">
   <label class="col-sm-2 control-label">Business Listing Details Keywords </label>
   <div class="col-sm-8">
      <input type="text" name="bldk" value="<?= get_option('bldk'); ?>" placeholder="" class="form-control input-sm" />
   </div>
</div>
<div class="form-group">
   <label class="col-sm-2 control-label">Business Listing Details Description </label>
   <div class="col-sm-8">
      <textarea name="bldd" class="form-control" rows=2><?= get_option('bldd'); ?></textarea>
   </div>
</div>
<div class="form-group">
   <label class="col-sm-2 control-label">Search page Heading </label>
   <div class="col-sm-8">
      <input type="text" name="sph" value="<?= get_option('sph'); ?>" placeholder="" class="form-control input-sm" />
   </div>
</div>
<div class="form-group">
   <label class="col-sm-2 control-label">Search page Keyword </label>
   <div class="col-sm-8">
      <input type="text" name="spk" value="<?= get_option('spk'); ?>" placeholder="" class="form-control input-sm" />
   </div>
</div>
<div class="form-group">
   <label class="col-sm-2 control-label">Search page Description </label>
   <div class="col-sm-8">
      <textarea name="spd" class="form-control" rows=2><?= get_option('spd'); ?></textarea>
   </div>
</div>

<div class="form-group">
   <label class="col-sm-2">&nbsp;</label>
   <div class="col-sm-5">
      <input type="submit" name="submit" value="Save Settings" class="btn btn-primary btn-sm" />
      <a href="<?= admin_url('seo/restore'); ?>" class="btn btn-sm btn-default reset">Restore Default</a>
   </div>
</div>

<div class="box-footer">
   <?php
   $str = '';
   if(is_array($arr_default) && count($arr_default) > 0){
      foreach($arr_default as $key => $val){
         $str .= $key . ',';
      }
   }
   $str = rtrim($str, ',');
   ?>
   <input type="hidden" name="fields" value="<?= $str; ?>" />
</div>
</div>



</div>
<script>
   $(document).ready(function(){
     $('.reset').click(function(){
       if(!confirm('It will RESET all values. Are you sure to proceed?'))
         return false;
   });
  });
</script>
<?= form_close(); ?>
</div>
<!-- /.nav-tabs-custom -->
</section>
</section>
<!-- /.content -->