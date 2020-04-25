<?php
session_start();
require '../../vendor/autoload.php';

use App\Model\Csv;
$nomeArquivo = $_SESSION['nome_arquivo'];
$planilha = $_FILES['csv']['tmp_name'];
$ext = substr($_FILES['csv']['name'], strrpos($_FILES['csv']['name'], '.'));
$csv = new Csv();
$records = $csv->validaCsv($planilha, $ext);
$alunos = array();
$alunosCursos = array();

foreach ($records as $key1 => $a) {
    $lastname = null;
    $nomeCompleto = explode(" ", $a['ALUNO']);
    $cont = count($nomeCompleto);
    $firstname = $nomeCompleto[0];
    for ($i = 0; $i < $cont; $i++) {
        if ($i != 0) {
            $lastname .= $nomeCompleto[$i] . " ";
        }
    }
    $disciplina = $a['SIGLA'] . "-" . $a['CURSO'] . "-" . $a['TURNO'];
    array_push($alunos, ['disciplina' => array($disciplina), 'username' => $a["RA"], 'password' => $a["CPF"],
        'firstname' => $firstname, 'lastname' => trim($lastname), 'email' => $a['EMAIL'],]);
}

foreach ($alunos as $key => $valor) {
    if (array_search($valor['username'], array_column($alunosCursos, 'username')) === false) {
        array_push($alunosCursos, $valor);
    } else {
        foreach ($alunosCursos as $key => $ac) {
            if ($ac['username'] == $valor['username']) {
                if (!array_search($valor['disciplina'][0], $alunosCursos[$key]['disciplina'])) {
                    array_push($alunosCursos[$key]['disciplina'], $valor['disciplina'][0]);
                }
            }
        }
    }
    unset($alunos[$key]);
}
$csv->criaCsv($alunosCursos, $nomeArquivo);


