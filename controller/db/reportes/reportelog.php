<?php 

ob_start();
SESSION_START();
header("Content-Type: text/html;charset=utf-8");

date_default_timezone_set("America/Guatemala");
setlocale(LC_TIME, 'Spanish_Guatemala');
//$cl_name = $_SESSION['cl_name'];    

    //conectar a base de datos
     require_once ('../cone.php');


  $conect = new basedatos;
  $conect -> conectarBD();


/** Include PHPExcel */
require_once '../classes/PHPExcel.php';

//$tipo =$_POST['tipoRepo'];

$fechain =$_POST['fechain'];
$fechades =$_POST['fechades'];

//if ($tipo == 'Fibertec'){

/** Error reporting */
error_reporting(E_ALL);
ini_set('memory_limit', '1G');
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
  die('This example should only be run from a Web Browser');

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
               ->setLastModifiedBy("Maarten Balliauw")
               ->setTitle("Office 2007 XLSX Test Document")
               ->setSubject("Office 2007 XLSX Test Document")
               ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
               ->setKeywords("office 2007 openxml php")
               ->setCategory("Test result file");

$fechaIn  = $_POST['fechain'];
$fechades  = $_POST['fechades'];

   //query
  $query="SELECT * FROM logs where fecha between '$fechaIn' and '$fechades'";

  //mandar informacion a la base de datos
  $hquery=mysqli_query($conect-> conectarBD(), $query);

  //validar datos
  $numdelineas=mysqli_num_rows($hquery);

if ($numdelineas > 0) {


////Titulos
    // Add some data

$objPHPExcel->setActiveSheetIndex(0)
  ->setCellValue('A1', 'Nombre Cliente')
  ->setCellValue('B1', 'Usuario')
  ->setCellValue('C1', 'Funcion')
  ->setCellValue('D1', 'Accion')
  ->setCellValue('E1', 'Fecha_hora');
  
                     
              
                         

$ind = 2;

  while($row=$hquery->fetch_assoc()){





               $objPHPExcel->setActiveSheetIndex(0)
  ->setCellValue('A'.$ind, $row['cliente'])
  ->setCellValue('B'.$ind, $row['usuario'])
  ->setCellValue('C'.$ind, $row['funcion'])
  ->setCellValue('D'.$ind, $row['accion'])
  ->setCellValue('E'.$ind, $row['fecha']);

              


            $ind++;

              }

          


}else{
  // Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Datos')
            ->setCellValue('A2', 'No hay Datos');
}




// Rename worksheet
$objPHPExcel->getActiveSheet(0)->setTitle('Logs Sistema MotoCity');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Reporteria_logs_MotoCity.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');



//vaciar datos
mysqli_close($conect -> conectarBD());
ob_end_flush();

exit;


//echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";



?>