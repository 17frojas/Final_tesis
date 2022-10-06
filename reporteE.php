<?php 

require('fpdf/fpdf.php');
require 'conexion.php';

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    $this->SetFont('Times','B',20);
    $this->Image('img/logo.png',0,0,70); //imagen(archivo, png/jpg || x,y,tamaño)
    $this->setXY(60,15);
    $this->Cell(100,8,'Reporte de Estudiantes',0,1,'C',0);
    $this->Ln(40);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','B',10);
    // Número de página
    $this->Cell(170,10,'SISTEMA UDENAR TESIS',0,0,'C',0);
    $this->Cell(25,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}

// // $query = "SELECT e.estado, m.id_municipio, m.municipio FROM t_municipio AS m INNER JOIN t_estado AS e ON m.id_estado=e.id_estado";

$stmt = $mysqli->prepare("SELECT * FROM estudiantes");
$stmt->execute();
$stmt->store_result();
$num = $stmt->num_rows;
$stmt->close();

// Creación del objeto de la clase heredada
$pdf = new PDF();//hacemos una instancia de la clase
$pdf->AliasNbPages();
$pdf->AddPage();//añade l apagina / en blanco
$pdf->SetMargins(2,10,10);
$pdf->SetAutoPageBreak(true,20);//salto de pagina automatico
////encabezado de la tabla
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',10);

