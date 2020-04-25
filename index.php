<?php session_start(); $_SESSION['nome_arquivo'] = date('d-m-Y-H-m-s').random_int(1,1000);?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="assets/css/estilo.css"/>
<!--    <link rel="stylesheet" href="assets/css/reset.css"/>-->
<!--    <link rel="stylesheet" href="assets/css/normalize.css"/>-->

</head>
<body>
<div class="container-fluid p-0">
    <div class="header bg-secondary">
        <div class="colorBranco font1-2 text-center p-3"><img src="assets/img/logoNovoPB.png" alt="rpa-sistemas"> </div>
        <div class="colorBranco font1-2 text-center p-2">CONVERTE CSV FATEC</div>
    </div>
    <div class="container">
       <div class="text-center mt-4"> <h3>Observações</h3></div>
       <div class="my-auto text-left">
           <div class="mb-4 mt-4">O arquivo a ser convertido deve vir no formato csv com os campos no header
                "RA", "ALUNO", "EMAIL", "TURNO", "CPF", "CURSO", "DISCIPLINA" o arquivo sera convertido para o formato
            especificado para importação no moodle onde o username sera a matricula siga o exemplo abaixo:</div>
            <div class="mb-4"><img src="assets/img/exemplo.JPG" class="img-fluid" alt="exemplo csv"/> </div>
            <div>Os nomes do campo "CURSO" devem ser "ADS", "GE", "GP", "LOG" e "SI" e no campo "TURNO" para Manha "M", Tarde "T" e Noite "N"
                exatamente assim para converter para o nome abreviado do moodle</div>
            <div class="mensagem"></div>
            <div class="form-group">
                <form action="app/Controller/conversor.php" method="post" id="form" enctype="multipart/form-data">
                    <div class="file-field mt-4">
                        <div><label for="csv" class="font1-2 font-weight-bolder">Escolha o arquivo csv</label></div>
                        <div class="btn btn-dark btn-sm">
                            <input type="file" name="csv" id="csv">
                        </div>
                        <div><input type="submit" value="enviar" class="btn btn-secondary mt-4"></div>
                    </div>
                </form>
                <div class="loading" id="load"></div>
            </div>
       </div>
    </div>
</div>
<div class="footer bg-secondary d-flex align-items-center justify-content-center colorBranco flex-column text-center"  id="footer">
    <div class="mt-1 ">Todos os direitos reservado Fatec_RL by Rodrigo Peixoto</div>
    <div class="mt-1">rodrigo.peixoto@fatec.sp.gov.br</div>
</div>
<script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/scriptAjax.js"></script>
</body>
</html>