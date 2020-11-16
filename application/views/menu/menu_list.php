
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

        
         <div class="row">
            <div class="col-md-11">


        <div class="col-md-3 " style=" padding:5px;;float: right">
        <input type="text" class="form-control input" name="menu_search_name" id="menu_search_id" placeholder="Menu"  />
        </div>

        <div class="col-md-3 " style=" padding:5px;;float: right">
        <input type="text" class="form-control input" name="controller_search_name" id="controller_search_id" placeholder="Controller"  />
        </div>

        <div class="col-md-3 " style=" padding:5px;;float: right">
        <input type="text" class="form-control input" name="parent_search_name" id="parent_search_id" placeholder="Parent"  />
        </div>

        <div class="col-md-3 " style=" padding:5px;;float: right">
        <input type="text" class="form-control input" name="active_search_name" id="active_search_id" placeholder="Active"  />
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
        return true;
        } else {
            return false;
        }
        post_url = "<?php echo site_url('menu/delete/')?>"+v;

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
                            url : '<?php echo site_url('menu/get_data') ?>',
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
                                         url : '<?php echo site_url('menu/get_data') ?>',
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
                                                     url : '<?php echo site_url('menu/get_data') ?>',
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