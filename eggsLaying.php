<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 28/11/2018
 * Time: 10:47
 */

define('FPDF_FONTPATH','font/');
require('fpdf.php');

class PDF extends FPDF
{
    private $initDate;
    private $finalDate;
    private $name;

    function Header()
    {
        $this->SetFont('Arial','B',7);
        $this->Cell(17,8,'Egg Laying/Inmunization Table',0,0,'L');
        $this->Cell(35);
        $this->Cell(17,8,$this->name,0,0,'C');
        $this->Cell(15);
        $this->Cell(17,8, 'Inmunization: ' . $this->initDate . '->' . $this->finalDate . '',0,0,'C');
        $this->Ln(10);
    }



    function Footer(){
        $this->SetY(-15);
        // Select Arial italic 8
        $this->SetFont('Arial','I',8);
        // Print centered page number
        $this->Cell(0,10,date('j-m-Y') . '           Processed by the system',0,0,'L');
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

    /*
     * Headers of the table
     */
    function loadHeaders($headers){
        $this->SetFont('Arial','B',7);
        foreach ($headers as $header) {
            $this->Cell(14, 4.7, $header, 1, 0, 'C');
        }
        $this->SetFont('Arial','',7);
    }

    function BasicTable($headers, $data)
    {
        $this->AddPage();
        $y = $this->GetY();
        $x = $this->GetX();
        $this->loadHeaders($headers);

        $this->Ln();
        // Datos
        $i = 0;

            foreach($data as $row)
            {
                $i++;

                if($i == 108){
                    $i = 1;
                    $x = 17;
                    $this->AddPage();
                    $this->loadHeaders($headers);
                    $this->Ln();
                }

                if($i%36 == 0){
                    $this->SetXY(($x+90), $y);
                    $x = $this->GetX();
                    $this->loadHeaders($headers);
                    $this->Ln();
                    $i++;
                }

                if($i > 36){
                    $this->SetX($x);
                    foreach($row as $col)
                        $this->Cell(14,4.7,$col,1);
                    $this->Ln();
                }else{
                    foreach($row as $col)
                        $this->Cell(14,4.7,$col,1);
                    $this->Ln();
                }



            }
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }




    /**
     * @param mixed $initDate
     */
    public function setInitDate($initDate)
    {
        $this->initDate = $initDate;
    }

    /**
     * @param mixed $finalDate
     */
    public function setFinalDate($finalDate)
    {
        $this->finalDate = $finalDate;
    }


}

if(isset($_GET['download'])) {
    $name = $_GET['name'];
    $initDate = $_GET['initDate'];
    $finalDate = $_GET['finalDate'];
    $pdf = new PDF('L','mm','A4');
    $pdf->SetLeftMargin(17);
    $pdf->setName($name);
    $pdf->setInitDate($initDate);
    $pdf->setFinalDate($finalDate);
    $data= $pdf->LoadData("datos.txt");

    //$pdf->AddPage();

    /* Header */


    /* Data*/
    $titles = array('Date', 'Days', 'Tray', 'Eggs', 'Pool', 'mL');
    $pdf->BasicTable($titles, $data);
    $pdf->Output('I', $name . '.pdf');
}
?>