<?php

session_start();

require('libreria/reportePDF/fpdf.php');
include('includes/cn.php');

//si es una reimpresion del ticket
if(isset($_GET['id']))
{
    $cod_reim = $_GET['id'];

    $consulta = "SELECT * from arreglos inner join clientes on doc_cli = doc_cliente where id = '$cod_reim' ";
    $resultado = mysqli_query($conexion,$consulta);
    $mostrar = mysqli_fetch_array($resultado);

    $ticket = $mostrar['id'];
    $doc_cliente = $mostrar['doc_cliente'];
    $nom_cliente = $mostrar['nom_cliente'];
    $ape_cliente = $mostrar['ape_cliente'];
    $tipo_arreglo = $mostrar['tipo_arreglo'];
    $fec_ingreso = $mostrar['fec_ingreso'];
    $fec_entregado = $mostrar['fec_entregado'];
    $cantidad = $mostrar['cantidad'];
    $tipo_prendas = $mostrar['tipo_prendas'];
    $arreglo = $mostrar['arreglo'];
    $total_arreglo = $mostrar['total_arreglo'];
    $abono = $mostrar['abono'];
    $abono_2 = $mostrar['abono_2'];
    $estado = $mostrar['estado'];
    $observaciones = $mostrar['observaciones'];
    $saldo = $mostrar['saldo'];
}
//si es el ticket generado despues de la venta
else
{
    $id_ticket = $_SESSION['entrega'];

    $consulta2 = "SELECT * from arreglos inner join clientes on doc_cli = doc_cliente where id = '$id_ticket' ";
    $resultado2 = mysqli_query($conexion,$consulta2);
    $mostrar2 = mysqli_fetch_array($resultado2);

    $ticket = $mostrar2['id'];
    $doc_cliente = $mostrar2['doc_cliente'];
    $nom_cliente = $mostrar2['nom_cliente'];
    $ape_cliente = $mostrar2['ape_cliente'];
    $tipo_arreglo = $mostrar2['tipo_arreglo'];
    $fec_ingreso = $mostrar2['fec_ingreso'];
    $fec_entregado = $mostrar2['fec_entregado'];
    $cantidad = $mostrar2['cantidad'];
    $tipo_prendas = $mostrar2['tipo_prendas'];
    $arreglo = $mostrar2['arreglo'];
    $total_arreglo = $mostrar2['total_arreglo'];
    $abono = $mostrar2['abono'];
    $abono_2 = $mostrar2['abono_2'];
    $estado = $mostrar2['estado'];
    $observaciones = $mostrar2['observaciones'];
    $saldo = $mostrar2['saldo'];
}

class PDF extends FPDF
{
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


    $pdf->SetDrawColor(89,155,179);
    $pdf->SetFillColor(255,0,0);
    $pdf->SetTextColor(0,0,0);

    $pdf->SetFont('Arial','B',25);
    // Movernos a la derecha
    // Título
    $pdf->Cell(0,10,'Su traje elegante',0,0,'C');

    $pdf->SetDrawColor(89,155,179);
    $pdf->SetFillColor(255,0,0);
    $pdf->SetTextColor(255,0,0);
    // Arial bold 15
    $pdf->SetFont('Arial','B',15);
    // Movernos a la derecha
    $pdf->Cell(60);
    // Título
    $pdf->Cell(0,30,'Ticket de servicio',0,0,'R');
    $pdf->Ln(8);

    $pdf->SetFont('Arial','B',20);
    $pdf->Cell(0,30,'S-000'.$ticket,0,0,'R');
    // Salto de línea
    $pdf->Ln(10);

    $pdf->SetDrawColor(89,155,179);
    $pdf->SetFillColor(255,0,0);
    $pdf->SetTextColor(89,155,179);

    $pdf->SetFont('Arial','B',10);

    $pdf->Cell(20,10,utf8_decode('Factura N°'),1, 0, 'C', 0);
    $pdf->Cell(30,10,utf8_decode('Fecha ingreso'),1, 0, 'C', 0);

