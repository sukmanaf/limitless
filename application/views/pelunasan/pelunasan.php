<style type="text/css">

  .panel-body{
    /*font-weight: bold;*/
  }

  .borderless td, .borderless th {
    border: none !important;
    padding: 3px;
} .borderless-5 td, .borderless-5 th {
    padding: 5px;
}

.td-header span {
  font-weight: bold;
  padding: 0px;
}
.td-header p {
  padding:0px;
}

</style>


  
<div class="panel panel-radius">
  <div class="row">
   <div class="col-md-2"></div>
    
   <h1 align="center">Pelunasan BPHTB</h1>
    <div class="panel-body" >
      <input type="hidden" name="" id="id_nopen" value="<?= @$sspd->no_pendaftaran ?>">
        

      <form action="#" id="postForm" class="form-horizontal" enctype="multipart/form-data" method="post">
        <div class="row">
            <div class="col-md-11 text-right">


                <div class="col-md-3 " style=" padding:5px;float: right">
                <input type="text" class="form-control" name="billing_search_name" id="billing_search_id" placeholder="Id Billing"  />
                </div>

            
                
            </div>
            <div class="col-md-1">
                <div class="row" style=" margin:5px">
                    <div class="col-md-12" style=" padding:5px">
                        <button type="submit" class=" btn btn-primary"><i class="fas fa-search"></i> </button>
                    </div>

                </div>
            </div>
    	</div>

    	<div class="row">
    		<div class="col-md-6 well" >1. Nama</div>
    		<div class="col-md-6 well"><span id="nama">.</span></div>
    		<div class="col-md-6 well">2. NIK</div>
    		<div class="col-md-6 well"><span id="nik">.</span></div>
    		<div class="col-md-6 well">3. Alamat Wajib Pajak</div>
    		<div class="col-md-6 well"><span id="alamat_wp">.</span></div>
    		<div class="col-md-6 well">4. NOP</div>
    		<div class="col-md-6 well"><span id="nop">.</span></div>
    		<div class="col-md-6 well">5. ALamat Objek Pajak</div>
    		<div class="col-md-6 well"><span id="alamat_op">.</span></div>
    		<div class="col-md-6 well">6. Total Bayar</div>
    		<div class="col-md-6 well"><span id="total_bayar">.</span></div>
    	</div>
	</form>
    </div>
    </div>
    </div>
    <script >


   $("#postForm").submit(function(event){
            event.preventDefault(); //prevent default action 
            $.LoadingOverlay("text", "Yep, still loading...");

            $.LoadingOverlay("show");

            var form = $('form')[0];
            var formData = new FormData(form);
            formData.append('image', $('input[type=file]')[0].files[0]); 

                   $.ajax({
                             url:'<?php echo site_url('pelunasan/get_all');?>', //URL submit
                             type:"post", //method Submit
                             data:new FormData(this), //penggunaan FormData
                             processData:false,
                             contentType:false,
                             cache:false,
                             async:false,
                              success: function(data){
                                
                           }
                         });
            

        
    });


    function action(acc){
        event.preventDefault(); //prevent default action 
        var r = confirm("Apakah Anda Yakin?");
        if (r == true) {
        } else {
            return false;
        }
        var nopen = $('#id_nopen').val();
        post_url = "<?php echo site_url('sspd/approve/')?>"+acc+'/'+nopen;

        $.ajax({
            url : post_url,
            type: 'POST',
            data : {},
            processData:false,
                     contentType:false,
                     cache:false,
                     async:false,
        }).done(function(response){
            response = JSON.parse(response);

            if (response.sts == 1){

                $.growl.notice({ message: response.jns+" Sukses!" });
                  // $.growl.error({ message: "The kitten is attacking!" });
                 
                setTimeout(function () {
                }, 1000);
            }else{
                $.growl.danger({ message: response.jns+" gagal!" });
                $(".btn").css('display','inline');

            }
        });
    }

    


</script>
