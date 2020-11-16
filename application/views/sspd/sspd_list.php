
<div class="panel panel-flat">
  <div class="col">
    <div class="col-md-4" style="margin-bottom: 10px">
        
    </div>
    <div class="card card-small mb-4">
      <div class="card-header border-bottom text-center">
            <h4><?php echo ucfirst($this->uri->segment(1)) ?></h4>
      </div>



      <div class="row" style="margin-bottom: 10px">
        <div class="col-md-12" style="margin: 10px">
            <a href="<?php echo site_url().$this->uri->segment(1) ?>/create" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</a></div>

    </div>

        <form action="#" id="postForm" enctype="multipart/form-data" method="post">
        <div class=" row">
            <div class="col-md-11 text-right">
                <div class="row" style=" margin:5px">

                <div class="col-md-3 " style=" padding:5px">
                <input type="text" class="form-control" name="id_ppat_search_name" id="id_ppat_search_id" placeholder="Id Ppat"  />
                </div>

                <div class="col-md-3 " style=" padding:5px">
                <input type="text" class="form-control" name="nik_search_name" id="nik_search_id" placeholder="Nik"  />
                </div>

                <div class="col-md-3 " style=" padding:5px">
                <input type="text" class="form-control" name="nop_search_name" id="nop_search_id" placeholder="Nop"  />
                </div>

                <div class="col-md-3 " style=" padding:5px">
                <input type="text" class="form-control" name="alamat_op_search_name" id="alamat_op_search_id" placeholder="Alamat Op"  />
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
        </form>
        
    <div class="card-body p-0 pb-3 text-center" style="padding: 30px;margin-top:20px">
            
        <table id="dtables" class="table table-bordered table-striped"></table>

    </div>
</div>
</div>
</div>

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
            ordering: true,    // Ordering (Sorting on Each Column)will Be Disabled
            info: true,         // Will show "1 to n of n entries" Text at bottom
            lengthChange: false, // Will Disabled Record number per page
            columns: [
            { title: "No" ,"width" : "5%" },
            { title: datae.judul[1] },
            { title: datae.judul[2] },
            { title: "Aksi" ,"width" : "27%" }
            ],
            order:[[0,'asc']]
            } );
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
            // console.log(dataSet);
            fixedColumns: true,
            data: datae.isi,
            columns: [
            { title: "No","width" : "5%"  },
            { title: datae.judul[1] },
            { title: datae.judul[2] },
            { title: "Aksi","width" : "27%"  }
            ],
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