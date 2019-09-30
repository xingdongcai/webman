<?php
/**
 * Created by PhpStorm.
 * User: janet
 * Date: 8/09/2017
 * Time: 2:51 AM
 */

class CreatePDF
{
    function CustomerPDF($header, $headerWidth, $data)
    {
        define ('K_PATH_IMAGES', 'img/');
        // create new PDF document
        $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true);
        // set document header information. This appears at the top of each page of the PDF document
        $pdf->SetHeaderData("login_image.png","20", "Famox Client List", '');

        // set header and footer fonts
        $pdf->setHeaderFont(array('helvetica', '', 20));

        //set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);

        //set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // add a page
        $pdf->AddPage();

        $pdf->Ln();

        $table = '<table cellpadding="5" cellspacing="5" border="0">';
        $table.='<tr bgcolor="#336888">';
        for($i = 0; $i < sizeof($header); ++$i)
        {
            $table.='<td width="'.$headerWidth[$i].'">'.$header[$i].'</td>';
        }
        $table.="</tr>";

        $rowCount=0;

        foreach($data as $row)
        {
            if($rowCount%2==0)
            {
                $table.='<tr valign="top" bgcolor="#ACC5D3">';
            }
            else
            {
                $table.='<tr valign="top">';
            }
            $table.="<td>$row[client_id]</td>";
            $table.="<td>$row[client_gname] $row[client_fname]</td>";
            $table.="<td>$row[client_street]</td>";
            $table.="<td>$row[client_mobile]</td>";
            $table.="</tr>";
            $rowCount++;
        }

        $table .= "</table>";

        $pdf->writeHTML($table, false, false, false, false, 'L');
        //add new line after text written
        //fill - paint background
        //reset last cell height
        //add current cell padding
        //alignment

        $saveDir= dirname($_SERVER["SCRIPT_FILENAME"])."/PDFS/";

        if($pdf->Output($saveDir.'Customers.pdf','F'));
        {
            return $table;
        }

        exit();

    }
}

