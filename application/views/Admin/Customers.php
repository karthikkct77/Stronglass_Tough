<?php if ($this->session->flashdata('message')): ?>
    <script type="text/javascript">
        $(document).ready(function() {
            swal({
                title: "Done",
                text: "<?php echo $this->session->flashdata('message'); ?>",
                timer: 1500,
                showConfirmButton: false,
                type: 'success'
            });
        });
    </script>
<?php endif; ?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-edit"></i>Add Customer</h1>

        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Customer Entry</li>
            <li class="breadcrumb-item"><a href="#">Add Customer</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Add Customers</h3>
                <div class="tile-body">
                    <form method="post" class="login-form" action="<?php echo site_url('Admin_Controller/Save_Customer'); ?>" name="data_register">
                        <div class="row">
                        <div class="col-md-6">
                        <div class="form-group ">
                            <label class="control-label">Company Name </label>
                            <input class="form-control" name="company_name" type="text" placeholder="Enter Company Name" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Company GSTIN/UIN </label>
                            <input class="form-control" name="gstin_number" type="text" placeholder="Enter GSTIN/UIN Number" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Company Address  </label>
                            <textarea class="form-control" name="address" placeholder="Enter Address" required></textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Company Address1  </label>
                            <textarea class="form-control" name="address1" placeholder="Enter Address1"></textarea>
                        </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Area</label>
                                <input class="form-control" name="area" type="text" placeholder="Enter Area">
                            </div>
                            <div class="form-group">
                                <label class="control-label">City</label>
                                <input class="form-control" name="city" type="text" placeholder="Enter City" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">State </label>
                                <input class="form-control" name="state" type="text" placeholder="Enter State" required>
                            </div>
                        <div class="form-group">
                            <label class="control-label">Phone </label>
                            <input class="form-control" name="phone" type="text" placeholder="Enter Phone Number" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Alternate Phone</label>
                            <input class="form-control" name="alternate_phone" type="text" placeholder="Enter Alternate Phone Number" >
                        </div>
                        <div class="form-group">
                            <label class="control-label">Email Id 1</label>
                            <input class="form-control" name="email_1" type="email" placeholder="Enter Email ID 1" required >
                        </div>
                        <div class="form-group">
                            <label class="control-label">Email Id 2</label>
                            <input class="form-control" name="email_2" type="email" placeholder="Enter Email ID 2" >
                        </div>

                            <button class="btn btn-primary pull-right" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>
                        </div>
                        </div>
                        <form>
            </div>
        </div>
    </div>
    </div>
</main>

