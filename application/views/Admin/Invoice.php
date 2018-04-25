<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-edit"></i> Invoice Entry</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Invoice Entry</li>
            <li class="breadcrumb-item"><a href="#">Upload Invoice</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-6" id="add">
            <div class="tile">
                <?php if($this->session->flashdata('message')){?>
                    <div class="alert alert-success">
                        <?php echo $this->session->flashdata('message')?>
                    </div>
                <?php } ?>
                <h3 class="tile-title">Upload Invoice Data</h3>
                <div class="tile-body">
                    <form method="post" enctype="multipart/form-data" class="login-form" action="<?php echo site_url('Admin_Controller/Upload_Invoice'); ?>" name="data_register">
                        <div class="form-group">
                            <label class="control-label">Upload Invoice</label>
                            <input type="file" id="exampleInputFile" name="userfile" required>
                        </div>

                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Upload</button>&nbsp;
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>