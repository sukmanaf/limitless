<div class="panel panel-white">
    <div class="panel-heading">
        <h6 class="panel-title">Tambah Berkas SSPD</h6>
        <div class="heading-elements">
            <ul class="icons-list">
               <!--  <li><a data-action="collapse"></a></li>
                <li><a data-action="reload"></a></li>
                <li><a data-action="close"></a></li> -->
            </ul>
        </div>
    </div>

    <form action="#" id="postForm" class="form-validation" enctype="multipart/form-data" method="post">
        <fieldset class="step" id="step1">
            <h6 class="form-wizard-title text-semibold">
                <span class="form-wizard-count">1</span>
                Data Wajib Pajak
                <small class="display-block"></small>
            </h6>
            <div class="row">


                <!-- hidden input -->
                <input type="hidden" required class="form-control "  id="id_tipe" name="tipe" value="<?php echo @$tipe; ?>">
                <input type="hidden" required class="form-control "  id="nopen" name="nopen" value="<?php echo @$sspd->no_pendaftaran; ?>">
                <input type="hidden" required class="form-control "  id="id_sspd" name="id_sspd" value="<?php echo @$sspd->id_sspd; ?>">
                <!-- hidden input -->

               <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label lbl-basic col-lg-2">NIK</label>
                    <div class="col-lg-4">
                        <input type="text" required  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control "  id="nik" name="nik" value="<?php echo @$sspd->nik; ?>">
                        <input type="hidden" required class="form-control "  id="id_nik" name="id_nik" value="<?php echo @$sspd->id; ?>">
                        
                    </div>
                    <div class="col-lg-6">
                        <button type="button" required class="btn btn-primary" onclick="get_nik($('#nik').val(),event)" >Cari NIK</button>
                    </div>
                </div>
            </div>


            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label lbl-basic col-lg-2">NAMA</label>
                    <div class="col-lg-10">
                        <input type="text" required  class="form-control"  id="nama" name="nama" value="<?php echo @$sspd->nama; ?>">
                    </div>
                </div>
            </div>




            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label lbl-basic col-lg-2">ALAMAT</label>
                    <div class="col-lg-10">
                        <input type="text"  required class="form-control"  id="alamat" name="alamat" value="<?php echo @$sspd->alamat; ?>">

                    </div>
                </div>
            </div>




            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label lbl-basic col-lg-2">PROPINSI</label>
                    <div class="col-lg-10">
                        <div class="form-group">
                            <select class="select" required id="select_propinsi"  name="kd_propinsi" onchange="get_kabupaten($(this).val())">
                                <option value="">Pilih Propinsi</option>
                                <?php foreach ($propinsi  as $key => $value): ?>
                                    <?php $sel=''; if(intVal($sspd->kd_propinsi) == $value->id){$sel='selected';} ?>

                                    <option <?=$sel ?>  value="<?=$value->id ?> "><?= $value->nama?></option>
                                <?php endforeach ?>

                            </select>
                            <input type="hidden" class="form-control" id="nm_propinsi" name="nm_propinsi" value="<?php echo @$sspd->nm_propinsi; ?>">

                        </div>
                    </div>
                </div>
            </div>




            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label lbl-basic col-lg-2">KOTA/KABUPATEN</label>
                    <div class="col-lg-10">
                        <div class="form-group" >
                            <select class="select" id="select_kabupaten" required name="kd_kabupaten" onchange="get_kecamatan($(this).val())">
                                <option value="">Pilih Kota/Kabupaten</option>
                                <?php if ($button == 'Update' ): ?>
                                    <?php foreach ($kabupaten  as $key => $value): ?>
                                        <?php $sel=''; if(intVal($sspd->kd_kabupaten) == $value->id){$sel='selected';} ?>

                                        <option <?=$sel ?>  value="<?=$value->id ?> "><?= $value->nama?></option>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </select>
                            <input type="hidden" class="form-control" id="nm_kabupaten" name="nm_kabupaten" value="<?php echo @$sspd->nm_kabupaten; ?>">

                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label lbl-basic col-lg-2">KECAMATAN</label>
                    <div class="col-lg-10">
                        <div class="form-group" >
                            <select class="select" required id="select_kecamatan"name="kd_kecamatan"  onchange="get_kelurahan($(this).val())">
                                <option value="">Pilih Kecamatan</option>
                                <?php if ($button == 'Update' ): ?>
                                    <?php foreach ($kecamatan  as $key => $value): ?>
                                        <?php $sel=''; if(intVal($kd_kecamatan) == $value->id){$sel='selected';} ?>

                                        <option <?=$sel ?>  value="<?=$value->id ?> "><?= $value->nama?></option>
                                    <?php endforeach ?>
                                <?php endif ?>

                            </select>
                            <input type="hidden" class="form-control" id="nm_kecamatan" name="nm_kecamatan" value="<?php echo @$sspd->nm_kecamatan; ?>">

                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label lbl-basic col-lg-2">KELURAHAN</label>
                    <div class="col-lg-10">
                     <div class="form-group" >
                        <select class="select" required id="select_kelurahan" name="kd_kelurahan" onchange="get_nama_kelurahan($(this).val())">
                            <option value="">Pilih Kelurahan</option>
                            <?php if ($button == 'Update' ): ?>
                                <?php foreach ($kelurahan  as $key => $value): ?>
                                    <?php $sel=''; if(intVal($kd_kelurahan) == $value->id){$sel='selected';} ?>

                                    <option <?=$sel ?>  value="<?=$value->id ?> "><?= $value->nama?></option>
                                <?php endforeach ?>
                            <?php endif ?>

                        </select>
                        <input type="hidden" required class="form-control" id="nm_kelurahan" name="nm_kelurahan" value="<?php echo @$sspd->nm_kelurahan; ?>">

                    </div>
                </div>
            </div>
        </div>




        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label lbl-basic col-lg-2">RT/RW</label>
                <div class="col-lg-10">
                    <input type="text" required class="form-control" id="rtrw" name="rtrw" value="<?php echo @$sspd->rtrw; ?>">
                </div>
            </div>
        </div>

       <div class="col-md-12" style="float: right">
            <div class="form-group">
                <div class="col-lg-10">
                   <div class="form-wizard-actions" style="margin-top: 50px">
                    <button class="btn btn-default" id="basic-back" onclick="back()" type="reset">Back</button>
                    <button class="btn btn-info" id="nik-next"  onclick="next()">Next</button>
                </div>
            </div>
        </div>




    </div>
