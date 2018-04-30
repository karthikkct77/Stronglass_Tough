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
                    <h4>Mob: <?php echo $st[0]['ST_Phone']; ?></h4>
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
                            <h5 id="address"></h5>
                            <h5 id="phone"></h5>
                            <h5 id="gstn"></h5>
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
                            <h5 id="address1"></h5>
                            <h5 id="phone1"></h5>
                            <h5 id="gstn1"></h5>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h2>Invoice No: <input type="text" name="invoice_no" id="invoice_no" value="12345"></h2>
                        <h3>Date:<input type="text" name="invoice_date" id="invoice_date" value="<?php echo date('Y-m-d'); ?>"> </h3>
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
                        <th>No.of Holes</th>
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
                                <td><input class="form-control" type="text" name="holes[]" id="holes<?php echo $i; ?>" value="<?php echo $key['holes']; ?>" readonly></td>
                                <td><input class="form-control" type="text" name="height[]" id="height<?php echo $i; ?>" value="<?php echo $key['height']; ?>" readonly></td>
                                <td><input class="form-control" type="text" name="width[]" id="width<?php echo $i; ?>" value="<?php echo $key['width']; ?>" readonly></td>
                                <td><input class="form-control" type="text" name="ch_height[]" id="ch_height<?php echo $i; ?>" value="<?php echo $key['ch_height']; ?>" readonly></td>
                                <td><input class="form-control" type="text" name="ch_weight[]" id="ch_weight<?php echo $i; ?>" value="<?php echo $key['ch_weight']; ?>" readonly></td>
                                <td><input class="form-control" type="text" name="area[]" id="area<?php echo $i; ?>" value="<?php echo $key['area']; ?>" readonly></td>
                                <td><input class="form-control" type="text" name="rate[]" id="rate<?php echo $i; ?>" onkeyup="change_rate('<?php echo $i; ?>')" ></td>
                                <td><input class="form-control" type="text" name="total[]" id="total<?php echo $i; ?>" ></td>

                            </tr>
                        <?php $i++; } ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td> <input type="text" class="form-control pull-right" id="grand_total" value="0"   readonly/></td>
                        </tr>
                        </tbody>
                    </table>
                    <script>
                        $("#grand_total").on('click', function() {
                            var total =document.getElementsByName("total[]");
                            var sum = 0;
                            for (var j = 0, iLen = total.length; j < iLen; j++) {
                                val=parseFloat(total[j].value);
                                sum +=val;
                            }
                            document.getElementById('grand_total').value = parseFloat(sum).toFixed(2);
                        });
                    </script>
                </div>
               <div class="row">

                       <div class="col-md-6">

                       </div>
                       <div class="col-md-6">
                           <table class="table table-hover table-bordered" id="sampleTable1">
                               <thead>
                               <th>Select Charges</th>
                               <th>No.of pieces</th>
                               <th>Price</th>
                               <th>Total</th>
                               </thead>
                               <tbody></tbody>
                               <tfoot>
                               <tr>
                                   <td><div class="form-group">
                                           <select name="charges[]" class="form-control" id="charges"  required >
                                               <option value="" >Select Charges</option>
                                               <?php foreach ($charges as $row):
                                               {
                                                   echo '<option value= "'.$row['charge_icode'].'">' . $row['charge_name'] . '</option>';
                                               }
                                               endforeach; ?>
                                           </select>
                                       </div></td>
                                   <td><input class="form-control" type="text" name="no_holes[]" id="no_holes" ></td>
                                   <td><input class="form-control" type="text" name="charge_amt[]" id="charge_amt" ></td>
                                   <td><input class="form-control" type="text" name="tot_charge_amt[]" id="tot_charge_amt" ></td>
                                   <td><input type="button" onclick="Add_one()" value="Add" id="Add" /></td>
                               </tr>
                               <tr>
                                  <td colspan="3" align="right">SUB-TOTAL</td>

                                   <td><input class="form-control" type="text" name="sub_tot" id="sub_tot" ></td>
                                   <td></td>
                               </tr>
                               <tr>
                                   <td colspan="3" align="right">INSURANCE</td>

                                   <td><input class="form-control" type="text" name="insurance" id="insurance" ></td>
                                   <td></td>
                               </tr>
                               <tr>
                                   <td colspan="3" align="right">SGST @<?php echo $tax[0]['SGST%']; ?></td>

                                   <td><input class="form-control" type="text" name="sgst" id="sgst" value="" ></td>
                                   <td></td>
                               </tr>
                               <tr>
                                   <td colspan="3" align="right">CGST @<?php echo $tax[0]['CGST%']; ?>
                                       <input type="hidden" id="gst" value="<?php echo $tax[0]['CGST%']; ?>">
                                   </td>


                                   <td><input class="form-control" type="text" name="cgst" id="cgst" value="" ></td>
                                   <td></td>
                               </tr>
                               <tr>

                                   <td colspan="3" align="right">GROSS TOTAL</td>
                                   <td><input class="form-control" type="text" name="gross_tot" id="gross_tot" readonly ></td>
                                   <td></td>
                               </tr>
                               </tfoot>
                           </table>
                       </div>

                   <script>
                       $("#sub_tot").on('click', function() {
                           var total =document.getElementsByName("tot_charge_amt[]");
                           var sum = 0;
                           for (var j = 0, iLen = total.length; j < iLen; j++) {
                               val=parseFloat(total[j].value);
                               sum +=val;
                           }
                           var grant_tot = document.getElementById('grand_total').value;
                           var sub_tot = parseFloat(sum) + parseFloat(grant_tot);
                           document.getElementById('sub_tot').value = parseFloat(sub_tot).toFixed(2);
                       });
                       $("#sgst").on('click', function() {
                           var sub_tot =document.getElementById('sub_tot').value;
                           var insurance =document.getElementById('insurance').value;
                           var gst = document.getElementById('gst').value;
                           var sum = ((parseFloat(sub_tot) + parseFloat(insurance)) * gst / 100 );
                           document.getElementById('sgst').value = parseFloat(sum).toFixed(2);
                           document.getElementById('cgst').value = parseFloat(sum).toFixed(2);
                       });
                       $("#gross_tot").on('click', function() {
                           var sub_tot =document.getElementById('sub_tot').value;
                           var insurance =document.getElementById('insurance').value;
                           var sgst = document.getElementById('sgst').value;
                           var cgst = document.getElementById('cgst').value;
                           var sum = (parseFloat(sub_tot) + parseFloat(insurance) + parseFloat(sgst) + parseFloat(cgst));
                           document.getElementById('gross_tot').value = parseInt(sum);
                       });
                   </script>

               </div>
                <div class="row">
                    <button class="btn btn-primary" type="submit" onclick="Save_invoice()"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>&nbsp;

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

    $("#no_holes").on('change keyup paste', function() {
        var holes = parseInt($(this).val());
        var amt = parseInt($('#charge_amt').val());
        var total =  parseInt(holes * amt);
        document.getElementById('tot_charge_amt').value = total;
    });

    $("#charges").change(function () {
        $.ajax({
            url:"<?php echo site_url('Admin_Controller/Edit_Charges'); ?>",
            data: {id:
                $(this).val()},
            type: "POST",
            success:function(server_response){
                var data = $.parseJSON(server_response);
                var  price = data[0]['charge_current_price'];
                document.getElementById('charge_amt').value = price;
            }
        });
    });
    $("#Add").click(function () {

        if($('#charges').val() == "")
        {
            alert("Please Select Charges...");
        }
        else if($('#no_holes').val() == ""){
            alert("Please enter No.of pieces...");
        }
        else
        {
            var chrgs = $("#charges option:selected").text();
            AddRow($('#charges').val(), $("#no_holes").val(),$("#charge_amt").val(),$("#tot_charge_amt").val(),chrgs);
            $("#charges").val("");
            $("#no_holes").val("");
            $("#charge_amt").val("");
            $("#tot_charge_amt").val("");
        }
    });

    function AddRow(charges,no_holes,charge_amt,tot_charge_amt,chrgs) {
        var tBody = $("#sampleTable1 > TBODY")[0];
        //Add Row.
        row = tBody.insertRow(-1);
        //Add Name cell.
        var cell = $(row.insertCell(-1));
        var stock = $("<input />");
        stock.attr("type", "hidden");
        stock.attr("name", "charges[]");
        stock.val(charges);
        cell.append(stock);

        var tech1 = $("<input />");
        tech1.attr("type", "text");
        tech1.attr("name", "test");
        tech1.attr("class", "form-control");
        tech1.attr('readonly', true);
        tech1.val(chrgs);
        cell.append(tech1);

        var cell = $(row.insertCell(-1));
        var cty = $("<input />");
        cty.attr("type", "text");
        cty.attr("class", "form-control");
        cty.attr("name", "no_holes[]");
        cty.attr('readonly', true);
        cty.val(no_holes);
        cell.append(cty);

        var cell = $(row.insertCell(-1));
        var cty1 = $("<input />");
        cty1.attr("type", "text");
        cty1.attr("class", "form-control");
        cty1.attr("name", "charge_amt[]");
        cty1.attr('readonly', true);
        cty1.val(charge_amt);
        cell.append(cty1);

        var cell = $(row.insertCell(-1));
        var cty2 = $("<input />");
        cty2.attr("type", "text");
        cty2.attr("class", "form-control");
        cty2.attr("name", "tot_charge_amt[]");
        cty2.attr('readonly', true);
        cty2.val(tot_charge_amt);
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
                    document.getElementById('total'+id).value = total.toFixed(2);
                    document.getElementById('rate'+id).value = amount;
//                    var tot =  document.getElementById('grand_total').value;
//                    var new_tot = parseInt(tot)  + parseInt(total);
//                    document.getElementById('grand_total').value =new_tot;
                }
            });
        });
    }

    function change_rate(id) {
        var pcs = document.getElementById('pics'+id).value;
        var area = document.getElementById('area'+id).value;
        var rate = document.getElementById('rate'+id).value;
        var total = (pcs * area * rate);
        document.getElementById('total'+id).value = total;
    }


    function Save_invoice() {
        var invoice =  document.getElementById('invoice_no').value;
        var invoice_date =  document.getElementById('invoice_date').value;


    }
    </script>

