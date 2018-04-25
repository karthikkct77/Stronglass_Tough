<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-edit"></i>View Stronglass </h1>

        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">ST Entry</li>
            <li class="breadcrumb-item"><a href="#">View Stronglass</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="tile">  <h3 class="tile-title">Stronglass Tough</h3>
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="size_table">
                        <tbody>
                        <?php
                        foreach ($st as $key)
                        {
                            ?>
                            <tr>
                                <td align="right">NAME</td><td><?php echo $key['ST_Name']; ?></td>
                            <tr>
                            <tr>
                                <td align="right">GSTIN</td><td><?php echo $key['ST_GSTIN']; ?></td>
                            <tr>
                            <tr>
                                <td align="right">Address</td><td><?php echo $key['ST_Address_1']; ?>, <?php echo $key['ST_Address_2']; ?></td>
                            <tr>
                            <tr>
                                <td align="right">Area</td><td><?php echo $key['ST_Area']; ?></td>
                            <tr>   <tr>
                                <td align="right">City</td><td><?php echo $key['ST_City']; ?></td>
                            <tr>
                            <tr>
                                <td align="right">State</td><td><?php echo $key['ST_State']; ?></td>
                            <tr>
                            <tr>
                                <td align="right">Phone</td><td><?php echo $key['ST_Phone']; ?></td>
                            <tr>
                            <tr>
                                <td align="right">Email</td><td><?php echo $key['ST_Email_ID1']; ?></td>
                            <tr>
                            <tr>
                                <td align="right">Bank Name</td><td><?php echo $key['ST_Bank']; ?></td>
                            <tr>
                            <tr>
                                <td align="right">Account Type</td><td><?php echo $key['ST_Bank_Account_Type']; ?></td>
                            <tr>
                            <tr>
                                <td align="right">Account Number</td><td><?php echo $key['ST_Bank_Account_Number']; ?></td>
                            <tr>
                            <tr>
                                <td align="right">IFSC</td><td><?php echo $key['ST_Bank_Account_IFSC_Code']; ?></td>
                            <tr>
                            <?php }

                                foreach ($tax as $key)
                                {
                                    ?>

                            <tr>
                                <td align="right">SGST%</td><td><?php echo $key['SGST%']; ?></td>
                            <tr>
                            <tr>
                                <td align="right">CGST%</td><td><?php echo $key['CGST%']; ?></td>
                            <tr>
                            <?php } ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<script type="text/javascript">
    $(document).ready( function () {
        $('#size_table').DataTable();
    } );
</script>