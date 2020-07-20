<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;

	class saidas extends Model{

		protected $table = "saidas";
		public $timestamps = false;
		protected $primaryKey = "id_saida";
		protected $fillable = [
			'id_aluno', 'nome', 'sobrenome', 'id_item', 'titulo', '_status', 'data_saida', 'data_limite', 'data_retorno', 'dias_atraso'
			
		];
	}