<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-edit"></i> Material Entry</h1>

        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Master Entry</li>
            <li class="breadcrumb-item"><a href="#">Material Entry</a></li>
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
                <h3 class="tile-title">Material</h3>
                <div class="tile-body">
                    <form method="post" class="login-form" action="<?php echo site_url('Admin_Controller/Save_Stock'); ?>" name="data_register">
                        <div class="form-group">
                            <label class="control-label">Material Name</label>
                            <input class="form-control" type="text" name="stock_name" placeholder="Enter stock name" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Material Price</label>
                            <input class="form-control" type="number" name="stock_price"  placeholder="Enter Amount" min="0" step="1" required>
                        </div>
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>&nbsp;
                    </form>
                </div>
            </div>
        </div>

        <!-- Update  Details -->
        <div class="col-md-6" id="update" style="display: none">
            <div class="tile">
                <h3 class="tile-title">Edit Material</h3>
                <div class="tile-body">
                    <form method="post" class="login-form" action="<?php echo site_url('Admin_Controller/Update_Material'); ?>" name="data_register" onsubmit="return confirm('Do you really want to Update The Material Datas?');">
                        <div class="form-group">
                            <label class="control-label">Material Name</label>
                            <input class="form-control" type="text" name="material_name" id="material" placeholder="Enter Charges name" readonly required>
                            <input type="hidden" name="material_icode" id="material_icode">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Material Price</label>
                            <input class="form-control" type="number" name="material_price" id="price" placeholder="Enter Amount" min="0" step="1" required>
                        </div>
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>&nbsp;
                        <button class="btn btn-danger" type="button" onClick="window.location.reload();">Close</button>
                    </form>

                </div>
            </div>
        </div>
        <!-- view Stock Details -->
        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title">Material List</h3>
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Stock Name</th>
                            <th>Stock Price</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1;
                        foreach ($stock as $val)
                        {
                            ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $val['Material_Name']; ?></td>
                            <td><?php echo $val['Material_Current_Price']; ?></td>
                            <td><button class="btn btn-info" onclick="edit_material('<?php echo $val['Material_Icode']; ?> ')">Edit</button></td>
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
    function edit_material (id) {
        $.ajax({
            url:"<?php echo site_url('Admin_Controller/Edit_Material'); ?>",
            data: {id: id},
            type: "POST",
            cache: false,
            success:function(server_response){
                $("#update").show();
                $("#add").hide();
                var data = $.parseJSON(server_response);
                var charges_name = data[0]['Material_Name'];
                document.getElementById('material').value = charges_name;
                var price = data[0]['Material_Current_Price'];
                document.getElementById('price').value = price;
                var icode =data[0]['Material_Icode'];
                document.getElementById('material_icode').value = icode;
            }
        });
    }
</script>