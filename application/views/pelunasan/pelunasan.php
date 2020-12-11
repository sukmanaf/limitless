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

<div class="col-md-2"></div>
<div class="col-md-8">
<div class="panel panel-radius">
  <div class="row">
   <div class="col-md-2"></div>
    
    <h1 align="center">Pelunasan BPHTB</h1>
    <div class="panel-body" >
        

      <form action="#" id="postForm" class="form-horizontal" enctype="multipart/form-data" method="post">
       <div class="row">
            <div class="col-md-3" align="center"></div>
            <div class="col-md-5" align="center">
                <div class="col-md-12 " style=" padding:5px;float: right;">
                    <input type="text" class="form-control input" name="billing" id="billing_search_id" placeholder="ID Billing"  />
                </div>


            </div>
            <div class="col-md-1">
                <div class="" style=" padding:5px;float: right;">
                    <button type="submit" class=" btn btn-primary" style="float: right;"><i class="fas fa-search"></i> </button>
                </div>
        </div>

          <table class="table table-bordered" id="table1" style="">

                   <!--  <tr>
                      <td>Pilih Tanggal Pembayarans</td>
                      <td>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" id="tanggal" name="tanggal" value="" class="form-control pickadate" placeholder="Tanggal Pembayaran" value="<?php echo date('Y-m-d') ?>">
                        </div></td>
                    </tr> -->
                    <tr>
                      <td width="40%">Nama</td>
                      <td><span id="span_nama" class="span"></span></td>
                    </tr>
                    <tr>
                      <td>Nomor Pendaftaran</td>
                      <td><span id="span_nopen" class="span"></span>
                        <input type="hidden" id="nopen" name="nopen">
                      </td>
                    </tr>
                    <tr>
                      <td>Alamat Wajib Pajak</td>
                      <td><span id="span_alamat_wp" class="span"></span></td>
                    </tr>
                    <tr>
                      <td>NOP</td>
                      <td><span id="span_nop" class="span"></span></td>
                    </tr>
                    <tr>
                      <td>Alamat Objek Pajak</td>
                      <td><span id="span_alamat_op" class="span"></span></td>
                    </tr>
                    <tr>
                      <td>Jumlah Bayar</td>
                      <td><span id="span_bayar" class="span"></span></td>
                    </tr>
                    <tr>
                      <td>Status Pembayaran</td>
                      <td><span id="span_status_bayar" class="span"></span></td>
                    </tr>
                    <tr>
                      <td colspan="2" align="center">
                        <button type="button" onclick="save()" class="btn btn-primary" disabled id="btn_verifikasi" >Verifikasi Pembayaran</button>
                      </td>
                    </tr>
                  </tbody>
                </table>
          <div class="row" style="margin-top: 20px">      
            
          </div>
      </form>
   </div>
  </div>
</div>
</div>
<div class="col-md-2"></div>

    <script >


   $("#postForm").submit(function(event){
            event.preventDefault(); //prevent default action 
            $.LoadingOverlay("text", "Yep, still loading...");
            // $.LoadingOverlay("show");
            if ($('#billing_search_id').val() == '') {
                $.growl.warning({ message: "Isi ID Biliing Terlebih Dahulu" });
                return false
            }

            var formData = new FormData(this);
              $.ajax({
               url:'<?php echo site_url('pelunasan/get_data');?>', //URL submit
               type:"post", //method Submit
               data:new FormData(this), //penggunaan FormData
               processData:false,
               contentType:false,
               cache:false,
               async:false,
                success: function(data){
                  data = JSON.parse(data);
                  // console.log(data.sts)
                  if (data.sts == 1 && data.data['status'] != 'MP001') {
                    $.growl.warning({ message: "Data Belum Tervalikasi Kabid!" });
                    $('#btn_verifikasi').attr('disabled',true);
                    $('#nopen').val('');

                    $('#tanggal').val('')
                    $('.span').html('')
                  }else if (data.sts == 1 && data.data['status'] == 'MP001') {
                    $.growl.notice({ message: "Data DItemukan!" });

                    $('#span_nama').html(data.data['nama']);
                    $('#nopen').val(data.data['no_pendaftaran']);
                    $('#span_nopen').html(data.data['no_pendaftaran']);
                    $('#span_alamat_wp').html(data.data['alamat'])
                    $('#span_nop').html(data.data['nop'])
                    $('#span_alamat_op').html(data.data['alamat_op'])
                    $('#span_bayar').html(data.data['total_bayar'])
                    var sts = data.data['status'];
                    var res = sts.substring(0, 2);
                    if (res == 'LN') {
                    $('#btn_verifikasi').attr('disabled',true);
                    $('#span_status_bayar').html('Sudah Melakukan Pembayaran')
                    } else{
                    $('#btn_verifikasi').attr('disabled',false);
                    $('#span_status_bayar').html('Belum Melakukan Pembayaran')
                    }   
                    $('#tanggal').val('');

                  }else{
                    $('#btn_verifikasi').attr('disabled',true);
                    $('#nopen').val('');

                    $('#tanggal').val('')
                    $('.span').html('')
                    $.growl.warning({ message: "ID Billing Tidak DItemukan!" });

                  }
                }
              });   
            
           
            

        
    });


   function save() {
    if ($('#tanggal').val()=='') {
      $.growl.warning({ message: "Isi Tanggal Pembayaran Terlebih Dahulu" });
                return false
    }

    var form = $('form')[0];
    var formData = new FormData(form);
     $.ajax({
               url:'<?php echo site_url('pelunasan/validasi');?>', //URL submit
               type:"post", //method Submit
               data:formData, //penggunaan FormData
               processData:false,
               contentType:false,
               cache:false,
               async:false,
                success: function(data){
                  data = JSON.parse(data);
                  // console.log(data.sts)
                  if (data.sts == 1) {
                    $.growl.notice({ message: "Verivikasi Pembayaran Berhasil!" });
                    $('#span_status_bayar').html('Sudah Melakukan Pembayaran')

                    $('#btn_verifikasi').attr('disabled',true);
                  }else{
                    $('#btn_verifikasi').attr('disabled',false);

                    // $('#datetim').val('')
                    // $('.span').html('')
                    $.growl.warning({ message: "Verifikasi Pembauaran gagal!" });

                  }
             }
           });
   }



    



</script>
