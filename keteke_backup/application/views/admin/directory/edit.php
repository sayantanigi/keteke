<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Update  Listing</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="<?=admin_url('directories/update/'.$pages->id)?>" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="container">
              <div class="row">
                <div class="col-sm-10">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Listing Title</label>
                      <input type="text" name="frm[title]" value="<?=$pages->title?>" class="form-control" id="exampleInputEmail1" placeholder="" autocomplete="off">
                    </div>
                  </div>
                      <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Listing Location</label>
                      <select name="frm[country]" class="form-control" required> 
                       
                        <option value="usa" <?php if($pages->country=='usa'){ echo "selected";} ?>>USA</option>
                        <option value="canada" <?php if($pages->country=='canada'){ echo "selected";} ?>>Canada</option>
                        <option value="australia" <?php if($pages->country=='australia'){ echo "selected";} ?>>Australia</option>
                        <option value="uk" <?php if($pages->country=='uk'){ echo "selected";} ?>>UK</option>
                        <option value="caribbean island" <?php if($pages->country=='caribbean island'){ echo "selected";} ?>>Caribbean Island</option>
                      </select>
                    </div>
                  </div>
                   <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Listing Categories</label>
                          <select name="frm[category]" class="form-control" required> 
                        <option value="hotel" <?php if($pages->category=='hotel'){ echo "selected";} ?>>Hotels</option>
                        <option value="restaurant" <?php if($pages->category=='restaurant'){ echo "selected";} ?>>Restaurants</option>
                        <option value="nightclub" <?php if($pages->category=='nightclub'){ echo "selected";} ?>>Nightclubs</option>
                        <option value="cruise" <?php if($pages->category=='cruise'){ echo "selected";} ?>>Cruises</option>
                      </select>
                    </div>
                  </div>
                  </div> 
                  <?php if($pages->adr_man !=1){ ?>
                  <div class="col-sm-10">
                    <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Address</label>
                      <input type="text" name="frm[location]" value="<?=$pages->location?>" class="form-control" id="location" >
                       <input type="hidden" name="frm[lati]" value="<?=$pages->lati?>" id="search_lat">
                    <input type="hidden" name="frm[longi]" value="<?=$pages->longi?>" id="search_lon">
                    </div>
                  </div>
                  </div>
          <?php } else { ?>
                <div class="col-sm-10">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Address</label>
                      <input type="text" name="frm[location]" value="<?=$pages->location?>" class="form-control">
                    </div>
                  </div> 
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Latitude</label>
                      <input type="text" name="frm[lati]" value="<?=$pages->lati?>" class="form-control">
                    </div>
                  </div> 
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Longitude</label>
                      <input type="text" name="frm[longi]" value="<?=$pages->longi?>" class="form-control" id="location" >
                    </div>
                  </div> 
                </div>
        <?php } ?>

                <div class="col-sm-10">

                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Listing Content</label>
                      <textarea name="frm[descr]"   class="form-control" id="editor1"><?=$pages->descr?></textarea>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Phone</label>
                      <input type="text" name="frm[phone]" value="<?=$pages->phone?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Phone">
                    </div>
                  </div> 
                 
                   <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="text" name="frm[email]" value="<?=$pages->email?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Email">
                    </div>
                  </div>
                   <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Website</label>
                      <input type="text" name="frm[website]" value="<?=$pages->website?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Ebsite URL">
                    </div>
                  </div>
                   <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Fax</label>
                      <input type="text" name="frm[fax]" value="<?=$pages->fax?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Fax No.">
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <?php  $names= explode(',', $pages->images); ?>
                      <img src="<?=site_url('assets/images/directory/'.$names[0])?>" onerror="this.src='<?=site_url()?>/assets/images/no-image.png';" class="img-responsive" style="width:100px">
                      <label for="exampleInputEmail1">Listing Images</label>
                      <input type="file"  name="files[]" multiple="" >
                    </div>
                </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Status</label>
                      <select name="frm[status]" class="form-control">
                        <option value="1" <?php if($pages->status==1){echo"selected";}?>>Active</option>
                        <option value="0" <?php if($pages->status==0){echo"selected";}?>>Inactive</option>
                      </select>
                    </div>
                  </div>
              </div>
            </div>
             <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
          </div>
        </form>

      <!-- /.box -->
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>