
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title"><?php echo ucfirst($this->uri->segment(1)) ?></h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
                <li><a data-action="reload"></a></li>
                <li><a data-action="close"></a></li>
            </ul>
        </div>
    </div>

    <div class="panel-body">
        

        <form action="#" id="postForm" class="form-basic" enctype="multipart/form-data" method="post">
            <fieldset class="content-group">

                <div class="form-group ">
                    <label class="control-label lbl-basic col-lg-2" >NIK</label>
                    <div class="col-lg-10">
                        <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" id="nik" name="nik" value="<?php echo $nik; ?>">
                    </div>
                </div>
                
                
                

                <div class="form-group">
                    <label class="control-label lbl-basic col-lg-2">NAMA</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>">
                    </div>
                </div>
                
                
                

                <div class="form-group">
                    <label class="control-label lbl-basic col-lg-2">ALAMAT</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat; ?>">
                    </div>
                </div>
                
                
            

                <div class="form-group">
                    <label class="control-label lbl-basic col-lg-2">PROPINSI</label>
                    <div class="col-lg-10">
                        <div class="form-group">
                            <select class="select-search" id="select_propinsi" name="kd_propinsi" onchange="get_kabupaten($(this).val())">
                                    <option value="0">Pilih Propinsi</option>
                                    <?php foreach ($propinsi  as $key => $value): ?>
                                    <?php $sel=''; if(intVal($kd_propinsi) == $value->id){$sel='selected';} ?>
                                        
                                    <option <?=$sel ?>  value="<?=$value->id ?> "><?= $value->nama?></option>
                                    <?php endforeach ?>
                                    
                            </select>
                        <input type="hidden" class="form-control" id="nm_propinsi" name="nm_propinsi" value="<?php echo $nm_propinsi; ?>">

                        </div>
                    </div>
                </div>
                
                
                

                <div class="form-group">
                    <label class="control-label lbl-basic col-lg-2">KOTA/KABUPATEN</label>
                    <div class="col-lg-10">
                        <div class="form-group" >
                            <select class="select-search" id="select_kabupaten" name="kd_kabupaten" onchange="get_kecamatan($(this).val())">
                                    <option value="0">Pilih Kota/Kabupaten</option>
                                    <?php if ($button == 'Update' ): ?>
                                    <?php foreach ($kabupaten  as $key => $value): ?>
                                    <?php $sel=''; if(intVal($kd_kabupaten) == $value->id){$sel='selected';} ?>
                                        
                                    <option <?=$sel ?>  value="<?=$value->id ?> "><?= $value->nama?></option>
                                    <?php endforeach ?>
                                    <?php endif ?>
                            </select>
                        <input type="hidden" class="form-control" id="nm_kabupaten" name="nm_kabupaten" value="<?php echo $nm_kabupaten; ?>">

                        </div>
                    </div>
                </div>
                
                
                <div class="form-group">
                    <label class="control-label lbl-basic col-lg-2">KECAMATAN</label>
                    <div class="col-lg-10">
                        <div class="form-group" >
                            <select class="select-search" id="select_kecamatan"name="kd_kecamatan"  onchange="get_kelurahan($(this).val())">
                                <option value="0">Pilih Kecamatan</option>
                                    <?php if ($button == 'Update' ): ?>
                                    <?php foreach ($kecamatan  as $key => $value): ?>
                                    <?php $sel=''; if(intVal($kd_kecamatan) == $value->id){$sel='selected';} ?>
                                        
                                    <option <?=$sel ?>  value="<?=$value->id ?> "><?= $value->nama?></option>
                                    <?php endforeach ?>
                                    <?php endif ?>
                                    
                            </select>
                        <input type="hidden" class="form-control" id="nm_kecamatan" name="nm_kecamatan" value="<?php echo $nm_kecamatan; ?>">

                        </div>
                    </div>
                </div>
                

                <div class="form-group">
                    <label class="control-label lbl-basic col-lg-2">KELURAHAN</label>
                    <div class="col-lg-10">
                       <div class="form-group" >
                            <select class="select-search" id="select_kelurahan" name="kd_kelurahan" onchange="get_nama_kelurahan($(this).val())">
                                <option value="0">Pilih Kelurahan</option>
                                    <?php if ($button == 'Update' ): ?>
                                    <?php foreach ($kelurahan  as $key => $value): ?>
                                    <?php $sel=''; if(intVal($kd_kelurahan) == $value->id){$sel='selected';} ?>
                                        
                                    <option <?=$sel ?>  value="<?=$value->id ?> "><?= $value->nama?></option>
                                    <?php endforeach ?>
                                    <?php endif ?>
                                    
                            </select>
                        <input type="hidden" class="form-control" id="nm_kelurahan" name="nm_kelurahan" value="<?php echo $nm_kelurahan; ?>">

                        </div>
                    </div>
                </div>
                
                
                

                <div class="form-group">
                    <label class="control-label lbl-basic col-lg-2">RT/RW</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="rtrw" name="rtrw" value="<?php echo $rtrw; ?>">
                    </div>
                </div>
                
                
                

                
                <div align="center">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> <?php echo $button ?></button>
                    <a href="<?php echo site_url('niks') ?>" class="btn btn-danger"><i class="fas fa-arrow-circle-left"></i> Kembali</a>

                </div>
                <input type="hidden" name="id" value="<?php echo $nik; ?>" /> 
            </fieldset>
            </form>
        </div>
    </div>
