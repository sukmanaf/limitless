
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
<div class="form-group">
                                        <label class="control-label lbl-basic col-lg-2">NOP</label>
                                        <div class="col-lg-4">
                                            <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" id="nik" name="nik" value="<?php echo $nop; ?>">
                                        </div>
                                        <div class="col-lg-6">
                                            <button class="btn btn-primary" onclick="#">Cari Nop</button>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label lbl-basic col-lg-2">Letak Tanah</label>
                                        <div class="col-lg-4">
                                            <input type="text"  class="form-control" id="nik" name="nik" value="<?php echo $alamat_op; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label lbl-basic col-lg-2">Kelurahan</label>
                                        <div class="col-lg-4">
                                            <input type="text"  class="form-control" id="nik" name="nik" value="<?php echo $kelurahan_op; ?>">
                                        </div>
                                        <label class="control-label lbl-basic col-lg-2">RT/RW</label>
                                        <div class="col-lg-4">
                                            <input type="text"  class="form-control" id="nik" name="nik" value="<?php echo $rtrw; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label lbl-basic col-lg-2">Kecamatan</label>
                                        <div class="col-lg-4">
                                            <input type="text"  class="form-control" id="nik" name="nik" value="<?php echo $kecamatan_op; ?>">
                                        </div>
                                        <label class="control-label lbl-basic col-lg-2">Kabupeten/Kota</label>
                                        <div class="col-lg-4">
                                            <input type="kabupaten_op"  class="form-control" id="nik" name="nik" value="<?php echo $kabupaten_op; ?>">
                                        </div>
                                    </div>

                

                
                <div align="center">
                    <button type="submit" id="bbb" class="btn btn-primary"><i class="fas fa-save"></i> <?php echo $button ?></button>
                    <a href="<?php echo site_url('sspd') ?>" class="btn btn-danger"><i class="fas fa-arrow-circle-left"></i> Kembali</a>

                </div>
                <input type="hidden" name="id" value="<?php echo @$id; ?>" /> 
            </fieldset>
            </form>
        </div>
    </div>
</div>
<script >
    $(document).ready(function() {

   
    $("#bbb").removeAttr('disabled');


   
$("#postForm").submit(function(event){
    // $(".btn").css('display','none');
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
            var response=JSON.parse (response)
            // console.log(datae.id);
            // return false;
            if (response.sts == 1){
            $.growl.notice({ message: "Simpan Sukses!" });
              
              setTimeout(function () {
                window.location.replace('<?php echo site_url('sspd/update_nop/') ?>'+response.id)
                
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
    var url = '<?php echo base_url() ?>sspd/get_kabupaten/'+v;
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

    var url = '<?php echo base_url() ?>sspd/get_kecamatan/'+v;
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
    var url = '<?php echo base_url() ?>sspd/get_kelurahan/'+v;
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
