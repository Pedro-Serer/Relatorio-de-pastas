<?php
  require_once 'dompdf/autoload.inc.php';
  require('../controller/cria_html.php');

  error_reporting(0);
  use Dompdf\Dompdf;
  $dompdf = new Dompdf();

  if (empty($_COOKIE['geraDir'])) {
      die("Diretório não encontrado ou ausente!");
  } else {
      $diretorio = $_COOKIE['geraDir'];
  }

  $html = criaHTML($diretorio);
  $dompdf->loadHtml($html);
  $dompdf->setPaper('A4', 'landscape');
  $dompdf->render();
  $dompdf->stream("Relatório das pastas");
?>
