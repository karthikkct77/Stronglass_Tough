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
            <h1><i class="fa fa-edit"></i>Add ST</h1>

        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Our Entry</li>
            <li class="breadcrumb-item"><a href="#">Add ST</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Add ST</h3>
                <div class="tile-body">
                    <form method="post" class="login-form" action="<?php echo site_url('Admin_Controller/Save_ST'); ?>" name="data_register">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="control-label">Our Company Name </label>
                                    <input class="form-control" name="company_name" type="text" placeholder="Enter Company Name" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Our GSTIN/UIN </label>
                                    <input class="form-control" name="gstin_number" type="text" placeholder="Enter GSTIN/UIN Number" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Our Address  </label>
                                    <textarea class="form-control" name="address" placeholder="Enter Address" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Our Address1  </label>
                                    <textarea class="form-control" name="address1" placeholder="Enter Address1"></textarea>
                                </div>
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
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="control-label">Email Id 1</label>
                                    <input class="form-control" name="email_1" type="email" placeholder="Enter Email ID 1" required >
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Email Id 2</label>
                                    <input class="form-control" name="email_2" type="email" placeholder="Enter Email ID 2" >
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Bank Name </label>
                                    <input class="form-control" name="bank" type="text" placeholder="Enter Bank Name" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Bank Account Number </label>
                                    <input class="form-control" name="account" type="text" placeholder="Enter Bank Account Number" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Bank Account Type </label>
                                    <input class="form-control" name="account_type" type="text" placeholder="Enter Account Type" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Bank Account IFSC Number </label>
                                    <input class="form-control" name="ifsc" type="text" placeholder="Enter Account IFSC Number" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">SGST % </label>
                                    <input class="form-control" name="sgst" type="text" placeholder="Enter SGST%" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">CGST % </label>
                                    <input class="form-control" name="cgst" type="text" placeholder="Enter CGST%" required>
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

