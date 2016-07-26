<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">People Read</h2>
        <table class="table">
	    <tr><td>firstname</td><td><?php echo $firstname; ?></td></tr>
	    <tr><td>lastname</td><td><?php echo $lastname; ?></td></tr>
	    <tr><td>address</td><td><?php echo $address; ?></td></tr>
	    <tr><td>area</td><td><?php echo $area; ?></td></tr>
	    <tr><td>postcode</td><td><?php echo $postcode; ?></td></tr>
	    <tr><td>age</td><td><?php echo $age; ?></td></tr>
	    <tr><td>created</td><td><?php echo $created; ?></td></tr>
	    <tr><td>updated</td><td><?php echo $updated; ?></td></tr>
	    <tr><td>deleted</td><td><?php echo $deleted; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('people') ?>" class="btn btn-default">Cancel</button></td></tr>
	</table>
    </body>
</html>