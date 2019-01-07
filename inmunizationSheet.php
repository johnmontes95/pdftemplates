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
    $pdf->SetFont('Arial','',9);
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
    $pdf->MultiCell(0, 6.2, $text, 1, 'L');
    $pdf->Line(25, 80, 180, 80);
    $pdf->Ln(20);
    $pdf->SetFont('Arial','BU',12);
    $pdf->Cell(15, 7, 'ANTIGEN PREPARATION');

    $text1 = "ANTIGEN: " . "\n";
    $text1 .= " - Supplied by: " .  "hohohohohohohohhohohohohohohohohho" . "\n";
    $text1 .= " - Labeled: " . "\n";
    $text1 .= " - Date delivered: " . "\n";
    $text1 .= " - Format: " . "\n";
    $text1 .= " 1) " . "\n";
    $text1 .= " 2) Vol: " . "\n";
    $text1 .= " 3) Total vol. needed: " . "\n";
    $text1 .= " 4) Aliquots: " . "\n";
    $text1 .= " 5) Conc: " . "\n";
    $text1 .= " 6) Inject: " . "\n";
    $text1 .= "\n" . "\n" . "\n" ."\n" .
        "\n" . "\n" . "\n" . "\n" . "\n" . "\n" . "\n" . "\n" . "\n";

    $pdf->Ln(11);
    $pdf->SetFont('Arial','',9);
    $pdf->MultiCell(0, 6, $text1, 1, 'L');



    //Second page
    $pdf->AddPage();
    $pdf->SetFont('Arial','U',11);
    $pdf->Cell(15, 7, 'ANTIGEN EMULSION PREPARATION');
    $pdf->Ln(11);
    $pdf->SetFont('Arial','',9);
    $pdf->MultiCell(0, 200, '', 1, 'L');


    //Third page
    $pdf->AddPage();
    $pdf->Ln(8);
    $pdf->SetFont('Arial','BU',11);
    $pdf->Cell(15, 7, 'IMMUNIZATION PROCEDURE');
    $pdf->Ln(9);
    $pdf->SetFont('Arial','',10.5);
    $text2 = "Birds allocated (Birds ID, relevant notes on experimental" .
        " animals such as health, behaviour and welfare issues)";
    $pdf->MultiCell(0, 6, $text2);
    $pdf->Ln(5);

    $pdf->Cell(15, 5, "Immunization timeline");
    $pdf->Ln(5);

    $titles = array('INJ.', 'DAY', 'DATE', 'VOLUME(ul)', 'AMOUNT(ug)', 'TYPE', 'NOTES');

    
    //Download name
    $pdf->Output('I', $name . '.pdf');
}