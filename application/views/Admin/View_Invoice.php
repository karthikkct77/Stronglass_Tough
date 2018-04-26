<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-edit"></i>Invoice</h1>

        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Profoma_invoice</li>
            <li class="breadcrumb-item"><a href="#">Profoma_invoice</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12" >
            <div class="tile">
                <div class="row invoice">
                    <h2><?php echo $st[0]['ST_Name']; ?></h2>
                    <h4><?php echo $st[0]['ST_Address_1']; ?>,<?php echo $st[0]['ST_Area']; ?>,<?php echo $st[0]['ST_City']; ?></h4>
                    <h3>Mob: <?php echo $st[0]['ST_Phone']; ?></h3>
                    <h4>Email :<?php echo $st[0]['ST_Email_ID1']; ?></h4>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <h3>Consignee</h3>
                        <div class="form-group ">
                            <label class="control-label">Customer Name </label>
                            <select name="company_name" class="form-control" id="company_name1" required >
                                <option value="" >Select Company</option>
                                <?php foreach ($customer as $row):
                                {
                                    echo '<option value= "'.$row['Customer_Icode'].'">' . $row['Customer_Company_Name'] . '</option>';
                                }
                                endforeach; ?>
                            </select>
                        </div>
                        <div id="consign">
                            <h3 id="coustomer"></h3>
                            <h4 id="address"></h4>
                            <h4 id="phone"></h4>
                            <h3 id="gstn"></h3>
                        </div>

                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <input type="checkbox" name="check" id="check" onclick="FillBilling()">
                            <em>Check this box if Current Address and Mailing permanent are the same.</em>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <h3>Buyer (if other than consignee)</h3>
                        <div class="form-group ">
                            <label class="control-label">Customer Name </label>
                            <select name="company_name" class="form-control" id="company_name2" required >
                                <option value="" >Select Company</option>
                                <?php foreach ($customer as $row):
                                {
                                    echo '<option value= "'.$row['Customer_Icode'].'">' . $row['Customer_Company_Name'] . '</option>';
                                }
                                endforeach; ?>
                            </select>
                        </div>
                        <div id="Buyer">
                            <h3 id="coustomer1"></h3>
                            <h4 id="address1"></h4>
                            <h4 id="phone1"></h4>
                            <h3 id="gstn1"></h3>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h2>Invoice No: 123</h2>
                    </div>
                </div>

                <div class="row">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                        <th>#</th>
                        <th>Material</th>
                        <th>Thickness</th>
                        <th>Hsn code</th>
                        <th>Special</th>
                        <th>No.of Pieces</th>
                        <th>Actucal Size(H)</th>
                        <th>Actucal Size(W)</th>
                        <th>Chargable Size(H)</th>
                        <th>Chargable Size(W)</th>
                        <th>Area</th>
                        <th>Rate</th>
                        <th>Total</th>
                        </thead>
                        <tbody>
                        <?php $i=1; foreach ($invoice as $key) { ?>
                            <tr id="row<?php echo $i; ?>">
                                <td><?php echo $i; ?></td>
                                <td>     <div class="form-group">
                                        <select name="material[]" class="form-control" id="material<?php echo $i; ?>" onclick="get_result('<?php echo $i; ?>')" required >
                                            <option value="" >Select material</option>
                                            <?php foreach ($stock as $row):
                                            {
                                                echo '<option value= "'.$row['Material_Icode'].'">' . $row['Material_Name'] . '</option>';
                                            }
                                            endforeach; ?>
                                        </select>
                                    </div>
                                </td>
                                <td> <input class="form-control" type="text" name="thickness[]" id="thckness<?php echo $i; ?>" value="<?php echo $key['Thickness']; ?>" readonly></td>
                                <td><input class="form-control" type="text" name="hsn[]" id="hsn<?php echo $i; ?>" value="" ></td>
                                <td><input class="form-control" type="text" name="type[]" id="type<?php echo $i; ?>" value="<?php echo $key['type']; ?>" readonly></td>
                                <td><input class="form-control" type="text" name="pics[]" id="pics<?php echo $i; ?>" value="<?php echo $key['pics']; ?>" readonly></td>
                                <td><input class="form-control" type="text" name="height[]" id="height<?php echo $i; ?>" value="<?php echo $key['height']; ?>" readonly></td>
                                <td><input class="form-control" type="text" name="width[]" id="width<?php echo $i; ?>" value="<?php echo $key['width']; ?>" readonly></td>
                                <td><input class="form-control" type="text" name="ch_height[]" id="ch_height<?php echo $i; ?>" value="<?php echo $key['ch_height']; ?>" readonly></td>
                                <td><input class="form-control" type="text" name="ch_weight[]" id="ch_weight<?php echo $i; ?>" value="<?php echo $key['ch_weight']; ?>" readonly></td>
                                <td><input class="form-control" type="text" name="area[]" id="area<?php echo $i; ?>" value="<?php echo $key['area']; ?>" readonly></td>
                                <td><input class="form-control" type="text" name="rate[]" id="rate<?php echo $i; ?>" ></td>
                                <td><input class="form-control" type="text" name="total[]" id="total<?php echo $i; ?>" ></td>
                            </tr>

                        <?php $i++; } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</main>
