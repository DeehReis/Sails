<?php

	// Cálculos para manter informações de dias atrasos, quantidades de livros com aluno em vários status e valores de multa atualizadas, antes de serem exibidas

	use App\saidas;
	use App\alunos;
	use App\itens;
	use App\livros;
		
	$var_saidas = saidas::where(['_status'=>0])->get();
		
	foreach ($var_saidas as $key => $value) {
		$data_atual = new DateTime(date('Y-m-d'));
		$data_limite = new DateTime(saidas::where(['id_saida'=>$value->id_saida])->value('data_limite'));

		$Diff = $data_limite->diff($data_atual);
		
		if($Diff->format('%r%a') > 0){
			saidas::where(['id_saida'=>$value->id_saida])->update(['dias_atraso'=>$Diff->format('%r%a')]);
		}
		else{
			saidas::where(['id_saida'=>$value->id_saida])->update(['dias_atraso'=>0]);
		}
	}

	$var_alunos = alunos::all();

	foreach ($var_alunos as $key => $value) {
						
		$total_livros = saidas::where(['id_aluno'=>$value->id_aluno])->where(['_status'=>0])->count();
		$var = alunos::where(['id_aluno'=>$value->id_aluno]);
		$var->update(['total_livros'=>$total_livros]);

		$total_atrasos = saidas::where(['id_aluno'=>$value->id_aluno])->where('dias_atraso','>',0)->where(['_status'=>0])->count();
		$var = alunos::where(['id_aluno'=>$value->id_aluno]);
		$var->update(['total_atrasos' => $total_atrasos]);

		$multa_ativa = (saidas::where(['id_aluno'=>$value->id_aluno])->where(['_status'=>0])->sum('dias_atraso')) * 1.25;
		$multa_passiva = alunos::where(['id_aluno'=>$value->id_aluno])->value('multa_passiva');
		$nova_multa = $multa_ativa + $multa_passiva;
		alunos::where(['id_aluno'=>$value->id_aluno])->update(['total_multa' => $nova_multa]);

	}

?>