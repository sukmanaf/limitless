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


/*.dokumen-logo{
display: flex;
 justify-content: center;
 align-items: center; 
}*/
.dokumen-logo img{
  width: 60%;
  object-fit: cover;
}

.transaksi_noborder{    
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: flex-end;
}
.transaksi{    
    border: 1px solid rgb(221, 221, 221);;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: flex-end;
}

.dokumen-judul p{
  margin-bottom: 0
}

.dokumen-judul hr{
  width: 100%;
}

.bold{
  font-weight: bold;
}
.span_bullet{
  margin-right: 20px;
  margin-left: 10px 
}
.span_bullet_kosong{
  margin-right: 32px;
  margin-left: 10px 
}
.perhitungan_angka{
  padding-right: 30px;
  font-weight: bold;
  display:flex;
  align-items: center;
  justify-content: space-between; 
}


</style>


<div class="panel panel-radius">
      <form action="#" id="postForm" class="form-horizontal" enctype="multipart/form-data" method="post">
  
    <div class="panel-body" >
     <?php if (@$session['jabatan'] == $sspd->status): ?>
      <div class="text-right" style="margin-bottom: 20px">
        
         <a href="#" onclick="action('<?= @$sspd->status ?>/approve')" class="btn-sm btn-primary"> Verifikasi</a>
      <a href="#" onclick="action('<?= @$sspd->status ?>/reject')" class="btn-sm btn-danger "> Tolak</a>
      </div>
      <?php endif ?>
      <input type="hidden" name="" id="id_nopen" value="<?= @$sspd->no_pendaftaran ?>">
        
      <div class="panel-header" style="border :1px solid rgb(221, 221, 221);">
        <div class="row" style="padding: 10px;margin: 5px; ">
          <div class="col-sm-12 col-md-3 dokumen-logo " align="center">
            <img src="<?= base_url() ?>assets/files/image/logo.png"  >
          </div>
          <div class="col-sm-12 col-md-6 dokumen-judul" align="center">
            <p class="bold">SURAT SETORAN PAJAK DAERAH</p>
             <p class="bold">BEA PEROLEHAN HAK ATAS TANAH DAN BANGUNAN</p>
             <p class="bold">(SSPD-BPHTB)</p>
             <hr style="margin-top: 5px;margin-bottom: 5px">
             <p>BERFUNGSI SEBAGAI SURAT PEMBERITAHUAN OBJEK PAJAK</p>
             <p>PAJAK BUMI DAN BANGUNAN (SPOP PBB)</p>
          </div>
          <div class="col-sm-12 col-md-3 dukumen-lembar" align="center">
            <span><b>Lembar</b></span><span style="font-size: 25pt">1</span><br>
                               <span>Untuk Wajib Pajak</span><br>
          </div>
        </div>
          <hr>
          <div class="panel-nik">

            <div class="row" style="">
              <div class="col-sm-12 col-md-3  ">
                  <span class="span_bullet">A.</span><span>1. Nama Wajib Pajak</span>
              </div>
              <div class="col-sm-12 col-md-9  " >
                  <span>: <?=@$sspd->nama ?></span>
              </div>
            </div>

            <div class="row" style="">
              <div class="col-sm-12 col-md-3  ">
                  <span class="span_bullet_kosong"></span><span>2. NIK</span>
              </div>
              <div class="col-sm-12 col-md-9  " >
                  <span>: <?=@$sspd->nik ?></span>
              </div>
            </div>
            <div class="row" style="">
              <div class="col-sm-12 col-md-3  ">
                  <span class="span_bullet_kosong"></span><span>3. Alamat</span>
              </div>
              <div class="col-sm-12 col-md-9  " >
                  <span>: <?=@$sspd->alamat ?></span>
              </div>
            </div>
            <div class="row" style="">
              <div class="col-sm-12 col-md-3  ">
                  <span class="span_bullet_kosong"></span><span>4. Kelurahan</span>
              </div>
              <div class="col-sm-12 col-md-3  " >
                  <span>: <?=@$sspd->nm_kelurahan ?></span>
              </div>
              <div class="col-sm-12 col-md-1  ">
                  <span>5.RT/RW </span>
              </div>
              <div class="col-sm-12 col-md-1  ">
                  <span>: <?=@$sspd->rtrw ?> </span>
              </div>
              <div class="col-sm-12 col-md-1  ">
                  <span>6.Kecamatan  </span>
              </div>
              <div class="col-sm-12 col-md-3  " >
                  <span>: <?=@$sspd->Kecamatan ?></span>
              </div>
            </div>
            <div class="row" style="">
              <div class="col-sm-12 col-md-3  ">
                  <span class="span_bullet_kosong"></span><span>6. Kabupaten</span>
              </div>
              <div class="col-sm-12 col-md-5  " >
                  <span>: <?=@$sspd->nm_kabupaten ?></span>
              </div>
              <div class="col-sm-12 col-md-1  " >
                  <span>8.Kodepos  </span>
                  
              </div>
              <div class="col-sm-12 col-md-3  " >
                  <span>: <?=@$sspd->kodepos ?></span>
              </div>
            </div>
          </div>
           <hr>
          <div class="panel-nop">

            <div class="row" style="">
              <div class="col-sm-12 col-md-4  ">
                  <span class="span_bullet">A.</span><span>1. Nomor Objek Pajak</span>
              </div>
              <div class="col-sm-12 col-md-8  " >
                  <span>: <?=@$sspd->nop ?></span>
              </div>
            </div>

            <div class="row" style="">
              <div class="col-sm-12 col-md-4  ">
                  <span class="span_bullet_kosong"></span><span>2. Letak Tanah dan Bangunan</span>
              </div>
              <div class="col-sm-12 col-md-8  " >
                  <span>: <?=@$sspd->alamat_op ?></span>
              </div>
            </div>
            <div class="row" style="">
              <div class="col-sm-12 col-md-4  ">
                  <span class="span_bullet_kosong"></span><span>3. Kelurahan / Desa</span>
              </div>
              <div class="col-sm-12 col-md-3  " >
                  <span>: <?=@$sspd->kelurahan_op ?></span>
              </div>
              <div class="col-sm-12 col-md-2  ">
                  <span>4.RT/RW </span>
              </div>
              <div class="col-sm-12 col-md-3  ">
                  <span>: <?=@$sspd->rtrw_op ?> </span>
              </div>
            </div>
            <div class="row" style="">
              <div class="col-sm-12 col-md-4  ">
                  <span class="span_bullet_kosong"></span><span>4. Kecamatan</span>
              </div>
              <div class="col-sm-12 col-md-3  " >
                  <span>: <?=@$sspd->kecamatan_op ?></span>
              </div>
              <div class="col-sm-12 col-md-2  ">
                  <span>6. Kota / Kabuaten </span>
              </div>
              <div class="col-sm-12 col-md-3  ">
                  <span>: <?=@$sspd->kabupaten_op ?> </span>
              </div>
            </div>
          </div>

          <div class="row" style="margin: 10px 10px 10px 40px">
            <table width="100%" class="table table-bordered" border="1">
            <tr>
              <th style="text-align: center" >Uraian</th>
              <th style="text-align: center"  colspan="2">Luas</th>
              <th style="text-align: center"  colspan="2">NJOP PBB /m2</th>
              <th style="text-align: center"  colspan="2">Luas X NJOP PBB /m2</th>
            </tr>
            <tr>
              <td width="25%">Tanah (Bumi)</td>
              <td width="1%">7</td>
              <td width="24%"><?=@$sspd->luas_tanah ?></td>
              <td width="1%">9</td>
              <td width="24%" align="right"><?=rupiah(@$sspd->njop_tanah) ?></td>
              <td width="1%">11</td>
              <td width="24%" align="right"><?=rupiah(@$sspd->luas_tanah*@$sspd->njop_tanah) ?></td>
            </tr>
            <tr>
              <td>Bangunan</td>
              <td >8</td>
              <td><?=@$sspd->luas_bangunan ?></td>
              <td >10</td>
              <td align="right"><?=rupiah(@$sspd->njop_bangunan) ?></td>
              <td >12</td>
              <td align="right"><?=rupiah(@$sspd->luas_bangunan*@$sspd->njop_bangunan )?></td>
            </tr>
            <tr>
              <td colspan="5" align="right">NJOP PBB</td>
              <td  >13</td>
              <td  align="right"><?=rupiah(@$sspd->njop_total) ?></td>
            </tr>
          </table>
          </div>

          <div class="row" style="margin-right: 20px;">
            <div class="col-md-9 transaksi_noborder">
              <span>14. Harga Transaksi</span>
            </div >
            <div class="col-md-3 transaksi" >
              <span style=";"><?= rupiah(@$sspd->harga_transaksi) ?></span>
            </div>
          </div>

          <div class="row" style="">
            <div class="col-sm-12 col-md-3  ">
                <span class="span_bullet"></span><span>15. Jenis Perolehan</span>
            </div>
            <div class="col-sm-12 col-md-9  " >
                <span>: <?=@$sspd->jenis_perolehan.' - '.@$sspd->jenis_perolehan_text ?></span>
            </div>
          </div>
          <div class="row" style="">
            <div class="col-sm-12 col-md-3  ">
                <span class="span_bullet"></span><span>16. Nomor Sertifikat</span>
            </div>
            <div class="col-sm-12 col-md-9  " >
                <span>: <?=@$sspd->nomor_sertifikat?></span>
            </div>
          </div>
           <hr>
          <div class="row" style="">
            <div class="col-sm-12 col-md-12  ">
                <span class="span_bullet">C.</span><span>Perhitungan BPHTB</span>
            </div>
          </div>


           <hr style="margin-bottom: 8px !important">
          <div class="row" style="">
            <div class="col-sm-12 col-md-9  ">
                <span class="span_bullet_kosong"></span><span>Nilai Perolehan Objek Pajak</span>
            </div>
            <div class="col-sm-12 col-md-3  perhitungan_angka" style="" align="right">
                <span>1. Rp.</span><span><?=format_number(@$sspd->npop)?></span>
            </div>
          </div>
           <hr style="margin-top: 8px !important;margin-bottom: 8px !important">
          <div class="row" style="">
            <div class="col-sm-12 col-md-9  ">
                <span class="span_bullet_kosong"></span><span>Nilai Perolehan Objek Pajak Tidak Kena Pajak</span>
            </div>
            <div class="col-sm-12 col-md-3  perhitungan_angka" style="" align="right">
                <span>2. Rp.</span><span><?=format_number(@$sspd->npoptkp)?></span>
            </div>
          </div>
           <hr style="margin-top: 8px !important;margin-bottom: 8px !important">
          <div class="row" style="">
            <div class="col-sm-12 col-md-9  ">
                <span class="span_bullet_kosong"></span><span>Nilai Perolehan Objek Pajak Kena Pajak</span>
            </div>
            <div class="col-sm-12 col-md-3  perhitungan_angka" style="" align="right">
                <span>3. Rp.</span><span><?=format_number(@$sspd->npopkp)?></span>
            </div>
          </div>
           <hr style="margin-top: 8px !important;margin-bottom: 8px !important">
          <div class="row" style="">
            <div class="col-sm-12 col-md-9  ">
                <span class="span_bullet_kosong"></span><span>Bea Perolehan Hak atas Tanah dan Bangunan</span>
            </div>
            <div class="col-sm-12 col-md-3  perhitungan_angka" style="" align="right">
                <span>4. Rp.</span><span><?=format_number(@$sspd->bphtb)?></span>
            </div>
          </div>
           <hr style="margin-top: 8px !important">

          <div class="row" style="">
            <div class="col-sm-12 col-md-12  ">
                <span class="span_bullet">D.</span><span>Jenis Setoran Berdasarkan</span>
            </div>
          </div>
          <div class="row" style="">
            <div class="col-sm-12 col-md-1  " align="right">
              <i class="fa fa-check-circle" ></i>
            </div>
            <div class="col-sm-12 col-md-11 ">
              <span>a. Perhitungan Wajib Pajak</span>
            </div>
          </div>
          <div class="row" style="">
            <div class="col-sm-12 col-md-1  " align="right">
            </div>
            <div class="col-sm-12 col-md-11 ">
              <span>b. STPD BPHTB / SKPD Kurang Bayar / SKPD</span>
            </div>
          </div>
          <div class="row" style="">
            <div class="col-sm-12 col-md-1  " align="right">
            </div>
            <div class="col-sm-12 col-md-3 ">
              <span style="margin-left: 15px">Kurang Bayar Tambahan </span>
            </div>
            <div class="col-sm-12 col-md-2 ">
              <span>Nomor : </span>
            </div>
            <div class="col-sm-12 col-md-2 ">
              <span>Tanggal : </span>
            </div>
          </div>
          <div class="row" style="">
            <div class="col-sm-12 col-md-1  " align="right">
            </div>
            <div class="col-sm-12 col-md-11 ">
              <span>c. Pengurang dihitung Sendiri Mendaji ___ % Berdasarkan Peraturah KDH Nomor : </span>
            </div>
          </div>
          <div class="row" style="">
            <div class="col-sm-12 col-md-1  " align="right">
            </div>
            <div class="col-sm-12 col-md-11 ">
              <span>d. ..................... </span>
            </div>
          </div>

           <hr style="margin-top: 8px !important">
          <div class="row" style="">
            <div class="col-sm-12 col-md-1"></div>
            <div class="col-sm-12 col-md-5  ">
                Jumlah Yang di Setor
            </div>
            <div class="col-sm-12 col-md-6 ">
              <span>Dengan Huruf </span>
            </div>
          </div>
          <div class="row" style="">
            <div class="col-sm-12 col-md-1"></div>
            <div class="col-sm-12 col-md-5  ">
                <span><b><?=rupiah(@$sspd->total_bayar) ?></b></span>
            </div>
            <div class="col-sm-12 col-md-6 ">
              <span><b><?= terbilang(@$sspd->total_bayar) ?></b></span>
            </div>
          </div>

           <hr style="margin-top: 8px !important">
          <div class="row" style="margin-bottom: 20px">
            <div class="col-sm-12 col-md-12  ">
                <span class="span_bullet">E.</span><span>Lampiran</span>
            </div>
          </div>
            <?php foreach ($lampiran as $key => $value): ?>
          <div class="row" style="margin-bottom: 10px">
            <div class="col-sm-12 col-md-1  "></div>
            <div class="col-sm-12 col-md-7  ">
              <span><?=($key+1).'.'.$value->nama ?></span>
            </div>
            <div class="col-sm-12 col-md-4  ">
              <?php foreach ($files as $kf => $vf) {
                  if ($vf->id_lampiran == $value->id) { ?>
                    <a href="#" onclick="show_image('<?= base_url().$vf->lokasi ?>')"  class="btn-xl btn-danger" data-toggle="modal" data-target="#modal4"  style="border-radius:5px;padding: 2% 6%;margin-top: 15px" > Lihat </a>
                  <?php }
              } ?>
            </div>
          </div>
            <?php endforeach ?>

      </div>

      <br>

	   </form>

    <div class="panel-heading">
                  <h6 class="panel-title text-semiold">Discussion</h6>
                  <div class="heading-elements">
                    <ul class="list-inline list-inline-separate heading-text text-muted">
                      <li>42 comments</li>
                      <li>75 pending review</li>
                    </ul>
                          </div>
                </div>

                <div class="panel-body">
                  <ul class="media-list stack-media-on-mobile" id="add_komen">
                    <?php foreach ($komen as $key => $value): ?>
                    <li class="media">
                      <div class="media-left">
                        <a href="#"><img src="<?=base_url() ?>assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></a>
                      </div>

                      <div class="media-body">
                        <div class="media-heading">
                          <a class="text-semibold">William Jennings</a>
                        </div>

                        <?=$value->text ?>

                        
                      </div>
                    </li>

                    <?php endforeach ?>
                      
                  </ul>
                </div>
                <hr class="no-margin">
      <form action="#" id="Formkomen" class="form-horizontal" enctype="multipart/form-data" method="post">
            <input type="hidden" name="nopen" id="nopen_komen" value="<?= @$sspd->no_pendaftaran ?>">
            <input type="hidden" name="send" id="send" value="<?= @$session['id'] ?>">
            <input type="hidden" name="tipe" id="tipe" value="<?= @$session['jenis'] ?>">


                <div class="panel-body">
                  <h6 class="no-margin-top content-group">Add comment</h6>
                  <div class="content-group">
                    <div id="add-comment" ></div>
                  </div>
                  
                  <div class="text-right">
                    <button type="submit" class="btn bg-blue"><i class="icon-plus22"></i> Add comment</button>
                  </div>
                </div>
    </form>
    </div>
  </div>
