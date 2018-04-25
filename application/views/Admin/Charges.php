<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-edit"></i> Charges Entry</h1>

        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Master Entry</li>
            <li class="breadcrumb-item"><a href="#">Charges Entry</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-6" id="add">
            <div class="tile">
                <h3 class="tile-title">Charges</h3>
                <?php if($this->session->flashdata('message')){?>
                    <div class="alert alert-success">
                        <?php echo $this->session->flashdata('message')?>
                    </div>
                <?php } ?>
                <div class="tile-body">
                    <form method="post" class="login-form" action="<?php echo site_url('Admin_Controller/Save_Charges'); ?>" name="data_register">
                        <div class="form-group">
                            <label class="control-label">Charges Name</label>
                            <input class="form-control" type="text" name="charges_name" placeholder="Enter Charges name" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Charges Price</label>
                            <input class="form-control" type="number" name="charges_price" placeholder="Enter Amount" min="0" step="1" required>
                        </div>
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>&nbsp;
                    </form>
                </div>
            </div>
        </div>
        <!-- Update  Details -->
        <div class="col-md-6" id="update" style="display: none">
            <div class="tile">
                <h3 class="tile-title">Edit Charges</h3>
                <div class="tile-body">
                    <form method="post" class="login-form" action="<?php echo site_url('Admin_Controller/Update_Charges'); ?>" name="data_register">
                        <div class="form-group">
                            <label class="control-label">Charges Name</label>
                            <input class="form-control" type="text" name="charges_name" id="charge" placeholder="Enter Charges name" required>
                            <input type="hidden" name="charges_icode" id="charges_icode">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Charges Price</label>
                            <input class="form-control" type="number" name="charges_price" id="price" placeholder="Enter Amount" min="0" step="1" required>
                        </div>
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>&nbsp;
                    </form>
                </div>
            </div>
        </div>
        <!-- view Stock Details -->
        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title">Charges List</h3>
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Charges Name</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1;
                        foreach ($charges as $val)
                        {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $val['charge_name']; ?></td>
                                <td><?php echo $val['charge_current_price']; ?></td>
                                <td><button class="btn btn-info" onclick="edit_charges('<?php echo $val['charge_icode']; ?> ')">Edit</button></td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<script>$('#sampleTable').DataTable();</script>
<script>
    function edit_charges (id) {
        $.ajax({
            url:"<?php echo site_url('Admin_Controller/Edit_Charges'); ?>",
            data: {id: id},
            type: "POST",
            cache: false,
            success:function(server_response){
                $("#update").show();
                $("#add").hide();
                var data = $.parseJSON(server_response);
                var charges_name = data[0]['charge_name'];
                document.getElementById('charge').value = charges_name;
                var price = data[0]['charge_current_price'];
                document.getElementById('price').value = price;
                var icode =data[0]['charge_icode'];
                document.getElementById('charges_icode').value = icode;
            }
        });
    }
</script>