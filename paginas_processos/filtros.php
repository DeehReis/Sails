<?php

	// Código responsável por identificar quais filtros foram selecionados, selecionar esse filtro e envia-lo para a página que fez o solicitação, juntamente com os dados necessários para marcar na thead o que esta sendo filtrado

	// O código determina quais as opções de filtragem por um switch com a variável 'pg', dentro de cada case existe outro switch, que escolhe dependendo da combinação de filtros solicitada como vai ser filtrado o conteudo do banco, e qual thead marcar

	// A filtragem ocorre após o código determinar e enviar para a página o comando da query correto, que vai ser utilizado no lugar do filtro padrão

	// O filtro é determinado ao clicar no nome da coluna em uma tabela nas páginas de consulta, com exceção do filtro ATIVO/INATIVO que é determinado a parte, ao selecionar uma das opções do 'radio' e clicar em filtrar

	require __DIR__ .'../../vendor/autoload.php';
	require __DIR__ .'../../database.php';

	use App\alunos;
	use App\adm_users;
	use App\itens;
	use App\livros;
	use App\saidas;

	session_start();

	$pagina = $_GET['pg'];

	switch ($pagina) {
		case 'alunos':
				// FILTROS ALUNOS:

			if(!($_GET['filtro_1'])){
				$_GET['filtro_1'] = 1;
			}

			if(!($_GET['filtro_2'])){
				$_GET['filtro_2'] = "Cod";
			}

			$filtro_1 = $_GET['filtro_1'];
			$filtro_2 = $_GET['filtro_2'];

			$_SESSION['filtrar_alunos'] = $filtro_1.$filtro_2;

			switch ($_SESSION['filtrar_alunos']) {
				
				case '1Cod':
				$_SESSION['filtrar_alunos'] = alunos::orderBy('cod_aluno','ASC')->get();
				$_SESSION['atual'] = 'atual_asc';
					break;

				case '1Nome':
				$_SESSION['filtrar_alunos'] = alunos::orderBy('nome','ASC')->get();
				$_SESSION['atual'] = 'atual_asc';
					break;
					
				case '1Sexo':
				$_SESSION['filtrar_alunos'] = alunos::orderBy('sexo','ASC')->get();
				$_SESSION['atual'] = 'atual_asc';
					break;

				case '1Nasci':
				$_SESSION['filtrar_alunos'] = alunos::orderBy('nascimento','ASC')->get();
				$_SESSION['atual'] = 'atual_asc';
					break;

				case '1Cidade':
				$_SESSION['filtrar_alunos'] = alunos::orderBy('cidade','ASC')->get();
				$_SESSION['atual'] = 'atual_asc';
					break;

				case '1Curso':
				$_SESSION['filtrar_alunos'] = alunos::orderBy('curso','ASC')->get();
				$_SESSION['atual'] = 'atual_asc';
					break;
					
				case '1Serie':
				$_SESSION['filtrar_alunos'] = alunos::orderBy('serie','ASC')->get();
				$_SESSION['atual'] = 'atual_asc';
					break;

				case '1Email':
				$_SESSION['filtrar_alunos'] = alunos::orderBy('email','ASC')->get();
				$_SESSION['atual'] = 'atual_asc';
					break;	

				case '1Fone':
				$_SESSION['filtrar_alunos'] = alunos::orderBy('telefone','ASC')->get();
				$_SESSION['atual'] = 'atual_asc';
					break;

				case '1Livros':
				$_SESSION['filtrar_alunos'] = alunos::orderBy('total_livros','ASC')->get();
				$_SESSION['atual'] = 'atual_asc';
					break;

				case '1Atrasos':
				$_SESSION['filtrar_alunos'] = alunos::orderBy('total_atrasos','ASC')->get();
				$_SESSION['atual'] = 'atual_asc';
					break;

				case '1Multa':
				$_SESSION['filtrar_alunos'] = alunos::orderBy('total_multa','ASC')->get();
				$_SESSION['atual'] = 'atual_asc';
					break;

				case '2Cod':
				$_SESSION['filtrar_alunos'] = alunos::orderBy('cod_aluno','DESC')->get();
				$_SESSION['atual'] = 'atual_desc';
					break;

				case '2Nome':
				$_SESSION['filtrar_alunos'] = alunos::orderBy('nome','DESC')->get();
				$_SESSION['atual'] = 'atual_desc';
					break;
					
				case '2Sexo':
				$_SESSION['filtrar_alunos'] = alunos::orderBy('sexo','DESC')->get();
				$_SESSION['atual'] = 'atual_desc';
					break;

				case '2Nasci':
				$_SESSION['filtrar_alunos'] = alunos::orderBy('nascimento','DESC')->get();
				$_SESSION['atual'] = 'atual_desc';
					break;

				case '2Cidade':
				$_SESSION['filtrar_alunos'] = alunos::orderBy('cidade','DESC')->get();
				$_SESSION['atual'] = 'atual_desc';
					break;

				case '2Curso':
				$_SESSION['filtrar_alunos'] = alunos::orderBy('curso','DESC')->get();
				$_SESSION['atual'] = 'atual_desc';
					break;
					
				case '2Serie':
				$_SESSION['filtrar_alunos'] = alunos::orderBy('serie','DESC')->get();
				$_SESSION['atual'] = 'atual_desc';
					break;

				case '2Email':
				$_SESSION['filtrar_alunos'] = alunos::orderBy('email','DESC')->get();
				$_SESSION['atual'] = 'atual_desc';
					break;	

				case '2Fone':
				$_SESSION['filtrar_alunos'] = alunos::orderBy('telefone','DESC')->get();
				$_SESSION['atual'] = 'atual_desc';
					break;

				case '2Livros':
				$_SESSION['filtrar_alunos'] = alunos::orderBy('total_livros','DESC')->get();
				$_SESSION['atual'] = 'atual_desc';
					break;

				case '2Atrasos':
				$_SESSION['filtrar_alunos'] = alunos::orderBy('total_atrasos','DESC')->get();
				$_SESSION['atual'] = 'atual_desc';
					break;

				case '2Multa':
				$_SESSION['filtrar_alunos'] = alunos::orderBy('total_multa','DESC')->get();
				$_SESSION['atual'] = 'atual_desc';
					break;

			}
			if($filtro_1==1){
				$filtro_1++; 
			}
			else{
				$filtro_1=1; 
			}

			$_SESSION['filtro_1'] = $filtro_1;
			$_SESSION['filtro_2'] = $filtro_2;

			if(!(empty($_POST['exibir']))){
				$_SESSION['exibir'] = $_POST['exibir'];
			}

			header('Location: ../paginas_adm/alunos_consulta.php');
			exit();
			break;
		
		case 'livros':
			if(!$_GET['filtro_1']){
				$_GET['filtro_1'] = 1;
			}

			if(!$_GET['filtro_2']){
				$_GET['filtro_2'] = Titulo;
			}

			$filtro_1 = $_GET['filtro_1'];
			$filtro_2 = $_GET['filtro_2'];

			$_SESSION['filtrar_livros'] = $filtro_1.$filtro_2;

			switch ($_SESSION['filtrar_livros']) {
				case '1Titulo':
					$_SESSION['filtrar_livros'] = livros::orderBy('titulo','ASC')->get();
					$_SESSION['atual'] = 'atual_asc';
					break;
				
				case '1Autor':
					$_SESSION['filtrar_livros'] = livros::orderBy('autor','ASC')->get();
					$_SESSION['atual'] = 'atual_asc';
					break;

				case '1Editora':
					$_SESSION['filtrar_livros'] = livros::orderBy('editora','ASC')->get();
					$_SESSION['atual'] = 'atual_asc';
					break;

				case '1Edicao':
					$_SESSION['filtrar_livros'] = livros::orderBy('ano_edicao','ASC')->get();
					$_SESSION['atual'] = 'atual_asc';
					break;

				case '1Volume':
					$_SESSION['filtrar_livros'] = livros::orderBy('volume','ASC')->get();
					$_SESSION['atual'] = 'atual_asc';
					break;

				case '1Categoria':
					$_SESSION['filtrar_livros'] = livros::orderBy('categoria','ASC')->get();
					$_SESSION['atual'] = 'atual_asc';
					break;

				case '2Titulo':
					$_SESSION['filtrar_livros'] = livros::orderBy('titulo','DESC')->get();
					$_SESSION['atual'] = 'atual_desc';
					break;
				
				case '2Autor':
					$_SESSION['filtrar_livros'] = livros::orderBy('autor','DESC')->get();
					$_SESSION['atual'] = 'atual_desc';
					break;

				case '2Editora':
					$_SESSION['filtrar_livros'] = livros::orderBy('editora','DESC')->get();
					$_SESSION['atual'] = 'atual_desc';
					break;

				case '2Edicao':
					$_SESSION['filtrar_livros'] = livros::orderBy('ano_edicao','DESC')->get();
					$_SESSION['atual'] = 'atual_desc';
					break;

				case '2Volume':
					$_SESSION['filtrar_livros'] = livros::orderBy('volume','DESC')->get();
					$_SESSION['atual'] = 'atual_desc';
					break;

				case '2Categoria':
					$_SESSION['filtrar_livros'] = livros::orderBy('categoria','DESC')->get();
					$_SESSION['atual'] = 'atual_desc';
					break;
			}

			if($filtro_1==1){
				$filtro_1++; 
			}
			else{
				$filtro_1=1; 
			}

			$_SESSION['filtro_1'] = $filtro_1;
			$_SESSION['filtro_2'] = $filtro_2;
			
			if(!(empty($_POST['exibir']))){
				$_SESSION['exibir'] = $_POST['exibir'];
			}
			
			header('Location: ../paginas_adm/livros_consulta.php');
			exit();
			break;

		case 'livros_aluno':
			if(!$_GET['filtro_1']){
				$_GET['filtro_1'] = 1;
			}

			if(!$_GET['filtro_2']){
				$_GET['filtro_2'] = Titulo;
			}

			$filtro_1 = $_GET['filtro_1'];
			$filtro_2 = $_GET['filtro_2'];

			$_SESSION['filtrar_livros'] = $filtro_1.$filtro_2;

			switch ($_SESSION['filtrar_livros']) {
				case '1Titulo':
					$_SESSION['filtrar_livros'] = livros::orderBy('titulo','ASC')->get();
					$_SESSION['atual'] = 'atual_asc';
					break;
				
				case '1Autor':
					$_SESSION['filtrar_livros'] = livros::orderBy('autor','ASC')->get();
					$_SESSION['atual'] = 'atual_asc';
					break;

				case '1Editora':
					$_SESSION['filtrar_livros'] = livros::orderBy('editora','ASC')->get();
					$_SESSION['atual'] = 'atual_asc';
					break;

				case '1Edicao':
					$_SESSION['filtrar_livros'] = livros::orderBy('ano_edicao','ASC')->get();
					$_SESSION['atual'] = 'atual_asc';
					break;

				case '1Volume':
					$_SESSION['filtrar_livros'] = livros::orderBy('volume','ASC')->get();
					$_SESSION['atual'] = 'atual_asc';
					break;

				case '1Categoria':
					$_SESSION['filtrar_livros'] = livros::orderBy('categoria','ASC')->get();
					$_SESSION['atual'] = 'atual_asc';
					break;

				case '2Titulo':
					$_SESSION['filtrar_livros'] = livros::orderBy('titulo','DESC')->get();
					$_SESSION['atual'] = 'atual_desc';
					break;
				
				case '2Autor':
					$_SESSION['filtrar_livros'] = livros::orderBy('autor','DESC')->get();
					$_SESSION['atual'] = 'atual_desc';
					break;

				case '2Editora':
					$_SESSION['filtrar_livros'] = livros::orderBy('editora','DESC')->get();
					$_SESSION['atual'] = 'atual_desc';
					break;

				case '2Edicao':
					$_SESSION['filtrar_livros'] = livros::orderBy('ano_edicao','DESC')->get();
					$_SESSION['atual'] = 'atual_desc';
					break;

				case '2Volume':
					$_SESSION['filtrar_livros'] = livros::orderBy('volume','DESC')->get();
					$_SESSION['atual'] = 'atual_desc';
					break;

				case '2Categoria':
					$_SESSION['filtrar_livros'] = livros::orderBy('categoria','DESC')->get();
					$_SESSION['atual'] = 'atual_desc';
					break;
			}

			if($filtro_1==1){
				$filtro_1++; 
			}
			else{
				$filtro_1=1; 
			}

			$_SESSION['filtro_1'] = $filtro_1;
			$_SESSION['filtro_2'] = $filtro_2;
			
			if(!(empty($_POST['exibir']))){
				$_SESSION['exibir'] = $_POST['exibir'];
			}
			
			header('Location: ../paginas_aluno/livros_consulta_aluno.php');
			exit();
			break;

		case 'adms':
			if(!$_GET['filtro_1']){
				$_GET['filtro_1'] = 1;
			}

			if(!$_GET['filtro_2']){
				$_GET['filtro_2'] = ID;
			}

			$filtro_1 = $_GET['filtro_1'];
			$filtro_2 = $_GET['filtro_2'];

			$_SESSION['filtrar_adms'] = $filtro_1.$filtro_2;

			switch ($_SESSION['filtrar_adms']) {
				
				case '1ID':
				$_SESSION['filtrar_adms'] = adm_users::orderBy('id_adm','ASC')->get();
				$_SESSION['atual'] = 'atual_asc';
					break;

				case '1Nome':
				$_SESSION['filtrar_adms'] = adm_users::orderBy('nome','ASC')->get();
				$_SESSION['atual'] = 'atual_asc';
					break;
					
				case '1Sexo':
				$_SESSION['filtrar_adms'] = adm_users::orderBy('sexo','ASC')->get();
				$_SESSION['atual'] = 'atual_asc';
					break;

				case '1Nasci':
				$_SESSION['filtrar_adms'] = adm_users::orderBy('nascimento','ASC')->get();
				$_SESSION['atual'] = 'atual_asc';
					break;

				case '1Cidade':
				$_SESSION['filtrar_adms'] = adm_users::orderBy('cidade','ASC')->get();
				$_SESSION['atual'] = 'atual_asc';
					break;

				case '1Email':
				$_SESSION['filtrar_adms'] = adm_users::orderBy('email','ASC')->get();
				$_SESSION['atual'] = 'atual_asc';
					break;	

				case '1Fone':
				$_SESSION['filtrar_adms'] = adm_users::orderBy('telefone','ASC')->get();
				$_SESSION['atual'] = 'atual_asc';
					break;

				case '2ID':
				$_SESSION['filtrar_adms'] = adm_users::orderBy('id_adm','DESC')->get();
				$_SESSION['atual'] = 'atual_desc';
					break;

				case '2Nome':
				$_SESSION['filtrar_adms'] = adm_users::orderBy('nome','DESC')->get();
				$_SESSION['atual'] = 'atual_desc';
					break;
					
				case '2Sexo':
				$_SESSION['filtrar_adms'] = adm_users::orderBy('sexo','DESC')->get();
				$_SESSION['atual'] = 'atual_desc';
					break;

				case '2Nasci':
				$_SESSION['filtrar_adms'] = adm_users::orderBy('nascimento','DESC')->get();
				$_SESSION['atual'] = 'atual_desc';
					break;

				case '2Cidade':
				$_SESSION['filtrar_adms'] = adm_users::orderBy('cidade','DESC')->get();
				$_SESSION['atual'] = 'atual_desc';
					break;

				case '2Email':
				$_SESSION['filtrar_adms'] = adm_users::orderBy('email','DESC')->get();
				$_SESSION['atual'] = 'atual_desc';
					break;	

				case '2Fone':
				$_SESSION['filtrar_adms'] = adm_users::orderBy('telefone','DESC')->get();
				$_SESSION['atual'] = 'atual_desc';
					break;

			}
			if($filtro_1==1){
				$filtro_1++; 
			}
			else{
				$filtro_1=1; 
			}

			$_SESSION['filtro_1'] = $filtro_1;
			$_SESSION['filtro_2'] = $filtro_2;

			if(!(empty($_POST['exibir']))){
				$_SESSION['exibir'] = $_POST['exibir'];
			}

			header('Location: ../paginas_adm/adms_consulta.php');
			exit();

			break;

		case 'saidas':
			if(!$_GET['filtro_1']){
				$_GET['filtro_1'] = 1;
			}

			if(!$_GET['filtro_2']){
				$_GET['filtro_2'] = ID_saidas;
			}

			$filtro_1 = $_GET['filtro_1'];
			$filtro_2 = $_GET['filtro_2'];

			$_SESSION['filtrar_saidas'] = $filtro_1.$filtro_2;

			switch ($_SESSION['filtrar_saidas']) {
				
				case '1id_saida':
				$_SESSION['filtrar_saidas'] = saidas::orderBy('id_saida','ASC')->get();
				$_SESSION['atual'] = 'atual_asc';
					break;

				case '1id_aluno':
				$_SESSION['filtrar_saidas'] = saidas::orderBy('id_aluno','ASC')->get();
				$_SESSION['atual'] = 'atual_asc';
					break;
					
				case '1Nome':
				$_SESSION['filtrar_saidas'] = saidas::orderBy('nome','ASC')->get();
				$_SESSION['atual'] = 'atual_asc';
					break;

				case '1id_item':
				$_SESSION['filtrar_saidas'] = saidas::orderBy('id_item','ASC')->get();
				$_SESSION['atual'] = 'atual_asc';
					break;

				case '1Titulo':
				$_SESSION['filtrar_saidas'] = saidas::orderBy('titulo','ASC')->get();
				$_SESSION['atual'] = 'atual_asc';
					break;

				case '1Status':
				$_SESSION['filtrar_saidas'] = saidas::orderBy('_status','ASC')->get();
				$_SESSION['atual'] = 'atual_asc';
					break;
					
				case '1data_saida':
				$_SESSION['filtrar_saidas'] = saidas::orderBy('data_saida','ASC')->get();
				$_SESSION['atual'] = 'atual_asc';
					break;

				case '1data_limite':
				$_SESSION['filtrar_saidas'] = saidas::orderBy('data_limite','ASC')->get();
				$_SESSION['atual'] = 'atual_asc';
					break;	

				case '1data_retorno':
				$_SESSION['filtrar_saidas'] = saidas::orderBy('data_retorno','ASC')->get();
				$_SESSION['atual'] = 'atual_asc';
					break;

				case '1dias_atraso':
				$_SESSION['filtrar_saidas'] = saidas::orderBy('dias_atraso','ASC')->get();
				$_SESSION['atual'] = 'atual_asc';
					break;

				case '2id_saida':
				$_SESSION['filtrar_saidas'] = saidas::orderBy('id_saida','DESC')->get();
				$_SESSION['atual'] = 'atual_desc';
					break;

				case '2id_aluno':
				$_SESSION['filtrar_saidas'] = saidas::orderBy('id_aluno','DESC')->get();
				$_SESSION['atual'] = 'atual_desc';
					break;
					
				case '2Nome':
				$_SESSION['filtrar_saidas'] = saidas::orderBy('nome','DESC')->get();
				$_SESSION['atual'] = 'atual_desc';
					break;

				case '2id_item':
				$_SESSION['filtrar_saidas'] = saidas::orderBy('id_item','DESC')->get();
				$_SESSION['atual'] = 'atual_desc';
					break;

				case '2Titulo':
				$_SESSION['filtrar_saidas'] = saidas::orderBy('titulo','DESC')->get();
				$_SESSION['atual'] = 'atual_desc';
					break;

				case '2Status':
				$_SESSION['filtrar_saidas'] = saidas::orderBy('_status','DESC')->get();
				$_SESSION['atual'] = 'atual_desc';
					break;
					
				case '2data_saida':
				$_SESSION['filtrar_saidas'] = saidas::orderBy('data_saida','DESC')->get();
				$_SESSION['atual'] = 'atual_desc';
					break;

				case '2data_limite':
				$_SESSION['filtrar_saidas'] = saidas::orderBy('data_limite','DESC')->get();
				$_SESSION['atual'] = 'atual_desc';
					break;	

				case '2data_retorno':
				$_SESSION['filtrar_saidas'] = saidas::orderBy('data_retorno','DESC')->get();
				$_SESSION['atual'] = 'atual_desc';
					break;

				case '2dias_atraso':
				$_SESSION['filtrar_saidas'] = saidas::orderBy('dias_atraso','DESC')->get();
				$_SESSION['atual'] = 'atual_desc';
					break;

			}
			if($filtro_1==1){
				$filtro_1++; 
			}
			else{
				$filtro_1=1; 
			}

			$_SESSION['filtro_1'] = $filtro_1;
			$_SESSION['filtro_2'] = $filtro_2;

			if(!(empty($_POST['exibir']))){
				$_SESSION['exibir'] = $_POST['exibir'];
			}

			header('Location: ../paginas_adm/saidas_consulta.php');
			exit();
			break;
	}

?>