<!DOCTYPE html>

<?php

	// Página com edição e exclusão de dados de alunos, reservada para adms

	require __DIR__ .'../../vendor/autoload.php';
	require __DIR__ .'../../database.php';

	use App\alunos;
	use App\saidas;
	use App\itens;
	use App\livros;

	// Verificação de login

	session_start();

	if(!(isset($_SESSION['log'])) && $_SESSION['log'] !=1){
		header('Location: ../index.php');
		exit();
	}	

	// Pegar variável id, da página anterior, para identificar qual linha da tabela será trabalhada

	$dados = livros::where(['id_livro'=>$_GET['id']]);
	$id = $_GET['id'];	

?>

<html lang="en">
	<head>

		<!-- Required meta tags -->

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<title>Detalhes do Livro</title>

		<link rel="stylesheet" type="text/css" href="../css/styles.css">

		<!-- Bootstrap CSS -->

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	</head>
	<body id="livros_consulta">

		<!-- Modal de edição -->

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

		        		<form action="../paginas_processos/editar.php?id=<?php echo $id; ?>&pg=livros" method="POST">
		        			<b>Editar dados de livro:<br>
		        			<span style="font-size: 10px">*Manter campos em branco, caso não queira edita-los!</span></b><br>
		        			<span style="font-size: 10px">*Evitar caracteres especiais!</span>
		        			<hr>
		        			<div class="_radio" style="margin-right: 50px;">
					       		<input type="radio" name="ativo" value="1" <?php if($dados->value('ativo')==1){ ?> checked="checked" <?php } ?>>
					       		<label>Ativo</label>	
					       		<input type="radio" name="ativo" value="2" <?php if($dados->value('ativo')==0){ ?> checked="checked" <?php } ?>>
					       		<label>Inativo</label>
					       	</div>
					       	<br>
					       	<hr>
			        		<input type="text" name="titulo" placeholder="Título" maxlength="100" style="margin-right:6%;" class="input_modal" value="<?php echo $dados->value('titulo'); ?>">
			        		<input type="text" name="autor" placeholder="Autor" class="input_modal" maxlength="50" value="<?php echo $dados->value('autor'); ?>">
					      	<br>
					       	<br style="clear:left;"><hr>
					       	<br>
					       	<input type="text" name="editora" placeholder="Editora" maxlength="50" style="margin-right: 6%" class="input_modal" value="<?php echo $dados->value('editora'); ?>">
					       	<input type="text" name="ano_edicao" placeholder="Ano de edição" maxlength="4" class="input_modal" pattern="\d*" value="<?php echo $dados->value('ano_edicao'); ?>">
					       	<br><br>
			        		<hr>
					       	<input type="text" name="volume" placeholder="Volume" style="margin-right: 6%" class="input_modal" pattern="\d*" value="<?php echo $dados->value('volume'); ?>">
					       	<input type="text" name="categoria" placeholder="Categoria" class="input_modal" value="<?php echo $dados->value('categoria'); ?>">
					       	<br style="clear: left;"><hr>	
	      					<input type="submit" name="Editar" class="input_modal">
		   				</form>

					</div>
				</div>
			</div>
		</div>
		
		<!-- Modal de exclusão -->

		<div class="modal fade" id="modalConfirma" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
		    	<div class="modal-content">
		      		<div class="modal-header">
		        		<h5 class="modal-title" id="exampleModalLabel" style="padding-left: 5%">&bull; Confirmar exclusão</h5>

		        		<button type="button" class="close" data-dismiss="modal">
		          			<span>&times;</span>
		        		</button>

		      		</div>
		      		<div class="modal-body" style="text-align: center">

		      			<a class="btn btn-primary excluir" href="../paginas_processos/editar.php?id=<?php echo $id; ?>&pg=livros&delete=<?php echo true; ?>">
		   					Excluir
		   				</a>

					</div>
				</div>
			</div>
		</div>

		<!-- Chamada do header -->

		<?php include "..\paginas_include\header.html"; ?>

		<div style="text-align: center; border-bottom: 5px solid lightgray">
			<br>
			<span class="table_titulo" style="border:none;">Detalhes do Livro</span>
			<br>
		</div>

		<!-- Tabela de dados, para DESKTOP -->

		<div class="conteudo d-none d-sm-block">
			<div class="rounded" style="border: 1px solid lightgray; padding: 0; font-size: 14px; text-align: center; margin-bottom: 15px">
				<div style="width: 13%;" class="dados_name">ID</div>
				<div style="width: 37%;" class="dados_data"><?php echo $dados->value('id_livro'); ?></div>
				<div style="width: 13%;" class="dados_name">Ativo</div>
				<div style="width: 37%;" class="dados_data"><?php if($dados->value('ativo')==1){ echo "Sim"; } else{ echo "Não"; } ?></div><br>

				<div style="clear: left"></div>
			</div>

			<div class="rounded" style="border: 1px solid lightgray; padding: 0; font-size: 14px; text-align: center;">

				<div style="width: 13%;" class="dados_name">Título</div>
				<div style="width: 77%;" class="dados_data overflow_detalhes"><?php echo $dados->value('titulo'); ?></div>

				<div style="width: 13%;" class="dados_name">Autor</div>
				<div style="width: 77%;" class="dados_data overflow_detalhes"><?php echo $dados->value('autor'); ?></div>

				<div style="clear: left"></div>
			</div>

			<div class="rounded" style="border: 1px solid lightgray; padding: 0; font-size: 13px; text-align: center; margin-top: 15px;">
				<div style="width: 13%;" class="dados_name">Editora</div>
				<div style="width: 37%;" class="dados_data overflow_detalhes"><?php echo $dados->value('editora'); ?></div>
				<div style="width: 13%;" class="dados_name">Ano de Edição</div>
				<div style="width: 37%;" class="dados_data"><?php echo $dados->value('ano_edicao'); ?></div>

				<div style="width: 13%;" class="dados_name">Volume</div>
				<div style="width: 37%;" class="dados_data"><?php echo $dados->value('volume'); ?></div>
				<div style="width: 13%;" class="dados_name">Categoria</div>
				<div style="width: 37%;" class="dados_data overflow_detalhes"><?php echo $dados->value('categoria'); ?></div>
				<div style="clear: left"></div>
			</div>
		</div>

		<!-- Tabela de dados, para MOBILE -->

		<div class="d-block d-sm-none">
			<div style="border: 1px solid lightgray; padding: 0; font-size: 14px; text-align: center; margin-bottom: 15px">
				<div class="dados_name_xs">ID</div>
				<div class="dados_data_xs"><?php echo $dados->value('id_livro'); ?></div>
				<div class="dados_name_xs">Ativo</div>
				<div class="dados_data_xs"><?php if($dados->value('ativo')==1){ echo "Sim"; } else{ echo "Não"; } ?></div><br>

				<div style="clear: left"></div>
			</div>

			<div style="border: 1px solid lightgray; padding: 0; font-size: 14px; text-align: center;">

				<div style="width: 20%;" class="dados_name_xs">Título</div>
				<div style="width: 80%;" class="dados_data_xs overflow_detalhes"><?php echo $dados->value('titulo'); ?></div>

				<div style="width: 20%;" class="dados_name_xs">Autor</div>
				<div style="width: 80%;" class="dados_data_xs overflow_detalhes"><?php echo $dados->value('autor'); ?></div>

				<div style="clear: left"></div>
			</div>

			<div style="border: 1px solid lightgray; padding: 0; font-size: 13px; text-align: center; margin-top: 15px;">
				<div class="dados_name_xs">Editora</div>
				<div class="dados_data_xs overflow_detalhes"><?php echo $dados->value('editora'); ?></div>
				<div class="dados_name_xs">Edição</div>
				<div class="dados_data_xs"><?php echo $dados->value('ano_edicao'); ?></div>

				<div class="dados_name_xs">Volume</div>
				<div class="dados_data_xs"><?php echo $dados->value('volume'); ?></div>
				<div class="dados_name_xs">Categoria</div>
				<div class="dados_data_xs overflow_detalhes"><?php echo $dados->value('categoria'); ?></div>
				<div style="clear: left"></div>
			</div>
		</div>

		<!-- DIV com botão de novo item, edição e exclusão, para DESKTOP -->

		<div class="conteudo d-none d-sm-block">
			<div style="text-align: center; margin: -140px 0 0 0;">
				<a class="btn btn-primary" href="../paginas_processos/cadastro.php?id=<?php echo $id; ?>&pg=itens" style="margin-right: 20px">
		   			Novo item
		   		</a>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalModelo" style="margin-right: 20px">
	  				Editar dados do livro
				</button>
				<button type="button" class="btn btn-primary excluir" data-toggle="modal" data-target="#modalConfirma" style="margin-right: 20px">
	  				Excluir
				</button>
		   		<br><br>
			</div>		
		</div>

		<!-- DIV com botão de novo item, edição e exclusão, para DESKTOP -->

		<div class="d-block d-sm-none">
			<div style="text-align: center; margin-top: 15px;">
				<a class="btn btn-primary" href="../paginas_processos/cadastro.php?id=<?php echo $id; ?>&pg=itens" style="margin-right: 20px">
		   			Novo item
		   		</a>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalModelo">
	  				Editar
				</button>
				<br><br>
				<button type="button" class="btn btn-primary excluir" data-toggle="modal" data-target="#modalConfirma" style="margin-right: 20px">
	  				Excluir
				</button>
		   		<br><br>
			</div>		
		</div>

		<?php

			// Mensagem de erro ao inativar item

			if(isset($_GET['erro']) && $_GET['erro'] ==1){
				$_GET['erro'] = 0;
				?>

				<div class="erro">
						
					Erro! Não é possível inativar item fora do estoque.

				</div>

				<?php
			}

		?>

		<!-- Tabela de itens do tipo de livro selecionado, itens com atraso são exibidos em vermelho -->

		<div class="conteudo-consulta" style="border-top: 5px solid lightgray; margin-top: -160px">
			<div style="text-align: center; margin-bottom: -20px">
				<span class="table_titulo" style="border:none;"> Itens e status </span>
			</div>
			<div class="scrollable">
				<table class="table">
					<thead>
						<tr>
							<td>ID.Item</td>
							<td>Ativo</td>	
							<td>Status</td>
							<td>ID.ALuno</td>
							<td>Nome</td>
							<td>Atraso(Dias)</td>
							<td style="background-color: #ffff99">Ativar/Inativar</td>
							<td style="background-color: #ff4d4d">Remover</td>
						</tr>
					</thead>
					<tbody>
						<?php

							$itens = itens::where(['id_livro'=>$id])->get();

							// Foreach para percorrer o banco de dados

							foreach($itens as $key => $value){

								if($value->_status==0){
									$id_aluno = saidas::orderBy('data_saida','DESC')->where(['id_item'=>$value->id_item])->value('id_aluno');
									$nome_sobrenome = alunos::where(['id_aluno'=>$id_aluno])->value('nome')." ".alunos::where(['id_aluno'=>$id_aluno])->value('sobrenome');
									$atraso = saidas::orderBy('id_saida','DESC')->where(['id_item'=>$value->id_item])->value('dias_atraso');

									if(isset($atraso)==false){
										$atraso = 0;
									}

									?>

									<tr <?php if($atraso>0){ ?> style="background-color: #ffcccc; color: #660000" <?php } ?>>
										<td><?php echo $value->id_item; ?></td>
										<td><?php echo $value->ativo; ?></td>
										<td><?php echo "Retirado"; ?></td>
										<td><?php echo $id_aluno; ?></td>
										<td><?php echo $nome_sobrenome; ?></td>
										<td><?php echo $atraso; ?></td>
										<td><a href="../paginas_processos/editar.php?id=<?php echo $id; ?>&id_item=<?php echo $value->id_item; ?>&pg=itens"><img src="../imagens/edit.png"></a></td>
										<td><a href="../paginas_processos/editar.php?id=<?php echo $id; ?>&id_item=<?php echo $value->id_item; ?>&pg=itens&delete=<?php echo true; ?>"><img src="../imagens/close.png"></a></td>
									</tr>

									<?php

								} else{

									?>
									<tr>
										<td><?php echo $value->id_item; ?></td>
										<td><?php echo $value->ativo; ?></td>
										<td><?php echo "Em estoque"; ?></td>
										<td><?php echo "*"; ?></td>
										<td><?php echo "*"; ?></td>
										<td><?php echo "*"; ?></td>
										<td><a href="../paginas_processos/editar.php?id=<?php echo $id; ?>&id_item=<?php echo $value->id_item; ?>&pg=itens"><img src="../imagens/edit.png"></a></td>
										<td><a href="../paginas_processos/editar.php?id=<?php echo $id; ?>&id_item=<?php echo $value->id_item; ?>&pg=itens&delete=<?php echo true; ?>"><img src="../imagens/close.png"></a></td>

									</tr>
									<?php
								}
								$atraso = 0;
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
