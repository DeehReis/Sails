<?php

	// Finalização de SESSION de login

	session_start();
	session_destroy();
	header('Location: ../index.php');
	exit();

?>