<?php

    if(!isset($_POST['frm_usuario'])){

        @$var_frm_usuario = $_SESSION['usu_pesquisado'];

    }else {

        $var_frm_usuario = $_POST['frm_usuario'];
        $_SESSION['usu_pesquisado'] = $_POST['frm_usuario'];

    }

    $consulta_usuario = "SELECT usu.CD_USUARIO, usu.NM_USUARIO,
    prest.CD_TIP_PRESTA, tp.NM_TIP_PRESTA
    FROM dbamv.PRESTADOR prest
    INNER JOIN dbamv.TIP_PRESTA tp
    ON tp.CD_TIP_PRESTA = prest.CD_TIP_PRESTA
    INNER JOIN dbasgu.USUARIOS usu
    ON usu.CD_PRESTADOR = prest.CD_PRESTADOR
    WHERE usu.CD_USUARIO = '$var_frm_usuario'
    AND prest.TP_SITUACAO = 'A'
    AND prest.CD_TIP_PRESTA = 4
    ORDER BY prest.NM_PRESTADOR ASC";


    //UNIFICANDO CONSULTA COM A CONEXAO
    $result_usuario = oci_parse($conn_ora,$consulta_usuario);

    //EXECUTANDO A CONSULTA NA CONEXAO INFORMADA
    oci_execute($result_usuario);

    //EXEMPLO PARA QUANDO TRAS APENAS UM RESULTADO
    //OCI_FETCH_ARRAY TRANSFORMA O RESULTADO EM UM TABELA
    $row_usu = oci_fetch_array($result_usuario);

    $var_cod = $row_usu['CD_USUARIO'];
    $var_nome = $row_usu['NM_USUARIO'];
    $var_funcao = $row_usu['NM_TIP_PRESTA']



    //EXEMPLO PARA MAIS DE UM RESULTADO
    //while($row_oracle = oci_fetch_array($result_oracle)){
    //}






















?>