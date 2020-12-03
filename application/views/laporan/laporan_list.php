

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
</div>
<div class="panel-body">
        <form action="#" id="postForm" enctype="multipart/form-data" method="post">

        
         <div class="row">
            <div class="col-md-11 text-right">

     
     
                <div class="col-md-4 " style=" padding:5px;float: right">
                <div class="input-group">
                            <span class="input-group-addon" style="margin-left: 10px"><i class="fa fa-calendar"></i></span>
                            <input type="text" id="tanggal_akhir" name="tanggal_akhir" value="" class="form-control pickadate" placeholder="Tanggal Akhir">
                        </div>
                </div>

     
                <div class="col-md-4 " style=" padding:5px;float: right">
                <div class="input-group">
                            <span class="input-group-addon" style="margin-left: 10px"><i class="fa fa-calendar"></i></span>
                            <input type="text" id="tanggal_awal" name="tanggal_awal" value="" class="form-control pickadate" placeholder="Tanggal Awal">
                            <span class="input-group-addon" style="margin-left: 10px"><i class="fa fa-long-arrow-right"></i></span>
                        </div>
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
</div>
<iframe src="" id="pdf" style="display: none"></iframe>
<div class="panel-body">

<table id="dtables" class="table datatable-responsive table-bordered table-striped" >
    <thead>
        <th>NO</th>
        <th>NO SSPD</th>
        <th>NAMA</th>
        <th>ALAMAT WP</th>
        <th>NOP</th>
        <th>ALAMAT OP</th>
        <th>RTRW OP</th>
        <th>KELURAHAN OP</th>
        <th>KECAMATAN OP</th>
        <th>LUAS TANAH  M2</th>
        <th>LUAS BANGUNAN M2</th>
        <th>NJOP TANAH /M2</th>
        <th>NJOP BANGUNAN /M2</th>
        <th>NJOP TOTAL</th>
        <th>HARGA TRANSAKSI</th>
        <th>NPOP</th>
        <th>NPOPTKP</th>
        <th>NPOPKP</th>
        <th>BPHTB</th>
        <th>TANGGAL VALIDASI BERKAS</th>
    </thead>
</table>
</div>
<div id="print">
    
</div>
</form>

</div>
<script>
   
    $(document).ready(function() {
        
       
            $('#dtables').DataTable({
            fixedColumns: true,
            searching: false,   // Search Box will Be Disabled
            ordering: true,
            scrollX: true ,        // Will show "1 to n of n entries" Text at bottom
            info: true,         // Will show "1 to n of n entries" Text at bottom
            lengthChange: false, // Will Disabled Record number per page
            dom: 'Bfrtip',
            buttons: [
                  'csv', 'excel'
            ]        // Will show "1 to n of n entries" Text at bottom

            });

         $("#postForm").submit(function(event){
            $.LoadingOverlay("text", "Yep, still loading...");

            $.LoadingOverlay("show");
            event.preventDefault(); //prevent default action 
            var form_data = $('#postForm').serialize(); //Encode form elements for submission
                
             if ($('#tanggal_awal').val() == '' ||$('#tanggal_akhir').val() == '' ) {
                    $.growl.warning({ message: "Mohon Isi Tanggal Awal dan Akhir!" });

            }
            $.ajax({
               url : '<?php echo site_url('laporan/get_data') ?>',
                type: 'POST',
                data : form_data,
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
                ordering: true,
                scrollX: true ,        // Will show "1 to n of n entries" Text at bottom
                info: true,         // Will show "1 to n of n entries" Text at bottom
                lengthChange: false, // Will Disabled Record number per page
                dom: 'Bfrtip',
                buttons: [
                      'csv',  {
                extend: 'excel',
                messageTop: 'Laporan BPHTB '+$('#tanggal_awal').val()+ ' - '+$('#tanggal_akhir').val()
            },
                ]
                });
                            $.LoadingOverlay("hide");

            });
            });




    } );

</script>