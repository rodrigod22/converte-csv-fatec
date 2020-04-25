<?php
session_start();
define('DIR_DOWNLOAD', 'csv/');
$arquivo = "aluno".$_SESSION['nome_arquivo'].".csv";
$caminho_download = DIR_DOWNLOAD . $arquivo;
if (!file_exists($caminho_download))
    die('Arquivo não existe!');
header('Content-type: octet/stream');
header('Content-disposition: attachment; filename="' . $arquivo . '";');
header('Content-Length: ' . filesize($caminho_download));
readfile($caminho_download);
unlink($caminho_download);
exit;