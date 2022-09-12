<?php 
    include '../../../../conexao.php';

    session_start();

    $cd_obs = $_POST['cd_obs'];


    echo $cons_pp = "DELETE FROM passagem_plantao.OBSERVACAO_PACIENTE oe WHERE oe.CD_OBSERVACAO = $cd_obs";

    //UNIFICANDO CONSULTA COM A CONEXAO
    $result_pp = oci_parse($conn_ora,$cons_pp);

    //EXECUTANDO A CONSULTA NA CONEXAO INFORMADA
    oci_execute($result_pp);



?>