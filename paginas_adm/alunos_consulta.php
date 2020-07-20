<!DOCTYPE html>
<?php

	// Página com consulta e cadastro de alunos, reservada para adms

	require __DIR__ .'../../vendor/autoload.php';
	require __DIR__ .'../../database.php';

	use App\alunos;
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

		<title>Consulta de Alunos</title>

		<link rel="stylesheet" type="text/css" href="../css/styles.css">

		<!-- Bootstrap CSS -->

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	</head>
	<body id="alunos_consulta">

		<!-- Modal de cadastro -->

		<div class="modal fade" id="modalModelo" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
		    	<div class="modal-content">
		      		<div class="modal-header">
		        		<h5 class="modal-title" id="exampleModalLabel" style="padding-left: 5%">&bull; Novo Aluno</h5>

		        		<button type="button" class="close" data-dismiss="modal">
		          			<span>&times;</span>
		        		</button>

		      		</div>
		      		<div class="modal-body">

		        		<form action="../paginas_processos/cadastro.php?pg=alunos" method="POST">
		        			<b>Preencha todos os campos abaixo:</b><br>
		        			<span style="font-size: 10px">*Evitar caracteres especiais!</span>
		        			<hr>
			        		<span style="float: left; font-size: 10px; width: 50%;">*Somente números</span>
			        		<input type="text" name="cod_aluno" placeholder="Código Aluno" maxlength="7" style="margin-right:6%;" class="input_modal" pattern="\d*">
			        		<input type="text" name="cidade" placeholder="Cidade" class="input_modal" maxlength="30">
							<input type="text" name="nome" placeholder="Nome" maxlength="20" style="margin-right: 6%" class="input_modal">
					       	<input type="text" name="sobrenome" placeholder="Sobrenome" maxlength="20" class="input_modal">
			        		<br>
					      	<br>
					       	<br style="clear:left;"><hr>
					       	<span style="float: left; color: gray">Data de nascimento | </span>
			        		<input type="date" name="nascimento" class="input_modal" style="width: 40%; margin-left: 2%">
			        		<br><br>
			        		<div class="_radio">
			        			<span style="color:gray;">Sexo |</span>
			        			<input type="radio" name="sexo" value="Mas">
			        			<label>Masculino</label>
			        			<input type="radio" name="sexo" value="Fem">
			        			<label>Feminino</label>
			        			<input type="radio" name="sexo" value="N.E">
			        			<label>Não especificado</label>
			        		</div>
			        		<br>
			        		<hr>
					       	<span style="float: left; font-size: 10px; width: 50%;margin-left: 50%;">*Somente números</span>
					       	<input type="text" name="curso" placeholder="Curso" style="margin-right: 6%" class="input_modal" maxlength="20">
					       	<input type="text" name="serie" placeholder="Serie" class="input_modal" pattern="\d*">
					       	<br>
					       	<span style="float: left; font-size: 10px; width: 50%;">*Senha provisória</span>
					       	<input type="text" name="senha" placeholder="Senha Provisória" style="margin-right: 6%" class="input_modal" value="123456789" maxlength="20">
					       	<input type="text" name="email" placeholder="E-Mail" class="input_modal" maxlength="30">
					       	<br style="clear: left;"><hr>
					       	<input type="text" name="ddd" placeholder="DDD" style="margin-right: 15px; width: 16%;  margin-right: 6%" class="input_modal" pattern="\d*" maxlength="3">
					       	<input type="text" name="telefone" placeholder="Telefone" class="input_modal" style="margin-right: 6%" pattern="\d*" maxlength="9"> 	
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
			$filtro_2 = "Cod";

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
								Erro ao cadastrar, campos em branco!
							</div>
							<?php
							break;
						
						case '2':
							?>
							<div class="erro">
								Erro ao cadastrar, código de aluno já existente!
							</div>
							<?php
							break;

						default:
							break;
					}
				}

				?>

			<br>

			<div class="table_titulo">CONSULTA DE ALUNOS</div>

			<!-- Chegada do filtro, vindo de 'filtros.php' -->

			<?php

				// Verificação para determinar se será usado um filtro novo, ou o filtro padrão

				if(isset($_SESSION['filtrar_alunos'])){
					$alunos = $_SESSION['filtrar_alunos'];
					$atual = $_SESSION['atual'];
				}
				else{
					$alunos = alunos::orderBy('cod_aluno','ASC')->get();
				}	

			?>

			<!-- DIV com botão de cadastro, e opções de filtragem por ativo/inativo, para DESKTOP -->

			<div class="filtros d-none d-sm-block">

				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalModelo" style="display: inline; margin-right: 50%">
  					Cadastrar novo aluno
				</button>
				<form action="../paginas_processos/filtros.php?pg=alunos" method="POST" style="display: inline">
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
  					Cadastrar novo aluno
				</button>
				<br>
				<form action="../paginas_processos/filtros.php?pg=alunos" method="POST" style="display: inline">
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

			<!-- Tabela de alunos cadastrados -->

			<div class="scrollable" style="margin-top: 0">
				<table class="table" style="margin: 0px;">
					<thead>
						<tr>

							<td><a class="<?php if($filtro_2=="Cod"){ echo $atual; } ?>" href="../paginas_processos/filtros.php?pg=alunos&filtro_2=Cod&filtro_1=<?php echo $filtro_1;?>">Cod.Aluno</a></td>
							<td><a class="<?php if($filtro_2=="Nome"){ echo $atual; } ?>" href="../paginas_processos/filtros.php?pg=alunos&filtro_2=Nome&filtro_1=<?php echo $filtro_1; ?>">Nome</a></td>
							<td><a class="<?php if($filtro_2=="Sexo"){ echo $atual; } ?>" href="../paginas_processos/filtros.php?pg=alunos&filtro_2=Sexo&filtro_1=<?php echo $filtro_1; ?>">Sexo</a></td>
							<td><a class="<?php if($filtro_2=="Nasci"){ echo $atual; } ?>" href="../paginas_processos/filtros.php?pg=alunos&filtro_2=Nasci&filtro_1=<?php echo $filtro_1; ?>">Nascimento</a></td>
							<td><a class="<?php if($filtro_2=="Cidade"){ echo $atual; } ?>" href="../paginas_processos/filtros.php?pg=alunos&filtro_2=Cidade&filtro_1=<?php echo $filtro_1; ?>">Cidade</a></td>
							<td><a class="<?php if($filtro_2=="Curso"){ echo $atual; } ?>" href="../paginas_processos/filtros.php?pg=alunos&filtro_2=Curso&filtro_1=<?php echo $filtro_1; ?>">Curso</a></td>
							<td><a class="<?php if($filtro_2=="Serie"){ echo $atual; } ?>" href="../paginas_processos/filtros.php?pg=alunos&filtro_2=Serie&filtro_1=<?php echo $filtro_1; ?>">Serie</a></td>
							<td><a class="<?php if($filtro_2=="Email"){ echo $atual; } ?>" href="../paginas_processos/filtros.php?pg=alunos&filtro_2=Email&filtro_1=<?php echo $filtro_1; ?>">E-mail</a></td>
							<td><a class="<?php if($filtro_2=="Fone"){ echo $atual; } ?>" href="../paginas_processos/filtros.php?pg=alunos&filtro_2=Fone&filtro_1=<?php echo $filtro_1; ?>">Telefone</a></td>
							<td><a class="<?php if($filtro_2=="Livros"){ echo $atual; } ?>" href="../paginas_processos/filtros.php?pg=alunos&filtro_2=Livros&filtro_1=<?php echo $filtro_1; ?>">Livros</a></td>
							<td><a class="<?php if($filtro_2=="Atrasos"){ echo $atual; } ?>" href="../paginas_processos/filtros.php?pg=alunos&filtro_2=Atrasos&filtro_1=<?php echo $filtro_1; ?>">Atrasos</a></td>
							<td><a class="<?php if($filtro_2=="Multa"){ echo $atual; } ?>" href="../paginas_processos/filtros.php?pg=alunos&filtro_2=Multa&filtro_1=<?php echo $filtro_1; ?>">Multa(R$)</a></td>
							<td style="background-color: #b3b3b3">Detalhes</td>

						</tr>
					</thead>
					<tbody>
						<?php

							// Foreach para percorrer banco de dados; Switch case para filtrar de acordo com o filtro Ativo/Inativo

							foreach ($alunos as $key => $value) {

								if(isset($_SESSION['exibir']) == false){
									$_SESSION['exibir'] = "ativos";
								}

								switch ($_SESSION['exibir']) {
									case 'ambos':
										?>
											<tr>
												<td><?php echo $value->cod_aluno; ?></td>
												<td><?php echo $value->nome." ".$value->sobrenome; ?></td> 
												<td><?php echo $value->sexo; ?></td>
												<td><?php echo $value->nascimento; ?></td>
												<td><?php echo $value->cidade; ?></td>
												<td><?php echo $value->curso; ?></td>
												<td><?php echo $value->serie; ?></td>
												<td><?php echo $value->email; ?></td> 
												<td><?php echo $value->ddd." ".$value->telefone; ?></td>
												<td><?php echo $value->total_livros ?></td>
												<td><?php echo $value->total_atrasos ?></td>
												<td><?php echo $value->total_multa ?></td>
												<td style="text-align: center;"><a href="../paginas_adm/alunos_detalhes.php?id=<?php echo $value->id_aluno ?>"><img src="../imagens/plus.png"></a></td>
											</tr>
										<?php
										break;
										
									case 'inativos':
										if($value->ativo==0){
											?>
												<tr>
													<td><?php echo $value->cod_aluno; ?></td>
													<td><?php echo $value->nome." ".$value->sobrenome; ?></td> 
													<td><?php echo $value->sexo; ?></td>
													<td><?php echo $value->nascimento; ?></td>
													<td><?php echo $value->cidade; ?></td>
													<td><?php echo $value->curso; ?></td>
													<td><?php echo $value->serie; ?></td>
													<td><?php echo $value->email; ?></td> 
													<td><?php echo $value->ddd." ".$value->telefone; ?></td>
													<td><?php echo $value->total_livros ?></td>
													<td><?php echo $value->total_atrasos ?></td>
													<td><?php echo $value->total_multa ?></td>
													<td style="text-align: center;"><a href="alunos_detalhes.php?id=<?php echo $value->id_aluno ?>"><img src="../imagens/plus.png"></a></td>
												</tr>
											<?php
										}
										break;

									case 'ativos': default:
										if($value->ativo==1){
										?>
											<tr>
												<td><?php echo $value->cod_aluno; ?></td>
												<td><?php echo $value->nome." ".$value->sobrenome; ?></td> 
												<td><?php echo $value->sexo; ?></td>
												<td><?php echo $value->nascimento; ?></td>
												<td><?php echo $value->cidade; ?></td>
												<td><?php echo $value->curso; ?></td>
												<td><?php echo $value->serie; ?></td>
												<td><?php echo $value->email; ?></td> 
												<td><?php echo $value->ddd." ".$value->telefone; ?></td>
												<td><?php echo $value->total_livros ?></td>
												<td><?php echo $value->total_atrasos ?></td>
												<td><?php echo $value->total_multa ?></td>
												<td style="text-align: center;"><a href="alunos_detalhes.php?id=<?php echo $value->id_aluno ?>"><img src="../imagens/plus.png"></a></td>
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
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	</body>
</html>
<?php

	// Unsets para limpar 'sessions' de erro_cadastro e filtrar_alunos

	unset($_SESSION['filtrar_alunos']);
	unset($_SESSION['erro_cadastro']);

?>