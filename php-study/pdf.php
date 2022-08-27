<?php

$pdf = pdf_new();
$fname = "test.pdf";
pdf_open_file($pdf, $fname);
pdf_begin_page($pdf, 595, 842);
pdf_rect($pdf, 100, 600, 50, 100);
pdf_fill($pdf);

pdf_end_page($pdf);
pdf_close($pdf);


?>