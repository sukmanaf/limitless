
    <!--Modal: Name-->
    <div class="modal fade" id="modal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">

        <!--Content-->
        <div class="modal-content">

          <!--Body-->
          <div class="modal-body mb-0 p-0">

            <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
              <img id="img_show" src="">            </div>

          </div>

          <!--Footer-->
          <div class="modal-footer justify-content-center">

            <button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4" data-dismiss="modal">Close</button>

          </div>

        </div>
        <!--/.Content-->

      </div>
    </div>
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


     
                <?php foreach ($lampiran as $key => $value): ?>
                    
                    <div class="form-group">
                        <div class="col-md-4">
                             <label class="control-label" style="margin-top: 5%"><?= $value->nama ?><?php if ($value->required == 1 ) { echo ' *';} ?></label>
                        </div>
                        <div class="col-md-4">
                            <?php foreach ($files as $kf => $vf) {
                                    if ($vf->id_lampiran == $value->id) { ?>
                              <div class="row" >
                                <div class="col-md-12">
                                        <button class="btn-xl  btn-primary" onclick="show_image('<?= base_url().'assets/files/sspd/'.$nopen.'/'.$vf->lokasi ?>')" data-toggle="modal" data-target="#modal4" style="margin-top: 10px;border-radius: 10%">Lihat</button>
                                        <button class="btn-xl  btn-danger" onclick="delete_image('<?= @$vf->lokasi ?>')"  style="margin-top: 10px;border-radius: 10%">Hapus</button>
                                </div>
                              </div>
                                    <?php }
                            } ?>
                        </div>



                        <div class="col-md-3">
                            <div class="form-group">
                                
                                <input name="<?=$value->id ?>" style="margin-top: 5%" onchange="img_upload()" type="file" class="file-input 2" data-show-caption="false" data-show-upload="false" data-browse-class="btn btn-primary btn-xs" data-remove-class="btn btn-default btn-xs">
                            </div>
                        </div>
                    </div>
                    <hr>
                <?php endforeach ?>
        
        
     

    
        
        <div align="center">
            <?php if ($hasil_cek_files == 0): ?>
                
        <button type="button" onclick="save()" class="btn btn-primary"><i class="fas fa-save"></i> <?php echo $button ?></button>
            <?php endif ?>
        <!-- <a href="<?php echo site_url('sspd') ?>" class="btn btn-danger"><i class="fas fa-arrow-circle-left"></i> Kembali</a> -->
        </div>
	    <input type="hidden" name="nopen" value="<?php echo $nopen; ?>" /> 
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

        function delete_image(v) {
            event.preventDefault(); //prevent default action 

          var nopen = '<?= @$nopen ?>';
          $.ajax({
                     url:'<?php echo site_url('sspd/delete_files');?>', //URL submit
                     type:"post", //method Submit
                     data:{'nopen' : nopen,'lokasi':v}, //penggunaan FormData
                     cache:false,
                     async:false,
                      success: function(data){
                        data = JSON.parse(data);
                        if (data.sts == '1') {
                            $.LoadingOverlay("hide");
                            $.growl.notice({ message: "Delete Sukses!" });
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        }else{
                            $.LoadingOverlay("hide");
                            $.growl.notice({ message: "Delete Gagal!" });
                            setTimeout(function () {
                                // window.location.replace('<?php echo site_url('sspd') ?>')
                            }, 2000);
                        }
                   }
                 });
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
                            }, 1000);
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
