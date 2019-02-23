<?php
  require_once 'dompdf/autoload.inc.php';

  use Dompdf\Dompdf;

  $dompdf = new Dompdf();

  $html = file_get_contents("pdf.html");
  $dompdf->loadHtml($html);
  $dompdf->setPaper('A4', 'landscape');
  $dompdf->render();
  $dompdf->stream("Relatório das pastas");
?>
