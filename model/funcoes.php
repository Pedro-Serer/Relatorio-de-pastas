<?php
    /**
    * CORRIGE O NOME DO DIRETÓRIO AO VOLTAR (../)
    *
    * Essa função arruma o nome do diretório ao
    * clicar no botão de nível anterior (../ ou ./).
    *
    * @param string $complete_path
    *
    * @return string diretório ajustado
    */

    function dirView ($complete_path)
    {
        $back_path = strrchr($complete_path, "\\");
        $indice = strrpos($complete_path, "\\");
        $complete_path = substr($complete_path, 0, $indice);
        $indice = strrpos($complete_path, "\\");
        $complete_path = substr($complete_path, 0, $indice);
        $indice = strrpos($complete_path, "\\");
        $complete_path = substr($complete_path, 0, $indice);

        return $complete_path .= $back_path;
    }

    /**
    * PESQUISA O DIRETÓRIO DIGITADO PELO USUÁRIO
    *
    * Essa função vascula o diretório infomado
    * e apresenta para o usuário todas as pastas,
    * arquivos e programas. Se a opção $sub estiver
    * setada para 0 então ativa a função dirView().
    *
    * @param string $diretorio
    * @param bool $sub
    *
    * @return void
    */

    function pesquisaDir ($diretorio, $sub, $local = 'default')
    {
        if (!is_dir($diretorio)){
            die("Diretório não existe ou permissões insuficientes!");
        }

        $info = scandir($diretorio);
        $i = 0;

        foreach ($info as $files) {
            $complete_path = $diretorio . DIRECTORY_SEPARATOR . $files;
            $is_folder = "arquivo";
            $sub_func = "";

            if ($sub == 0) {
                $complete_path = dirView($complete_path);
            }

            if(!is_file($complete_path)) {
                $is_folder = "pasta";
                $sub_func = "pesquisar(this)";

                if ($i < 2) {
                  $sub_func = "pesquisar(this, 0)";
                }
            }

            //Habilita modelo próprio para o PDF
            if ($local == 'view') {
                echo "<div class='$is_folder' ondblclick='$sub_func'>" . $complete_path . "</div>";
            } else {
                  //Modelo padrão, saída para o usuário
                  echo "<tr><td><img class='$is_folder'><td class='$is_folder' ondblclick='$sub_func'>"
                    . $complete_path . "</td></tr>";
            }

            $i++;
        }
    }

    isset($_POST['efeito']) ? $sub = $_POST['efeito'] : $sub = false;

    isset($_POST['dir']) ? pesquisaDir($_POST['dir'], (bool) $sub) : false;
