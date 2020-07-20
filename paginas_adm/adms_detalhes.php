<!DOCTYPE html>

<?php

	// Página com edição e exclusão de dados de administradores, reservada para adms

	require __DIR__ .'../../vendor/autoload.php';
	require __DIR__ .'../../database.php';

	use App\adm_users;

	// Verificação de login

	session_start();

	if(!(isset($_SESSION['log'])) && $_SESSION['log'] !=1){
		header('Location: ../index.php');
		exit();
	}	

	// Pegar variável id, da página anterior, para identificar qual linha da tabela será trabalhada

	$id = $_GET['id'];
	$dados = adm_users::where(['id_adm'=>$_GET['id']]);

?>

<html lang="en">
	<head>

		<!-- Required meta tags -->

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<title>Detalhes do Administrador</title>

		<link rel="stylesheet" type="text/css" href="../css/styles.css">

		<!-- Bootstrap CSS -->

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	</head>
	<body id="adms_consulta">

		<!-- Modal de edição -->

		<div class="modal fade" id="modalModelo" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
		    	<div class="modal-content">
		      		<div class="modal-header">
		        		<h5 class="modal-title" id="exampleModalLabel" style="padding-left: 5%">&bull; Perfil</h5>

		        		<button type="button" class="close" data-dismiss="modal">
		          			<span>&times;</span>
		        		</button>

		      		</div>
		      		<div class="modal-body">

		        		<form action="../paginas_processos/editar.php?id=<?php echo $id; ?>&pg=adms" method="POST">
		        			<b>Editar dados de administrador:<br>
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
							<input type="text" name="nome" placeholder="Nome" maxlength="20" style="margin-right: 6%" class="input_modal" value="<?php echo $dados->value('nome'); ?>">
					       	<input type="text" name="sobrenome" placeholder="Sobrenome" maxlength="20" class="input_modal" value="<?php echo $dados->value('sobrenome'); ?>">
			        		<br>
					      	<br>
					       	<br style="clear:left;"><hr>
					       	<span style="float: left; color: gray">Data de nascimento | </span>
			        		<input type="date" name="nascimento" class="input_modal" style="width: 40%; margin-left: 2%" value="<?php echo $dados->value('nascimento'); ?>">
			        		<br><br>
			        		<div class="_radio">
			        			<span style="color:gray;">Sexo |</span>
			        			<input type="radio" name="sexo" value="Mas" <?php if($dados->value('Sexo')=="Mas"){ ?> checked="checked" <?php } ?>>
			        			<label>Masculino</label>
			        			<input type="radio" name="sexo" value="Fem" <?php if($dados->value('Sexo')=="Fem"){ ?> checked="checked" <?php } ?>>
			        			<label>Feminino</label>
			        			<input type="radio" name="sexo" value="N.E" <?php if($dados->value('Sexo')=="N.E"){ ?> checked="checked" <?php } ?>>
			        			<label>Não especificado</label>
			        		</div>
			        		<br>
			        		<hr>
					       	<br>
					       	<input type="text" name="login" placeholder="Login" style="margin-right: 6%" class="input_modal" maxlength="20" value="<?php echo $dados->value('login'); ?>">
					       	<input type="text" name="senha" placeholder="Senha" class="input_modal" maxlength="20" value="<?php echo $dados->value('senha'); ?>">
					       	<input type="text" name="email" placeholder="E-Mail" style="margin-right: 6%" class="input_modal" maxlength="30" value="<?php echo $dados->value('email'); ?>">
					       	<input type="text" name="cidade" placeholder="Cidade" class="input_modal" maxlength="30" value="<?php echo $dados->value('cidade'); ?>">
					       	<br style="clear: left;"><hr>
					       	<input type="text" name="ddd" placeholder="DDD" style="margin-right: 15px; width: 16%;  margin-right: 6%" class="input_modal" pattern="\d*" maxlength="3" value="<?php echo $dados->value('ddd'); ?>">
					       	<input type="text" name="telefone" placeholder="Telefone" class="input_modal" style="margin-right: 6%; width: 25%" pattern="\d*" maxlength="9" value="<?php echo $dados->value('telefone'); ?>"> 
	
	      					<input type="submit" class="input_modal" value="Salvar" style="margin-right: 67px; padding: 5px">
		   				</form>

					</div>
				</div>
			</div>
		</div>

		<!-- Chamada do header -->

		<?php include "..\paginas_include\header.html"; ?>

		<div style="text-align: center; border-bottom: 5px solid lightgray">
			<br>
			<span class="table_titulo" style="border:none;">Detalhes de Administrador</span>
			<br>
		</div>

		<!-- Tabela de dados, para DESKTOP -->

		<div class="conteudo d-none d-sm-block">
			<div class="rounded" style="border: 1px solid lightgray; padding: 0; font-size: 14px; text-align: center;">
				<div style="width: 13%;" class="dados_name">ID</div>
				<div style="width: 37%;" class="dados_data"><?php echo $dados->value('id_adm'); ?></div>
				<div style="width: 13%;" class="dados_name">Login</div>
				<div style="width: 37%;" class="dados_data"><?php echo $dados->value('login'); ?></div>

				<div style="width: 13%;" class="dados_name">Nome</div>
				<div style="width: 37%;" class="dados_data overflow_detalhes"><?php echo $dados->value('nome'); ?></div>
				<div style="width: 13%;" class="dados_name">Sobrenome</div>
				<div style="width: 37%;" class="dados_data overflow_detalhes"><?php echo $dados->value('sobrenome'); ?></div>

				<div style="width: 13%;" class="dados_name">Sexo</div>
				<div style="width: 37%;" class="dados_data"><?php echo $dados->value('sexo'); ?></div>
				<div style="width: 13%;" class="dados_name">Nascimento</div>
				<div style="width: 37%;" class="dados_data"><?php echo $dados->value('nascimento'); ?></div>

				<div style="width: 13%;" class="dados_name">Cidade</div>
				<div style="width: 37%;" class="dados_data overflow_detalhes"><?php echo $dados->value('cidade'); ?></div>
				<div style="width: 13%;" class="dados_name">Email</div>
				<div style="width: 37%;" class="dados_data overflow_detalhes"><?php echo $dados->value('email'); ?></div>

				<div style="width: 13%;" class="dados_name">DDD</div>
				<div style="width: 37%;" class="dados_data"><?php echo $dados->value('ddd'); ?></div>
				<div style="width: 13%;" class="dados_name">Telefone</div>
				<div style="width: 37%;" class="dados_data"><?php echo $dados->value('telefone'); ?></div>

				<div style="clear: left"></div>
			</div>
		</div>

		<!-- Tabela de dados, para MOBILE -->

		<div class="d-block d-sm-none">
			<div style="border: 1px solid lightgray; padding: 0; font-size: 14px; text-align: center;">
				<div class="dados_name_xs">ID</div>
				<div class="dados_data_xs"><?php echo $dados->value('id_adm'); ?></div>
				<div class="dados_name_xs">Login</div>
				<div class="dados_data_xs"><?php echo $dados->value('login'); ?></div>

				<div class="dados_name_xs">Nome</div>
				<div class="dados_data_xs overflow_detalhes"><?php echo $dados->value('nome'); ?></div>
				<div class="dados_name_xs">Sobrenome</div>
				<div class="dados_data_xs overflow_detalhes"><?php echo $dados->value('sobrenome'); ?></div>

				<div class="dados_name_xs">Sexo</div>
				<div class="dados_data_xs"><?php echo $dados->value('sexo'); ?></div>
				<div class="dados_name_xs">Nascimento</div>
				<div class="dados_data_xs"><?php echo $dados->value('nascimento'); ?></div>

				<div class="dados_name_xs">Cidade</div>
				<div class="dados_data_xs overflow_detalhes"><?php echo $dados->value('cidade'); ?></div>
				<div class="dados_name_xs">Email</div>
				<div class="dados_data_xs overflow_detalhes"><?php echo $dados->value('email'); ?></div>

				<div class="dados_name_xs">DDD</div>
				<div class="dados_data_xs"><?php echo $dados->value('ddd'); ?></div>
				<div class="dados_name_xs">Telefone</div>
				<div class="dados_data_xs"><?php echo $dados->value('telefone'); ?></div>

				<div style="clear: left"></div>
			</div>
		</div>

		<!-- DIV com botão de edição e exclusão, para DESKTOP -->

		<div class="d-none d-sm-block">
			<div style="text-align: center; margin: -60px 0 20px 0 ">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalModelo" style="margin-right: 20px">
	  			Editar dados de administrador
			</button>
			<a class="btn btn-primary excluir" href="../paginas_processos/editar.php?id=<?php echo $id; ?>&pg=adms&delete=<?php echo true; ?>">
		   		Excluir
		   	</a>
			</div>
		</div>

		<!-- DIV com botão de edição e exclusão, para MOBILE -->

		<div class="d-block d-sm-none">
			<div style="text-align: center; margin-top: 15px; text-align: center">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalModelo" style="margin-right: 20px">
	  			Editar dados de administrador
			</button>
			<a class="btn btn-primary excluir" href="../paginas_processos/editar.php?id=<?php echo $id; ?>&pg=adms&delete=<?php echo true; ?>">
		   		Excluir
		   	</a>
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