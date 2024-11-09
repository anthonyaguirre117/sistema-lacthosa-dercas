<?php 
require('./fpdf181/fpdf.php');

class PDF extends FPDF
{

/*/ Cabecera de página
function Header()
{
    // Logo
    //$this->Image('',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',20);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(30,20,utf8_decode(''),0,0,'C');
    // Salto de línea
    $this->Ln(5);
}*/

/*
var $col = 0;

function SetCol($col)
{
    // Move position to a column
    $this->col = $col;
    $x = 10+$col*65;
    $this->SetLeftMargin($x);
    $this->SetX($x);
}

function AcceptPageBreak()
{
    if($this->col<2)
    {
        // Go to next column
        $this->SetCol($this->col+1);
        $this->SetY(10);
        return false;
    }
    else
    {
        // Regrese a la primera columna y emita un salto de página
        $this->SetCol(0);
        return true;
    }
}*/


/*
// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(0);
    // Arial italic 8
 //     $this->Image('../app/img/express.png',53,250,50);
   //   $this->Image('../app/img/1715.png',65,275,26);
    //$this->SetFont('Arial','I',8);
    //$this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'R');


    $this->SetY(0);
    $this->MultiCell(180,5,utf8_decode(''), 0,'C',0);

  

}*/

}



 ?>