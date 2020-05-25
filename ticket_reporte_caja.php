<?php

require('libreria/reportePDF/fpdf.php');
$fecha3 = 0;

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
        $this->Cell(0,45,'Reporte de caja por fechas',0,0,'R');
        $this->Ln(45);       

        $this->SetFont('Arial','B',10);

        $this->Cell(25,10,utf8_decode('Fecha de caja'),1, 0, 'C', 0);
        $this->Cell(35,10,utf8_decode('Venta registrada') ,1, 0, 'C', 0);
        $this->Cell(35,10,'Fecha de registro' ,1, 0, 'C', 0);
        $this->Cell(50,10,utf8_decode('Usuario') ,1, 0, 'C', 0);
        $this->Cell(40,10,'Rol' ,1, 1, 'C', 0);
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

$pdf = new PDF('L', 'mm', array(139.7,215.9));
$pdf->AliasNbPages();
$pdf->AddPage();

include('includes/cn.php');

$fecha1 = $_POST['fecha1'];
$fecha2 = $_POST['fecha2'];

$consulta = "Select * from caja inner join usuarios on usuario_registra_caja = id inner join roles on cod_rol = N_rol where dia_caja between '$fecha1' and '$fecha2' ";
$resultado = mysqli_query($conexion,$consulta);
while($mostrar = mysqli_fetch_array($resultado))
{
    $pdf->SetDrawColor(0,80,180);
    $pdf->SetFillColor(230,230,0);
    $pdf->SetTextColor(0,0,0);

    $pdf->Cell(25,10,$mostrar['dia_caja'] ,1, 0, 'C', 0);
    $pdf->Cell(35,10,'$ '.number_format($mostrar['venta_caja']) ,1, 0, 'C', 0);
    $pdf->Cell(35,10,$mostrar['fec_registro'] ,1, 0, 'C', 0);
    $pdf->Cell(50,10,$mostrar['nombre'] ,1, 0, 'C', 0);
    $pdf->Cell(40,10,$mostrar['tipo_rol'] ,1, 1, 'C', 0);
}


$pdf->Output();
?>