<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add</h3>
                    </div>
                    <form action="<?= admin_url('Categories/addMarketcategory/' . $pages->id) ?>" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-row row">
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="frm[name]" value="<?= $pages->name ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter  Name">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row">
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="frm[status]" class="form-control">
                                            <option value="1" <?php if (@$pages->status == '1') { echo "selected"; } ?>>Active</option>
                                            <option value="0" <?php if (@$pages->status == '0') { echo "selected"; } ?>>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" onclick="goBack()" class="btn btn-danger">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>