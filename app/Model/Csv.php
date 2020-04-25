<?php

namespace App\Model;

use League\Csv\Reader;
use League\Csv\Statement;

class Csv
{
    private $alunos;

    public function leCsv($csv)
    {
        $stream = fopen($csv, 'r');
        $csv = Reader::createFromStream($stream)->setOutputBOM(Reader::BOM_UTF8);
        $csv->setDelimiter(';');
        $csv->setHeaderOffset(0);
        $stmt = (new Statement());
        $this->alunos = $stmt->process($csv);
    }

    public function validaCsv($planilha, $ext){
        if($planilha == null || $ext != '.csv'){
            echo '1';
            exit;
        }
        $this->leCsv($planilha);
        $records = $this->getAlunos();
        if(!array_key_exists('ALUNO', $records[1]) || !array_key_exists('RA', $records[1]) || !array_key_exists('CPF', $records[1]) ||
            !array_key_exists('CURSO', $records[1]) || !array_key_exists('TURNO', $records[1]) || !array_key_exists('SIGLA', $records[1]) ||
            !array_key_exists('DISCIPLINA', $records[1]) || !array_key_exists('EMAIL', $records[1])){
            echo "2";
            exit;
        }
        return $this->getAlunos();
    }

    public function criaCsv($alunos, $nomeArquivo)
    {
        $stream = fopen(__DIR__ . "/../../csv/aluno$nomeArquivo.csv",'w');
        $csvw = \League\Csv\Writer::createFromStream($stream);
        $csvw->insertOne([
            'username', 'password', 'firstname', 'lastname', 'email', 'course1', 'course2', 'course3',
            'course4', 'course5', 'course6', 'course7', 'course8', 'course9', 'course10', 'course11',
            'course12', 'course13', 'course14', 'course15', 'course16', 'course17', 'course18',
        ]);

        foreach ($alunos as $record){
            $disciplina[1] = $disciplina[2] = $disciplina[3] = $disciplina[4] = $disciplina[5] = null;
            $disciplina[6] = $disciplina[7] = $disciplina[8] = $disciplina[9] = $disciplina[10] = null;
            $disciplina[11] = $disciplina[12] = $disciplina[13] = $disciplina[14] = $disciplina[15] = null;
            $disciplina[16] = $disciplina[17] = $disciplina[18] = null;

            for($i = 1; $i <= 18; $i++){
                if(isset($record['disciplina'][$i-1])){
                    $disciplina[$i] = $record['disciplina'][$i-1];
                }else{
                    $disciplina[$i] == null;
                }
            }
            $csvw->insertOne([
                $record['username'], $record['password'], $record['firstname'], $record['lastname'], $record['email'],
                $disciplina[1], $disciplina[2], $disciplina[3], $disciplina[4], $disciplina[5], $disciplina[6], $disciplina[7],
                $disciplina[8], $disciplina[9], $disciplina[10], $disciplina[11], $disciplina[12], $disciplina[13], $disciplina[14],
                $disciplina[15], $disciplina[16], $disciplina[17], $disciplina[18],
            ]);
        }
    }
    public function getAlunos()
    {
        return iterator_to_array($this->alunos);
    }
}