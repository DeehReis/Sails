<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;

	class livros extends Model{

		protected $table = "livros";
		public $timestamps = false;
		protected $primaryKey = "id_livro";
		protected $fillable = [
			'ativo','titulo','autor','editora', 'ano_edicao', 'volume', 'categoria'
		];
	}