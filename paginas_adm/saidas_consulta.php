<!DOCTYPE html>
<?php

	// Página com consulta e registro de saídas, reservada para adms

	require __DIR__ .'../../vendor/autoload.php';
	require __DIR__ .'../../database.php';

	use App\saidas;
	use App\itens;
	use App\alunos;
	use App\livros;

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

		<title>Consulta de Saídas</title>

		<link rel="stylesheet" type="text/css" href="../css/styles.css">

		<!-- Bootstrap CSS -->

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	</head>
	<body id="saidas_consulta">

		<!-- Modal de cadastro -->

		<div class="modal fade" id="modalModelo" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
		    	<div class="modal-content">
		      		<div class="modal-header">
		        		<h5 class="modal-title" id="exampleModalLabel" style="padding-left: 5%">&bull; Nova Saída</h5>

		        		<button type="button" class="close" data-dismiss="modal">
		          			<span>&times;</span>
		        		</button>

		      		</div>
		      		<div class="modal-body">

		        		<form action="../paginas_processos/cadastro.php?pg=saidas" method="POST">
		        			<b>Preencha todos os campos abaixo:</b>
		        			<span style="font-size: 10px">*Evitar caracteres especiais!</span>
		        			<hr>
							<input type="text" name="id_aluno" placeholder="ID.Aluno" maxlength="10" style="margin-right: 6%" class="input_modal" pattern="\d*">
					       	<input type="text" name="id_item" placeholder="ID.Item" maxlength="10" class="input_modal" pattern="\d*">
			        		<hr style="clear: left">	
	      					<input type="submit" name="Registrar" class="input_modal">
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
			$filtro_2 = "id_saida";

		}

		// Chamada do header

		include "..\paginas_include\header.html";

		?>

		<!-- Inicio da DIV de conteúdo -->

		<div class="conteudo_consulta">
			<br>

			<?php

				// Mensagens em caso de erros no cadastro

				if(isset($_SESSION['erro_cadastro'])){

					switch ($_SESSION['erro_cadastro']) {
						case '1':
							?>
							<div class="erro">
							
							Erro ao registrar, campos em branco e/ou dados incorretos!
							
							</div>
							<?php
							break;
						
						case '2':
							?>
							<div class="erro">
							
							Erro ao registrar, item não se encontra no estoque!
							
							</div>
							<?php
							break;

						case '3':
							?>
							<div class="erro">
							
							Erro ao registrar, aluno com multas pendentes!
							
							</div>
							<?php
							break;
					}
				}
			?>

			<br>
			<div class="table_titulo">CONSULTA DE SAÍDAS</div>

			<!-- Chegada do filtro, vindo de 'filtros.php' -->

			<?php

				// Verificação para determinar se será usado um filtro novo, ou o filtro padrão

				if(isset($_SESSION['filtrar_saidas'])){
					$saidas = $_SESSION['filtrar_saidas'];
					$atual = $_SESSION['atual'];
				}
				else{
					   $saidas = saidas::orderBy('id_saida','DESC')->get();
				}	
			?>

			<!-- DIV com botão de cadastro, para DESKTOP -->

			<div class="filtros d-none d-sm-block">

				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalModelo" style="display: inline;">
  					Registrar nova saída
				</button>

			</div>

			<!-- DIV com botão de cadastro, para MOBILE -->

			<div class="filtros d-block d-sm-none">

				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalModelo" style="display: inline;">
  					Registrar nova saída
				</button>

			</div>

			<!-- Tabela de saídas cadastradas -->

			<div class="scrollable" style="margin-top: 0">
				<table class="table" style="margin: 0px;">
					<thead>
						<tr>

							<td><a class="<?php if($filtro_2=="id_saida"){ echo $atual; } ?>" href="../paginas_processos/filtros.php?pg=saidas&filtro_2=id_saida&filtro_1=<?php echo $filtro_1;?>">ID.Saída</a></td>
							<td><a class="<?php if($filtro_2=="id_aluno"){ echo $atual; } ?>" href="../paginas_processos/filtros.php?pg=saidas&filtro_2=id_aluno&filtro_1=<?php echo $filtro_1; ?>">ID.Aluno</a></td>
							<td><a class="<?php if($filtro_2=="Nome"){ echo $atual; } ?>" href="../paginas_processos/filtros.php?pg=saidas&filtro_2=Nome&filtro_1=<?php echo $filtro_1; ?>">Nome</a></td>
							<td><a class="<?php if($filtro_2==="id_item"){ echo $atual; } ?>" href="../paginas_processos/filtros.php?pg=saidas&filtro_2=id_item&filtro_1=<?php echo $filtro_1; ?>">ID.Item</a></td>
							<td><a class="<?php if($filtro_2==="Titulo"){ echo $atual; } ?>" href="../paginas_processos/filtros.php?pg=saidas&filtro_2=Titulo&filtro_1=<?php echo $filtro_1; ?>">Título</a></td>
							<td><a class="<?php if($filtro_2==="Status"){ echo $atual; } ?>" href="../paginas_processos/filtros.php?pg=saidas&filtro_2=Status&filtro_1=<?php echo $filtro_1; ?>">Status</a></td>
							<td><a class="<?php if($filtro_2==="data_saida"){ echo $atual; } ?>" href="../paginas_processos/filtros.php?pg=saidas&filtro_2=data_saida&filtro_1=<?php echo $filtro_1; ?>">Saída</a></td>
							<td><a class="<?php if($filtro_2==="data_limite"){ echo $atual; } ?>" href="../paginas_processos/filtros.php?pg=saidas&filtro_2=data_limite&filtro_1=<?php echo $filtro_1; ?>">Limite</a></td>
							<td><a class="<?php if($filtro_2==="data_retorno"){ echo $atual; } ?>" href="../paginas_processos/filtros.php?pg=saidas&filtro_2=data_retorno&filtro_1=<?php echo $filtro_1; ?>">Retorno</a></td>
							<td><a class="<?php if($filtro_2==="dias_atraso"){ echo $atual; } ?>" href="../paginas_processos/filtros.php?pg=saidas&filtro_2=dias_atraso&filtro_1=<?php echo $filtro_1; ?>">Atraso(Dias)</a></td>
							<td style="background-color: #b3b3b3">Detalhes</td>
							<td style="background-color: #80ff80">Devolução</td>
						</tr>
					</thead>
					<tbody>
						<?php

							// Foreach para percorrer banco de dados;

							foreach ($saidas as $key => $value) {

								?>
								
								<tr <?php if($value->dias_atraso>0 && $value->_status == 0){ ?> style="background-color: #ffcccc; color: #660000" <?php } ?>>
									<td><?php echo $value->id_saida; ?></td>
									<td><?php echo $value->id_aluno; ?></td>
									<td><?php echo $value->nome." ".$value->sobrenome; ?></td> 
									<td><?php echo $value->id_item; ?></td>
									<td class="overflow_tabela"><?php echo $value->titulo; ?></td>
									<td><?php if($value->_status == 0){ echo "Retirado"; } else{ echo "Em estoque"; } ?></td> 
									<td><?php echo $value->data_saida; ?></td>
									<td><?php echo $value->data_limite; ?></td>
									<td><?php if($value->_status == 0){ echo "Não retornado"; } else{ echo $value->data_retorno; } ?></td>
									<td><?php echo $value->dias_atraso; ?></td>
									<td style="text-align: center;"><a href="saidas_detalhes.php?id=<?php echo $value->id_saida; ?>"><img src="../imagens/plus.png"></a></td>
									<td style="text-align: center;"><a href="../paginas_processos/editar.php?id=<?php echo $value->id_saida; ?>&pg=saidas&devolucao=<?php echo true; ?>"><img src="../imagens/tick.png"></a></td>
								</tr>

								<?php

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
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

	</body>
</html>
<?php

	// Unsets para limpar 'sessions' de erro_cadastro e filtrar_saidas

	unset($_SESSION['filtrar_saidas']);
	unset($_SESSION['erro_cadastro']);

?>