
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
<a href="<?php echo site_url().$this->uri->segment(1) ?>/create" class="btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah</a>
</div>
<div class="panel-body">
        <form action="#" id="postForm" enctype="multipart/form-data" method="post">




        <div class="col-md-3 " style=" padding:5px">
            <button type="submit" class=" btn btn-primary"><i class="fas fa-search"></i> </button>
        </div>

</div>


<table id="dtables" class="table datatable-responsive table-bordered table-striped"></table>

</form>

</div>

<script>
function hapus(v,event){
    event.preventDefault(); //prevent default action 
    var r = confirm("Yakin Hapus Data Ini?");
    if (r == true) {
        return true;
        } else {
            return false;
        }
        post_url = "<?php echo site_url('nik/delete/')?>"+v;

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

                        $('.input').keypress(function (e) {
                          if (e.which == 13) {
                             $('#postForm').submit();
                            return false;  
                          }
                        });
                        $.ajax({
                            url : '<?php echo site_url('nik/get_data') ?>',
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
                                         url : '<?php echo site_url('nik/get_data') ?>',
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
                                                     url : '<?php echo site_url('nik/get_data') ?>',
                                                     type: 'POST',
                                                     data : {},
                                                     dataType : 'json',
                                                     }).done(function(response){
                                                        datae=response;
                                                        $('#dtables').DataTable().clear().destroy();
                                                        $('#dtables').DataTable( {

                                                            data: datae.isi,
                                                            columns: [
                                                            { title: "No","width" : "5%"  },
                                                            { title: datae.judul[1] },
                                                            { title: datae.judul[2] },
                                                            { title: "Aksi","width" : "25%"  }
                                                            ],
                                                            order:[[0,'asc']]
                                                            });
                                                            });
                                                        }
                                                        </script>