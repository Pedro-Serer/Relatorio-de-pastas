<?php
    require('../model/funcoes.php');

    function criaHTML ($diretorio)
    {
        define('SERVER_NAME_DATA', $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT']);
        define('SERVER_DATA', $_SERVER['SERVER_SOFTWARE']);

        $html = "
        <!DOCTYPE HTML PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
        <html xml:lang='en' xmlns='http://www.w3.org/1999/xhtml' lang='pt-br'>
        <head>
        <meta http-equiv='content-type' content='text/html; charset=UTF-8' />

        <title>Relatório de pastas</title>
        <style type='text/css'>

          @page {
            margin: 2cm;
          }

          body {
            font-family: sans-serif;
            margin: 0.5cm 0;
            text-align: justify;
          }

          #header,
          #footer {
            position: fixed;
            left: 0;
            right: 0;
            color: #aaa;
            font-size: 0.9em;
          }

          #header {
            top: 0;
            border-bottom: 0.1pt solid #aaa;
          }

          #footer {
            bottom: 0;
            border-top: 0.1pt solid #aaa;
          }

          #header table,
          #footer table {
            width: 100%;
            border-collapse: collapse;
            border: none;
          }

          #header td,
          #footer td {
            padding: 0;
            width: 50%;
          }

          .page-number {
            text-align: center;
          }

          .page-number:before {
            content: 'Página ' counter(page);
          }

          hr {
            page-hr/eak-after: always;
            border: 0;
          }

        </style>

        </head>

        <body>

          <div id='header'>
            <table>
              <tr>
                <td>" . SERVER_DATA . "</td>
                <td style='text-align: right;'>" . SERVER_NAME_DATA  . "</td>
              </tr>
            </table>
          </div>

          <div id='footer'>
            <div class='page-number'></div>
          </div>

          <h2>Relatório de pastas e arquivos</h2>";

        //Cria um buffer para a função pesquisaDir()
        ob_start();
        pesquisaDir($diretorio, (bool) 1, 'view');

        //Libera o buffer para apresentação correta dos dados
        $html .= ob_get_clean();

        $html .= "</body></html>";
        return $html;
    }
