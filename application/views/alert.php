<div class="row">
    <div class="col-sm-12">
        <?php if($this -> session -> flashdata('success')) { ?>
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php
                echo $this->session->flashdata('success');
                $this->session->unset_userdata('success') ?>
            </div>
        <?php }
        if($this->session->flashdata('info')) { ?>
            <div class="alert alert-info alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php echo $this->session->flashdata('info'); $this->session->unset_userdata('info')?>
            </div>
        <?php }
        if($this->session->flashdata('error')) { ?>
            <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php echo $this->session->flashdata('error'); $this->session->unset_userdata('error')?>
            </div>
        <?php
        }
        if($this->session->flashdata('warning')) { ?>
            <div class="alert alert-warning alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php echo $this->session->flashdata('warning'); $this->session->unset_userdata('warning')?>
            </div>
        <?php } ?>
    </div>
</div>