</fieldset>

<fieldset class="step" id="step2">
    <h6 class="form-wizard-title text-semibold">
        <span class="form-wizard-count">2</span>
        Data Objek Pajak
        <small class="display-block"></small>
    </h6>

    <div class="row">

        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label lbl-basic col-lg-2">NOP</label>
                <div class="col-lg-4">
                    <input type="text"  required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" id="nop" name="nop" value="<?php echo @$sspd->nop; ?>">
                </div>
                <div class="col-lg-6">
                    <button type="button" class="btn btn-primary" onclick="get_nop($('#nop').val(),event)" >Cari Nop</button>
                    
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label lbl-basic col-lg-2">Letak Tanah</label>
                <div class="col-lg-4">
                    <input type="text" required  class="form-control" id="alamat_op" name="alamat_op" value="<?php echo @$sspd->alamat_op; ?>">
                </div>

            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label lbl-basic col-lg-2">Kelurahan</label>
                <div class="col-lg-4">
                    <input type="text" required  class="form-control" id="kelurahan_op" name="kelurahan_op" value="<?php echo @$sspd->kelurahan_op; ?>">
                </div>
                <label class="control-label lbl-basic col-lg-2">RT/RW</label>
                <div class="col-lg-4">
                    <input type="text" required  class="form-control" id="rtrw_op" name="rtrw_op" value="<?php echo @$sspd->rtrw_op; ?>">
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label lbl-basic col-lg-2">Kecamatan</label>
                <div class="col-lg-4">
                    <input type="text" required  class="form-control" id="kecamatan_op" name="kecamatan_op" value="<?php echo @$sspd->kecamatan_op; ?>">
                </div>
                <label class="control-label lbl-basic col-lg-2">Kabupeten/Kota</label>
                <div class="col-lg-4">
                    <input type="text" required  class="form-control" id="kabupaten_op" name="kabupaten_op" value="<?php echo @$sspd->kabupaten_op; ?>">
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <h5 style="margin-top: 20px">Perhitungan PBB</h5>
        </div>

        <div class="col-md-12" >
            <div class="form-group">
                <label class="control-label lbl-basic col-lg-2">Luas Tanah</label>
                <div class="col-lg-2">
                    <input type="text" required  class="form-control mask" onkeyup="hitung()" id="luas_tanah" name="luas_tanah" value="<?php echo format_number(@$sspd->luas_tanah); ?>">
                </div>
                <label class="control-label lbl-basic col-lg-2">NJOP Tanah</label>
                <div class="col-lg-2">
                    <input type="text" required  class="form-control mask" onkeyup="hitung()" id="njop_tanah" name="njop_tanah" value="<?php echo format_number(@$sspd->njop_tanah); ?>">
                </div>
                <label class="control-label lbl-basic col-lg-2">Total NJOP Tanah</label>
                <div class="col-lg-2">
                    <input type="text" required readonly class="form-control mask" onkeyup="hitung()" id="total_njop_tanah" name="total_njop_tanah" value="<?php echo format_number(@$sspd->njop_tanah*@$sspd->luas_tanah); ?>">
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label lbl-basic col-lg-2">Luas Bangunan</label>
                <div class="col-lg-2">
                    <input type="text" required  class="form-control mask" onkeyup="hitung()" id="luas_bangunan" name="luas_bangunan" value="<?php echo format_number(@$sspd->luas_bangunan); ?>">
                </div>
                <label class="control-label lbl-basic col-lg-2">NJOP Bangunan</label>
                <div class="col-lg-2">
                    <input type="text" required  class="form-control mask" onkeyup="hitung()" id="njop_bangunan" name="njop_bangunan" value="<?php echo format_number(@$sspd->njop_bangunan); ?>">
                </div>
                <label class="control-label lbl-basic col-lg-2">Total NJOP Bangunan</label>
                <div class="col-lg-2">
                    <input type="text" required readonly class="form-control mask" onkeyup="hitung()" id="total_njop_bangunan" name="total_njop_bangunan" value="<?php echo format_number(@$sspd->njop_bangunan*@$sspd->luas_bangunan); ?>">
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <div class="col-lg-8">
                </div>
                <label class="control-label lbl-basic col-lg-2">NJOP PBB</label>
                <div class="col-lg-2">
                    <input type="text" required readonly class="form-control mask" onkeyup="hitung()" id="total_njop" name="total_njop" value="<?php echo format_number(@$sspd->njop_total); ?>">
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label lbl-basic col-lg-2">PBB Lunas 5 Tahun</label>
                <div class="col-lg-4" id="status_lunas">
                </div>
                    <!-- <input type="hidden" required  class="form-control" id="angka_lunas" name="" value=""> -->
                </div>
            </div>
        </div>

        
       <div class="col-md-12" style="float: right">
            <div class="form-group">
                <div class="col-lg-10">
                   <div class="form-wizard-actions" style="margin-top: 50px">
                    <button class="btn btn-default" id="basic-back" onclick="back()" type="reset">Back</button>
                    <button class="btn btn-info" id="nop-next"  onclick="next()">Next</button>
                </div>
            </div>
        </div>





    </div>
