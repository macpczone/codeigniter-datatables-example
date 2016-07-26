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
        <h2 style="margin-top:0px">People <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
                <label for="varchar">firstname <?php echo form_error('firstname') ?></label>
                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="firstname" value="<?php echo $firstname; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar">lastname <?php echo form_error('lastname') ?></label>
                <input type="text" class="form-control" name="lastname" id="lastname" placeholder="lastname" value="<?php echo $lastname; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar">address <?php echo form_error('address') ?></label>
                <input type="text" class="form-control" name="address" id="address" placeholder="address" value="<?php echo $address; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar">area <?php echo form_error('area') ?></label>
                <input type="text" class="form-control" name="area" id="area" placeholder="area" value="<?php echo $area; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar">postcode <?php echo form_error('postcode') ?></label>
                <input type="text" class="form-control" name="postcode" id="postcode" placeholder="postcode" value="<?php echo $postcode; ?>" />
            </div>
	    <div class="form-group">
                <label for="tinyint">age <?php echo form_error('age') ?></label>
                <input type="text" class="form-control" name="age" id="age" placeholder="age" value="<?php echo $age; ?>" />
            </div>
        <?php if ($id != NULL) {; ?>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <?php } ?>
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('example') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>
