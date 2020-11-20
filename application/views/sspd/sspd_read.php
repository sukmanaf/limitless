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
<div class="panel panel-radius">
  <div class="row">
   <div class="col-md-2"></div>
    
   <?php if ($session['jabatan'] == $sspd->status): ?>
   <div class="col-md-10" style="padding-top: 20px;">
        
      <a href="#" onclick="action('<?= @$sspd->status ?>/approve')" class="btn-sm btn-primary"> Verifikasi</a>
      <a href="#" onclick="action('<?= @$sspd->status ?>/reject')" class="btn-sm btn-danger"> Tolak</a>
   </div>
      <?php endif ?>
  </div>
    <div class="panel-body" >
      <input type="hidden" name="" id="id_nopen" value="<?= @$sspd->no_pendaftaran ?>">
        

      <form action="#" id="postForm" class="form-horizontal" enctype="multipart/form-data" method="post">
        <fieldset class="content-group">


          <table style="">
              <tr>
                <td style="border: 1px solid #e0dfd7;padding: 10px">
                <table width="100%" style="margin-top: 10px">

                  <tr>
                    <td>
                        <table width="100%">
                          <tr>
                            <td width="25%" align="center" ><img src="<?= base_url() ?>assets/files/image/logo.png" style="width: 60%"></td>
                            <td width="50%"align="center" class="td-header">
                               <span>SURAT SETORAN PAJAK DAERAH</span><br>
                               <span>BEA PEROLEHAN HAK ATAS TANAH DAN BANGUNAN</span><br>
                               <span>(SSPD-BPHTB)</span><br>
                               <hr style="margin-top: 5px;margin-bottom: 5px">
                               <label>BERFUNGSI SEBAGAI SURAT PEMBERITAHUAN OBJEK PAJAK</label><br>
                               <label>PAJAK BUMI DAN BANGUNAN (SPOP PBB)</label><br>
                            </td>
                            <td width="25"align="center"> 
                               <span><b>Lembar</b></span><span style="font-size: 25pt">1</span><br>
                               <span>Untuk Wajib Pajak</span><br>

                            </td>
                          </tr>
                          <tr>
                           
                          </tr>
                        </table>
                      <hr>
                    </td>
                  </tr>
                  <tr>
                    <td>
                          <table width="100%" style="" class=" borderless">
                            <tr>
                              <td width="5%"><b>A.</b></td>
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
                              <td>: <?=@$sspd->alamat ?></td>
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
                              <td>7.</td>
                              <td>Kabupaten/Kota</td>
                              <td>: <?=@$sspd->kabupaten_op ?></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td>8.</td>
                              <td>Kode Pos</td>
                              <td>:</td>
                            </tr>
                          </table>
                          
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <hr>
                          
                          <table width="100%" style="" class="borderless">
                            <tr>
                              <td width="5%"><b>B.</b></td>
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
                              <td>: <?=@$sspd->alamat_op?></td>
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
                          

                    </td>
                  </tr>
                    <td>
                          
                          <table width="100%" style="margin-top: 20px;margin-bottom: 10px">
                            <tr>
                              <td width="5%"></td>
                              <td>
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
                              </td>
                            </tr>
                          </table>
                          

                    </td>
                  </tr>

                  <tr>
                    <td>
                        <table width="100%" class="borderless-5">
                          <tr>
                            <td width="5%" ></td>
                            <td width="69.3%" align="right">14. Harga Transaksi </td>
                            <td style="height: 30px;border : 1px solid #e0dfd7;text-align: right;padding-right: 2%"> <b><?=rupiah(@$sspd->harga_transaksi) ?></td>
                          </tr>
                          <tr>
                            <td> </td>
                            <td ><span>15. Jenis Perolehan : <?= @$sspd->jenis_perolehan.' - '.@$sspd->jenis_perolehan_text ?></span></td>
                            <td> </td>
                          </tr>
                          <tr>
                            <td> </td>
                            <td ><span>16. Nomor Sertifikat : <?= @$sspd->nomor_sertifikat ?></span></td>
                            <td> </td>
                          </tr>
                        </table>

                    </td>
                  </tr>
                  <tr>
                    <td>

                      <hr>

                        <table width="100%" style="margin-bottom: 10px">
                          <tr>
                            <td width="5%" ><b>C</b></td>
                            <td> <b>Perhitungan BPHTB</b></td>
                          </tr>
                        </table>

                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="col-md-8" style="padding-left: 5%">
                        <span>1. Nilai Perolehan Objek Pajak (NPOP)</span>
                      </div>
                      <div class="col-md-4">
                        
                             <b>1. <?=rupiah(@$sspd->npop) ?></b>
                      </div>
                      <hr>

                          
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="col-md-8" style="padding-left: 5%">
                        <span>2. Nilai Perolehan Objek Pajak Tidak Kena Pajak (NPOPTKP)</span>
                      </div>
                      <div class="col-md-4">
                        
                             <b>2. <?=rupiah(@$sspd->npoptkp) ?></b>
                      </div>
                      <hr>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="col-md-8" style="padding-left: 5%">
                        <span>3. Nilai Perolehan Objek Pajak Kena Pajak (NPOPKP)</span>
                      </div>
                      <div class="col-md-4">
                        
                             <b>3. <?=rupiah(@$sspd->npopkp) ?></b>
                      </div>
                      <hr>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="col-md-8" style="padding-left: 5%">
                        <span>4. Bea Perolehan Hak atas Tanah dan Bangunan (BPHTB)</span>
                      </div>
                      <div class="col-md-4">
                        
                             <b>4. <?=rupiah(@$sspd->bphtb) ?></b>
                      </div>
                      <hr>
                    </td>
                  </tr>

                  <tr>
                    <td>


                        <table width="100%">
                          <tr>
                            <td width="5%" ><b>D</b></td>
                            <td> <b>Jumlah Setoran Berdasarkan</b></td>
                          </tr>
                        </table>

                    </td>
                  </tr>
                  <tr>
                    <td>
                        <table width="100%" style="margin-top: 10px">
                          <tr>
                            <td width="5%" ></td>
                            <td width="3%" >
                              <i class="fa fa-check-circle" aria-hidden="true"></i>
                            </td>
                            <td width="2%" >a. </td>
                            <td width="30%" > Perhitungan Wajib Pajak</td>
                            <td></td>
                            <td> </td>
                          </tr>
                          <tr>
                            <td width="5%" ></td>
                            <td width="3%" ></td>
                            <td width="2%" style="vertical-align: top">b.</td>
                            <td width="30%" >STPD BPHTB / SKPD Kurangbayar / SKPD Kurang Bayar Tambahan</td>
                            <td width="10%" style="vertical-align: bottom;">nomor:</td>
                            <td width="10%"> </td>
                            <td width="20%" style="vertical-align: bottom;">Tanggal : -</td>
                            <td> </td>
                          </tr>
                          <tr>
                            <td width="5%" ></td>
                            <td width="3%" ></td>
                            <td width="2%" style="vertical-align: top">c.</td>
                            <td width="90%" colspan="4">Pengurang dihitung Sendiri Mendaji  ___ % Berdasarkan Peraturah KDH Nomor :</td>
                            <td> </td>
                          </tr>
                          <tr>
                            <td width="5%" ></td>
                            <td width="3%" ></td>
                            <td width="2%" style="vertical-align: top">d.</td>
                            <td width="90%" colspan="4">....................................</td>
                            <td> </td>
                          </tr>

                          
                        </table>

                    </td>
                  </tr>

                  <tr>
                    <td>

                      <hr>

                        <table width="100%">
                          <tr>
                            <td width="5%" ></td>
                            <td width="30%"> Jumlah Yang di Setor</td>
                            <td> Dengan Huruf</td>
                          </tr>
                          <tr>
                            <td width="5%" ></td>
                            <td width="30%"> <b><?= rupiah(@$sspd->bphtb) ?></b></td>
                            <td> <b><?= terbilang(@$sspd->bphtb) ?></b></td>
                          </tr>
                        </table>
                      <hr>
                    </td>
                  </tr>
                  <tr>
                    <td>
                        <table width="100%">
                          <tr>
                            <td width="5%" ><b>E</b></td>
                            <td > <b>Lampiran</b></td>
                          </tr>
                        </table>

                    </td>
                  </tr>
                  <tr>
                    <td>
                        <table width="90%" style="margin-left: 5%;margin-right: 10%" class="borderless-5">
                          <?php foreach ($lampiran as $key => $value): ?>
                            <tr >
                              <td width="60%" style="vertical-align: center;"><?=($key+1).'. '.$value->nama ?></td>
                              <td>
                                <?php foreach ($files as $kf => $vf) {
                                          if ($vf->id_lampiran == $value->id) { ?>
                                            <a href="#" onclick="show_image('<?= base_url().$vf->lokasi ?>')"  class="btn-xl btn-danger" data-toggle="modal" data-target="#modal4"  style="border-radius:5px;padding: 2% 6%;margin-top: 15px" > Lihat </a>
                                          <?php }
                                      } ?>
                              </td>
                            </tr>
                          <?php endforeach ?>
                        </table>
                      <hr>

                    </td>
                  </tr>
                </table>
                </td>
              </tr>      
          </table>  
        
        <div align="center">
                
        <!-- <button type="button" onclick="save()" class="btn btn-primary"><i class="fas fa-save"></i> <?php echo $button ?></button> -->
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
