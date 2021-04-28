<?php

function definirNomeArquivo($arquivo, $extensao) {
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyz';
    $nome_foto_array = explode(' ', $arquivo);
    $nome_foto = implode('_', $nome_foto_array); 
    $sufixo = '';
    for($i=0; $i<10; $i++) {
        $sufixo.=substr($caracteres, rand(0, strlen($caracteres)-1), 1);
    }
    return $nome_foto.'_'.$sufixo.'.'.$extensao;
}

?>