<script>
    $("#company_name1").change(function () {
        $.ajax({
            url:"<?php echo site_url('Admin_Controller/get_Customer_Details'); ?>",
            data: {id:
                $(this).val()},
            type: "POST",
            success:function(server_response){
                var data = $.parseJSON(server_response);
                    document.getElementById('coustomer').innerHTML = data[0]['Customer_Company_Name'];
                    document.getElementById('address').innerHTML = data[0]['Customer_Address_1'] + data[0]['Customer_Area'] + data[0]['Customer_City'] ;
                    document.getElementById('phone').innerHTML = "Mob :" + data[0]['Customer_Phone'];
                    document.getElementById('gstn').innerHTML = "GSTIN :" + data[0]['Customer_GSTIN'];
            }
        });
    });

    $("#company_name2").change(function () {
        $.ajax({
            url:"<?php echo site_url('Admin_Controller/get_Customer_Details'); ?>",
            data: {id:
                $(this).val()},
            type: "POST",
            success:function(server_response){
                var data = $.parseJSON(server_response);
                $('#Buyer').show();
                document.getElementById('coustomer1').innerHTML = data[0]['Customer_Company_Name'];
                document.getElementById('address1').innerHTML = data[0]['Customer_Address_1'] + data[0]['Customer_Area'] + data[0]['Customer_City'] ;
                document.getElementById('phone1').innerHTML = "Mob :" + data[0]['Customer_Phone'];
                document.getElementById('gstn1').innerHTML = "GSTIN :" + data[0]['Customer_GSTIN'];
            }
        });
    });

    function FillBilling() {
        if($('#check').is(":checked"))
        {
            $('#Buyer').show();
            document.getElementById('coustomer1').innerHTML =  document.getElementById('coustomer').innerHTML;
            document.getElementById('address1').innerHTML  = document.getElementById('address').innerHTML;
            document.getElementById('phone1').innerHTML =  document.getElementById('phone').innerHTML
            document.getElementById('gstn1').innerHTML =  document.getElementById('gstn').innerHTML;
        }
        else
        {
            $('#Buyer').hide();
        }
    }
    function get_result(id) {
        var pcs = document.getElementById('pics'+id).value;
        var area = document.getElementById('area'+id).value;
        $("#material"+id).change(function () {
            $.ajax({
                url:"<?php echo site_url('Admin_Controller/Edit_Material'); ?>",
                data: {id:
                    $(this).val()},
                type: "POST",
                success:function(server_response){
                    var data = $.parseJSON(server_response);

                    var amount = data[0]['Material_Current_Price'];
                    var total = pcs * area * amount;
                    document.getElementById('total'+id).value = total;
                }
            });
        });
    }
    </script>