</div>


     <!-- Comments -->
              <div class="panel panel-flat">
                
              </div>
              <!-- /comments -->
    <script >

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
   $("#Formkomen").submit(function(event){
        event.preventDefault(); //prevent default action 

        var text = CKEDITOR.instances['add-comment'].getData()
        if(text != ''){
            var formData = new FormData(this)
            formData.append('komen', text);
           $.ajax({
                     url:'<?php echo site_url('sspd/komen');?>', //URL submit
                     type:"post", //method Submit
                     data:formData, //penggunaan FormData
                     processData:false,
                     contentType:false,
                     cache:false,
                     async:false,
                      success: function(data){
                        data = JSON.parse(data);
                        if (data.sts == 1) {
                          $('#add_komen').append(data.data);
                          CKEDITOR.instances['add-comment'].setData('');
                        //     $.LoadingOverlay("hide");
                        //     $.growl.notice({ message: "Upload Sukses!" });
                        //     setTimeout(function () {
                        //         location.reload();
                        //     }, 2000);

                        }else {
                        //     $.LoadingOverlay("hide");
                        //     $.growl.notice({ message: "Berkas Tersimpan!" });
                        //     setTimeout(function () {
                        //         window.location.replace('<?php echo site_url('sspd') ?>')
                        //     }, 2000);
                        }
                   }
          });
                
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
                  location.reload()
                }, 1000);
            }else{
                $.growl.danger({ message: response.jns+" gagal!" });
                $(".btn").css('display','inline');

            }
        });
    }

    
    function komen(){
        event.preventDefault(); //prevent default action 
  
        var nopen = $('#id_nopen').val();
        post_url = "<?php echo site_url('sspd/komen/')?>";

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
                  location.reload()
                }, 1000);
            }else{
                $.growl.danger({ message: response.jns+" gagal!" });
                $(".btn").css('display','inline');

            }
        });
    }

    


</script>
