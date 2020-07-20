<!DOCTYPE html>
<?php

	// Index para alunos

	require __DIR__ .'../../vendor/autoload.php';
	require __DIR__ .'../../database.php';

	use App\alunos;
	use App\itens;
	use App\saidas;

	// Verificação de login

	session_start();

	if(!(isset($_SESSION['log'])) && $_SESSION['log'] !=1){
		header('Location: ../index.php');
		exit();
	}	

	// Chamada dos cálculos necessários para manter os dados atualizados

	include "..\paginas_include\calculos.php";

?>

<html lang="en">
	<head>

		<!-- Required meta tags -->

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<title>Index - Estudante</title>

		<link rel="stylesheet" type="text/css" href="../css/styles.css">

		<!-- Bootstrap CSS -->

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	</head>
	<body id="home">

		<?php

			$login = $_SESSION['login'];
			$id = alunos::where(['cod_aluno'=>$login]) -> value('id_aluno');
			$name = alunos::where(['cod_aluno'=>$login]) -> value('nome');
			$surname = alunos::where(['cod_aluno'=>$login]) -> value('sobrenome');
			$sexo = alunos::where(['cod_aluno'=>$login]) -> value('sexo');

			// Chamada do header

			include "..\paginas_include\header_aluno.html";
		?>

		<!-- Index para DESKTOP -->

		<div class="conteudo d-none d-sm-block">

			<!-- Mensagem de bem-vindo -->

			<div class="welcome">
				<?php 

					switch ($sexo) {
						case 'Mas': case 'N.E':
							
							?>

							<b>Bem-vindo</b><br>
							<span style="font-size: 21px;">Estudante - <?php  echo $name." ".$surname;  ?></span>

							<?php 

							break;
						
						case 'Fem':

							?>

							<b>Bem-vinda</b><br>
							<span style="font-size: 21px;">Estudante - <?php  echo $name." ".$surname;  ?></span>

							<?php

							break;
					}

				?>
				
			</div>

			<!-- Dados úteis -->

			<div>
				<div class="notificacao rounded" style="background-color: #66b3ff; float: left; margin-left: 70px;">
					Total de livros com estudante : <span style="font-weight: bold"><?php echo alunos::where(['id_aluno'=>$id])->value('total_livros'); ?></span>
					<hr>
					Total de livros atrasados : <span style="font-weight: bold"><?php echo alunos::where(['id_aluno'=>$id])->value('total_atrasos'); ?></span>
				</div>
				<br>
				<div class="notificacao rounded" style="background-color: #66b3ff; float: right; margin-right: 70px;">
					Valor total da multa(R$) : <span style="font-weight: bold"><?php echo alunos::where(['id_aluno'=>$id])->value('total_multa');?></span>
				</div>
				<br style="clear: left;">
			</div>

		</div>

		<!-- Index para MOBILE -->

		<div class="d-block d-sm-none">

			<!-- Mensagem de bem-vindo -->

			<div class="welcome">
				<?php 

					switch ($sexo) {
					case 'Mas': case 'N.E':
							
						?>

						<b>Bem-vindo</b><br>
						<span style="font-size: 21px;">Estudante - <?php  echo $name." ".$surname;  ?></span>

						<?php 

						break;
						
					case 'Fem':

						?>

						<b>Bem-vinda</b><br>
						<span style="font-size: 21px;">Estudante - <?php  echo $name." ".$surname;  ?></span>

						<?php

						break;
					}

				?>
					
			</div>

			<!-- Dados úteis -->

			<div style="text-align: center">
				<div style="width: 65%;display: inline-block; background-color: #80bfff;">Total de livros com estudante</div>
				<div style="width: 33%;display: inline-block; background-color: white;"><span style="font-weight: bold"><?php echo alunos::where(['id_aluno'=>$id])->value('total_livros'); ?></span></div>
				<div style="width: 65%;display: inline-block; background-color: #80bfff;">Total de livros atrasados</div>
				<div style="width: 33%;display: inline-block; background-color: white;"><span style="font-weight: bold"><?php echo alunos::where(['id_aluno'=>$id])->value('total_atrasos'); ?></span></div>
				<div style="width: 65%;display: inline-block; background-color: #80bfff;">Valor total da multa(R$)</div>
				<div style="width: 33%;display: inline-block; background-color: white;"><span style="font-weight: bold"><?php echo alunos::where(['id_aluno'=>$id])->value('total_multa');?></span></div>
			</div>
		</div>	

		<!-- Footer da página -->	

		<?php include "../paginas_include/footer.html"; ?>

	</body>

		<!-- Optional JavaScript -->

		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		
</html>