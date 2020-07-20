<?php

	// Página de login

	require __DIR__ . '/vendor/autoload.php';
	require 'database.php';

	session_start();

?>

<!DOCTYPE html>
<html>
	<head>

		<base href="Sails" />

		<title>Login - Sails</title>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link rel="stylesheet" type="text/css" href="css\styles.css">

		<!-- Bootstrap CSS -->

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	</head>
	<body style="background-color: #f2f2f2;">

		<!-- Logo e divisória -->

		<div id="logo">
			<h1><img src="imagens/logo.png"></h1>
			<p><i>"Desbrave um oceano de conhecimento"</i></p>
		</div>
		<div class="menuDiv">
			<br>
			<br>
		</div>

		<!-- Formulário de login e mensagem de erro, DESKTOP -->

		<div class="d-none d-sm-block">
			<div class="login">
				<p style="font-size: 15px;">Acesse com seu usuário de aluno ou administrador</p>
				<hr>

				<?php
					if(isset($_SESSION['log']) && $_SESSION['log'] == 3){

						?>

						<div class="erro">
							Credenciais incorretas. Por favor tente novamente.
						</div>
						<br>

						<?php
					}
				?>

				<form action="paginas_processos/validation.php" method="post">
					<input type="text" name="login" placeholder="Login"><br><br>
					<input type="password" name="senha" placeholder="Senha"><br><br><br>
					<input type="submit" value="Acessar" class="acessar">
				</form>

			</div>
		</div>

		<!-- Formulário de login e mensagem de erro, DESKTOP -->

		<div  class="d-block d-sm-none">
			<div style="text-align: center">
				<br>
				<p style="font-size: 15px;">Acesse com seu usuário de aluno ou administrador</p>
				<hr>

				<?php
					if(isset($_SESSION['log']) && $_SESSION['log'] == 2){
						?>
						<div class="erro">
							Credenciais incorretas. Por favor tente novamente.
						</div>
						<br>
						<?php
					}
				?>

				<form action="paginas_processos/validation.php" method="post">
					<input type="text" name="login" placeholder="Login"><br><br>
					<input type="password" name="senha" placeholder="Senha"><br><br><br>
					<input type="submit" value="Acessar" class="acessar">
				</form>

				<br><br>
			</div>
		</div>

		<!-- Footer da página -->

		<?php include "paginas_include/footer.html"; ?>
		
	</body>

		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</html>

<?php

	// Unsets para limpar 'session' de log

	unset($_SESSION['log']);

?>
