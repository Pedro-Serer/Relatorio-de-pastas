<!DOCTYPE html>
<html lang="pt-br">
	<title> Mostrar pastas e subpastas </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto" rel="stylesheet">

	<style>
		body{
			overflow-x: hidden;
		}

		.pasta{
			position: relative;
			left: 29px;
			width: 30%;
			height: 32px;
			margin: 5px;
			border: 1px solid black;
		}

		.pasta:hover{
			transform: scale(1.1);
			background-color: rgba(0, 0, 0, .1);
		}

		.arquivo{
			position: relative;
			width: 30%;
			height: 32px;
			left: 30px;
			margin: 5px;
			border: 1px solid black;
		}

		.arquivo:hover{
			transform: scale(1.1);
			background-color: rgba(0, 0, 0, .1);
		}

		.nomePasta{
			position: relative;
			left: 50px;
			bottom: 54px;
			font-size: 16pt;
		}

		.nomeArquivo{
			position: relative;
			left: 50px;
			bottom: 45px;
			font-size: 13pt;
		}

		.mostra{
			position: relative;
			bottom: 13px;
			height: 0px;
			visibility: hidden;
		}

		.expande{
			position: relative;
			left: 60px;
			height: 1px;
			bottom: 53px;
			cursor: pointer;
			font-family: 'Open Sans', sans-serif;
		}

		.expArq{
			position: relative;
			left: 60px;
			height: 1px;
			bottom: 53px;
			font-family: 'Open Sans', sans-serif;
		}

		#hr{
			border: 1px solid #BDBDBD;
			position: fixed;
			top: 10px;
			left: 50%;
			height: 90%;
		}

		#right-btn{
			position: fixed;
			border: 1px solid #BDBDBD;
			top: 60%;
			right: 15%;
			height: 10%;
			width: 20%;
			border-radius: 5px;
			border-color: black;
			border-width: 2px;
		}

		#right-hrs{
			position: fixed;
			top: 43%;
			right: 24%;

		}

		#left-hr{
			position: relative;
			right: 45px;
			bottom: -35px;
		}

		#right-hr{
			position: relative;
			left: 45px;
			top: -35px;
		}

		#right-form{
			position: fixed;
			top: 20%;
			right: 6%;
			width: 40%;
		}

		button{
			background-color: #0174DF;
			color: white;
			height: 100%;
			width: 100%;
			border-radius: 5px;
			border-color: black;
			font-size: 13pt;
			font-family: 'Roboto', sans-serif;
		}

		input[type=text]{
			width: 80%;
			height: 27px;
			border: 1px solid #0174DF;
			border-radius: 5px;
		}

		input[type=submit]{
			height: 32px;
			border: 1px solid #0174DF;
			border-radius: 5px;
			font-family: 'Roboto', sans-serif;
		}

		hr {
			color: black;
		  display: block;
		  border-style: inset;
		  border-width: 1px;
			width: 30px;
		}
	</style>

<body>
	<h1 style="font-family: 'Anton', sans-serif;">Pastas</h1>
	<div id="right-form">
		<form method="get" action="">
			<center><h1 style="font-family: 'Anton', sans-serif;"> Pesquisar por diretório </h1></center>
			<input name="dir" type="text" required>
			<input type="submit" value="Pesquisar">
		</form>
	</div>

	<div id="right-hrs">
		<hr id="left-hr"><h2>OU</h2><hr id="right-hr">
	</div>

	<div id="right-btn">
		<a href="http://127.0.0.1/relatorio.php" target="_blank"><button> Relatório PDF </button></a>
	</div>

<?php
	error_reporting(0);
	$input = $_GET['dir'];

	if(!$dirname = scandir($input)){
		echo "Erro encontrado: ".$input;
		die("<script>alert('Diretório errado, tente novamente!')</script>");
	}
	$id = -1;

	/*Percorre a pasta atual*/
	for($i = 0; $i<count($dirname); $i++){
		$name = "$input\\$dirname[$i]";

		 if(is_file($name) == false && $dirname[$i] != "." && $dirname[$i] != ".."){
			$d = dir($name);
			$id++;

			/*Mostra o caminho da subpasta*/
			echo "</br><img src='pasta.png' witdh='40' height='40'><h2 id='$id' class='expande'>".$name."</h2>";
			echo "<div class='mostra $i'>";

			/*Percorre a subpasta dentro da pasta principal*/
			while (($subDir = $d->read()) !== false) {
				$new = $name."\\".$subDir;
				$arq = fopen("C:\\xampp\htdocs\Teste\\pdf.html", "a+");

					/*Prevenção, dando privilégios ao sistema*/
					if(chmod($new, 0755)){

						/*Verifica se é pasta ou não*/
						if(is_file($new)){
							echo "<div class='arquivo'>";
				   		echo "<img src='arquivo.png' witdh='40' height='40'>"."<p class='nomeArquivo'>".$subDir."</p>"."</br>";
							echo "</div>";
							fwrite($arq, "<h1>(SUBPASTA $name)</h1><h3>Arquivo: <b>$subDir</b></h3><hr/>");
						}
						else{
							echo "<div class='pasta'>";
							echo "<img src='pasta.png' witdh='40' height='40'>"."<p class='nomePasta'>".$subDir."</p>"."</br>";
							echo "</div>";
							fwrite($arq, "<h1>(SUBPASTA $name)</h1><h3>Pasta: <b>$subDir</b></h3><hr/>");
						}
				 	}
				}
				echo "</div>";
				$d->close();
				fclose($arq);
			 }

			 if(is_file($name) == true && $dirname[$i] != "." && $dirname[$i] != ".."){
				 	echo "</br><img src='arquivo.png' witdh='40' height='40'><h2 class='expArq'>".$dirname[$i]."</h2>";
			 }
		}
	?>

	<script>
		var elementos = document.getElementsByClassName('expande');

		for(var i = 0; i<elementos.length; i++){
			let j = 0;
			elementos[i].addEventListener("click", function(e){
				var elementoClicado = e.target;
				j++;

				var pastaArquivo = document.getElementsByClassName('mostra');
				var a = parseInt(elementoClicado.id);
				console.log(a);
				if(j % 2 == 0){
					pastaArquivo[a].style.visibility = "hidden";
					pastaArquivo[a].style.height = 0;
				}
				else{
					pastaArquivo[a].style.visibility = "visible";
					pastaArquivo[a].style.height = "auto";
				}
			});
		}
	</script>
	<div id="hr"></div>

	</body>
</html>
