<!DOCTYPE html>
<?php

	// Página com consulta e cadastro de livros, reservada para adms

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

		<!-- Modal de cadastro -->

		<div class="modal fade" id="modalModelo" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
		    	<div class="modal-content">
		      		<div class="modal-header">
		        		<h5 class="modal-title" id="exampleModalLabel" style="padding-left: 5%">&bull; Novo Livro</h5>

		        		<button type="button" class="close" data-dismiss="modal">
		          			<span>&times;</span>
		        		</button>

		      		</div>
		      		<div class="modal-body">

		        		<form action="../paginas_processos/cadastro.php?pg=livros" method="POST">
		        			<b>Preencha todos os campos abaixo:</b><br>
		        			<span style="font-size: 10px">*Evitar caracteres especiais!</span>
		        			<hr>
			        		<input type="text" name="titulo" placeholder="Título" maxlength="100" style="margin-right:6%;" class="input_modal">
			        		<input type="text" name="autor" placeholder="Autor" class="input_modal" maxlength="50">
					      	<br>
					       	<br style="clear:left;"><hr>
					       	<br>
					       	<input type="text" name="editora" placeholder="Editora" maxlength="50" style="margin-right: 6%" class="input_modal">
					       	<input type="text" name="ano_edicao" placeholder="Ano de edição" maxlength="4" class="input_modal" pattern="\d*">
					       	<br><br>
			        		<hr>
					       	<input type="text" name="volume" placeholder="Volume" style="margin-right: 6%" class="input_modal" pattern="\d*">
					       	<input type="text" name="categoria" placeholder="Categoria" class="input_modal">
					       	<br style="clear: left;"><hr>	
	      					<input type="submit" name="Cadastrar" class="input_modal">
		   				</form>

					</div>
				</div>
			</div>
		</div>

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

		include "..\paginas_include\header.html";

		?>

		<!-- Inicio da DIV de conteúdo -->

		<div class="conteudo_consulta">

			<br>

			<?php

				// Mensagem em caso de erros no cadastro

				if(isset($_SESSION['erro_cadastro']) && $_SESSION['erro_cadastro'] == 1){

					?>

					<div class="erro">
						Erro ao cadastrar, campos em branco!
					</div>

					<?php
				}

			?>

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

			<!-- DIV com botão de cadastro, e opções de filtragem por ativo/inativo, para DESKTOP -->

			<div class="filtros d-none d-sm-block">

				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalModelo" style="display: inline; margin-right: 50%">
  					Cadastrar novo livro
				</button>

				<form action="../paginas_processos/filtros.php?pg=livros" method="POST" style="display: inline">
					<input type="radio" name="exibir" value="ativos" style="margin: 20px">
					<label>Ativos</label>
					<input type="radio" name="exibir" value="inativos" style="margin: 20px">
					<label>Inativos</label>
					<input type="radio" name="exibir" value="ambos" style="margin: 20px">
					<label>Ambos</label>
					<input type="submit" value="Exibir" style="margin-left: 30px;">
				</form>

			</div>

			<!-- DIV com botão de cadastro, e opções de filtragem por ativo/inativo, para MOBILE -->

			<div class="filtros d-block d-sm-none">

				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalModelo" style="display: inline;">
  					Cadastrar novo livro
				</button>
				<br>
				<form action="../paginas_processos/filtros.php?pg=livros" method="POST" style="display: inline">
					<input type="radio" name="exibir" value="ativos" style="margin: 20px 10px 20px 10px">
					<label>Ativos</label>
					<input type="radio" name="exibir" value="inativos" style="margin: 20px 10px 20px 10px">
					<label>Inativos</label>
					<input type="radio" name="exibir" value="ambos" style="margin: 20px 10px 20px 10px">
					<label>Ambos</label>
					<br>
					<input type="submit" value="Exibir">
				</form>

			</div>

			<!-- Tabela de livros cadastrados -->

			<div class="scrollable" style="margin-top: 0">
				<table class="table" style="margin: 0px;">
					<thead>

						<tr>
							<td><a class="<?php if($filtro_2=="Titulo"){ echo $atual; } ?>" href="../paginas_processos/filtros.php?pg=livros&filtro_2=Titulo&filtro_1=<?php echo $filtro_1;?>">Título</a></td>
							<td><a class="<?php if($filtro_2=="Autor"){ echo $atual; } ?>" href="../paginas_processos/filtros.php?pg=livros&filtro_2=Autor&filtro_1=<?php echo $filtro_1; ?>">Autor</a></td>
							<td><a class="<?php if($filtro_2=="Editora"){ echo $atual; } ?>" href="../paginas_processos/filtros.php?pg=livros&filtro_2=Editora&filtro_1=<?php echo $filtro_1; ?>">Editora</a></td>
							<td><a class="<?php if($filtro_2=="Edicao"){ echo $atual; } ?>" href="../paginas_processos/filtros.php?pg=livros&filtro_2=Edicao&filtro_1=<?php echo $filtro_1; ?>">Edição</a></td>
							<td><a class="<?php if($filtro_2=="Volume"){ echo $atual; } ?>" href="../paginas_processos/filtros.php?pg=livros&filtro_2=Volume&filtro_1=<?php echo $filtro_1; ?>">Volume</a></td>
							<td><a class="<?php if($filtro_2=="Categoria"){ echo $atual; } ?>" href="../paginas_processos/filtros.php?pg=livros&filtro_2=Categoria&filtro_1=<?php echo $filtro_1; ?>">Categoria</a></td>
							<td style="background-color: #b3b3b3">Detalhes</td>
						</tr>

					</thead>
					<tbody>
						<?php

							// Foreach para percorrer banco de dados; Switch case para filtrar de acordo com o filtro Ativo/Inativo

							foreach ($livros as $key => $value) {

								if(isset($_SESSION['exibir']) == false){
									$_SESSION['exibir'] = "ativos";
								}

								switch ($_SESSION['exibir']) {
									case 'ambos':
											?>
												<tr>
													<td><?php echo $value->titulo; ?></td>
													<td><?php echo $value->autor ?></td> 
													<td><?php echo $value->editora; ?></td>
													<td><?php echo $value->ano_edicao; ?></td>
													<td><?php echo $value->volume; ?></td>
													<td><?php echo $value->categoria; ?></td>
													<td style="text-align: center;"><a href="livros_detalhes.php?id=<?php echo $value->id_livro?>"><img src="../imagens/plus.png"></a></td>
												</tr>
											<?php
										break;
									
									case 'inativos':
										if($value->ativo==0){
											?>
												<tr>
													<td><?php echo $value->titulo; ?></td>
													<td><?php echo $value->autor ?></td> 
													<td><?php echo $value->editora; ?></td>
													<td><?php echo $value->ano_edicao; ?></td>
													<td><?php echo $value->volume; ?></td>
													<td><?php echo $value->categoria; ?></td>
													<td style="text-align: center;"><a href="livros_detalhes.php?id=<?php echo $value->id_livro?>"><img src="../imagens/plus.png"></a></td>
												</tr>
											<?php
										}
										break;

									case 'ativos': default:
										if($value->ativo==1){
										?>
												<tr>
													<td><?php echo $value->titulo; ?></td>
													<td><?php echo $value->autor ?></td> 
													<td><?php echo $value->editora; ?></td>
													<td><?php echo $value->ano_edicao; ?></td>
													<td><?php echo $value->volume; ?></td>
													<td><?php echo $value->categoria; ?></td>
													<td style="text-align: center;"><a href="livros_detalhes.php?id=<?php echo $value->id_livro?>"><img src="../imagens/plus.png"></a></td>
												</tr>
										<?php
										}
										break;
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

	// Unsets para limpar 'sessions' de erro_cadastro e filtrar_livros

	unset($_SESSION['filtrar_livros']);
	unset($_SESSION['erro_cadastro']);

?>