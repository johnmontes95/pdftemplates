<?php

define('FPDF_FONTPATH','font/');
require('fpdf.php');

class PDF extends FPDF
{


    function Header(){
        $this->SetFont('Arial','B',12);
        $this->Cell(17,10,'IMMUNIZATION SHEET',0,0,'L');
        $x = $this->GetX();
        $y = $this->GetY();
        $this->Image("img/logo.png", $x+100, $y+1);
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

        //Table
        $x = $this->GetX();
        $y = $this->GetY();
        $text = "BIRD # " . "\n" . $data;
        $this->MultiCell(22, 12.5, $text, 1, 'C');
        $this->SetXY($x+22, $y);
        //First row
        $this->Cell(14, 5, $headers['0'], 1, 0, 'C');
        $this->Cell(14, 5, $headers['1'], 1, 0, 'C');
        $this->Cell(23, 5, $headers['2'], 1, 0, 'C');
        $this->Cell(24, 5, $headers['3'], 1, 0, 'C');
        $this->Cell(24, 5, $headers['4'], 1, 0, 'C');
        $this->Cell(19, 5, $headers['5'], 1, 0, 'C');
        $this->Cell(19, 5, $headers['6'], 1, 0, 'C');
        // Second row
        $this->SetXY($x+22, $y+5);
        $this->Cell(14, 5, '1', 1, 0, 'C');
        $this->Cell(14, 5, 'D0', 1, 0, 'C');
        $this->Cell(23, 5, '', 1, 0, 'C');
        $this->Cell(24, 5, '', 1, 0, 'C');
        $this->Cell(24, 5, '', 1, 0, 'C');
        $this->Cell(19, 5, '', 1, 0, 'C');
        $this->Cell(19, 5, '', 1, 0, 'C');

        //Third row
        $this->SetXY($x+22, $y+10);
        $this->Cell(14, 5, '2', 1, 0, 'C');
        $this->Cell(14, 5, 'D14', 1, 0, 'C');
        $this->Cell(23, 5, '', 1, 0, 'C');
        $this->Cell(24, 5, '', 1, 0, 'C');
        $this->Cell(24, 5, '', 1, 0, 'C');
        $this->Cell(19, 5, '', 1, 0, 'C');
        $this->Cell(19, 5, '', 1, 0, 'C');

        //Fourth row
        $this->SetXY($x+22, $y+15);
        $this->Cell(14, 5, '3', 1, 0, 'C');
        $this->Cell(14, 5, 'D28', 1, 0, 'C');
        $this->Cell(23, 5, '', 1, 0, 'C');
        $this->Cell(24, 5, '', 1, 0, 'C');
        $this->Cell(24, 5, '', 1, 0, 'C');
        $this->Cell(19, 5, '', 1, 0, 'C');
        $this->Cell(19, 5, '', 1, 0, 'C');

        //Fifth row
        $this->SetXY($x+22, $y+20);
        $this->Cell(14, 5, '4', 1, 0, 'C');
        $this->Cell(14, 5, 'D42', 1, 0, 'C');
        $this->Cell(23, 5, '', 1, 0, 'C');
        $this->Cell(24, 5, '', 1, 0, 'C');
        $this->Cell(24, 5, '', 1, 0, 'C');
        $this->Cell(19, 5, '', 1, 0, 'C');
        $this->Cell(19, 5, '', 1, 0, 'C');

        $this->Write(5, "IM - intramuscular");

        $this->Ln(10);

    }

    function lastTable($headers){

        //First row

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(22, 5, 'BIRD', 1, 0, 'C');
        $this->Cell(22, 5, 'D0', 1, 0, 'C');
        $this->Cell(22, 5, 'D14', 1, 0, 'C');
        $this->Cell(22, 5, 'D28', 1, 0, 'C');
        $this->Cell(22, 5, 'D42', 1, 0, 'C');
        $this->Cell(22, 5, '', 1, 0, 'C');
        $this->Cell(22, 5, '', 1, 0, 'C');
        $this->Ln();


        $this->SetFont('Arial', '', 10);
        //Second row

        $this->Cell(22, 10, $headers['0'], 1, 0, 'C');
        $this->Cell(22, 10, '', 1, 0, 'C');
        $this->Cell(22, 10, '', 1, 0, 'C');
        $this->Cell(22, 10, '', 1, 0, 'C');
        $this->Cell(22, 10, '', 1, 0, 'C');
        $this->Cell(22, 10, '', 1, 0, 'C');
        $this->Cell(22, 10, '', 1, 0, 'C');
        $this->Ln();

        //Third row
        $this->Cell(22, 10, $headers['1'], 1, 0, 'C');
        $this->Cell(22, 10, '', 1, 0, 'C');
        $this->Cell(22, 10, '', 1, 0, 'C');
        $this->Cell(22, 10, '', 1, 0, 'C');
        $this->Cell(22, 10, '', 1, 0, 'C');
        $this->Cell(22, 10, '', 1, 0, 'C');
        $this->Cell(22, 10, '', 1, 0, 'C');
        $this->Ln();

        //Fourth row
        $this->Cell(22, 10, $headers['2'], 1, 0, 'C');
        $this->Cell(22, 10, '', 1, 0, 'C');
        $this->Cell(22, 10, '', 1, 0, 'C');
        $this->Cell(22, 10, '', 1, 0, 'C');
        $this->Cell(22, 10, '', 1, 0, 'C');
        $this->Cell(22, 10, '', 1, 0, 'C');
        $this->Cell(22, 10, '', 1, 0, 'C');
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
    $text = "ANTIGEN: " . "Z01". "\n";
    $text .= "CAGE: " .  "" . "\n";
    $text .= "IMMUNIZATION PERIOD: " . "\n";
    $text .= "RESPONSIBLE INVESTIGATOR(S): " . "\n";
    $text .= "SPONSOR: " . "\n";
    $text .= "DATE: ";
    $pdf->MultiCell(0, 6.2, $text, 1, 'L');
    $pdf->Line(25, 80, 180, 80);
    $pdf->Ln(20);
    $pdf->SetFont('Arial','BU',12);
    $pdf->Cell(15, 7, 'ANTIGEN PREPARATION');

    $text1 = "ANTIGEN: " . "Z01" . "\n";
    $text1 .= " - Supplied by: " .  "" . "\n";
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
    $pdf->Ln(8);
    $titles = array('INJ.', 'DAY', 'DATE', 'VOLUME(ul)', 'AMOUNT(ug)', 'TYPE', 'NOTES');
    $birdcolor = array('RED', 'GREEN', 'BLUE');
    //First table
    $pdf->BasicTable($titles,  $birdcolor['0']);


    //Second table
    $pdf->BasicTable($titles, $birdcolor['1']);


    //Third table
    $pdf->BasicTable($titles,  $birdcolor['2']);


    //Fourth table
    $pdf->lastTable($birdcolor);

    //Download name
    $pdf->Output('I', $name . '.pdf');
}