<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-edit"></i> Master Entry</h1>

        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Master Entry</li>
            <li class="breadcrumb-item"><a href="#">Size Entry</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title">Size</h3>

                <div class="tile-body">
                    <form method="post" class="login-form" action="<?php echo site_url('Admin_Controller/Save_Size'); ?>" name="data_register">
                        <div class="form-group">
                            <label class="control-label">Size(mm) </label>
                            <input class="form-control" name="size" type="text" placeholder="Enter Size" required>
                        </div>
                    <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>
                    <form>
                </div>

            </div>
        </div>
        <div class="col-md-6">
            <div class="tile">  <h3 class="tile-title">Size</h3>
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="size_table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Size(mm)</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i=1;
                        foreach ($size as $key)
                        {
                            ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $key['size']; ?></td>
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
    <script type="text/javascript">
        $(document).ready( function () {
            $('#size_table').DataTable();
        } );

    </script>
