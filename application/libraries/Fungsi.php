<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Fungsi 
{
    function __construct() {
        $this->ci =& get_instance();
    }

    function PdfGenerator($html, $filename){
        // instantiate and use the dompdf class
        $dompdf = new Dompdf\Dompdf();
        $dompdf->loadHtml('$html');
        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');
        // Render the HTML as PDF
        $dompdf->render();
        // Output the generated PDF to Browser
        $dompdf->stream($filename, array('Attachment'=>0));
    }
}