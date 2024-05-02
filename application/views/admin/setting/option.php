<?php

$arr_default['hth1'] = '';
$arr_default['hd1'] = '';
$arr_default['hth2'] = '';
$arr_default['hd2'] = '';
$arr_default['hth3'] = '';
$arr_default['hd3'] = '';
$arr_default['hth4'] = '';
$arr_default['hd4'] = '';
$arr_default['hth5'] = '';
$arr_default['hd5'] = '';
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
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-12 col-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Content Setting</h3>
          </div>
          <!-- /.card-header -->
          <?php echo form_open(admin_url('option'), array('class' => 'form-horizontal')); ?>
          <div class="card-body">
            <div class="form-row row">
              <div class="col-lg-12 col-12">
                <div class="form-group">
                 <label >Heading 1</label>
                 <div class="col-lg-8">
                  <input type="text" name="hth1" value="<?= get_option('hth1'); ?>" placeholder="" class="form-control input-lg" />
                </div>
              </div>
            </div>
             <div class="col-lg-12 col-12">
            <div class="form-group">
             <label >Description 1</label>
             <div class="col-lg-8">
              <textarea name="hd1" class="form-control" rows=2><?= get_option('hd1'); ?></textarea>

            </div>
          </div>
        </div>
         <div class="col-lg-12 col-12">
          <div class="form-group">
           <label >Heading 2</label>
           <div class="col-lg-8">
            <input type="text" name="hth2" value="<?= get_option('hth2'); ?>" placeholder="" class="form-control input-lg" />
          </div>
        </div>
      </div>
       <div class="col-lg-12 col-12">
        <div class="form-group">
         <label >Description 2</label>
         <div class="col-lg-8">
          <textarea name="hd2" class="form-control" rows=2><?= get_option('hd2'); ?></textarea>
        </div>
      </div>
    </div>
     <div class="col-lg-12 col-12">
      <div class="form-group">
       <label >Heading 3</label>
       <div class="col-lg-8">
        <input type="text" name="hth3" value="<?= get_option('hth3'); ?>" placeholder="" class="form-control input-lg" />
      </div>
    </div>
  </div>
   <div class="col-lg-12 col-12">
    <div class="form-group">
     <label >Description 3</label>
     <div class="col-lg-8">
      <textarea name="hd3" class="form-control" rows=2><?= get_option('hd3'); ?></textarea>
    </div>
  </div>
</div>
     <div class="col-lg-12 col-12">
      <div class="form-group">
       <label >Heading 4</label>
       <div class="col-lg-8">
        <input type="text" name="hth4" value="<?= get_option('hth4'); ?>" placeholder="" class="form-control input-lg" />
      </div>
    </div>
  </div>
   <div class="col-lg-12 col-12">
    <div class="form-group">
     <label >Description 4</label>
     <div class="col-lg-8">
      <textarea name="hd4" class="form-control" rows=2><?= get_option('hd4'); ?></textarea>
    </div>
  </div>
</div>



  <div class="form-group">
   <label>&nbsp;</label>
   <div class="col-lg-12">
    <input type="submit" name="submit" value="Save Settings" class="btn btn-primary btn-sm" />
    <a href="<?= admin_url('settings/restore'); ?>" class="btn btn-sm btn-default reset">Restore Default</a>
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
</div>
<!-- ./col -->
</div>
<!-- /.row -->
</div><!-- /.container-fluid -->
</section>
<!-- Main content -->
