<?php

	require __DIR__ . '/vendor/autoload.php';

	use Illuminate\Database\Capsule\Manager as Capsule;
	use Illuminate\Events\Dispatcher;
	use Illuminate\Container\Container;

	use App\User;

	$capsule = new Capsule;

	$capsule->addConnection([
	    'driver'    => 'mysql',
	    'host'      => 'localhost',
	    'database'  => 'biblioteca_db',
	    'username'  => 'root',
	    'password'  => 'admin@0906',
	    'charset'   => 'utf8',
	    'collation' => 'utf8_unicode_ci',
	    'prefix'    => '',
	]);

	$capsule->setEventDispatcher(new Dispatcher(new Container));

	// Make this Capsule instance available globally via static methods... (optional)
	$capsule->setAsGlobal();

	// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
	$capsule->bootEloquent();

	/* User::create([
		"name"=>"Andre",
		"email"=>"andretritolareis@gmail.com",
		"password"=>"teste123",
	]); */

?>