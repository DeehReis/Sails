<!DOCTYPE html>
<?php

	// Página com consulta de livros, reservada para alunos

	require __DIR__ .'../../vendor/autoload.php';
	require __DIR__ .'../../database.php';

	use App\livros;
	use App\itens;

	// Verificação de login

	session_start();

	if(!(isset($_SESSION['log'])) && $_SESSION['log'] !=1){
		header('Location: ../index.php');
		exit();
	}	

?>

<html lang="en">
	<head>

		<!-- Required meta tags -->

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<title>Consulta de Livros</title>

		<link rel="stylesheet" type="text/css" href="../css/styles.css">

		<!-- Bootstrap CSS -->

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	</head>
	<body id="livros_consulta">

		<?php

		// Valores dos filtros, vindos de 'filtros.php' para marcar a coluna da tabela que esta sendo filtrada

		if(isset($_SESSION['filtro_1']) && isset($_SESSION['filtro_2'])){

			$filtro_1 = $_SESSION['filtro_1'];
			$filtro_2 = $_SESSION['filtro_2'];

		}
		else{

			$filtro_1 = 1;
			$filtro_2 = "Titulo";

		}

		// Chamada do header

		include "..\paginas_include\header_aluno.html";

		?>

		<!-- Inicio da DIV de conteúdo -->

		<div class="conteudo_consulta">
			<br>
			<br>
			<div class="table_titulo">CONSULTA DE LIVROS</div>

			<!-- Chegada do filtro, vindo de 'filtros.php' -->

			<?php

				// Verificação para determinar se será usado um filtro novo, ou o filtro padrão

				if(isset($_SESSION['filtrar_livros'])){
					$livros = $_SESSION['filtrar_livros'];
					$atual = $_SESSION['atual'];
				}
				else{
					   $livros = livros::orderBy('titulo','ASC')->get();
				}	

			?>
			<!-- Tabela de livros cadastrados -->

			<div class="scrollable" style="margin-top: 0">
				<table class="table" style="margin: 0px;">
					<thead>

						<tr>
							<td><a class="<?php if($filtro_2=="Titulo"){ echo $atual; } ?>" href="../paginas_processos/filtros.php?pg=livros_aluno&filtro_2=Titulo&filtro_1=<?php echo $filtro_1;?>">Título</a></td>
							<td><a class="<?php if($filtro_2=="Autor"){ echo $atual; } ?>" href="../paginas_processos/filtros.php?pg=livros_aluno&filtro_2=Autor&filtro_1=<?php echo $filtro_1; ?>">Autor</a></td>
							<td><a class="<?php if($filtro_2=="Editora"){ echo $atual; } ?>" href="../paginas_processos/filtros.php?pg=livros_aluno&filtro_2=Editora&filtro_1=<?php echo $filtro_1; ?>">Editora</a></td>
							<td><a class="<?php if($filtro_2==="Edicao"){ echo $atual; } ?>" href="../paginas_processos/filtros.php?pg=livros_aluno&filtro_2=Edicao&filtro_1=<?php echo $filtro_1; ?>">Edição</a></td>
							<td><a class="<?php if($filtro_2==="Volume"){ echo $atual; } ?>" href="../paginas_processos/filtros.php?pg=livros_aluno&filtro_2=Volume&filtro_1=<?php echo $filtro_1; ?>">Volume</a></td>
							<td><a class="<?php if($filtro_2==="Categoria"){ echo $atual; } ?>" href="../paginas_processos/filtros.php?pg=livros_aluno&filtro_2=Categoria&filtro_1=<?php echo $filtro_1; ?>">Categoria</a></td>
						</tr>

					</thead>
					<tbody>
						<?php

							// Foreach para percorrer banco de dados; Switch case para filtrar de acordo com o filtro Ativo/Inativo

							foreach ($livros as $key => $value) {
								
								if($value->ativo==1){
									?>
										<tr>
											<td><?php echo $value->titulo; ?></td>
											<td><?php echo $value->autor ?></td> 
											<td><?php echo $value->editora; ?></td>
											<td><?php echo $value->ano_edicao; ?></td>
											<td><?php echo $value->volume; ?></td>
											<td><?php echo $value->categoria; ?></td>
										</tr>
									<?php
								}
								
							}
						?>
					</tbody>
				</table>
			</div>	
		</div>

		<!-- Footer da página -->

		<?php include "../paginas_include/footer.html"; ?>

		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->

		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script></body>

</html>

<?php

	// Unset para limpar filtrar_livros

	unset($_SESSION['filtrar_livros']);

?>
