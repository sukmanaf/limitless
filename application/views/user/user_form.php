
    
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
        

        <form action="#" id="postForm" class="form-horizontal" enctype="multipart/form-data" method="post">
            <fieldset class="content-group">

        
     

        <div class="form-group">
                    <label class="control-label col-lg-2">username</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>">
                    </div>
                </div>
        
        
     

        <div class="form-group">
                    <label class="control-label col-lg-2">password </label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="password" name="password" value="">
                    </div>
                </div>
        <?php if (@$jns == 'update'): ?>
            
        <div class="form-group">
                    <label class="control-label col-lg-2"></label>
                    <div class="col-lg-10">
                        <i>*isi Password jika ingin mengganti password, kosongi jika tidak ganti password</i>
                    </div>
                </div>
        <?php endif ?>
        

        <div class="form-group">
                    <label class="control-label col-lg-2">nama</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>">
                    </div>
                </div>
        
        
     

        <div class="form-group">
                    <label class="control-label col-lg-2">jenis</label>
                    <div class="col-lg-10">
                        <select class="select" name="jenis" onchange="jenis_change($(this).val())">
                            <option <?php if(@$jenis =='PP'){echo 'selected';}  ?> value="PP">PPAT</option>
                            <option <?php if(@$jenis =='PM'){echo 'selected';}  ?> value="PM">PEMDA</option>
                            <option <?php if(@$jenis =='BK'){echo 'selected';} ?>value="BK">BANK</option>
                        </select>
                    </div>
                </div>
        
        <div class="form-group" id="div_jabatan" <?php if($jenis != "PM"){echo 'style="display: none"';} ?> >
                    <label class="control-label col-lg-2">jabatan</label>
                    <div class="col-lg-10">
                        <select class="select" name="jabatan">
                            <option <?php if(@$jabatan == "PM001"){echo 'selected';} ?> value="PM001">Pelayanan</option>
                            <option <?php if(@$jabatan == "PM002"){echo 'selected';} ?> value="PM002">Kasubid</option>
                            <option <?php if(@$jabatan == "PM003"){echo 'selected';} ?> value="PM003">Kabid</option>
                        </select>
                    </div>
                </div>
        
        
     

        <div class="form-group">
                    <label class="control-label col-lg-2">blokir</label>
                    <div class="col-lg-10">
                        
                        <div class="form-group">
                                <label class="radio-inline">
                                    <input type="radio" name="radio-unstyled-inline-left" name="blokir" value="0" checked="checked">
                                    Tidak
                                </label>

                                <label class="radio-inline">
                                    <input type="radio" name="radio-unstyled-inline-left" name="blokir" value="1">
                                    Ya
                                </label>
                            </div>

                    </div>
                </div>
        
        
     
        
     

        <div align="center">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> <?php echo $button ?></button>
        <a href="<?php echo site_url('user') ?>" class="btn btn-danger"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	</form>
    </div>
    </div>
    </div>
    <script >
   
$(document).ready(function() {
  

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

            // alert('Data Tersimpan');

            // $.notify("Data tersimpan", "success");
            $.growl.notice({ message: "Simpan Sukses!" });
              // $.growl.error({ message: "The kitten is attacking!" });
              // $.growl.notice({ message: "The kitten is cute!" });
              // $.growl.warning({ message: "The kitten is ugly!" });
             
            setTimeout(function () {
                    window.location.replace('<?php echo site_url('user') ?>')
                       
                    }, 2000);
                //    $.ajax({
                //              url:'<?php echo site_url('user/do_upload');?>', //URL submit
                //              type:"post", //method Submit
                //              data:new FormData(this), //penggunaan FormData
                //              processData:false,
                //              contentType:false,
                //              cache:false,
                //              async:false,
                //               success: function(data){
                //                   alert("Upload Image Berhasil."); //alert jika upload berhasil
                //            }
                //          });
            }else{
                $.growl.warning({ message: "Simpan gagal!" });
                $(".btn").css('display','inline');

            }
        });

        
    });
});

    
     function jenis_change(v) {
            if(v == 'PM'){

            $('#div_jabatan').css('display','block')
            }else{

            $('#div_jabatan').css('display','none')
            }
        }

</script>
