<!DOCTYPE html>
<html lang="pt-br">
	<title> Mostrar pastas e subpastas </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link href="https://fonts.googleapis.com/css?family=Luckiest+Guy|Russo+One" rel="stylesheet">

	<style>
		*{margin: 0px; padding: 0px;}

		.titulo{
			font-family: 'Luckiest Guy', cursive;
		}

		.apresentacao{
			font-family: 'Russo One', sans-serif;
		}

		.c{
			margin: 40px;
		}

		.pasta, .arquivo {
			background-color: white;
			padding: 12px;
			border: 1px solid rgba(0, 0, 0, .1);
			box-shadow: 2px 2px 2px rgba(0, 0, 0, .1);
			cursor: pointer;
		}

		.elementos{
			background-color: #f1f1f1;
			overflow: scroll;
			overflow-x: hidden;
			height: 300px;
		}

		footer{
			position: relative;
			top: 400px;
			width: 100%;
		}

		@media (min-width: 700px){
			.texto{
				width: 50%;
			}
		}
	</style>

<body>
	<header class="w3-container w3-black"><h1 class="titulo"> Relatório de pastas </h1></header>

	<center class="w3-container c">
		<div id="right-form">
			<form>
				<h1 class="apresentacao"> Pesquisar por diretório </h1>
				<input id="diretorio" class="w3-input w3-border texto w3-margin-bottom" type="text" required>
			</form>
			<button onclick="pesquisar()" class="w3-button w3-blue" type="button">Pesquisar</button>
			<a href="http://127.0.0.1/Teste/Relatorio-de-pastas/" target="_blank"><button class="w3-button w3-blue"> Relatório PDF </button></a>
		</div>
	</center>

	<footer class="w3-padding-16 w3-black">
		<p>Feito por <a href="https://pedrosererti.000webhostapp.com" title="W3.CSS" target="_blank" class="w3-hover-text-green">Pedro Serer TI</a></p>
	</footer>

	<div class="w3-container">
		<div id="retorno" class="w3-card elementos"></div>
	</div>

	<script>
			const pasta = document.getElementsByClassName('pasta');
			const arquivo = document.getElementsByClassName('arquivo');

			function pesquisar(subDir = null, efeito = 1) {
					let dir = document.getElementById('diretorio').value;
					let http = new XMLHttpRequest();

					http.onreadystatechange = function() {
							if (this.readyState == 4 && this.status == 200) {
									document.getElementById('retorno').innerHTML = this.responseText;
							}
					}

					if (subDir != null) {
						document.getElementById('diretorio').value = subDir.innerHTML;
						dir = subDir.innerHTML;
					}

					//Impedir que o input fique vazio

					http.open("POST", "diretorio.php");
					http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					http.send(`dir=${dir}&efeito=${efeito}`);
			}
	</script>
	</body>
</html>
