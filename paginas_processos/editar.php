<?php

	// Código responsável por lidar com as solicitações de edição e exclusão de registros no banco de dados

	// O código determina se é uma solicitação de exclusão pelo valor da variável 'delete', e se é uma edição em qualquer outro caso

	// A página de origem é determinada pela variável 'pg'

	// O Switch uso a valor de 'pg' para determinar qual o procedimento que será utilizado para editar os dados

	// Campos vazios nos formulários de edição não resultam em alterações no banco

	// O código de edição também é responsável por lidar com a alteração de status de ativo para inativo, e vice-versa

	// Os pagamentos de multa também são realizados pelo código de edição

	require __DIR__ .'../../vendor/autoload.php';
	require __DIR__ .'../../database.php';

	use App\alunos;
	use App\saidas;
	use App\livros;
	use App\itens;
	use App\adm_users;

	session_start();

	$id_item = $_GET['id_item'];
	$id = $_GET['id'];
	$deletar = $_GET['delete'];

	if($deletar==true){
		$deletar = false;

		switch ($_GET['pg']) {
			case 'alunos':
				$del = alunos::where(['id_aluno'=>$id])->delete();
				header('location: ../paginas_adm/alunos_consulta.php');
				exit();
				break;
			
			case 'livros':

				$itens = itens::where(['id_livro'=>$id])->get();

				foreach($itens as $key => $value){

					$del = itens::where(['id_item'=>$value->id_item])->delete();

				}
				
				$del = livros::where(['id_livro'=>$id])->delete();
				header('location: ../paginas_adm/livros_consulta.php');
				exit();
				break;

			case 'itens':
				$del = itens::where(['id_item'=>$id_item])->delete();
				header('location: ../paginas_adm/livros_detalhes.php?id='.$id);
				exit();
				break;

			case 'adms':
				$del = adm_users::where(['id_adm'=>$id])->delete();
				header('location: ../paginas_adm/adms_consulta.php');
				exit();
				break;

			case 'saidas':
				$del = saidas::where(['id_saida'=>$id])->delete();
				header('location: ../paginas_adm/saidas_consulta.php');
				exit();
				break;
		}
	}

	switch ($_GET['pg']) {
		case 'alunos':
				if(!(empty($_POST['ativo']))) {	
					switch ($_POST['ativo']) {
						case '1':
							alunos::where(['id_aluno'=>$id])->update(['ativo'=>1]);
							break;
						
						case '2':
							alunos::where(['id_aluno'=>$id])->update(['ativo'=>0]);
							break;
					}
				}
				if(!(empty($_POST['cod_aluno']))) {
					alunos::where(['id_aluno'=>$id])->update(['cod_aluno'=>$_POST['cod_aluno']]);
				}
				if(!(empty($_POST['nome']))) {
					alunos::where(['id_aluno'=>$id])->update(['nome'=>$_POST['nome']]);
				}
				if(!(empty($_POST['sobrenome']))) {
					alunos::where(['id_aluno'=>$id])->update(['sobrenome'=>$_POST['sobrenome']]);
				}
				if(!(empty($_POST['sexo']))) {
					alunos::where(['id_aluno'=>$id])->update(['sexo'=>$_POST['sexo']]);
				}
				if(!(empty($_POST['nascimento']))) {
					alunos::where(['id_aluno'=>$id])->update(['nascimento'=>$_POST['nascimento']]);
				}
				if(!(empty($_POST['cidade']))) {
					alunos::where(['id_aluno'=>$id])->update(['cidade'=>$_POST['cidade']]);
				}
				if(!(empty($_POST['curso']))) {
					alunos::where(['id_aluno'=>$id])->update(['curso'=>$_POST['curso']]);
				}
				if(!(empty($_POST['serie']))) {
					alunos::where(['id_aluno'=>$id])->update(['serie'=>$_POST['serie']]);
				}
				if(!(empty($_POST['email']))) {
					alunos::where(['id_aluno'=>$id])->update(['email'=>$_POST['email']]);
				}
				if(!(empty($_POST['ddd']))) {
					alunos::where(['id_aluno'=>$id])->update(['ddd'=>$_POST['ddd']]);
				}
				if(!(empty($_POST['telefone']))) {
					alunos::where(['id_aluno'=>$id])->update(['telefone'=>$_POST['telefone']]);
				}
				if(!(empty($_POST['senha']))) {
					alunos::where(['id_aluno'=>$id])->update(['senha'=>$_POST['senha']]);
				}

				header('location: ../paginas_adm/alunos_detalhes.php?id='.$id);
						break;
		
		case 'livros':
			if(!(empty($_POST['ativo']))) {	
					switch ($_POST['ativo']) {
						case '1':
							livros::where(['id_livro'=>$id])->update(['ativo'=>1]);
							break;
						
						case '2':
							livros::where(['id_livro'=>$id])->update(['ativo'=>0]);
							break;
					}
				}
				if(!(empty($_POST['titulo']))) {
					livros::where(['id_livro'=>$id])->update(['titulo'=>$_POST['titulo']]);
				}
				if(!(empty($_POST['autor']))) {
					livros::where(['id_livro'=>$id])->update(['autor'=>$_POST['autor']]);
				}
				if(!(empty($_POST['editora']))) {
					livros::where(['id_livro'=>$id])->update(['editora'=>$_POST['editora']]);
				}
				if(!(empty($_POST['ano_edicao']))) {
					livros::where(['id_livro'=>$id])->update(['ano_edicao'=>$_POST['ano_edicao']]);
				}
				if(!(empty($_POST['volume']))) {
					livros::where(['id_livro'=>$id])->update(['volume'=>$_POST['volume']]);
				}
				if(!(empty($_POST['categoria']))) {
					livros::where(['id_livro'=>$id])->update(['categoria'=>$_POST['categoria']]);
				}
				
				header('location: ../paginas_adm/livros_detalhes.php?id='.$id);
			break;

		case 'itens':
			$ativo = itens::where(['id_item'=>$id_item])->value(ativo);
			if(itens::where(['id_item'=>$id_item])->value(_status) == 0){

				header('location: ../paginas_adm/livros_detalhes.php?erro=1&id='.$id);
				exit();
			}
			if($ativo==0){
				$ativo = 1;
			}
			else{
				$ativo = 0;	
			}
			itens::where(['id_item'=>$id_item])->update(['ativo'=>$ativo]);
			header('location: ../paginas_adm/livros_detalhes.php?id='.$id);
			break;

		case 'adms':
			if(!(empty($_POST['ativo']))) {	
					switch ($_POST['ativo']) {
						case '1':
							adm_users::where(['id_adm'=>$id])->update(['ativo'=>1]);
							break;
						
						case '2':
							adm_users::where(['id_adm'=>$id])->update(['ativo'=>0]);
							break;
					}
				}
			if(!(empty($_POST['nome']))) {
					adm_users::where(['id_adm'=>$id])->update(['nome'=>$_POST['nome']]);
				}
				if(!(empty($_POST['sobrenome']))) {
					adm_users::where(['id_adm'=>$id])->update(['sobrenome'=>$_POST['sobrenome']]);
				}
				if(!(empty($_POST['sexo']))) {
					adm_users::where(['id_adm'=>$id])->update(['sexo'=>$_POST['sexo']]);
				}
				if(!(empty($_POST['nascimento']))) {
					adm_users::where(['id_adm'=>$id])->update(['nascimento'=>$_POST['nascimento']]);
				}
				if(!(empty($_POST['cidade']))) {
					adm_users::where(['id_adm'=>$id])->update(['cidade'=>$_POST['cidade']]);
				}
				if(!(empty($_POST['login']))) {
					adm_users::where(['id_adm'=>$id])->update(['login'=>$_POST['login']]);
				}
				if(!(empty($_POST['senha']))) {
					adm_users::where(['id_adm'=>$id])->update(['senha'=>$_POST['senha']]);
				}
				if(!(empty($_POST['email']))) {
					adm_users::where(['id_adm'=>$id])->update(['email'=>$_POST['email']]);
				}
				if(!(empty($_POST['ddd']))) {
					adm_users::where(['id_adm'=>$id])->update(['ddd'=>$_POST['ddd']]);
				}
				if(!(empty($_POST['telefone']))) {
					adm_users::where(['id_adm'=>$id])->update(['telefone'=>$_POST['telefone']]);
				}

				header('location: ../paginas_adm/adms_detalhes.php?id='.$id);
			break;

		case 'adms_perfil':

				if(!(empty($_POST['nome']))) {
					adm_users::where(['id_adm'=>$id])->update(['nome'=>$_POST['nome']]);
				}
				if(!(empty($_POST['sobrenome']))) {
					adm_users::where(['id_adm'=>$id])->update(['sobrenome'=>$_POST['sobrenome']]);
				}
				if(!(empty($_POST['sexo']))) {
					adm_users::where(['id_adm'=>$id])->update(['sexo'=>$_POST['sexo']]);
				}
				if(!(empty($_POST['nascimento']))) {
					adm_users::where(['id_adm'=>$id])->update(['nascimento'=>$_POST['nascimento']]);
				}
				if(!(empty($_POST['cidade']))) {
					adm_users::where(['id_adm'=>$id])->update(['cidade'=>$_POST['cidade']]);
				}
				if(!(empty($_POST['login']))) {
					adm_users::where(['id_adm'=>$id])->update(['login'=>$_POST['login']]);
					$_SESSION['login'] = adm_users::where(['id_adm'=>$id])->value(login);
				}
				if(!(empty($_POST['senha']))) {
					adm_users::where(['id_adm'=>$id])->update(['senha'=>$_POST['senha']]);
				}
				if(!(empty($_POST['email']))) {
					adm_users::where(['id_adm'=>$id])->update(['email'=>$_POST['email']]);
				}
				if(!(empty($_POST['ddd']))) {
					adm_users::where(['id_adm'=>$id])->update(['ddd'=>$_POST['ddd']]);
				}
				if(!(empty($_POST['telefone']))) {
					adm_users::where(['id_adm'=>$id])->update(['telefone'=>$_POST['telefone']]);
				}

				header('location: ../paginas_adm/perfil.php');
			break;

		case 'aluno_perfil':

			if(!(empty($_POST['nome']))) {
				alunos::where(['id_aluno'=>$id])->update(['nome'=>$_POST['nome']]);
			}
			if(!(empty($_POST['sobrenome']))) {
				alunos::where(['id_aluno'=>$id])->update(['sobrenome'=>$_POST['sobrenome']]);
			}
			if(!(empty($_POST['sexo']))) {
				alunos::where(['id_aluno'=>$id])->update(['sexo'=>$_POST['sexo']]);
			}
			if(!(empty($_POST['nascimento']))) {
				alunos::where(['id_aluno'=>$id])->update(['nascimento'=>$_POST['nascimento']]);
			}
			if(!(empty($_POST['cidade']))) {
				alunos::where(['id_aluno'=>$id])->update(['cidade'=>$_POST['cidade']]);
			}
			if(!(empty($_POST['senha']))) {
				alunos::where(['id_aluno'=>$id])->update(['senha'=>$_POST['senha']]);
			}
			if(!(empty($_POST['email']))) {
				alunos::where(['id_aluno'=>$id])->update(['email'=>$_POST['email']]);
			}
			if(!(empty($_POST['ddd']))) {
				alunos::where(['id_aluno'=>$id])->update(['ddd'=>$_POST['ddd']]);
			}
			if(!(empty($_POST['telefone']))) {
				alunos::where(['id_aluno'=>$id])->update(['telefone'=>$_POST['telefone']]);
			}

			header('location: ../paginas_aluno/perfil_aluno.php');
			break;

		case 'saidas':
				$id_aluno =saidas::where(['id_saida'=>$id])->value(id_aluno);
				$atraso = saidas::where(['id_saida'=>$id])->value(dias_atraso);
				$status = saidas::where(['id_saida'=>$id])->value(_status);
				$id_item = saidas::where(['id_saida'=>$id])->value(id_item);
				if($_GET['devolucao'] == true && $status == 0){
					alunos::where(['id_aluno'=>$id_aluno])->update(['multa_passiva'=>($atraso*1.25)]);
					saidas::where(['id_saida'=>$id])->update(['_status'=>1]);
					itens::where(['id_item'=>$id_item])->update(['_status'=>1]);
					saidas::where(['id_saida'=>$id])->update(['data_retorno'=>date("Y-m-d")]);
					header('location: ../paginas_adm/saidas_consulta.php');
					exit();
				}

				if(!(empty($_POST['id_aluno']))) {
					saidas::where(['id_saida'=>$id])->update(['id_aluno'=>$_POST['id_aluno']]);
					$nome = alunos::where(['id_aluno'=>$_POST['id_aluno']])->value(nome);
					saidas::where(['id_saida'=>$id])->update(['nome'=>$nome]);
					$sobrenome = alunos::where(['id_aluno'=>$_POST['id_aluno']])->value(sobrenome);
					saidas::where(['id_saida'=>$id])->update(['sobrenome'=>$sobrenome]);
				}
				if(!(empty($_POST['id_item']))) {
					saidas::where(['id_saida'=>$id])->update(['id_item'=>$_POST['id_item']]);
					$titulo = livros::where(['id_livro'=>$_POST['id_item']])->value(titulo);
					saidas::where(['id_saida'=>$id])->update(['titulo'=>$titulo]);
				}

				header('location: ../paginas_adm/saidas_detalhes.php?id='.$id);
			break;

		case 'alunos_pagamento':

			$valor_multa = alunos::where(['id_aluno'=>$id])->value(total_multa);
			$subtracao = $valor_multa - $_POST['valorPagamento'];

			if($subtracao < 0){
				header('location: ../paginas_adm/alunos_detalhes.php?erro=1&id='.$id);
				exit();
			}

			if(!(empty($_POST['valorPagamento']))){
				alunos::where(['id_aluno'=>$id])->update(['total_multa'=>$subtracao]);
			}
			header('location: ../paginas_adm/alunos_detalhes.php?id='.$id);
			break;
	}

?>
