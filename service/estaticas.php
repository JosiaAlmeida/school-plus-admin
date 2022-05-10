<?php
$candidaturas;
$candidaturasMasculinas;
$candidaturasFemininas;
$selecionados;
$alunos = array();
$alunosNaoSelecionado = array();
try {
    $queryTotalCandidatura = "select Count(*) 'total' from candidatura";
    $totalCandidatura = $myslq_i->query($queryTotalCandidatura);
    $result = array();
    while($row = $totalCandidatura->fetch_assoc()){
        extract($row);
        $item = array(
            'total'=>$total
        );
        array_push($result, $item);
    }
    $candidaturas = $result[0]['total'];

    $queryTotalCandidaturaFeminino = "select count(*) 'total' from candidatura where sexo='F'";
    $totalCandidaturaFemininas = $myslq_i->query($queryTotalCandidaturaFeminino);
    $result = array();
    while($row = $totalCandidaturaFemininas->fetch_assoc()){
        extract($row);
        $item = array(
            'total'=>$total
        );
        array_push($result, $item);
    }
    $candidaturasFemininas = $result[0]['total'];

    $queryTotalCandidaturaMasculino = "select count(*) 'total' from candidatura where sexo='M'";
    $totalCandidaturaMasculino = $myslq_i->query($queryTotalCandidaturaMasculino);
    $result = array();
    while($row = $totalCandidaturaMasculino->fetch_assoc()){
        extract($row);
        $item = array(
            'total'=>$total
        );
        array_push($result, $item);
    }
    $candidaturasMasculinas = $result[0]['total'];

    $queryTotalCandidaturaSelecionados = "select count(*) 'total' from candidatura where selecionado=0";
    $totalCandidaturaSelecionado = $myslq_i->query($queryTotalCandidaturaSelecionados);
    $result = array();
    while($row = $totalCandidaturaSelecionado->fetch_assoc()){
        extract($row);
        $item = array(
            'total'=>$total
        );
        array_push($result, $item);
    }
    $selecionados = $result[0]['total'];

    $queryAluno = "SELECT cd.nome,cd.escola_antiga, cd.idade, cd.telefone, cd.bi, cd.sexo, cd.media, cd.selecionado, cs.nome 'Curso' FROM candidatura as cd join curso as cs where cd.selecionado=1 and cd.Curso_id=cs.id";
    $alunosCandidatura = $myslq_i->query($queryAluno);
    $result = array();
    while($row = $alunosCandidatura->fetch_assoc()){
        extract($row);
        $item = array(
            'id'=>$id,
            'nome'=>$nome,
            'idade'=>$idade,
            'telefone'=>$telefone,
            'bi'=>$bi,
            'sexo'=>$sexo,
            'escola_antiga'=>$escola_antiga,
            'media'=>$media,
            'selecionado'=>$selecionado,
            'Curso'=>$Curso,
        );
        array_push($result, $item);
    }
    $alunos = $result;

    $queryAlunoNaoAceito = "SELECT cd.id ,cd.nome, cd.idade, cd.escola_antiga, cd.telefone, cd.bi, cd.sexo, cd.media, cd.selecionado, cs.nome 'Curso' FROM candidatura as cd join curso as cs where cd.selecionado=0 and cd.Curso_id=cs.id";
    $alunosCandidaturaNaoAptos = $myslq_i->query($queryAlunoNaoAceito);
    $result = array();
    while($row = $alunosCandidaturaNaoAptos->fetch_assoc()){
        extract($row);
        $item = array(
            'id'=>$id,
            'nome'=>$nome,
            'idade'=>$idade,
            'telefone'=>$telefone,
            'bi'=>$bi,
            'sexo'=>$sexo,
            'escola_antiga'=>$escola_antiga,
            'media'=>$media,
            'selecionado'=>$selecionado,
            'Curso'=>$Curso,
        );
        array_push($result, $item);
    }
    $alunosNaoSelecionado = $result;
  } catch (\Throwable $th) {
    echo $th->getMessage();
}
