<?php

function render_php($path)
{
    ob_start();
    include($path);
    $var=ob_get_contents(); 
    ob_end_clean();
    return $var;
}




$mpdf = new mPDF(); 

$mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text

$mpdf->WriteHTML(render_php('_data_pdf.php'));

$mpdf->Output();

exit;
//==============================================================
//==============================================================
//==============================================================

?>