    $pdf->SetDrawColor(255,0,0);
    $pdf->SetFillColor(255,0,0);
    $pdf->SetTextColor(255,0,0);

    $pdf->Cell(30,10,utf8_decode('Fecha entrega') ,1, 1, 'C', 0);

    $pdf->SetDrawColor(89,155,179);
    $pdf->SetFillColor(255,0,0);
    $pdf->SetTextColor(0,0,0);

    $pdf->Cell(20,10,$ticket ,1, 0, 'C', 0);
    $pdf->Cell(30,10,$fec_ingreso ,1, 0, 'C', 0);

    $pdf->SetDrawColor(255,0,0);
    $pdf->SetFillColor(255,0,0);
    $pdf->SetTextColor(255,0,0);

    $pdf->Cell(30,10,$fec_entregado ,1, 1, 'C', 0);

    $pdf->Ln(1);

    $pdf->SetDrawColor(89,155,179);
    $pdf->SetFillColor(255,0,0);
    $pdf->SetTextColor(89,155,179);

    $pdf->Cell(40,10,'Documento' ,1, 0, 'C', 0);
    $pdf->Cell(60,10,'Nombres' ,1, 0, 'C', 0);
    $pdf->Cell(65,10,'Apellidos' ,1, 0, 'C', 0);
    $pdf->Cell(30,10,'Tipo servicio' ,1, 1, 'C', 0);

    $pdf->SetDrawColor(89,155,179);
    $pdf->SetFillColor(255,0,0);
    $pdf->SetTextColor(0,0,0);

    $pdf->Cell(40,10,$doc_cliente ,1, 0, 'C', 0);
    $pdf->Cell(60,10,utf8_decode($nom_cliente) ,1, 0, 'C', 0);
    $pdf->Cell(65,10,utf8_decode($ape_cliente) ,1, 0, 'C', 0);
    $pdf->Cell(30,10,utf8_decode($tipo_arreglo) ,1, 1, 'C', 0);

    $pdf->Ln(1);

    $pdf->SetDrawColor(89,155,179);
    $pdf->SetFillColor(255,0,0);
    $pdf->SetTextColor(89,155,179);

    $pdf->Cell(35,10,'Cantidad prendas' ,1, 0, 'C', 0);
    $pdf->Cell(40,10,'Tipo prendas' ,1, 0, 'C', 0);
    $pdf->Cell(120,10,'Servicio solicitado' ,1, 1, 'C', 0);

    $pdf->SetDrawColor(89,155,179);
    $pdf->SetFillColor(255,0,0);
    $pdf->SetTextColor(0,0,0);

    $pdf->Cell(35,10,$cantidad ,1, 0, 'C', 0);
    $pdf->Cell(40,10,utf8_decode($tipo_prendas) ,1, 0, 'C', 0);
    $pdf->Cell(120,10,utf8_decode($arreglo) ,1, 1, 'L', 0);

    $pdf->Ln(1);

    $pdf->SetDrawColor(89,155,179);
    $pdf->SetFillColor(255,0,0);
    $pdf->SetTextColor(89,155,179);

    $pdf->Cell(30,10,'Total servicio' ,1, 0, 'C', 0);
    $pdf->Cell(30,10,'Abono' ,1, 0, 'C', 0);
    $pdf->Cell(30,10,'Saldo' ,1, 0, 'C', 0);
    $pdf->Cell(105,10,'Observaciones' ,1, 1, 'C', 0);

    $pdf->SetDrawColor(89,155,179);
    $pdf->SetFillColor(255,0,0);
    $pdf->SetTextColor(0,0,0);

    $pdf->Cell(30,10,'$ '.number_format($total_arreglo) ,1, 0, 'C', 0);
    $pdf->Cell(30,10,'$ '.number_format($abono) ,1, 0, 'C', 0);
    $pdf->Cell(30,10,'$ '.number_format($saldo) ,1, 0, 'C', 0);
    $pdf->Cell(105,10,utf8_decode($observaciones) ,1, 1, 'L', 0);

$pdf->Output();
?>