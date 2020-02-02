const pasta = document.getElementsByClassName('pasta');
const arquivo = document.getElementsByClassName('arquivo');

//Função que atribui simbolo de pasta ou arquivo
function img_replace() {
  let image = document.getElementsByTagName('img');

  for (var i = 0; i < image.length; i++) {
    if (image[i].className === 'pasta') {
      image[i].src = '_img/pasta.png';
      image[i].width = 50;
    } else {
      image[i].src = '_img/arquivo.png';
      image[i].width = 50;
    }
  }
}

//Função que conecta ao PHP para pesquisar o diretório informado
function pesquisar(subDir = null, efeito = 1) {
    let dir = document.getElementById('diretorio').value;
    let div = document.getElementById('retorno');
    let http = new XMLHttpRequest();

    http.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            div.innerHTML = this.responseText;

            document.getElementById('number')
              .innerHTML = "Mostrando " + (div.childNodes.length) + " arquivos";

            img_replace();
        }
    }

    //Impedir que o input fique vazio
    if (dir == "") {
      div.innerHTML = "<p class='w3-text-red'>Campo de pesquisa pode ficar vazio!</p>";
      return;
    }

    //modifica a apresentação ao clicar nos níveis anteriores
    if (subDir != null) {
      document.getElementById('diretorio').value = subDir.innerHTML;
      dir = subDir.innerHTML;
    }

    http.open("POST", "model/funcoes.php");
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send(`dir=${dir}&efeito=${efeito}`);
}

//Gera um cookie para o relatório poder ser gerado
function gerar() {
    let dir = document.getElementById('diretorio').value;
    document.cookie = "geraDir = " + dir;
}
