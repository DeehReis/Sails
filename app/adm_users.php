<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;

	class adm_users extends Model{

		protected $table = "adm_users";
		public $timestamps = false;
		protected $primaryKey = "id_adm";
		protected $fillable = [
			'ativo', 'nome', 'sobrenome', 'nascimento', 'cidade', 'login', 'senha', 'email', 'ddd', 'telefone'
		];
	}