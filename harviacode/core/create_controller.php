<?php

$string = "<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class " . $c . " extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        \$this->load->model('$m');
        \$this->load->library('form_validation');";

if ($jenis_tabel <> 'reguler_table') {
    $string .= "        \n\t\$this->load->library('datatables');";
}
        
$string .= "
    }";

if ($jenis_tabel == 'reguler_table') {
    
$string .= "\n\n    public function index()
    {
        \$q = urldecode(\$this->input->get('q', TRUE));
        \$start = intval(\$this->input->get('start'));
        
        if (\$q <> '') {
            \$config['base_url'] = base_url() . '$c_url/index.html?q=' . urlencode(\$q);
            \$config['first_url'] = base_url() . '$c_url/index.html?q=' . urlencode(\$q);
        } else {
            \$config['base_url'] = base_url() . '$c_url/index.html';
            \$config['first_url'] = base_url() . '$c_url/index.html';
        }

        \$config['per_page'] = 10;
        \$config['page_query_string'] = TRUE;
        \$config['total_rows'] = \$this->" . $m . "->total_rows(\$q);
        \$$c_url = \$this->" . $m . "->get_limit_data(\$config['per_page'], \$start, \$q);

        \$this->load->library('pagination');
        \$this->pagination->initialize(\$config);

        \$data = array(
            '" . $c_url . "_data' => \$$c_url,
            'q' => \$q,
            'pagination' => \$this->pagination->create_links(),
            'total_rows' => \$config['total_rows'],
            'start' => \$start,
        );
        \$this->load->view('$c_url/$v_list', \$data);
    }";

} else {
    
$string .="\n\n    public function index()
    {
        \$this->skin->dashboard('$c_url/$v_list',null);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo \$this->" . $m . "->json();
    }


    public function get_data()
    {   

        \$cari =[
        ";
$cari=array();
foreach ($all as $key => $value) {
    if($key == 1){

        $string .= "\t\t'".$value['column_name']."'=>@\$_POST['".$value['column_name']."_search_name'],\n";
    }else if ($key > 1 && $key < 4) {
        
        // $cari[$value['column_name']] = $value['column_name'];
        $string .= "\t\t\t\t'".$value['column_name']."'=>@\$_POST['".$value['column_name']."_search_name'],\n";
        

    }else if($key == 4){

    $string .= "\t\t\t\t'".$value['column_name']."'=> @\$_POST['".$value['column_name']."_search_name']\n";
    }
}

// echo "<pre>";
// print_r ($all);
// echo "</pre>";exit();

 



$string .= "
                ];
            \$dataq = \$this->".$m."->get_all(\$cari);
        \$judul=[];
        \$data['isi']=[];
        foreach (\$dataq as \$key => \$v) {
            foreach (\$v as \$k => \$val) {
                  array_push(\$judul, \$k);
            }            
            \$a= [\$key+1,\$v->".$all[1]['column_name'].",\$v->".$all[2]['column_name'].",
                 '<a href=\"'. site_url(\"$c_url/read/\").\$v->".$all[0]['column_name'].".'\" class=\"btn-xs btn-primary\"> Lihat</a>
                 <a href=\"'. site_url(\"$c_url/update/\").\$v->".$all[0]['column_name'].".'\" class=\"btn-xs btn-info\"> Ubah</a>

                  <a href=\"#\" class=\"btn-xs btn-danger\" onclick=\"hapus('.\$v->". $all[0]['column_name'].".',event)\"> Hapus</a>
                 '];
            // <button  class=\"btn-sm btn-danger\" onclick=\"hapus('.\$v->". $all[0]['column_name'].".',event)\"><i class=\"fas fa-trash\"></i> hapus</button>
            array_push(\$data['isi'], \$a);
        }
        \$data['judul']=\$judul;

        echo json_encode(\$data);
    }

       public function show()
    {

        \$row = \$this->".$m."->get_all();
        if (\$row) {
            \$row=\$row[0];
            \$data = array(
                    'id_".$all[0]['column_name']."' => \$row->".$all[0]['column_name'].",
                    'judul' => \$row->judul,
                    'isi' => \$row->isi,
                    'tanggal' => \$row->tanggal,
                    'user_id' => \$row->id_user,
            );
            //\$da['a']=\$dataq;
            \$this->skin->view('data_show', \$data);
        } else {
            \$this->session->set_flashdata('message', 'Record Not Found');
            \$this->load->view('error404');
            
        }
    }
        public function do_upload(){
    
        \$path = \$_FILES['file']['name'];
        \$ext = pathinfo(\$path, PATHINFO_EXTENSION);
        \$nama = str_replace(' ', '', \$this->input->post('judul')).'.'.\$ext;
    
            \$config['upload_path']          = './image/';
            \$config['allowed_types']        = 'gif|jpg|png';
            \$config['file_name']            = \$nama;
            // echo \$config['file_name'];exit();
            // \$config['file_name']            = 'anu';
            // \$config['max_size']             = 1000000;
            // \$config['max_width']            = 1024;
            // \$config['max_height']           = 768;
  
            \$this->load->library('upload', \$config);
            if ( ! \$this->upload->do_upload('file'))
            {
                    \$error = array('error' => \$this->upload->display_errors());
                    echo json_encode(\$error);
                    // \$this->skin->dashboard('upload_form', \$error);
            }
            else
            {
                    \$data = array('upload_data' => \$this->upload->data());
                    echo base_url().'image/'.\$data['upload_data']['file_name'];
            }
        }


        public function upload_summernote()
    {

        \$config['upload_path']          = './image/summernote/';
        \$config['allowed_types']        = 'gif|jpg|png';
        \$config['file_name']            = date('YmdHis');
        // echo \$config['file_name'];exit();
        // \$config['file_name']            = 'anu';
        // \$config['max_size']             = 1000000;
        // \$config['max_width']            = 1024;
        // \$config['max_height']           = 768;
        
        \$this->load->library('upload', \$config);
        // echo json_encode(\$_FILES);exit();
        if ( ! \$this->upload->do_upload('image'))
        {
                \$error = array('error' => \$this->upload->display_errors());
                echo json_encode(\$error);
        }
        else
        {
                \$data = array('upload_data' => \$this->upload->data());
                echo base_url().'image/summernote/'.\$data['upload_data']['file_name'];
        }
    }

    ";

}
    
$string .= "\n\n    public function read(\$id) 
    {
        \$row = \$this->" . $m . "->get_by_id(\$id);
        if (\$row) {
            \$data = array(";
foreach ($all as $row) {
    $string .= "\n\t\t'" . $row['column_name'] . "' => \$row->" . $row['column_name'] . ",";
}
$string .= "\n\t    );
            \$this->skin->dashboard('$c_url/$v_read', \$data);
        } else {
            \$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('$c_url'));
        }
    }

    public function create() 
    {
        \$data = array(
            'button' => 'Simpan',
            'action' => site_url('$c_url/create_action'),";
foreach ($all as $row) {
    $string .= "\n\t    '" . $row['column_name'] . "' => set_value('" . $row['column_name'] . "'),";
}
$string .= "\n\t);
        \$this->skin->dashboard('$c_url/$v_form', \$data);
    }
    
    public function create_action() 
    {
        
            \$data = array(";
foreach ($non_pk as $row) {
    $string .= "\n\t\t'" . $row['column_name'] . "' => \$this->input->post('" . $row['column_name'] . "'),";
}
$string .= "\n\t    );

            \$acc = \$this->".$m."->insert(\$data);
            echo \$acc;
    }
    
    public function update(\$id) 
    {
        \$row = \$this->".$m."->get_by_id(\$id);

        if (\$row) {
            \$data = array(
                'button' => 'Update',
                'action' => site_url('$c_url/update_action'),";
foreach ($all as $row) {
    $string .= "\n\t\t'" . $row['column_name'] . "' => set_value('" . $row['column_name'] . "', \$row->". $row['column_name']."),";
}
$string .= "\n\t    );
            \$this->skin->dashboard('$c_url/$v_form', \$data);
        } else {
            \$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('$c_url'));
        }
    }
    
    public function update_action() 
    {
        
            \$data = array(";
foreach ($non_pk as $row) {
    $string .= "\n\t\t'" . $row['column_name'] . "' => \$this->input->post('" . $row['column_name'] . "'),";
}    
$string .= "\n\t    );

            \$acc = \$this->".$m."->update(\$this->input->post('$pk', TRUE), \$data);
            echo \$acc;
        
    }
    
    public function delete(\$id) 
    {
        \$row = \$this->".$m."->get_by_id(\$id);

        if (\$row) {
           \$acc = \$this->".$m."->delete(\$id);
            echo \$acc;

        } else {
            \$this->session->set_flashdata('message', 'Record Not Found');
            echo 0;
        }
    }

    public function _rules() 
    {";
foreach ($non_pk as $row) {
    $int = $row3['data_type'] == 'int' || $row['data_type'] == 'double' || $row['data_type'] == 'decimal' ? '|numeric' : '';
    $string .= "\n\t\$this->form_validation->set_rules('".$row['column_name']."', '".  strtolower(label($row['column_name']))."', 'trim|required$int');";
}    
$string .= "\n\n\t\$this->form_validation->set_rules('$pk', '$pk', 'trim');";
$string .= "\n\t\$this->form_validation->set_error_delimiters('<span class=\"text-danger\">', '</span>');
    }";

if ($export_excel == '1') {
    $string .= "\n\n    public function excel()
    {
        \$this->load->helper('exportexcel');
        \$namaFile = \"$table_name.xls\";
        \$judul = \"$table_name\";
        \$tablehead = 0;
        \$tablebody = 1;
        \$nourut = 1;
        //penulisan header
        header(\"Pragma: public\");
        header(\"Expires: 0\");
        header(\"Cache-Control: must-revalidate, post-check=0,pre-check=0\");
        header(\"Content-Type: application/force-download\");
        header(\"Content-Type: application/octet-stream\");
        header(\"Content-Type: application/download\");
        header(\"Content-Disposition: attachment;filename=\" . \$namaFile . \"\");
        header(\"Content-Transfer-Encoding: binary \");

        xlsBOF();

        \$kolomhead = 0;
        xlsWriteLabel(\$tablehead, \$kolomhead++, \"No\");";
foreach ($non_pk as $row) {
        $column_name = label($row['column_name']);
        $string .= "\n\txlsWriteLabel(\$tablehead, \$kolomhead++, \"$column_name\");";
}
$string .= "\n\n\tforeach (\$this->" . $m . "->get_all() as \$data) {
            \$kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber(\$tablebody, \$kolombody++, \$nourut);";
foreach ($non_pk as $row) {
        $column_name = $row['column_name'];
        $xlsWrite = $row['data_type'] == 'int' || $row['data_type'] == 'double' || $row['data_type'] == 'decimal' ? 'xlsWriteNumber' : 'xlsWriteLabel';
        $string .= "\n\t    " . $xlsWrite . "(\$tablebody, \$kolombody++, \$data->$column_name);";
}
$string .= "\n\n\t    \$tablebody++;
            \$nourut++;
        }

        xlsEOF();
        exit();
    }";
}

if ($export_word == '1') {
    $string .= "\n\n    public function word()
    {
        header(\"Content-type: application/vnd.ms-word\");
        header(\"Content-Disposition: attachment;Filename=$table_name.doc\");

        \$data = array(
            '" . $table_name . "_data' => \$this->" . $m . "->get_all(),
            'start' => 0
        );
        
        \$this->load->view('" . $c_url ."/". $v_doc . "',\$data);
    }";
}

if ($export_pdf == '1') {
    $string .= "\n\n    function pdf()
    {
        \$data = array(
            '" . $table_name . "_data' => \$this->" . $m . "->get_all(),
            'start' => 0
        );
        
        ini_set('memory_limit', '32M');
        \$html = \$this->load->view('" . $c_url ."/". $v_pdf . "', \$data, true);
        \$this->load->library('pdf');
        \$pdf = \$this->pdf->load();
        \$pdf->WriteHTML(\$html);
        \$pdf->Output('" . $table_name . ".pdf', 'D'); 
    }";
}

$string .= "\n\n}\n\n/* End of file $c_file */
/* Location: ./application/controllers/$c_file */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator ".date('Y-m-d H:i:s')." */
/* http://harviacode.com */";




$hasil_controller = createFile($string, $target . "controllers/" . $c_file);

?>