</div>
<script >
    $(document).ready(function() {

   


   
    $(".btn").removeAttr('disabled');
$("#postForm").submit(function(event){
    $(".btn").css('display','none');
        event.preventDefault(); //prevent default action 
        var post_url = '<?php echo $action ?>'; //get form action url
        var request_method = $(this).attr("method"); //get form GET/POST method
        var form_data = new FormData(this); //Encode form elements for submission
        
        if ($('#desc').summernote('codeview.isActivated')) {
            $('#desc').summernote('codeview.deactivate'); 
        }
        
        $.ajax({
            url : post_url,
            type: 'POST',
            data : form_data,
            processData:false,
            contentType:false,
            cache:false,
            async:false,
        }).done(function(response){
            if (response == 1){
            $.growl.notice({ message: "Simpan Sukses!" });
              
              setTimeout(function () {
                window.location.replace('<?php echo site_url('niks') ?>')
                
            }, 2000);
               
            }else{
                $.growl.warning({ message: "Simpan gagal!" });
                $(".btn").css('display','inline');

            }
        });

        
    });
});

    
   function get_kabupaten(v) {
    var text=$("#select_propinsi option:selected").text();
    $('#nm_propinsi').val(text);
    var url = '<?php echo base_url() ?>niks/get_kabupaten/'+v;
    $.ajax({
            url : url,
            type: 'POST',
            data : {},
            processData:false,
            contentType:false,
            cache:false,
            async:false,
        }).done(function(response){
            $('#select_kabupaten').html(response);
        });
   }    
   function get_kecamatan(v) {
    var text=$("#select_kabupaten option:selected").text();
    $("#nm_kabupaten").val(text);

    var url = '<?php echo base_url() ?>niks/get_kecamatan/'+v;
    $.ajax({
            url : url,
            type: 'POST',
            data : {},
            processData:false,
            contentType:false,
            cache:false,
            async:false,
        }).done(function(response){
            console.log(response)
            $('#select_kecamatan').html(response);
        });
   }    
   function get_kelurahan(v) {
    var text=$("#select_kecamatan option:selected").text();
    $("#nm_kecamatan").val(text);
    var url = '<?php echo base_url() ?>niks/get_kelurahan/'+v;
    $.ajax({
            url : url,
            type: 'POST',
            data : {},
            processData:false,
            contentType:false,
            cache:false,
            async:false,
        }).done(function(response){
            console.log(response)
            $('#select_kelurahan').html(response);
        });
   }   
    function get_nama_kelurahan(v) {
    var text=$("#select_kelurahan option:selected").text();
    $("#nm_kelurahan").val(text);
    }

</script>
