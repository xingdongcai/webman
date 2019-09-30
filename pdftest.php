<?php
ob_start();
    require "vendor/autoload.php";
    $pdf = new TCPDF('L', 'mm', 'A4', true);
    $pdf->setHeaderFont(array('helvetica', 'B',24));
    $pdf->setHeaderData(null,null,'My First PDF Document','');
    $pdf->SetFont(array('helvetica'),'',16);
    $pdf->AddPage();
    $pdf->Cell(40,10,'First Cell - no border',0,1);
    $pdf->Cell(100,10,'Second Cell - border/centred', 1,1,'C');
    $pdf->Ln();
    $pdf->Cell(100,10,'Third Cell - top/bottom border', 'T,B',1);
    $pdf->Ln();
    $pdf->SetFillColor(255,0,0);
    $pdf->Cell(100,10,'Fourth Cell - border/filled', 1,1,'C',1);
    ob_clean();
    $saveDir= dirname($_SERVER["SCRIPT_FILENAME"])."/PDFS/"; //save to PDFS Dir
    $pdf->Output($saveDir.'PDFFile1.pdf','F');
?>