</fieldset>

<fieldset class="step" id="step3">
    <h6 class="form-wizard-title text-semibold">
        <span class="form-wizard-count">3</span>
        Perhitungan BPHTB
        <!-- <small class="display-block">Previous work places</small> -->
    </h6>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label lbl-basic col-lg-2">NJOP</label>
                <div class="col-lg-4">
                    <input type="text"  required readonly  class="form-control" id="njop_total" name="njop_total" value="<?php echo format_number(@$sspd->njop_total); ?>">
                </div>
                <div class="col-lg-6">
                    <!-- <button type="button" class="btn btn-primary" onclick="get_nop($('#nop').val(),event)" >Cari Nop</button> -->
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label lbl-basic col-lg-2">Harga Transaksi</label>
                <div class="col-lg-4">
                    <input type="text"  required onkeyup="hitung()" class="form-control mask" id="harga_transaksi" name="harga_transaksi" value="<?php echo format_number(@$sspd->harga_transaksi); ?>">
                </div>
                <div class="col-lg-6">
                    <!-- <button type="button" class="btn btn-primary" onclick="get_nop($('#nop').val(),event)" >Cari Nop</button> -->
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label lbl-basic col-lg-2">No Bukti Kepemilikan</label>
                <div class="col-lg-4">
                    <input type="text"  required  class="form-control" id="nomor_sertifikat" name="nomor_sertifikat" value="<?php echo @$sspd->nomor_sertifikat; ?>">
                </div>
                <div class="col-lg-6">
                    <!-- <button type="button" class="btn btn-primary" onclick="get_nop($('#nop').val(),event)" >Cari Nop</button> -->
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label lbl-basic col-lg-2">Jenis Perolehan</label>
                <div class="col-lg-4">
                    <div class="form-group">
                        <select class="select" required id="jenis_perolehan"  name="jenis_perolehan" onchange="hitung($(this).val())">
                            <option value="">Pilih Jenis Perolehan</option>
                            <?php foreach ($jns_perolehan  as $key => $value): ?>
                                <?php $sel=''; if($sspd->jenis_perolehan == $value->kode){$sel='selected';} ?>

                                <option <?=$sel ?>  value="<?=$value->kode ?> " data="<?=$value->npoptkp ?>"><?= $value->nama?></option>
                            <?php endforeach ?>

                        </select>

                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label lbl-basic col-lg-2">NPOP</label>
                <div class="col-lg-4">
                    <input type="text"  required readonly class="form-control" id="npop" name="npop" value="<?php echo format_number(@$sspd->npop); ?>">
                </div>
                <div class="col-lg-6">
                    <!-- <button type="button" class="btn btn-primary" onclick="get_nop($('#nop').val(),event)" >Cari Nop</button> -->
                </div>
            </div>
        </div>


        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label lbl-basic col-lg-2">npoptkp</label>
                <div class="col-lg-4">
                    <input type="text"  required readonly class="form-control" id="npoptkp" name="npoptkp" value="<?php echo format_number(@$sspd->npoptkp); ?>">
                </div>
                <div class="col-lg-6">
                    <!-- <button type="button" class="btn btn-primary" onclick="get_nop($('#nop').val(),event)" >Cari Nop</button> -->
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label lbl-basic col-lg-2">npopkp</label>
                <div class="col-lg-4">
                    <input type="text"  required readonly class="form-control" id="npopkp" name="npopkp" value="<?php echo format_number(@$sspd->npopkp); ?>">
                </div>
                <div class="col-lg-6">
                    <!-- <button type="button" class="btn btn-primary" onclick="get_nop($('#nop').val(),event)" >Cari Nop</button> -->
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label lbl-basic col-lg-2">bphtb</label>
                <div class="col-lg-4">
                    <input type="text"  required readonly class="form-control" id="bphtb" name="bphtb" value="<?php echo format_number(@$sspd->bphtb); ?>">
                </div>
                <div class="col-lg-6">
                    <!-- <button type="button" class="btn btn-primary" onclick="get_nop($('#nop').val(),event)" >Cari Nop</button> -->
                </div>
            </div>
        </div>


       <div class="col-md-12" style="float: right">
            <div class="form-group">
                <div class="col-lg-10">
                   <div class="form-wizard-actions" style="margin-top: 50px">
                    <button class="btn btn-default" id="basic-back" onclick="back()" type="reset">Back</button>
                    <button class="btn btn-info"   onclick="simpan()">Next</button>
                </div>
            </div>
        </div>



