
    <!--Modal: Name-->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" style="width: 50%" role="document">

        <!--Content-->
        <div class="modal-content" id="div_modal" >

          <!--Body-->
   
            <?php echo $modal; ?>

          <!--Footer-->
          <div class="modal-footer justify-content-center">


          </div>

        </div>
        <!--/.Content-->

      </div>
    </div>


    
<div class="panel panel-flat">
<div class="panel-heading">
<h4><?php echo ucfirst($this->uri->segment(1)) ?></h4>
<div class="heading-elements">
<ul class="icons-list">
<!-- <li><a data-action="collapse"></a></li>
<li><a data-action="reload"></a></li>
<li><a data-action="close"></a></li> -->
</ul>
</div>
</div>


<div class="panel-heading">
<!-- <a href="<?php echo site_url().$this->uri->segment(1) ?>/create" class="btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah</a> -->
<a href="#" data-toggle="modal" data-target="#modal"  class="btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah</a>

</div>
<div class="panel-body">
        <form action="#" id="postForm" enctype="multipart/form-data" method="post">

        
         <div class="row">
            <div class="col-md-11">
                <div class="col-md-3 " style=" padding:5px;float: right;">
                    <input type="text" class="form-control input" name="nik_search_name" id="nik_search_id" placeholder="Nik"  />
                </div>

                <div class="col-md-3 " style=" padding:5px;float: right">
                    <input type="text" class="form-control input" name="nama_search_name" id="nama_search_id" placeholder="Nama"  />
                </div>

            </div>
            <div class="col-md-1">
                <div class="" style=" padding:5px;float: right;">
                    <button type="submit" class=" btn btn-primary" style="float: right;"><i class="fas fa-search"></i> </button>
                </div>
        </div>
    </div>
</div>

<div class="panel-body">

<table id="dtables" class="table datatable-responsive table-bordered table-striped"></table>
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
    post_url = "<?php echo site_url('niks/delete/')?>"+v;

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
            }else if(response == 0){
                $.growl.danger({ message: "Hapus gagal!" });
                $(".btn").css('display','inline');

            }else if(response == 2){
                $.growl.danger({ message: "NIK Terdaftar di SSPD!" });
                $(".btn").css('display','inline');

            }
    });
}

        var datae;
        $(document).ready(function() {

            $('.input').keypress(function (e) {
              if (e.which == 13) {
                 $('#postForm').submit();
                return false;  
              }
            });
            $.ajax({
                url : '<?php echo site_url('niks/get_data') ?>',
                type: 'POST',
                data : {},
                dataType : 'json',
                }).done(function(response){ //
                // datae=JSON.parse(response);
                // var datae=JSON.parse (response);
                    datae=response;
                    // console.log(datae);
                    $('#dtables').DataTable( {
                // console.log(dataSet);

                        fixedColumns: true,
                        data: datae.isi,
                        searching: false,   // Search Box will Be Disabled
                        ordering: true,    // Ordering (Sorting on Each Column)will Be Disabled
                        info: true,         // Will show "1 to n of n entries" Text at bottom
                        lengthChange: false, // Will Disabled Record number per page
                        columns: [
                        { title: "No" ,"width" : "5%" },
                        { title: datae.judul[1] },
                        { title: datae.judul[2] },
                        { title: "Aksi" ,"width" : "27 %" }
                        ],
                        order:[[0,'asc']]
                        } );
                        });

            $("#postForm").submit(function(event){
                event.preventDefault(); //prevent default action 
                var form_data = $('#postForm').serialize(); //Encode form elements for submission

                console.log(form_data);

                $.ajax({
                 url : '<?php echo site_url('niks/get_data') ?>',
                 type: 'POST',
                 data : form_data,
                 dataType : 'json',
                 }).done(function(response){
                    datae=response;
                    $('#dtables').DataTable().clear().destroy();
                    $('#dtables').DataTable( {
                        fixedColumns: true,
                        data: datae.isi,
                        searching: false,   // Search Box will Be Disabled
                        ordering: true,    // Ordering (Sorting on Each Column)will Be Disabled
                        info: true,         // Will show "1 to n of n entries" Text at bottom
                        lengthChange: false, // Will Disabled Record number per page
                        columns: [
                        { title: "No" ,"width" : "5%" },
                        { title: datae.judul[1] },
                        { title: datae.judul[2] },
                        { title: "Aksi" ,"width" : "27 %" }
                        ],
                        order:[[0,'asc']]
                        });
                });
            });




        } );

        function update_datatable(){
            $.ajax({
             url : '<?php echo site_url('niks/get_data') ?>',
             type: 'POST',
             data : {},
             dataType : 'json',
             }).done(function(response){
                datae=response;
                $('#dtables').DataTable().clear().destroy();
                $('#dtables').DataTable( {

                    fixedColumns: true,
                    data: datae.isi,
                    searching: false,   // Search Box will Be Disabled
                    ordering: true,    // Ordering (Sorting on Each Column)will Be Disabled
                    info: true,         // Will show "1 to n of n entries" Text at bottom
                    lengthChange: false, // Will Disabled Record number per page
                    columns: [
                    { title: "No" ,"width" : "5%" },
                    { title: datae.judul[1] },
                    { title: datae.judul[2] },
                    { title: "Aksi" ,"width" : "27 %" }
                    ],
                    order:[[0,'asc']]
                });
            });
        }
</script>