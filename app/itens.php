<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;

	class itens extends Model{

		protected $table = "itens";
		public $timestamps = false;
		protected $primaryKey = "id_item";
		protected $fillable = [
			'ativo','id_livro'
		];
	}