</div>
</fieldset>

                          
    </form>
    <hr>
<?php if ($tipe == 'update'): ?>
    

    <!-- <div class="panel-heading"> -->
        <h6 style="margin-left: 20px" class="panel-title text-semiold">Diskusi</h6>
        <div class="heading-elements">
          <ul class="list-inline list-inline-separate heading-text text-muted">
            <!-- <li>42 comments</li> -->
            <!-- <li>75 pending review</li> -->
          </ul>
                </div>
      <!-- </div> -->

      <div class="panel-body">
        <ul class="media-list stack-media-on-mobile" id="add_komen">

          <?php foreach ($komen as $key => $value): ?>
          <li class="media">
            <div class="media-left">
              <a href="#"><img src="<?=base_url() ?>assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></a>
            </div>

            <div class="media-body">
              <div class="media-heading">
                <a class="text-semibold"><?=@$value->nama ?></a>
                <p style="font-size:8pt"><?=tanggal_indonesia(@$value->date) ?></p>
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
            <input type="hidden" name="send" id="send" value="<?= @$session['id_user'] ?>">
            <input type="hidden" name="tipe" id="tipe" value="<?= @$session['jenis'] ?>">


                <div class="panel-body">
                  <h6 class="no-margin-top content-group">Add comment</h6>
                  <div class="content-group">
                    <!-- <div id="add-comment" ></div> -->
                    <textarea class="form-control" id="komen" name="komen"></textarea>
                  </div>
                  
                  <div class="text-right">
                    <button type="submit" class="btn bg-blue"><i class="icon-plus22"></i> Add comment</button>
                  </div>
                </div>
        </form>
    </div>
