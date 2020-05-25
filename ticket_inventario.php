<?php

require('libreria/reportePDF/fpdf.php');

class PDF extends FPDF
{

    function Header()
    {
        $this->SetDrawColor(89,155,179);
        $this->SetFillColor(255,0,0);
        $this->SetTextColor(0,0,0);
        // Logo
        //$this->Image('imagenes/transporte.jpg',10,8,33);
        // Arial bold 15
        $this->SetFont('Arial','B',25);
        // Título
        $this->Cell(0,20,'Su traje elegante',0,0,'C');

        $this->SetDrawColor(0,80,180);
        $this->SetFillColor(230,230,0);
        $this->SetTextColor(255,0,0);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Título
        $this->Cell(0,45,'Inventario de prendas',0,0,'R');
        $this->Ln(45);       

        $this->SetFont('Arial','B',10);

        $this->Cell(25,10,'Ticket',1, 0, 'C', 0);
        $this->Cell(30,10,'Documento' ,1, 0, 'C', 0);
        $this->Cell(20,10,'Cantidad' ,1, 0, 'C', 0);
        $this->Cell(50,10,'Prendas' ,1, 0, 'C', 0);
        $this->Cell(25,10,'Ingreso' ,1, 0, 'C', 0);
        $this->Cell(40,10,'Arreglo' ,1, 1, 'C', 0);
    }
// Pie de página
    function Footer()
    {
        $this->SetDrawColor(89,155,179);
        $this->SetFillColor(255,0,0);
        $this->SetTextColor(0,0,0);
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','',7);
        // Número de página
        $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
    }
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

include('includes/cn.php');

$consulta="SELECT * from arreglos where estado = 'por entregar' and tipo_arreglo = 'arreglo' /*or estado = 'por entregar' and tipo_arreglo = 'sobremedida'*/";
$resultado = mysqli_query($conexion,$consulta);
while($mostrar = mysqli_fetch_array($resultado))
{
    $pdf->SetDrawColor(0,80,180);
    $pdf->SetFillColor(230,230,0);
    $pdf->SetTextColor(0,0,0);

    $pdf->Cell(25,10,$mostrar['id'] ,1, 0, 'C', 0);
    $pdf->Cell(30,10,$mostrar['doc_cli'] ,1, 0, 'C', 0);
    $pdf->Cell(20,10,$mostrar['cantidad'] ,1, 0, 'C', 0);
    $pdf->Cell(50,10,$mostrar['tipo_prendas'] ,1, 0, 'C', 0);
    $pdf->Cell(25,10,$mostrar['fec_ingreso'] ,1, 0, 'C', 0);
    $pdf->Cell(40,10,$mostrar['arreglo'] ,1, 1, 'C', 0);
}


$pdf->Output();
?>