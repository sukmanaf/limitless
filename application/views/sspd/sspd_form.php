<div class="panel panel-white">
    <div class="panel-heading">
        <h6 class="panel-title">Basic example</h6>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
                <li><a data-action="reload"></a></li>
                <li><a data-action="close"></a></li>
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




               <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label lbl-basic col-lg-2">NIK</label>
                    <div class="col-lg-4">
                        <input type="text" required  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control "  id="nik" name="nik" value="<?php echo $nik; ?>123">
                        <input type="hidden" required class="form-control "  id="id_nik" name="id_nik" value="<?php echo $id; ?>">
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
                        <input type="text" required  class="form-control"  id="nama" name="nama" value="<?php echo @$nama; ?>">
                    </div>
                </div>
            </div>




            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label lbl-basic col-lg-2">ALAMAT</label>
                    <div class="col-lg-10">
                        <input type="text"  required class="form-control"  id="alamat" name="alamat" value="<?php echo @$alamat; ?>">

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
                                    <?php $sel=''; if(intVal($kd_propinsi) == $value->id){$sel='selected';} ?>

                                    <option <?=$sel ?>  value="<?=$value->id ?> "><?= $value->nama?></option>
                                <?php endforeach ?>

                            </select>
                            <input type="hidden" class="form-control" id="nm_propinsi" name="nm_propinsi" value="<?php echo @$nm_propinsi; ?>">

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
                                        <?php $sel=''; if(intVal($kd_kabupaten) == $value->id){$sel='selected';} ?>

                                        <option <?=$sel ?>  value="<?=$value->id ?> "><?= $value->nama?></option>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </select>
                            <input type="hidden" class="form-control" id="nm_kabupaten" name="nm_kabupaten" value="<?php echo @$nm_kabupaten; ?>">

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
                            <input type="hidden" class="form-control" id="nm_kecamatan" name="nm_kecamatan" value="<?php echo @$nm_kecamatan; ?>">

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
                        <input type="hidden" required class="form-control" id="nm_kelurahan" name="nm_kelurahan" value="<?php echo @$nm_kelurahan; ?>">

                    </div>
                </div>
            </div>
        </div>




        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label lbl-basic col-lg-2">RT/RW</label>
                <div class="col-lg-10">
                    <input type="text" required class="form-control" id="rtrw" name="rtrw" value="<?php echo @$rtrw; ?>">
                </div>
            </div>
        </div>

       <div class="col-md-12" style="float: right">
            <div class="form-group">
                <div class="col-lg-10">
                   <div class="form-wizard-actions" style="margin-top: 50px">
                    <button class="btn btn-default" id="basic-back" onclick="back()" type="reset">Back</button>
                    <button class="btn btn-info" id="basic-next"  onclick="next()">Next</button>
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
                    <input type="text"  required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" id="nop" name="nop" value="<?php echo $nop; ?>137202000500803350">
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
                    <input type="text" required  class="form-control" id="alamat_op" name="alamat_op" value="<?php echo @$alamat_op; ?>">
                </div>

            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label lbl-basic col-lg-2">Kelurahan</label>
                <div class="col-lg-4">
                    <input type="text" required  class="form-control" id="kelurahan_op" name="kelurahan_op" value="<?php echo @$kelurahan_op; ?>">
                </div>
                <label class="control-label lbl-basic col-lg-2">RT/RW</label>
                <div class="col-lg-4">
                    <input type="text" required  class="form-control" id="rtrw_op" name="rtrw_op" value="<?php echo @$rtrw_op; ?>">
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label lbl-basic col-lg-2">Kecamatan</label>
                <div class="col-lg-4">
                    <input type="text" required  class="form-control" id="kecamatan_op" name="kecamatan_op" value="<?php echo @$kecamatan_op; ?>">
                </div>
                <label class="control-label lbl-basic col-lg-2">Kabupeten/Kota</label>
                <div class="col-lg-4">
                    <input type="text" required  class="form-control" id="kabupaten_op" name="kabupaten_op" value="<?php echo @$kabupaten_op; ?>">
                </div>
            </div>
        </div>

        <div class="col-md-12" >
            <div class="form-group">
                <label class="control-label lbl-basic col-lg-2">Luas Tanah</label>
                <div class="col-lg-4">
                    <input type="text" required  class="form-control mask" id="luas_tanah" name="luas_tanah" value="<?php echo @$luas_tanah; ?>">
                </div>
                <label class="control-label lbl-basic col-lg-2">NJOP Tanah</label>
                <div class="col-lg-4">
                    <input type="text" required  class="form-control mask" id="njop_tanah" name="njop_tanah" value="<?php echo @$njop_tanah; ?>">
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label lbl-basic col-lg-2">Luas Bangunan</label>
                <div class="col-lg-4">
                    <input type="text" required  class="form-control mask" id="luas_bangunan" name="luas_bangunan" value="<?php echo @$luas_bangunan; ?>">
                </div>
                <label class="control-label lbl-basic col-lg-2">NJOP Bangunan</label>
                <div class="col-lg-4">
                    <input type="text" required  class="form-control mask" id="njop_bangunan" name="njop_bangunan" value="<?php echo @$njop_bangunan; ?>">
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label lbl-basic col-lg-2">Status Lunas 5 Tahun</label>
                <div class="col-lg-4" id="status_lunas">
                </div>
                <label class="control-label lbl-basic col-lg-2"></label>
                <div class="col-lg-4">
                    <!-- <input type="hidden" required  class="form-control" id="angka_lunas" name="" value=""> -->
                </div>
            </div>
        </div>

        
       <div class="col-md-12" style="float: right">
            <div class="form-group">
                <div class="col-lg-10">
                   <div class="form-wizard-actions" style="margin-top: 50px">
                    <button class="btn btn-default" id="basic-back" onclick="back()" type="reset">Back</button>
                    <button class="btn btn-info" id="basic-next"  onclick="next()">Next</button>
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
                    <input type="text"  required readonly  class="form-control" id="njop_total" name="njop_total" value="<?php echo $njop_total; ?>">
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
                    <input type="text"  required onkeyup="hitung()" class="form-control mask" id="harga_transaksi" name="harga_transaksi" value="<?php echo $harga_transaksi; ?>">
                </div>
                <div class="col-lg-6">
                    <!-- <button type="button" class="btn btn-primary" onclick="get_nop($('#nop').val(),event)" >Cari Nop</button> -->
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label lbl-basic col-lg-2">Nomor Sertifikat</label>
                <div class="col-lg-4">
                    <input type="text"  required  class="form-control" id="nomor_sertifikat" name="nomor_sertifikat" value="<?php echo $nomor_sertifikat; ?>">
                </div>
                <div class="col-lg-6">
                    <!-- <button type="button" class="btn btn-primary" onclick="get_nop($('#nop').val(),event)" >Cari Nop</button> -->
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label lbl-basic col-lg-2">Jenis Perolehan</label>
                <div class="col-lg-10">
                    <div class="form-group">
                        <select class="select" required id="jenis_perolehan"  name="jenis_perolehan" onchange="hitung($(this).val())">
                            <option value="">Pilih Jenis Perolehan</option>
                            <?php foreach ($jns_perolehan  as $key => $value): ?>
                                <?php $sel=''; if($jenis_perolehan == $value->id){$sel='selected';} ?>

                                <option <?=$sel ?>  value="<?=$value->id ?> " data="<?=$value->npoptkp ?>"><?= $value->nama?></option>
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
                    <input type="text"  required readonly class="form-control" id="npop" name="npop" value="<?php echo $npop; ?>">
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
                    <input type="text"  required readonly class="form-control" id="npoptkp" name="npoptkp" value="<?php echo $npoptkp; ?>">
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
                    <input type="text"  required  class="form-control" id="npopkp" name="npopkp" value="<?php echo $npopkp; ?>">
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
                    <input type="text"  required  class="form-control" id="bphtb" name="bphtb" value="<?php echo $bphtb; ?>">
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

                            <!-- <fieldset class="step" id="step4">
                                <h6 class="form-wizard-title text-semibold">
                                    <span class="form-wizard-count">4</span>
                                    Additional info
                                    <small class="display-block">We are almost done now</small>
                                </h6>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="display-block">Applicant resume:</label>
                                            <input type="file" name="resume" class="file-styled">
                                            <span class="help-block">Accepted formats: pdf, doc. Max file size 2Mb</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Where did you find us?</label>
                                            <select name="source" data-placeholder="Choose an option..." class="select-simple">
                                                <option></option> 
                                                <option value="monster">Monster.com</option> 
                                                <option value="linkedin">LinkedIn</option> 
                                                <option value="google">Google</option> 
                                                <option value="adwords">Google AdWords</option> 
                                                <option value="other">Other source</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Availability:</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="availability" class="styled">
                                                    Immediately
                                                </label>
                                            </div>

                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="availability" class="styled">
                                                    1 - 2 weeks
                                                </label>
                                            </div>

                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="availability" class="styled">
                                                    3 - 4 weeks
                                                </label>
                                            </div>

                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="availability" class="styled">
                                                    More than 1 month
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Additional information:</label>
                                            <textarea name="additional-info" rows="5" cols="5" placeholder="If you want to add any info, do it here." class="form-control"></textarea>
                                        </div>
                                    </div>


                                    
                                    <div class="col-md-12" style="margin-top: 50px;float: right">
                                        <div class="form-group">
                                            <div class="col-lg-10">
                                                <button class="btn btn-default" onclick="">back</button>
                                                <button class="btn btn-primary" onclick="save()">Sumbit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset> -->

                           <!--  <div class="form-wizard-actions" style="margin-top: 50px">
                                <button class="btn btn-default" id="basic-back" type="reset">Back</button>
                                <button class="btn btn-info" id="basic-next" type="submit" onclick="cek(1)">Next</button>
                            </div> -->
    </form>
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




    $("#postForm").submit(function(event){
        if (save == 0) {
            return false;
        }else{

            
                // $(".btn").css('display','none');
            event.preventDefault(); //prevent default action 
            var post_url = '<?= site_url('sspd/create_action')?>'; //get form action url
            var request_method = $(this).attr("method"); //get form GET/POST method
            var form_data = new FormData(this); //Encode form elements for submission
            form_data.forEach(function(value, key){
                object[key] = value;
            });
            var json = JSON.stringify(object);
            // items
            // console.log(form_data);
            // console.log(object);
            // json = object
            // var testObject = json;
            // localStorage.setItem('testObject', JSON.stringify(testObject));
            // var retrievedObject = JSON.parse(localStorage.getItem('testObject'));
            // console.log('retrievedObject: ', retrievedObject);

            // var r = confirm("Apakah Data Yang Dimasukan Sudah Benar?");
            // if (r == true) {
            // } else {
            //     return false;
            // }
            // return false;
            
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
                    $.growl.notice({ message: "Simpan Sukses!" });
                    setTimeout(function () {
                            window.location.replace('<?php echo site_url('sspd/lampiran/') ?>'+response.nopen)
                            }, 2000);
                }else{
                    $.growl.warning({ message: "Simpan gagal!" });
                    $(".btn").css('display','inline');

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
            // console.log(dataq.NOP);
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
                if (data.lunas == 0) {
                    $.growl.warning({ message: "PBB 5 Tahun belum Lunas!" });

                    $('#basic-next').css('display','none');
                }
            }else{

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
            $('#select_kabupaten').html(response);
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
