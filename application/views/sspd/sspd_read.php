<style type="text/css">



</style>
<div class="panel panel-radius">
   
    <div class="panel-body">
        

        <form action="#" id="postForm" class="form-horizontal" enctype="multipart/form-data" method="post">
            <fieldset class="content-group">

        
          <table width="100%" style="">
            <tr>
              <td>
                  <div class="col-md-12" style="padding-top: 30px;padding-bottom: 20px">
                    
                    <table width="100%">
                      <tr>
                        <td width="5%">A.</td>
                        <td>1.</td>
                        <td>Nama Wajib Pajak</td>
                        <td>: <?=@$sspd->nama ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td></td>
                        <td>2.</td>
                        <td>NIK</td>
                        <td>: <?=@$sspd->nik ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td></td>
                        <td>3.</td>
                        <td>Alamat Wajib Pajak</td>
                        <td>: <?=@$sspd->alamat_wp ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td></td>
                        <td>4.</td>
                        <td>Kelurahan / Desa</td>
                        <td>: <?=@$sspd->kelurahan_op ?></td>
                        <td>5.</td>
                        <td>RT/RW</td>
                        <td>: <?=@$sspd->rtrw_op ?></td>
                        <td>6.</td>
                        <td>Kecamatan</td>
                        <td>: <?=@$sspd->kecamatan_op ?></td>
                      </tr>
                      
                     
                      <tr>
                        <td></td>
                        <td>6.</td>
                        <td>Kabupaten/Kota</td>
                        <td>: <?=@$sspd->kabupaten_op ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Kode Pos</td>
                        <td>:</td>
                      </tr>
                    </table>
                    
                  </div>
                  </div>

              </td>
            </tr>
            <tr>
              <td>
                <hr>
                  <div class="col-md-12" style="padding-bottom: 20px">
                    
                    <table width="100%" style="">
                      <tr>
                        <td width="5%">B.</td>
                        <td>1.</td>
                        <td>Nomor Objek Pajak</td>
                        <td>: <?=@$sspd->nop ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td></td>
                        <td>2.</td>
                        <td>Letak Tanah dan Bangunan</td>
                        <td>: <?=@$sspd->lokasi_op?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      <tr>
                        <td></td>
                        <td>3.</td>
                        <td>Kelurahan / Desa</td>
                        <td>: <?=@$sspd->kelurahan_op ?></td>
                        <td>4.</td>
                        <td>RT / RW</td>
                        <td>: <?= @$sspd->rtrw_op ?></td>
                      </tr>
                      <tr>
                        <td></td>
                        <td>5.</td>
                        <td>Kecamatan</td>
                        <td>: <?=@$sspd->kecamatan_op ?></td>
                        <td>6.</td>
                        <td>RT/RW</td>
                        <td>: <?=@$sspd->kabupaten_op ?></td>
                      </tr>
                      
                    </table>
                    
                  </div>
                  </div>

              </td>
            </tr>
          </table>
                
        
     

    
        
        <div align="center">
                
        <button type="button" onclick="save()" class="btn btn-primary"><i class="fas fa-save"></i> <?php echo $button ?></button>
        <!-- <a href="<?php echo site_url('sspd') ?>" class="btn btn-danger"><i class="fas fa-arrow-circle-left"></i> Kembali</a> -->
        </div>
	    <input type="hidden" name="nopen" value="<?php echo @$nopen; ?>" /> 
        <input type="hidden" id="submited" onclick="save()" name="submit" value="0" /> 
	</form>
    </div>
    </div>
    </div>
    <script >

        function show_image(v) {
            event.preventDefault(); //prevent default action 
            console.log(v)
            $("#img_show").attr("src",v);

        }
function img_upload(argument) {
    $('#postForm').submit()
}function save(argument) {

    $('#submited').val(1)

    $('#postForm').submit()
}
$(document).ready(function() {



   $("#postForm").submit(function(event){
            event.preventDefault(); //prevent default action 
            $.LoadingOverlay("text", "Yep, still loading...");

            $.LoadingOverlay("show");

            var form = $('form')[0];
            var formData = new FormData(form);
            formData.append('image', $('input[type=file]')[0].files[0]); 

                   $.ajax({
                             url:'<?php echo site_url('sspd/do_upload');?>', //URL submit
                             type:"post", //method Submit
                             data:new FormData(this), //penggunaan FormData
                             processData:false,
                             contentType:false,
                             cache:false,
                             async:false,
                              success: function(data){
                                data = JSON.parse(data);
                                if (data.jns == 'img') {
                                    $.LoadingOverlay("hide");
                                    $.growl.notice({ message: "Upload Sukses!" });
                                    setTimeout(function () {
                                        location.reload();
                                    }, 2000);
                                }else if(data.jns == 'data'){
                                    $.LoadingOverlay("hide");
                                    $.growl.notice({ message: "Berkas Tersimpan!" });
                                    setTimeout(function () {
                                        window.location.replace('<?php echo site_url('sspd') ?>')
                                    }, 2000);
                                }
                           }
                         });
            

        
    });
});

    


</script>
