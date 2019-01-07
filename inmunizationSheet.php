<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 28/11/2018
 * Time: 22:53
 */

define('FPDF_FONTPATH','font/');
require('fpdf.php');

class PDF extends FPDF
{


    function Header(){
        $this->SetFont('Arial','B',12);
        $this->Cell(17,10,'INMUNIZATION SHEET',0,0,'L');
        $this->Line(25, 25, 180, 25);
        $this->Ln(25);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->Line(25, 269, 180, 269);
    }

    function LoadData($file)
    {
        // Leer las líneas del fichero
        $lines = file($file);
        $data = array();
        foreach($lines as $line)
            $data[] = explode(';',trim($line));
        return $data;
    }

    function BasicTable($headers, $data)
    {
        // Cabecera
        foreach ($headers as $header) {
            $this->Cell(17, 7, $header, 1, 0, 'C');
        }
        $this->Ln();
        // Datos

        foreach($data as $row)
        {
            foreach($row as $col)
                $this->Cell(17,7,$col,1);
            $this->Ln();
        }
    }
}

if(isset($_GET['download'])) {
    $name = $_GET['name'];
    $pdf = new PDF('P','mm','A4');
    $data= $pdf->LoadData("datos.txt");
    $pdf->SetFont('Arial','',7);
    $pdf->SetLeftMargin(25);
    $pdf->SetRightMargin(25);

    //First page
    $pdf->AddPage();
    $text = "ANTIGEN: " . "\n";
    $text .= "CAGE: " .  "hohohohohohohohhohohohohohohohohho" . "\n";
    $text .= "INMUNIZATION PERIOD: " . "\n";
    $text .= "RESPONSIBLE INVESTIGATOR(S): " . "\n";
    $text .= "SPONSOR: " . "\n";
    $text .= "DATE: ";
    $pdf->MultiCell(0, 6, $text, 1, 'L');
    $pdf->Line(25, 80, 180, 80);
    $pdf->Ln(20);
    $pdf->SetFont('Arial','BU',12);
    $pdf->Cell(15, 7, 'ANTIGEN PREPARATION');

    //Second page
    $pdf->AddPage();

    //Third page
    $pdf->AddPage();
    //Download name
    $pdf->Output('I', $name . '.pdf');
}