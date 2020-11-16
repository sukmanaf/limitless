
    <body>
        <h2 style="margin-top:0px">Barang Read</h2>
        <table class="table">
	    <tr><td>Nama</td><td><?php echo $nama; ?></td></tr>
	    <tr><td>Harga</td><td><?php echo $harga; ?></td></tr>
	    <tr><td>Updated At</td><td><?php echo $updated_at; ?></td></tr>
	    <tr><td>Keterangan</td><td><?php echo $keterangan; ?></td></tr>
	    <tr><td>Created At</td><td><?php echo $created_at; ?></td></tr>
	    <tr><td>Datetim</td><td><?php echo $datetim; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('barang') ?>" class="btn btn-danger">Cancel</a></td></tr>
	</table>
        </body>