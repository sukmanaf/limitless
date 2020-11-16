<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span>  SSPD - BPHTB</h2>
</div>

<div class="page-content-wrap">
<div class="row">
    
        <div class="panel panel-default">
            <div class="col-md-12">
                <?php if (!empty($info)) {echo $info;} ?>
            </div>
            <div class="panel-heading">
                <div class="row">
                   <a class="btn btn-primary" href="<?php echo base_url().'assets/files/contoh_harga_referensi.xlsx' ?>">Download Format</a>
                </div>
            </div>
            <div class="listform">
                <div class="panel-body">
                   
                <form method="post"  id="postan" action="<?php echo base_url();?>index.php/import/upload" enctype="multipart/form-data">

                	<div class="col-md-6">
                		
					<input type="file" id="id_file"  name="file" class="form-control">
                	</div>
                	<div class="col-md-1">
                		

					<!-- <input type="submit" name="preview" value="Preview"> -->
                    <input type="submit" name="submit" value="baru">
					<!-- <button class="btn-info btn" onclick="lihat()">Lihat</button> -->
                	</div>
                	<div class="col-md-1">
					<!-- <button class="btn-danger btn" id="btn_import" >Import Data</button> -->
                		
                	</div>
				</form>

				<div id="div_tabel" style="margin-top: 30px;padding-top: 30px">
					
				</div>
                </div>
            </div>
            <div class="listform">
                <div class="panel-body">
                   
                <form method="post"  id="postan" action="<?php echo base_url();?>index.php/import/upload_buana" enctype="multipart/form-data">

                    <div class="col-md-6">
                        
                    <input type="file" id="id_file"  name="file" class="form-control">
                    </div>
                    <div class="col-md-1">
                        

                    <!-- <input type="submit" name="preview" value="Preview"> -->
                    <input type="submit" name="submit" value="buana">
                    <!-- <button class="btn-info btn" onclick="lihat()">Lihat</button> -->
                    </div>
                    <div class="col-md-1">
                    <!-- <button class="btn-danger btn" id="btn_import" >Import Data</button> -->
                        
                    </div>
                </form>

                <div id="div_tabel" style="margin-top: 30px;padding-top: 30px">
                    
                </div>
                </div>
            </div>
            <div class="listform">
                <div class="panel-body">
                     <!-- <?php if (!$harga): echo 'Data SSPD kosong.';else: ?> -->
                </div>
            </div>
            <div class="listform">
                <div class="panel-body" id="div_tabel">
                    
                </div>
                
                <?php endif;?>
            </div>
        </div>
    </div>
</div>
	
	<!-- Buat sebuah tag form dan arahkan action nya ke controller ini lagi -->
	<!-- <form method="post"  id="postan" action="<?php echo base_url();?>index.php/harga_r/import" enctype="multipart/form-data"> -->
	

