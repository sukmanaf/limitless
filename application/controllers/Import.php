<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Import extends CI_Controller {


public function __construct()
{
	parent::__construct();
	$this->load->model('m_main','main');
}
	public function index()
	{
		$data = null;
		$this->load->view('import_excel.php', $data, FALSE);	
	}



	public function upload(){
    
    // echo "<pre>";
    // print_r ($_FILES);
    // echo "</pre>";exit();

  $file   = explode('.',$_FILES['file']['name']);
  $length = count($file);
  if($file[$length -1] == 'xlsx' || $file[$length -1] == 'xls'){
   $tmp    = $_FILES['file']['tmp_name'];
   $this->load->library('excel');
   $read   = PHPExcel_IOFactory::createReaderForFile($tmp);
   $read->setReadDataOnly(true);
   $excel  = $read->load($tmp);
   $secval = $excel->getproperties()->gettitle();
   $sheets = $read->listWorksheetNames($tmp); 
   // echo "<pre>";
   // print_r ($sheets);
   // echo "</pre>";exit();
   foreach($sheets as $sheet){
    $_sheet = $excel->setActiveSheetIndexByName($sheet);
    $maxRow = $_sheet->getHighestRow();
    $maxCol = $_sheet->getHighestColumn();
//     #Security Validation


    $field  = array();
    $sql    = array();
    $realmaxRow = $maxRow;
    $maxCol = range('A', $maxCol);

      for($i = 2; $i <= $maxRow; $i++){
      	$arr = array(
          // $sql[$i]['merek'] = $_sheet->getCell("A$i")->getCalculatedValue();
          'jenis' => $_sheet->getCell("B$i")->getCalculatedValue(),
          'harga' => $_sheet->getCell("C$i")->getCalculatedValue(),
          'angsuran12' => $_sheet->getCell("D$i")->getCalculatedValue(),
          'dp12' => $_sheet->getCell("E$i")->getCalculatedValue(),
          'angsuran24' => $_sheet->getCell("F$i")->getCalculatedValue(),
          'dp24' => $_sheet->getCell("G$i")->getCalculatedValue(),
          'angsuran36' => $_sheet->getCell("H$i")->getCalculatedValue(),
          'dp36' => $_sheet->getCell("I$i")->getCalculatedValue(),
          'angsuran48' => $_sheet->getCell("J$i")->getCalculatedValue(),
          'dp48' => $_sheet->getCell("K$i")->getCalculatedValue(),
          'angsuran60' => $_sheet->getCell("L$i")->getCalculatedValue(),
          'dp60' => $_sheet->getCell("M$i")->getCalculatedValue()
      	);
      	array_push($sql, $arr);
      }
    }

    // echo "<pre>";
    // print_r ($sql);
    // echo "</pre>";exit();

    if (!empty($sql)) {
      $data['data'] = $sql;
      
      
      $ins = $this->db->insert_batch('jenis_mobil', $sql);
      // echo $this->db->last_query();;
      if ($ins) {
          echo 'sukses';
      }else{
        echo 'gagal';
      }    
    }else{
      echo 'gagal';
    }

    
//     redirect("Siswa"); // Redirect ke halaman awal (ke controller siswa fungsi index)
    }
  }
	public function upload_buana(){
    
    // echo "<pre>";
    // print_r ($_FILES);
    // echo "</pre>";exit();

  $file   = explode('.',$_FILES['file']['name']);
  $length = count($file);
  if($file[$length -1] == 'xlsx' || $file[$length -1] == 'xls'){
   $tmp    = $_FILES['file']['tmp_name'];
   $this->load->library('excel');
   $read   = PHPExcel_IOFactory::createReaderForFile($tmp);
   $read->setReadDataOnly(true);
   $excel  = $read->load($tmp);
   $secval = $excel->getproperties()->gettitle();
   $sheets = $read->listWorksheetNames($tmp); 
   // echo "<pre>";
   // print_r ($sheets);
   // echo "</pre>";exit();
   foreach($sheets as $sheet){
    $_sheet = $excel->setActiveSheetIndexByName($sheet);
    $maxRow = $_sheet->getHighestRow();
    $maxCol = $_sheet->getHighestColumn();
//     #Security Validation


    $field  = array();
    $arr    = array();
    $sql    = array();
    $realmaxRow = $maxRow;
    $maxCol = range('A', $maxCol);
    $merek='';
      for($i = 2; $i <= $maxRow; $i++){
          $tenor = intval($_sheet->getCell("C$i")->getCalculatedValue())+1;
          $merk =  $_sheet->getCell("A$i")->getCalculatedValue();
      	$arr_baru = array(
          'jenis' => $_sheet->getCell("A$i")->getCalculatedValue(),
          'harga' => $_sheet->getCell("B$i")->getCalculatedValue(),
          'angsuran'.$tenor => $_sheet->getCell("D$i")->getCalculatedValue(),
          'dp'.$tenor => $_sheet->getCell("E$i")->getCalculatedValue(),
          'id_mobil' => $_sheet->getCell("F$i")->getCalculatedValue(),
 
      	);
     
      	if ($merek != $merk) {
      		if ($merk != '') {
      		$sql[$merk] = $arr_baru;
      			
      		}
      	}else{
      		$as= 'angsuran'.$tenor;
      		$dp= 'dp'.$tenor;
      		$sql[$merk][$as] = $_sheet->getCell("D$i")->getCalculatedValue();
      		$sql[$merk][$dp] = $_sheet->getCell("E$i")->getCalculatedValue();
      		// $sql->angsuran.$tenor = $_sheet->getCell("D$i")->getCalculatedValue();
      		// $sql->dp.$tenor = $_sheet->getCell("E$i")->getCalculatedValue();
      	}
          $merek =  $merk;
      }
    }
    $sql2= array();
    foreach ($sql as $key => $value) {
    	
    	array_push($sql2, $value);
    }
    unset($sql2[17]);

    if (!empty($sql2)) {
      $data['data'] = $sql2;
      
    // echo "<pre>";
    // print_r ($sql2);
    // echo "</pre>";exit();
      foreach ($sql2 as $key => $value) {
        
      $ins = $this->db->insert('jenis_mobil', $value);
      }
      // echo $this->db->last_query();;
      if ($ins) {
          echo 'sukses';
      }else{
        echo 'gagal';
      }    
    }else{
      echo 'gagal';
    }

    
//     redirect("Siswa"); // Redirect ke halaman awal (ke controller siswa fungsi index)
    }
  }

}

/* End of file Import.php */
/* Location: ./application/controllers/Import.php */