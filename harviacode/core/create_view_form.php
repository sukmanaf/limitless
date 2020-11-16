<?php 

$string = "
    
<div class=\"panel panel-flat\">
    <div class=\"panel-heading\">
        <h5 class=\"panel-title\"><?php echo ucfirst(\$this->uri->segment(1)) ?></h5>
        <div class=\"heading-elements\">
            <ul class=\"icons-list\">
                <li><a data-action=\"collapse\"></a></li>
                <li><a data-action=\"reload\"></a></li>
                <li><a data-action=\"close\"></a></li>
            </ul>
        </div>
    </div>

    <div class=\"panel-body\">
        

        <form action=\"#\" id=\"postForm\" class=\"form-horizontal\" enctype=\"multipart/form-data\" method=\"post\">
            <fieldset class=\"content-group\">

        ";

foreach ($non_pk as $row) {
    if ($row["data_type"] == 'text')
    {
    $string .= "

                
                <div class=\"form-group\">
                    <label class=\"control-label col-lg-2\">".$row["column_name"]."</label>
                    <div class=\"col-lg-10\">
                        <textarea rows=\"5\" cols=\"5\" class=\"form-control\" name=\"".$row["column_name"]."\" placeholder=\"Default textarea\"><?php echo $".$row["column_name"]."; ?></textarea>
                    </div>
                </div>
                ";
    }else if ($row["data_type"] == 'date' || $row["data_type"] == 'datetime')
    {
    $string .= "


           <div class=\"form-group\">
                    <label class=\"control-label col-lg-2\">".$row["column_name"]."</label>
                    <div class=\"col-lg-10\">
                       <div class=\"input-group\">
                                            <span class=\"input-group-addon\"><i class=\"icon-calendar5\"></i></span>
                                            <input type=\"text\" id=\"".$row["column_name"]."\" name=\"".$row["column_name"]."\" value=\"<?php echo $".$row["column_name"]."; ?>\" class=\"form-control pickadate\" placeholder=\"Try me&hellip;\">
                                        </div>
                    </div>
                </div>";
    }else if ($row["data_type"] == 'timestamp')
    {
    $string .= "";

    } else
    {
    $string .= "
     

        <div class=\"form-group\">
                    <label class=\"control-label col-lg-2\">".$row["column_name"]."</label>
                    <div class=\"col-lg-10\">
                        <input type=\"text\" class=\"form-control\" id=\"".$row["column_name"]."\" name=\"".$row["column_name"]."\" value=\"<?php echo $".$row["column_name"]."; ?>\">
                    </div>
                </div>
        
        ";
    }
}
$string .="<div align=\"center\">
        <button type=\"submit\" class=\"btn btn-primary\"><i class=\"fas fa-save\"></i> <?php echo \$button ?></button>
        <a href=\"<?php echo site_url('".$c_url."') ?>\" class=\"btn btn-danger\"><i class=\"fas fa-arrow-circle-left\"></i> Kembali</a>
        </div>";
$string .= "\n\t    <input type=\"hidden\" name=\"".$pk."\" value=\"<?php echo $".$pk."; ?>\" /> ";
$string .= "\n\t</form>
    </div>
    </div>
    </div>
    <script >
$(document).ready(function() {
   // $('.summernote').summernote({
   //              height: \"700px\",
                
   //          });
$('#isi').summernote({
            height: 700,
            callbacks: {
                   onImageUpload: function(image) {
                               uploadImage(image[0]);
                           }
               }

            
        });

function uploadImage(image) {
        var data = new FormData();
        data.append(\"image\", image);
        $.ajax({
            url:'<?php echo site_url('$c_url/upload_summernote');?>', //URL submit
                     type:\"post\", //method Submit
                     data:data, //penggunaan FormData
                     processData:false,
                     contentType:false,
                     cache:false,
                     async:false,
            success: function(url) {
                console.log('url', url)
                var image = $('<img>').attr('src', url);
                $('#isi').summernote(\"insertNode\", image[0]);
            },
            error: function(data) {
                console.log('data', data)
            }
        });
    }


   $(\"#postForm\").submit(function(event){
        $(\".btn\").css('display','none');
        event.preventDefault(); //prevent default action 
        var post_url = '<?php echo \$action ?>'; //get form action url
        var request_method = $(this).attr(\"method\"); //get form GET/POST method
        var form_data = new FormData(this); //Encode form elements for submission
        
        if ($('#desc').summernote('codeview.isActivated')) {
            $('#desc').summernote('codeview.deactivate'); 
        }
        
        $.ajax({
            url : post_url,
            type: 'POST',
            data : form_data,
            processData:false,
                     contentType:false,
                     cache:false,
                     async:false,
        }).done(function(response){
            if (response == 1){

            // alert('Data Tersimpan');

            // $.notify(\"Data tersimpan\", \"success\");
            $.growl.notice({ message: \"Simpan Sukses!\" });
              // $.growl.error({ message: \"The kitten is attacking!\" });
              // $.growl.notice({ message: \"The kitten is cute!\" });
              // $.growl.warning({ message: \"The kitten is ugly!\" });
             
            setTimeout(function () {
                    window.location.replace('<?php echo site_url('$c_url') ?>')
                       
                    }, 2000);
                //    $.ajax({
                //              url:'<?php echo site_url('$c_url/do_upload');?>', //URL submit
                //              type:\"post\", //method Submit
                //              data:new FormData(this), //penggunaan FormData
                //              processData:false,
                //              contentType:false,
                //              cache:false,
                //              async:false,
                //               success: function(data){
                //                   alert(\"Upload Image Berhasil.\"); //alert jika upload berhasil
                //            }
                //          });
            }else{
                $.growl.warning({ message: \"Simpan gagal!\" });
                $(\".btn\").css('display','inline');

            }
        });

        
    });
});

    


</script>
";

$hasil_view_form = createFile($string, $target."views/" . $c_url . "/" . $v_form_file);

?>