


<div class="panel panel-flat">
<h3 align="center"><?php echo strtoupper(ucfirst($this->uri->segment(1))) ?></h3>
<div class="heading-elements">
<ul class="icons-list">
<!-- <li><a data-action="collapse"></a></li>
<li><a data-action="reload"></a></li>
<li><a data-action="close"></a></li> -->
</ul>
</div>


<div class="" style="margin-left: 20px">
    <?php if ($session['jenis']== 'PP' ): ?>
<a href="<?php echo site_url().$this->uri->segment(1) ?>/create" class="btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah</a>
    <?php endif ?>
    <?php if ($session['jenis']== 'BK' ): ?>
<a href="<?php echo site_url().$this->uri->segment(1) ?>/create_manual" class="btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah</a>
    <?php endif ?>
</div>
<div class="panel-body">
        <form action="#" id="postForm" enctype="multipart/form-data" method="post">

        
         <div class="row">
            <div class="col-md-11 text-right">

                <div class="col-md-3 " style=" padding:5px;float: right">
                <input type="text" class="form-control" name="nama_search_name" id="nama_search_id" placeholder="Nama/No Pendaftaran/ NIK"  />
                </div>
<!-- 
                <div class="col-md-3 " style=" padding:5px;float: right">
                <input type="text" class="form-control" name="nik_search_name" id="nik_search_id" placeholder="Nik"  />
                </div>

                <div class="col-md-3 " style=" padding:5px;float: right">
                <input type="text" class="form-control" name="nopen_search_name" id="nopen_search_id" placeholder="No Pendaftaran"  />
                </div> -->

            
                
            </div>
            <div class="col-md-1">
                <div class="row" style=" margin:5px">
                    <div class="col-md-12" style=" padding:5px">
                        <button type="submit" class=" btn btn-primary"><i class="fas fa-search"></i> </button>
                    </div>

                </div>
            </div>
    </div>
</div>
<iframe src="" id="pdf" style="display: none"></iframe>
<div class="panel-body">

<table id="dtables" class="table datatable-responsive table-bordered table-striped" >
    <thead>
        <th>No</th>
        <th>No Pendaftaran</th>
        <th>Tanggal Dibuat</th>
        <th>Nama</th>
        <th>Status</th>
        <th>Aksi</th>
    </thead>
</table>
</div>
<div id="print">
    
</div>
</form>

</div>
<script>
    function hapus(v,event){
        event.preventDefault(); //prevent default action 
        var r = confirm("Yakin Hapus Data Ini?");
        if (r == true) {
        } else {
            return false;
        }
        post_url = "<?php echo site_url('sspd/delete/')?>"+v;

        $.ajax({
            url : post_url,
            type: 'POST',
            data : {},
            processData:false,
                     contentType:false,
                     cache:false,
                     async:false,
        }).done(function(response){
            if (response == 1){

                $.growl.notice({ message: "Hapus Sukses!" });
                  // $.growl.error({ message: "The kitten is attacking!" });
                 
                setTimeout(function () {
                        update_datatable();                       
                    }, 1000);
            }else{
                $.growl.warning({ message: "Hapus gagal!" });
                $(".btn").css('display','inline');

            }
        });
    }

    var datae;
    $(document).ready(function() {
        $.ajax({
            url : '<?php echo site_url('sspd/get_data') ?>',
            type: 'POST',
            data : {},
            dataType : 'json',
        }).done(function(response){ //
            // datae=JSON.parse(response);
            // var datae=JSON.parse (response);
            datae=response;
            console.log(datae);
            $('#dtables').DataTable( {
            // console.log(dataSet);

           fixedColumns: true,
            data: datae.isi,
            searching: false,   // Search Box will Be Disabled
            ordering: false,    // Ordering (Sorting on Each Column)will Be Disabled
            info: true,         // Will show "1 to n of n entries" Text at bottom
            lengthChange: false, // Will Disabled Record number per page
            order:[[0,'asc']]
            });
        });

         $("#postForm").submit(function(event){
        event.preventDefault(); //prevent default action 
        var form_data = $('#postForm').serialize(); //Encode form elements for submission
            
            console.log(form_data);

        $.ajax({
           url : '<?php echo site_url('sspd/get_data') ?>',
            type: 'POST',
            data : form_data,
            dataType : 'json',
        }).done(function(response){
            datae=response;
            // console.log(datae);
            $('#dtables').DataTable().clear().destroy();
            $('#dtables').DataTable( {
            fixedColumns: true,
            data: datae.isi,
            searching: false,   // Search Box will Be Disabled
            ordering: false,    // Ordering (Sorting on Each Column)will Be Disabled
            info: true,         // Will show "1 to n of n entries" Text at bottom
            lengthChange: false, // Will Disabled Record number per page
            order:[[0,'asc']]
            });
        });
        });




    } );

    function update_datatable(){
        $.ajax({
           url : '<?php echo site_url('sspd/get_data') ?>',
            type: 'POST',
            data : {},
            dataType : 'json',
        }).done(function(response){
            datae=response;
            // console.log(datae);
            $('#dtables').DataTable().clear().destroy();
            $('#dtables').DataTable( {
            // console.log(dataSet);

            fixedColumns: true,
            data: datae.isi,
            searching: false,   // Search Box will Be Disabled
            ordering: false,    // Ordering (Sorting on Each Column)will Be Disabled
            info: true,         // Will show "1 to n of n entries" Text at bottom
            lengthChange: false, // Will Disabled Record number per page
            order:[[0,'asc']]
            });
        });
    }


    function print(id){
        link = "<?php echo site_url('sspd/print/')?>"+id;
        $('#pdf').attr('src', link);
        event.preventDefault(); //prevent default action 
        setTimeout(function () {
        printTrigger('pdf')
                            },500);
        
    }   
    function billing(id){
        link = "<?php echo site_url('sspd/billing/')?>"+id;
        $('#pdf').attr('src', link);
        event.preventDefault(); //prevent default action 
        setTimeout(function () {
        printTrigger('pdf')
                            }, 500);
        
    }
    function pendaftaran(id){
        link = "<?php echo site_url('sspd/pendaftaran/')?>"+id;
        $('#pdf').attr('src', link);
        event.preventDefault(); //prevent default action 
        setTimeout(function () {
        printTrigger('pdf')
                            }, 500);
        
    }

    
function printTrigger(elementId) {

    var getMyFrame = document.getElementById(elementId);
    getMyFrame.focus();
    getMyFrame.contentWindow.print();
}
</script>