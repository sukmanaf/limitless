<?php 

$string = "";




$column_non_pk = array();
foreach ($non_pk as $row) {
    $column_non_pk[] .= "{\"data\": \"".$row['column_name']."\"}";
}
$col_non_pk = implode(',', $column_non_pk);


$string.="
<div class=\"panel panel-flat\">
<div class=\"panel-heading\">
<h4><?php echo ucfirst(\$this->uri->segment(1)) ?></h4>
<div class=\"heading-elements\">
<ul class=\"icons-list\">
<!-- <li><a data-action=\"collapse\"></a></li>
<li><a data-action=\"reload\"></a></li>
<li><a data-action=\"close\"></a></li> -->
</ul>
</div>
</div>


<div class=\"panel-heading\">
<a href=\"<?php echo site_url().\$this->uri->segment(1) ?>/create\" class=\"btn-sm btn-primary\"><i class=\"fas fa-plus\"></i> Tambah</a>
</div>
<div class=\"panel-body\">
        <form action=\"#\" id=\"postForm\" enctype=\"multipart/form-data\" method=\"post\">

        
         <div class=\"row\">
            <div class=\"col-md-11\">
";
foreach ($non_pk as $key => $row) {
            // $string.=$row['column_name'];
    if ($key < 4) {
        $string.="

        <div class=\"col-md-3 \" style=\" padding:5px;;float: right\">
        <input type=\"text\" class=\"form-control input\" name=\"".$row["column_name"]."_search_name\" id=\"".$row["column_name"]."_search_id\" placeholder=\"".label($row["column_name"])."\"  />
        </div>";
    }
}

if ($export_excel == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/excel'), ' Export Excel', ' style=\"float:right;margin-right:10px \" class=\"btn-sm btn-success fas fa-file-excel\"'); ?>";
}
if ($export_word == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/word'), ' Export Word', ' style=\"float:right;margin-right:10px \" class=\"btn-sm btn-info fas fa-file-word\"'); ?>";
}
if ($export_pdf == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/pdf'), ' Export PDF', ' style=\"float:right;margin-right:10px \" class=\"btn-sm btn-danger fas fa-file-pdf\"'); ?>";
}

$string .="


        </div>
        <div class=\"col-md-1\">
            <div class=\"\" style=\" padding:5px;float: right;\">
                <button type=\"submit\" class=\" btn btn-primary\" style=\"float: right;\"><i class=\"fas fa-search\"></i> </button>
            </div>
        </div>
    </div>
</div>

<div class=\"panel-body\">

<table id=\"dtables\" class=\"table datatable-responsive table-bordered table-striped\"></table>
</div>
</form>

</div>

<script>
function hapus(v,event){
    event.preventDefault(); //prevent default action 
    var r = confirm(\"Yakin Hapus Data Ini?\");
    if (r == true) {
        return true;
        } else {
            return false;
        }
        post_url = \"<?php echo site_url('$c_url/delete/')?>\"+v;

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

                    $.growl.notice({ message: \"Hapus Sukses!\" });
                  // $.growl.error({ message: \"The kitten is attacking!\" });

                    setTimeout(function () {
                        update_datatable();                       
                        }, 1000);
                        }else{
                            $.growl.warning({ message: \"Hapus gagal!\" });
                            $(\".btn\").css('display','inline');

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
                            url : '<?php echo site_url('$c_url/get_data') ?>',
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
                                    info: true,         // Will show \"1 to n of n entries\" Text at bottom
                                    lengthChange: false, // Will Disabled Record number per page
                                    columns: [
                                    { title: \"No\" ,\"width\" : \"5%\" },
                                    { title: datae.judul[1] },
                                    { title: datae.judul[2] },
                                    { title: \"Aksi\" ,\"width\" : \"27 %\" }
                                    ],
                                    order:[[0,'asc']]
                                    } );
                                    });

                                    \$(\"#postForm\").submit(function(event){
                                        event.preventDefault(); //prevent default action 
                                        var form_data = \$('#postForm').serialize(); //Encode form elements for submission

                                        console.log(form_data);

                                        \$.ajax({
                                         url : '<?php echo site_url('$c_url/get_data') ?>',
                                         type: 'POST',
                                         data : form_data,
                                         dataType : 'json',
                                         }).done(function(response){
                                            datae=response;
                                            \$('#dtables').DataTable().clear().destroy();
                                            \$('#dtables').DataTable( {
                                                fixedColumns: true,
                                                data: datae.isi,
                                                searching: false,   // Search Box will Be Disabled
                                                ordering: true,    // Ordering (Sorting on Each Column)will Be Disabled
                                                info: true,         // Will show \"1 to n of n entries\" Text at bottom
                                                lengthChange: false, // Will Disabled Record number per page
                                                columns: [
                                                { title: \"No\" ,\"width\" : \"5%\" },
                                                { title: datae.judul[1] },
                                                { title: datae.judul[2] },
                                                { title: \"Aksi\" ,\"width\" : \"27 %\" }
                                                ],
                                                order:[[0,'asc']]
                                                });
                                                });
                                                });




                                                } );

                                                function update_datatable(){
                                                    \$.ajax({
                                                     url : '<?php echo site_url('$c_url/get_data') ?>',
                                                     type: 'POST',
                                                     data : {},
                                                     dataType : 'json',
                                                     }).done(function(response){
                                                        datae=response;
                                                        \$('#dtables').DataTable().clear().destroy();
                                                        \$('#dtables').DataTable( {

                                                            data: datae.isi,
                                                            columns: [
                                                            { title: \"No\",\"width\" : \"5%\"  },
                                                            { title: datae.judul[1] },
                                                            { title: datae.judul[2] },
                                                            { title: \"Aksi\",\"width\" : \"25%\"  }
                                                            ],
                                                            order:[[0,'asc']]
                                                            });
                                                            });
                                                        }
                                                        </script>";


                                                        $hasil_view_list = createFile($string, $target."views/" . $c_url . "/" . $v_list_file);

                                                        ?>