<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-edit"></i> Material Inventory</h1>

        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Master Entry</li>
            <li class="breadcrumb-item"><a href="#">Inventory</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-7" id="add">
            <div class="tile">
                <?php if($this->session->flashdata('message')){?>
                    <div class="alert alert-success">
                        <?php echo $this->session->flashdata('message')?>
                    </div>
                <?php } ?>
                <h3 class="tile-title">Inventory</h3>
                <div class="tile-body">
                    <table class="table  table-bordered" id="sampleTable1" border="2">
                        <thead>
                        <tr>
                            <th>Select Meterial</th>
                            <th>Current quantity</th>
                            <th>To Added Quentity</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td>
                            <div class="form-group">
                                <select name="material[]" class="form-control" id="material" required >
                                    <option value="" >Select material</option>
                                    <?php foreach ($stock as $row):
                                    {
                                        echo '<option value= "'.$row['Material_Icode'].'">' . $row['Material_Name'] . '</option>';
                                    }
                                    endforeach; ?>
                                </select>
                            </div>
                            </td>
                            <td>
                                <input  class="form-control" type="text" id="current_qty" readonly>
                            </td>
                            <td>
                                <input class="form-control" type="number" name="new_qty[]" id="qty"  placeholder="Enter quentity" min="0" step="1" required>
                            </td>
                            <td>
                                <input class="form-control" type="text" name="total_qty[]" id="total_qty"  readonly>
                            </td>
                            <td><input type="button" onclick="Add_one()" value="Add" id="Add" /></td>
                        </tr>
                        </tfoot>
                    </table>
                    <button class="btn btn-primary" type="submit" onclick="Save_inventry()"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>&nbsp;

                </div>

            </div>
        </div>
        <div class="col-md-5">
            <div class="tile">  <h3 class="tile-title">Material Inventory List</h3>
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Material</th>
                            <th>Current Quantity</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i=1;
                        foreach ($inventary as $key)
                        {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $key['Material_Name']; ?></td>
                                <td><?php echo $key['Material_Current_Quantity']; ?></td>
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
<script>
    $('#sampleTable').DataTable();
    $("#material").change(function () {
        $.ajax({
            url:"<?php echo site_url('Admin_Controller/get_quantity'); ?>",
            data: {id:
                $(this).val()},
            type: "POST",
            success:function(server_response){
                var data = $.parseJSON(server_response);

                if (data.length === 0) {
                    document.getElementById('current_qty').value = 0;
                }
                else
                {
                    var  qty = data[0]['Material_Current_Quantity'];
                    document.getElementById('current_qty').value = qty;

                }
            }
        });
    });

    $("#qty").on('change keyup paste', function() {
        var qty = parseInt($(this).val());
        var current_qty = parseInt($('#current_qty').val());
        var total =  parseInt(qty + current_qty);
        document.getElementById('total_qty').value = total;


    });

    $("#Add").click(function () {

        if($('#material').val() == "")
        {
            alert("Please Select Material...");
        }
        else if($('#qty').val() == ""){
            alert("Please enter additional quantity...");
        }
        else
        {
            var stocks = $("#material option:selected").text();
            AddRow($('#material').val(), $("#current_qty").val(),$("#qty").val(),$("#total_qty").val(),stocks);
            $("#material").val("");
            $("#current_qty").val("");
            $("#qty").val("");
            $("#total_qty").val("");
        }
    });

    function AddRow(material,current_qty,newqty,total_qty,stocks) {

        var tBody = $("#sampleTable1 > TBODY")[0];
        //Add Row.
        row = tBody.insertRow(-1);
        //Add Name cell.
        var cell = $(row.insertCell(-1));
        var stock = $("<input />");
        stock.attr("type", "hidden");
        stock.attr("name", "material[]");
        stock.val(material);
        cell.append(stock);

        var tech1 = $("<input />");
        tech1.attr("type", "text");
        tech1.attr("name", "test");
        tech1.attr("class", "form-control");
        tech1.attr('readonly', true);
        tech1.val(stocks);
        cell.append(tech1);

        var cell = $(row.insertCell(-1));
        var cty = $("<input />");
        cty.attr("type", "text");
        cty.attr("class", "form-control");
        cty.attr("name", "cty[]");
        cty.attr('readonly', true);
        cty.val(current_qty);
        cell.append(cty);

        var cell = $(row.insertCell(-1));
        var cty1 = $("<input />");
        cty1.attr("type", "text");
        cty1.attr("class", "form-control");
        cty1.attr("name", "new_qty[]");
        cty1.attr('readonly', true);
        cty1.val(newqty);
        cell.append(cty1);

        var cell = $(row.insertCell(-1));
        var cty2 = $("<input />");
        cty2.attr("type", "text");
        cty2.attr("class", "form-control");
        cty2.attr("name", "total_qty[]");
        cty2.attr('readonly', true);
        cty2.val(total_qty);
        cell.append(cty2);

        cell = $(row.insertCell(-1));
        var btnRemove = $("<input />");
        btnRemove.attr("type", "button");
        btnRemove.attr("onclick", "Remove(this);");
        btnRemove.val("Remove");
        cell.append(btnRemove);
    };
    function Remove(button) {
        //Determine the reference of the Row using the Button.
        var row = $(button).closest("TR");
        var name = $("TD", row).eq(0).html();
        if (confirm("Do you want to delete: ")) {

            //Get the reference of the Table.
            var table = $("#sampleTable1")[0];

            //Delete the Table row using it's Index.
            table.deleteRow(row[0].rowIndex);
        }
    };
    </script>

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
    function Save_inventry() {

        var material =document.getElementsByName("material[]");
        var materials = [];
        for (var j = 0, iLen = material.length; j < iLen; j++) {
            materials.push(material[j].value);
        }

        var new_qty =document.getElementsByName("new_qty[]");
        var new_qtys = [];
        for (var j = 0, iLen = new_qty.length; j < iLen; j++) {
            new_qtys.push(new_qty[j].value);
        }

        var total_qty =document.getElementsByName("total_qty[]");
        var total_qtys = [];
        for (var j = 0, iLen = total_qty.length; j < iLen; j++) {
            total_qtys.push(total_qty[j].value);
        }

        if (materials == '' || new_qtys == '' || total_qtys == ''){
            alert("Please Select All Fields");
        }
        else{
            $.ajax({
                url:"<?php echo site_url('Admin_Controller/Save_Inventary'); ?>",
                data: {material_id: materials, new_quantity: new_qtys, total_quantity: total_qtys },
                type: "POST",
                cache: false,
                success:function(server_response){
                    if(server_response == 1)
                    {
                        swal({
                                title: "Good job!",
                                text: "You clicked the button!",
                                type: "success"
                            },
                            function(){
                                location.reload();
                            });

                    }

                }
            });
        }

    }

</script>