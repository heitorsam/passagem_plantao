<?php 
    include '../../../../conexao.php';

    session_start();

    $usuario = $_SESSION['usuarioLogin'];

    $obs = $_POST['obs'];

    $setor = $_POST['setor'];


    echo $cons_pp = "INSERT INTO passagem_plantao.OBSERVACAO_INTERCORRENCIA
                    SELECT passagem_plantao.seq_obs_intercorrencia.NEXTVAL CD_OBSERVACAO,
                    $setor AS CD_SETOR,
                    NULL AS CD_DURANTE,
                    '$usuario' AS CD_USUARIO_CRIACAO,
                    SYSDATE AS HR_CRIACAO,
                    '$obs' AS OBSERVACAO
                    FROM DUAL";

    //UNIFICANDO CONSULTA COM A CONEXAO
    $result_pp = oci_parse($conn_ora,$cons_pp);

    //EXECUTANDO A CONSULTA NA CONEXAO INFORMADA
    oci_execute($result_pp);



?>