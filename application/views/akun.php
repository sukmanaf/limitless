
    
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">User Account</h5>
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
                        <input type="text" class="form-control" id="nama" name="username" value="<?php echo $username; ?>">
                    </div>
                </div>
        
         

        <div class="form-group">
                    <label class="control-label col-lg-2">password</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="nama" name="password" value="<?php echo $password; ?>">
                    </div>
                </div>
        
         

        <div class="form-group">
                    <label class="control-label col-lg-2">Nama</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>">
                    </div>
                </div>
        
        
     

      
     <?php if (@$jenis=='update'): ?>
         

        <div class="form-group">
                    <label class="control-label col-lg-2">Blokir</label>
                    <div class="col-lg-10">
                        <input type="checkbox" <?php if(@$blokir == 1 ){echo 'checked';} ?>  class="form-check-input" name="Blokir" id=""> Blokir

                    </div>
                </div>
     <?php endif ?>
        
        <input type="hidden" name="id_ppat" value="<?= @$id_ppat ?>">
        <input type="hidden" name="id_user" value="<?= @$id_user ?>">
        
     


        <div align="center">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> <?php echo $button ?></button>
        <a href="<?php echo site_url('ppat') ?>" class="btn btn-danger"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
        </div>
	    <input type="hidden" name="id" value="<?php echo $id_user; ?>" /> 
	</form>
    </div>
    </div>
    </div>
    <script >
$(document).ready(function() {
   // $('.summernote').summernote({
   //              height: "700px",
                
   //          });
$('#isi').summernote({
            height: 700,
            callbacks: {
                   onImageUpload: function(image) {
                               uploadImage(image[0]);
                           }
               }

            
        });

function uploadImage(image) {
        var data = new FormData();
        data.append("image", image);
        $.ajax({
            url:'<?php echo site_url('ppat/upload_summernote');?>', //URL submit
                     type:"post", //method Submit
                     data:data, //penggunaan FormData
                     processData:false,
                     contentType:false,
                     cache:false,
                     async:false,
            success: function(url) {
                console.log('url', url)
                var image = $('<img>').attr('src', url);
                $('#isi').summernote("insertNode", image[0]);
            },
            error: function(data) {
                console.log('data', data)
            }
        });
    }


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
            response = JSON.parse(response);
            if (response.sts == 1){

            // alert('Data Tersimpan');

            // $.notify("Data tersimpan", "success");
            $.growl.notice({ message: "Simpan Sukses!" });
              // $.growl.error({ message: "The kitten is attacking!" });
              // $.growl.notice({ message: "The kitten is cute!" });
              // $.growl.warning({ message: "The kitten is ugly!" });
             
            setTimeout(function () {
                    window.location.replace('<?php echo site_url('ppat') ?>')
                       
                    }, 2000);
                //    $.ajax({
                //              url:'<?php echo site_url('ppat/do_upload');?>', //URL submit
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

    


</script>
