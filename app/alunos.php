<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;

	class alunos extends Model{

		protected $table = "alunos";
		public $timestamps = false;
		protected $primaryKey = "id_aluno";
		protected $fillable = [
			'ativo','cod_aluno','nome','sobrenome', 'sexo', 'nascimento', 'cidade', 'curso', 'serie', 'semestre', 'email', 'ddd', 'telefone', 'login', 'senha', 
			'total_livros', 'total_atrasos', 'total_multa'
		];
	}