<?php endif ?>

  </div>
</div>
</div>

<script >
    function back() {
        save=0;
    }
    function next() {
        $('#postForm').submit();
        // console.log('next')
    }

    function simpan() {

        save = 1;
        // $('#postForm').submit();
        // console.log('save')
    }



    var object = {};
    var save =0;
    $(document).ready(function() {
        $('#komen').summernote({
            toolbar: false,
        });
    if ( $('#id_tipe').val() == 'update') {
        // get_propinsi_selected(dataq.kd_propinsi);
        get_kabupaten_selected('<?= @$sspd->kd_kabupaten ?>');
        get_kecamatan_selected('<?= @$sspd->kd_kecamatan ?>');
        get_kelurahan_selected('<?= @$sspd->kd_kelurahan ?>');
        get_history_nop('<?= @$sspd->nop ?>')
    }

    $("#postForm").submit(function(event){
        if (save == 0) {
            return false;
        }else{

            
                // $(".btn").css('display','none');
            event.preventDefault(); //prevent default action 
            var post_url = '<?= $action?>'; //get form action url
            var request_method = $(this).attr("method"); //get form GET/POST method
            var form_data = new FormData(this); //Encode form elements for submission
            form_data.forEach(function(value, key){
                object[key] = value;
            });
            var json = JSON.stringify(object);
            
            $.ajax({
                url : post_url,
                type: 'POST',
                data : json,
                processData:false,
                contentType:false,
                cache:false,
                async:false,
            }).done(function(response){
                response=JSON.parse(response)
                console.log(response.sts_sspd)
                // return false;
                if (response.sts_nik == 0){
                    $.growl.warning({ message: "Simpan Data NIK gagal!" });
                    $(".btn").css('display','inline');

                }else if(response.sts_sspd== 1){
                    $(".btn").css('display','none');

                    $.growl.notice({ message: "Simpan Sukses!" });
                    setTimeout(function () {
                            window.location.replace('<?php echo site_url('sspd/upload_lampiran/') ?>'+response.nopen)
                            }, 2000);
                }else{
                    $.growl.warning({ message: "Simpan gagal!" });
                    $(".btn").css('display','inline');

                }
            });

        }  
    });
     $("#Formkomen").submit(function(event){
        event.preventDefault(); //prevent default action 
        var message = $('textarea#komen').val();
        // var text = CKEDITOR.instances['add-comment'].getData()
        if( message != ''){
            var formData = new FormData(this)
            // formData.append('komen', text);
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
                          $('#komen').summernote('reset');
                          // CKEDITOR.instances['add-comment'].setData('');
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

        function get_nop(nop,event) {
            $('#basic-next').css('display','inline');

            if (nop == '') {
                $.growl.warning({ message: "Isi Nop Terlebih Dahulu!" });
                return false;
            }
        event.preventDefault(); //prevent default action 

        $.ajax({
            url : '<?=base_url() ?>sspd/get_nop/'+nop,
            type: 'POST',
            data : {},
            processData:false,
            contentType:false,
            cache:false,
            async:false,
        }).done(function(response){
            var data = JSON.parse(response);
            var dataq = data.datas;
            // dataq= JSON.parse(dataq);
            console.log(dataq);
            if (data.sts == 1) {
                $.growl.notice({ message: "Data NOP Ditemukan!" });
                $('#kecamatan_op').val(dataq.OP_KECAMATAN)
                $('#kabupaten_op').val(dataq.OP_KOTAKAB)
                $('#kelurahan_op').val(dataq.OP_KELURAHAN)
                $('#rtrw_op').val(dataq.OP_RT+'/'+dataq.OP_RW)
                $('#alamat_op').val(dataq.OP_ALAMAT)
                $('#luas_tanah').val(format_number(dataq.OP_LUAS_BUMI))
                $('#luas_bangunan').val(format_number(dataq.OP_LUAS_BANGUNAN))
                $('#njop_tanah').val(format_number(dataq.OP_NJOP_TANAH_PERMETER))
                $('#njop_bangunan').val(format_number(dataq.OP_NJOP_BANGUNAN_PERMETER))
                $('#njop_total').val(format_number(parseInt(dataq.OP_NJOP_BANGUNAN)+parseInt(dataq.OP_NJOP_BUMI)))
                $('#total_njop').val(format_number(parseInt(dataq.OP_NJOP_BANGUNAN)+parseInt(dataq.OP_NJOP_BUMI)))
                $('#total_njop_tanah').val(format_number(dataq.OP_NJOP_TANAH_PERMETER*dataq.OP_LUAS_BUMI))
                $('#total_njop_bangunan').val(format_number(dataq.OP_NJOP_BANGUNAN_PERMETER*dataq.OP_LUAS_BANGUNAN))
                get_history_nop(nop)
            }else{
                $.growl.warning({ message: "NOP Tidak ditemukan!" });
                $('#kecamatan_op').val('')
                $('#kabupaten_op').val('')
                $('#kelurahan_op').val('')
                $('#rtrw_op').val('')
                $('#alamat_op').val('')
            }

        });
    }

    function get_history_nop(nop) {


        $.ajax({
            url : '<?=base_url() ?>sspd/get_history_nop/'+nop,
            type: 'POST',
            data : {},
            processData:false,
            contentType:false,
            cache:false,
            async:false,
        }).done(function(response){
            var data = JSON.parse(response);
            // dataq= JSON.parse(dataq);
            // console.log(data);
            if (data.sts == 1) {
                $('#status_lunas').html(data.datas)
                
                    console.log(data.lunas+' lunas');
                if (data.lunas == 0 || data.lunas == null ) {
                    $.growl.warning({ message: "PBB 5 Tahun belum Lunas!" });

                    console.log('masuk if');

                    $('#nop-next').attr("disabled", true);

                }else{
                    console.log('masuk else atas');
                    $('#nop-next').attr("disabled", false);
                }
            }else{
                console.log('masuk else bawah');
                    $('#nop-next').attr("disabled", false);

            }

        });
    }

    function get_nik(nik,event) {
        if (nik == '') {
            $.growl.warning({ message: "Isi Nik Terlebih Dahulu!" });
            return false;
        }
        event.preventDefault(); //prevent default action 

        $.ajax({
            url : '<?=base_url() ?>sspd/get_nik/'+nik,
            type: 'POST',
            data : {},
            processData:false,
            contentType:false,
            cache:false,
            async:false,
        }).done(function(response){
            var data = JSON.parse(response);
            var dataq = data.datas;
            // dataq= JSON.parse(dataq);
                // console.log(dataq)
                if (data.sts == 1) {
                    $.growl.notice({ message: "Nik Ditemukan!" });
                    $('#nama').val(dataq.nama)
                    $('#id_nik').val(dataq.id)
                    $('#alamat').val(dataq.alamat)
                    get_propinsi_selected(dataq.kd_propinsi);
                    get_kabupaten_selected(dataq.kd_kabupaten);
                    get_kecamatan_selected(dataq.kd_kecamatan);
                    get_kelurahan_selected(dataq.kd_kelurahan);
                    $('#rtrw').val(dataq.rtrw)
                }else{
                    $.growl.warning({ message: "NIK Tidak ditemukan, Silahkan Isi Data !" });
                    $('#nama').val('')
                    $('#alamat').val('')
                    $('#rtrw').val('')
                    $('#select_kecamatan').html('<option value="">Pilih Kecamatan</option>')
                    $('#select_kabupaten').html('<option value="">Pilih Kabupaten</option>')
                    $('#select_kelurahan').html('<option value="">Pilih Kelurahan</option>')
                    get_propinsi();
                }

            // if (response == 1){

            // $.growl.notice({ message: "Simpan Sukses!" });


            // setTimeout(function () {
            //         window.location.replace('<?php echo site_url('sspd') ?>')

            //         }, 2000);

            // }else{
            //     $.growl.warning({ message: "Simpan gagal!" });
            //     $(".btn").css('display','inline');

            // }
        });
    }
    
    function get_propinsi() {
        var url = '<?php echo base_url() ?>sspd/get_propinsi';
        $.ajax({
            url : url,
            type: 'POST',
            data : {},
            processData:false,
            contentType:false,
            cache:false,
            async:false,
        }).done(function(response){
            // console.log(response)
            $('#select_propinsi').html(response);
        });
    }     
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
            // console.log(response)
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
            // console.log(response)
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
            // console.log(response)
            $('#select_kelurahan').html(response);
        });
    }   

    function get_propinsi_selected(v) {

        var url = '<?php echo base_url() ?>sspd/get_propinsi_selected/'+v;
        $.ajax({
            url : url,
            type: 'POST',
            data : {},
            processData:false,
            contentType:false,
            cache:false,
            async:false,
        }).done(function(response){
            // console.log(response)
            $('#select_propinsi').html(response);
            var text=$("#select_propinsi option:selected").text();
            $("#nm_propinsi").val(text);
        });
    }  
    function get_kabupaten_selected(kab) {

        var url = '<?php echo base_url() ?>sspd/get_kabupaten_selected/'+kab;
        $.ajax({
            url : url,
            type: 'POST',
            data : {},
            processData:false,
            contentType:false,
            cache:false,
            async:false,
        }).done(function(response){
            // console.log(response)
            $('#select_kabupaten').html(response);
            var text=$("#select_kabupaten option:selected").text();
            $("#nm_kabupaten").val(text);
        });
    }  
    function get_kecamatan_selected(v) {
        var url = '<?php echo base_url() ?>sspd/get_kecamatan_selected/'+v;
        $.ajax({
            url : url,
            type: 'POST',
            data : {},
            processData:false,
            contentType:false,
            cache:false,
            async:false,
        }).done(function(response){
            // console.log(response)
            $('#select_kecamatan').html(response);
            var text=$("#select_kecamatan option:selected").text();
            $("#nm_kecamatan").val(text);
        });
    }  
    function get_kelurahan_selected(v) {
        var url = '<?php echo base_url() ?>sspd/get_kelurahan_selected/'+v;
        $.ajax({
            url : url,
            type: 'POST',
            data : {},
            processData:false,
            contentType:false,
            cache:false,
            async:false,
        }).done(function(response){
            // console.log(response)
            $('#select_kelurahan').html(response);
            var text=$("#select_kelurahan option:selected").text();
            $("#nm_kelurahan").val(text);
        });
    }   

    function get_nama_kelurahan(v) {
        var text=$("#select_kelurahan option:selected").text();
        $("#nm_kelurahan").val(text);
    }

    function hitung() {

        //hitung njop
        var luas_tanah = $('#luas_tanah').val().replace(/\./g, '');
        var luas_bangunan = $('#luas_bangunan').val().replace(/\./g, '');
        var njop_tanah = $('#njop_tanah').val().replace(/\./g, '');
        var njop_bangunan = $('#njop_bangunan').val().replace(/\./g, '');
        var total_njop_tanah = parseInt(luas_tanah*njop_tanah);
        var total_njop_bangunan = parseInt(luas_bangunan*njop_bangunan);
        var total_njop = parseInt(total_njop_tanah+total_njop_bangunan);
        $('#total_njop_tanah').val(format_number(total_njop_tanah));
        $('#total_njop_bangunan').val(format_number(total_njop_bangunan));
        $('#total_njop').val(format_number(total_njop));
        $('#njop_total').val(format_number(total_njop));

        //hitung bphtb
        var njop_total = $('#njop_total').val().replace(/\./g, '');
        var harga_transaksi = $('#harga_transaksi').val().replace(/\./g, '');
        var npoptkp = $('#jenis_perolehan').find('option:selected').attr('data');
        npoptkp = npoptkp == undefined? 0: npoptkp;
        var npop = parseInt(njop_total) > parseInt(harga_transaksi) ? njop_total : harga_transaksi;
        var npopkp = parseInt(npop-npoptkp);
        npopkp = npopkp < 0 ? 0 : npopkp;
        var bphtb = npopkp*0.05;

        $('#npop').val(format_number(npop));
        $('#npoptkp').val(format_number(npoptkp));
        $('#npopkp').val(format_number(npopkp));
        $('#bphtb').val(format_number(bphtb));
        // $('#npop').val();
        // $('#npop').val();


        
    }
    function format_number(nStr)
    {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + '.' + '$2');
        }
        return x1 + x2;
    }
    function getFormData($form){
        var unindexed_array = $form.serializeArray();
        var indexed_array = {};

        $.map(unindexed_array, function(n, i){
            indexed_array[n['name']] = n['value'];
        });

        return indexed_array;
    }
    $( document ).ready(function() {
        $('.mask').on('keyup', function(event) {
            $(this).mask("#.##0", {reverse: true, maxlength: false});
        });
    });

</script>
