<?php

	// Código responsável por verificar se os campos de cadastro atendem os requisitos, e se nenhuma situação indesejada ocorre, antes de realizar o insert no bando de dados, e redirecionar o usuário a página de consultas atualizada

	// Switch cases determinam de que página a solicitação de cadastro veio, e com isso determinam os valores necessários para realizar o cadastro com sucesso

	// Em caso de erros, um valor é atribuido a SESSION['erro_cadastro'], de acordo com o tipo de erro

	// A SESSION determinará qual mensagem de erro aparece na página de consulta

	// A página de onde a solicitação vem é determinada pelo variável pg, enviada junto ao link

	require __DIR__ .'../../vendor/autoload.php';
	require __DIR__ .'../../database.php';

	use App\alunos;
	use App\saidas;
	use App\livros;
	use App\itens;
	use App\adm_users;

	session_start();

	switch ($_GET['pg']) {
		case 'alunos':

			if(!(empty(alunos::where(['cod_aluno'=>$_POST['cod_aluno']])->value(id_aluno)))){
				$_SESSION['erro_cadastro'] = 2;
				header('Location: ../paginas_adm/alunos_consulta.php');
				exit();
			}

			if(empty($_POST['cod_aluno']) || empty($_POST['nome']) || empty($_POST['sobrenome']) || empty($_POST['sexo']) || empty($_POST['nascimento']) || empty($_POST['cidade']) || empty($_POST['curso']) || empty($_POST['serie']) || empty($_POST['email']) || empty($_POST['ddd']) || empty($_POST['telefone']) || empty($_POST['senha'])){

				$_SESSION['erro_cadastro'] = 1;
				header('Location: ../paginas_adm/alunos_consulta.php');
				exit();
			}

			$cod_aluno = $_POST['cod_aluno'];
			$nome = $_POST['nome'];
			$sobrenome = $_POST['sobrenome'];
			$sexo = $_POST['sexo'];
			$nascimento = $_POST['nascimento'];
			$cidade = $_POST['cidade'];
			$curso = $_POST['curso'];
			$serie = $_POST['serie'];
			$email = $_POST['email'];
			$ddd = $_POST['ddd'];
			$telefone = $_POST['telefone'];
			$senha = $_POST['senha'];

			alunos::insert(['ativo'=>1, 'cod_aluno' => $cod_aluno, 'nome' => $nome, 'sobrenome' => $sobrenome, 'sexo' => $sexo, 'nascimento' => $nascimento, 'cidade' => $cidade, 'curso' => $curso, 'serie' => $serie, 'email' => $email, 'ddd' => $ddd, 'telefone' => $telefone, 'senha' => $senha, 'total_livros'=>0, 'total_atrasos'=>0, 'total_multa'=>0]);

			header('Location: ../paginas_adm/alunos_consulta.php');
			exit();
			break;
		
		case 'livros':
			if(empty($_POST['titulo']) || empty($_POST['autor']) || empty($_POST['editora']) || empty($_POST['ano_edicao']) || empty($_POST['volume']) || empty($_POST['categoria'])){

				$_SESSION['erro_cadastro'] = 1;
				header('Location: ../paginas_adm/livros_consulta.php');
				exit();
			}

			$titulo = $_POST['titulo'];
			$autor = $_POST['autor'];
			$editora = $_POST['editora'];
			$ano_edicao = $_POST['ano_edicao'];
			$volume = $_POST['volume'];
			$categoria = $_POST['categoria'];

			livros::insert(['ativo'=>1, 'titulo' => $titulo, 'autor' => $autor, 'editora' => $editora, 'ano_edicao' => $ano_edicao, 'volume' => $volume, 'categoria' => $categoria]);

			header('Location: ../paginas_adm/livros_consulta.php');
			exit();
			break;

		case 'adms':

			if(!(empty(adm_users::where(['login'=>$_POST['login']])->value('id_adm')))){
				$_SESSION['erro_cadastro'] = 2;
				header('Location: ../paginas_adm/adms_consulta.php');
				exit();
			}

			if(empty($_POST['nome']) || empty($_POST['sobrenome']) || empty($_POST['sexo']) || empty($_POST['nascimento']) || empty($_POST['cidade']) || empty($_POST['email']) || empty($_POST['ddd']) || empty($_POST['telefone']) || empty($_POST['senha']) || empty($_POST['login'])){

				$_SESSION['erro_cadastro'] = 1;
				header('Location: ../paginas_adm/adms_consulta.php');
				exit();
			}

			$nome = $_POST['nome'];
			$sobrenome = $_POST['sobrenome'];
			$sexo = $_POST['sexo'];
			$nascimento = $_POST['nascimento'];
			$cidade = $_POST['cidade'];
			$email = $_POST['email'];
			$ddd = $_POST['ddd'];
			$telefone = $_POST['telefone'];
			$login = $_POST['login'];
			$senha = $_POST['senha'];

			adm_users::insert(['ativo'=>1, 'nome' => $nome, 'sobrenome' => $sobrenome, 'sexo' => $sexo, 'nascimento' => $nascimento, 'cidade' => $cidade, 'email' => $email, 'ddd' => $ddd, 'telefone' => $telefone, 'login' => $login, 'senha' => $senha]);

			header('Location: ../paginas_adm/adms_consulta.php');
			exit();
			break;

		case 'saidas':

			$status_atual_item = saidas::where(['id_item'=>$_POST['id_item']])->orderBy('id_saida','DESC')->value('_status');
			if(count(saidas::where(['id_item'=>$_POST['id_item']])->get())==0){
				$status_atual_item = 1;
			}
			$total_multa_aluno = alunos::where(['id_aluno'=>$_POST['id_aluno']])->value('total_multa');

			if($total_multa_aluno > 0){
				$_SESSION['erro_cadastro'] = 3;
				header('Location: ../paginas_adm/saidas_consulta.php');
				exit();
			}
			if($status_atual_item == 0){
				$_SESSION['erro_cadastro'] = 2;
				header('Location: ../paginas_adm/saidas_consulta.php');
				exit();
			}

			if(empty($_POST['id_aluno']) || empty($_POST['id_item'])){
				$_SESSION['erro_cadastro'] = 1;
				header('Location: ../paginas_adm/saidas_consulta.php');
				exit();
			}

			$check_aluno = alunos::where(['id_aluno'=>$_POST['id_aluno']]) -> get();
			$check_item = itens::where(['id_item'=>$_POST['id_item']]) -> get();

			if(!(count($check_aluno)>0 && count($check_item)>0)){
				$_SESSION['erro_cadastro'] = 1;
				header('Location: ../paginas_adm/saidas_consulta.php');
				exit();
			}

			$id_aluno = $_POST['id_aluno'];
			$nome = alunos::where(['id_aluno'=>$id_aluno])->value(nome);
			$sobrenome = alunos::where(['id_aluno'=>$id_aluno])->value(sobrenome);
			$id_item = $_POST['id_item'];
			$id_livro = itens::where(['id_item'=>$id_item])->value(id_livro);
			$titulo = livros::where(['id_livro'=>$id_livro])->value(titulo);
			$status = 0;
			$data_saida = date("Y-m-d");
			$data_limite = date("Y-m-d", strtotime('+14 days'));
			$data_retorno = null;
			$dias_atraso = 0;

			saidas::insert(['id_aluno' => $id_aluno, 'nome' => $nome, 'sobrenome' => $sobrenome, 'id_item' => $id_item, 'titulo' => $titulo, '_status' => $status, 'data_saida' => $data_saida, 'data_limite' => $data_limite, 'data_retorno' => $data_retorno, 'dias_atraso' => $dias_atraso]);
			itens::where(['id_item'=>$id_item])->update(['_status'=>0]);

			header('Location: ../paginas_adm/saidas_consulta.php');
			exit();
			break;

		case 'itens':

			itens::insert(['ativo'=>1, 'id_livro' => $_GET['id'], '_status' => 1]);

			header('Location: ../paginas_adm/livros_detalhes.php?id='.$_GET['id']);
			exit();
			break;
	}

	

?>
