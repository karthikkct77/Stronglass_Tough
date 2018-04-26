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
                    </div>
                    <div class="col-md-3">
                        <h2>Invoice No: 123</h2>
                    </div>
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
                var one = data[0]['Customer_Company_Name'],data[0]['Customer_Address_1'];
                    document.getElementById('coustomer').innerHTML = data[0]['Customer_Company_Name'];
                    document.getElementById('address').innerHTML = data[0]['Customer_Address_1'];
                    document.getElementById('phone').innerHTML = data[0]['Customer_Phone'];
                    document.getElementById('gstn').innerHTML = data[0]['Customer_GSTIN'];

            }
        });
    });
    </script>

