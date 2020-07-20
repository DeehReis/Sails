<!DOCTYPE html>
<?php

	// Página com edição e exclusão de dados de saídas, reservada para adms

	require __DIR__ .'../../vendor/autoload.php';
	require __DIR__ .'../../database.php';

	use App\saidas;

	// Verificação de login

	session_start();

	if(!(isset($_SESSION['log'])) && $_SESSION['log'] !=1){
		header('Location: ../index.php');
		exit();
	}	

	// Pegar variável id, da página anterior, para identificar qual linha da tabela será trabalhada

	$dados = saidas::where(['id_saida'=>$_GET['id']]);
	$id = $_GET['id'];	

?>

<html lang="en">
	<head>

		<!-- Required meta tags -->

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<title>Detalhes da Saídas</title>

		<link rel="stylesheet" type="text/css" href="../css/styles.css">

		<!-- Bootstrap CSS -->

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	</head>
	<body id="saidas_consulta">

		<!-- Modal de edição -->

		<div class="modal fade" id="modalModelo" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
		    	<div class="modal-content">
		      		<div class="modal-header">
		        		<h5 class="modal-title" id="exampleModalLabel" style="padding-left: 5%">&bull; Editar</h5>

		        		<button type="button" class="close" data-dismiss="modal">
		          			<span>&times;</span>
		        		</button>

		      		</div>
		      		<div class="modal-body">

		        		<form action="../paginas_processos/editar.php?id=<?php echo $id; ?>&pg=saidas" method="POST">
		        			<b>Editar dados de saída:<br>
		        			<span style="font-size: 10px">*Manter campos em branco, caso não queira edita-los!</span></b><br>
		        			<span style="font-size: 10px">*Evitar caracteres especiais!</span>
		        			<br>
		        			<span style="float: left; font-size: 10px; width: 50%;">*Somente números</span>
					       	<hr>
			        		<input type="text" name="id_aluno" placeholder="ID.Aluno" maxlength="10" style="margin-right:6%;" class="input_modal" pattern="\d*" value="<?php echo $dados->value('id_aluno'); ?>">
			        		<input type="text" name="id_item" placeholder="ID.Item" maxlength="10" class="input_modal" pattern="\d*" value="<?php echo $dados->value('id_item'); ?>">
			        		<hr style="clear: left">
	
	      					<input type="submit" class="input_modal" value="Salvar" style="margin-right: 67px; padding: 5px">
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

		      			<a class="btn btn-primary excluir" href="../paginas_processos/editar.php?id=<?php echo $id; ?>&pg=saidas&delete=<?php echo true; ?>">
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
			<span class="table_titulo" style="border:none;">Detalhes da Saída</span>
			<br>
		</div>
		<div style="text-align: center">
		<span style="font-size: 14px"><b>*Não é recomendado excluir saídas recentes</b></span>
		</div>

		<!-- Tabela de dados, para DESKTOP -->

		<div class="conteudo d-none d-sm-block">
			<div class="rounded" style="border: 1px solid lightgray; padding: 0; font-size: 14px; text-align: center;">
				<div style="width: 13%;" class="dados_name">ID.Saída</div>
				<div style="width: 37%;" class="dados_data"><?php echo $dados->value('id_saida'); ?></div>
				<div style="width: 13%;" class="dados_name">ID.Aluno</div>
				<div style="width: 37%;" class="dados_data"><?php echo $dados->value('id_aluno'); ?></div>
				<div style="clear: left"></div>

				<div style="width: 13%;" class="dados_name">Nome</div>
				<div style="width: 37%;" class="dados_data"><?php echo $dados->value('nome'); ?></div>
				<div style="width: 13%;" class="dados_name">Sobrenome</div>
				<div style="width: 37%;" class="dados_data"><?php echo $dados->value('sobrenome'); ?></div>
				<div style="clear: left"></div>

				<div style="width: 13%;" class="dados_name">ID.Item</div>
				<div style="width: 37%;" class="dados_data"><?php echo $dados->value('id_item'); ?></div>
				<div style="width: 13%;" class="dados_name">Status</div>
				<div style="width: 37%;" class="dados_data"><?php if($dados->value('_status') == 0){ echo "Retirado"; } else{ echo "Em estoque"; }; ?></div>
				<div style="clear: left"></div>

				<div style="width: 13%;" class="dados_name">Título</div>
				<div style="width: 77%;" class="dados_data"><?php echo $dados->value('titulo'); ?></div>
				<div style="clear: left"></div>

			</div>

			<div class="rounded" style="border: 1px solid lightgray; padding: 0; font-size: 13px; text-align: center; margin-top: 15px;">
				<div style="width: 13%;" class="dados_name">Data-Saída</div>
				<div style="width: 37%;" class="dados_data"><?php echo $dados->value('data_saida'); ?></div>
				<div style="width: 13%;" class="dados_name">Data-Limite</div>
				<div style="width: 37%;" class="dados_data"><?php echo $dados->value('data_limite'); ?></div>
				<div style="clear: left"></div>
				<div style="width: 13%;" class="dados_name">Data-Retorno</div>
				<div style="width: 37%;" class="dados_data"><?php if(empty($dados->value('data_retorno'))){ echo "Não retornado"; } else{ echo $dados->value('data_retorno'); } ?></div>
				<div style="width: 13%;" class="dados_name">Atraso(Dias)</div>
				<div style="width: 37%;" class="dados_data"><?php echo $dados->value('dias_atraso'); ?></div>
				<div style="clear: left"></div>
			</div>

		</div>

		<!-- Tabela de dados, para MOBILE -->

		<div class="d-block d-sm-none">
			<div style="border: 1px solid lightgray; padding: 0; font-size: 14px; text-align: center;">
				<div class="dados_name_xs">ID.Saída</div>
				<div class="dados_data_xs"><?php echo $dados->value('id_saida'); ?></div>
				<div class="dados_name_xs">ID.Aluno</div>
				<div class="dados_data_xs"><?php echo $dados->value('id_aluno'); ?></div>
				<div style="clear: left"></div>

				<div class="dados_name_xs">Nome</div>
				<div class="dados_data_xs"><?php echo $dados->value('nome'); ?></div>
				<div class="dados_name_xs">Sobrenome</div>
				<div class="dados_data_xs"><?php echo $dados->value('sobrenome'); ?></div>
				<div style="clear: left"></div>

				<div class="dados_name_xs">ID.Item</div>
				<div class="dados_data_xs"><?php echo $dados->value('id_item'); ?></div>
				<div class="dados_name_xs">Status</div>
				<div class="dados_data_xs"><?php if($dados->value('_status') == 0){ echo "Retirado"; } else{ echo "Em estoque"; }; ?></div>
				<div style="clear: left"></div>

				<div style="width: 20%;" class="dados_name_xs">Título</div>
				<div style="width: 75%;" class="dados_data_xs overflow_detalhes"><?php echo $dados->value('titulo'); ?></div>
				<div style="clear: left"></div>

			</div>

			<div style="border: 1px solid lightgray; padding: 0; font-size: 13px; text-align: center; margin-top: 15px;">
				<div class="dados_name_xs">Saída</div>
				<div class="dados_data_xs"><?php echo $dados->value('data_saida'); ?></div>
				<div class="dados_name_xs">Limite</div>
				<div class="dados_data_xs"><?php echo $dados->value('data_limite'); ?></div>
				<div style="clear: left"></div>

				<div class="dados_name_xs">Retorno</div>
				<div class="dados_data_xs"><?php if(empty($dados->value('data_retorno'))){ echo "Não retornado"; } else{ echo $dados->value('data_retorno'); } ?></div>
				<div class="dados_name_xs">Atraso</div>
				<div class="dados_data_xs"><?php echo $dados->value('dias_atraso'); ?></div>
				<div style="clear: left"></div>
			</div>
		</div>

		<!-- DIV com botão de edição e exclusão, para DESKTOP -->

		<div class="d-none d-sm-block">
			<div style="text-align: center; margin: -60px 0 20px 0;">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalModelo" style="margin-right: 20px">
	  				Editar dados da saída
				</button>
				<button type="button" class="btn btn-primary excluir" data-toggle="modal" data-target="#modalConfirma" style="margin-right: 20px">
	  				Excluir
				</button>
			</div>	
		</div>

		<!-- DIV com botão de edição e exclusão, para DESKTOP -->

		<div class="d-block d-sm-none">
			<div style="text-align: center; margin-top: 15px;">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalModelo" style="margin-right: 20px">
	  				Editar dados da saída
				</button>
				<button type="button" class="btn btn-primary excluir" data-toggle="modal" data-target="#modalConfirma" style="margin-right: 20px">
	  				Excluir
				</button>
		   		<br><br>
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
