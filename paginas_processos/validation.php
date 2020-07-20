<?php

	// Verificação para login
	
	require __DIR__ .'../../vendor/autoload.php';
	require __DIR__ .'../../database.php';

	use App\adm_users;
	use App\alunos;

	// Verificar se os campos estão vazios

	if(empty($_POST['login'])||empty($_POST['senha'])){
		header('Location: ../index.php');
		exit();
	}

	$login = $_POST['login'];
	$senha = $_POST['senha'];

	// Check de login adm

	$check_adm = adm_users::where(['login'=>$login, 'senha'=>$senha]) -> get();

	// Check de login aluno

	$check_aluno = alunos::where(['cod_aluno'=>$login, 'senha'=>$senha]) -> get();

	// Verificações de login e inicio de SESSION

	if(count($check_adm)>0){
		session_start();
		$_SESSION['log'] = 1;
		$_SESSION['login'] = $login;
		header('Location: ..\paginas_adm\home_adm.php');
		exit();
	}
	else if(count($check_aluno)>0){
		session_start();
		$_SESSION['log'] = 2;
		$_SESSION['login'] = $login;
		header('Location: ..\paginas_aluno\home_aluno.php');
		exit();
	}
	else{
		session_start();
		$_SESSION['log'] = 3;
		header('Location: ../index.php');
		exit();
	}





?>