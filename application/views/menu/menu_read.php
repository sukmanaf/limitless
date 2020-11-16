
    <body>
        <h2 style="margin-top:0px">Menu Read</h2>
        <table class="table">
	    <tr><td>Menu</td><td><?php echo $menu; ?></td></tr>
	    <tr><td>Controller</td><td><?php echo $controller; ?></td></tr>
	    <tr><td>Parent</td><td><?php echo $parent; ?></td></tr>
	    <tr><td>Active</td><td><?php echo $active; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('menu') ?>" class="btn btn-danger">Cancel</a></td></tr>
	</table>
        </body>